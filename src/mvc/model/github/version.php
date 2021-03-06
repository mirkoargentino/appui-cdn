<?php
/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 16/12/2016
 * Time: 11:48
 */
/** @var $model \bbn\mvc\model */
if ( !empty($model->data['git_user']) && !empty($model->data['git_repo']) && defined('BBN_GITHUB_TOKEN') ){
  $git = new \Github\Client();
  $git->authenticate(BBN_GITHUB_TOKEN, Github\Client::AUTH_HTTP_TOKEN);

  $dependencies = '';

  // If you don't have a version's ID get the link of the latest release from GitHub
  if ( empty($model->data['git_id_ver']) || ( $model->data['git_id_ver'] === $model->data['git_latest_ver'] )){
    // If you don't have the latest name's version get it from the tags
    if ( empty($model->data['git_latest_ver']) ){
      $tags = $git->api('repo')->tags($model->data['git_user'], $model->data['git_repo']);
      if ( !empty($tags) ){
        $version_name = $tag[0]['name'];
      }
    }
    else {
      $version_name = $model->data['git_latest_ver'];
    }
    $down_url = 'https://github.com/'.$model->data['git_user'].'/'.$model->data['git_repo'].'/archive/'.$version_name.'.zip';
  }

  // Get version by ID
  if ( !empty($model->data['git_id_ver']) &&
    ( $model->data['git_id_ver'] !== $model->data['git_latest_ver'] ) &&
    // Get version's info
    ($version = \bbn\x::to_object($git->api('repo')->releases()->show($model->data['git_user'], $model->data['git_repo'], $model->data['git_id_ver'])))
  ){
    // Version's name
    $version_name = $version->name;
    // Get assets
    if ( $ass = $git->api('repo')->releases()->assets()->all($model->data['git_user'], $model->data['git_repo'], $model->data['git_id_ver']) ){
      $down_url = $ass[0]['browser_download_url'];
    }
    else if ( !empty($version->zipball_url) ){
      $down_url = $version->zipball_url;
    }
    else {
      $down_url = 'https://github.com/'.$model->data['git_user'].'/'.$model->data['git_repo'].'/archive/'.$version_name.'.zip';
    }
  }

  // Get dependencies
  if ( !empty($version_name) &&
    $git->api('repo')->contents()->exists(
      $model->data['git_user'],
      $model->data['git_repo'],
      'bower.json',
      $version_name
    ) &&
    ($bower = json_decode($git->api('repo')->contents()->download(
      $model->data['git_user'],
      $model->data['git_repo'],
      'bower.json',
      $version_name
    ), true)) &&
    !empty($bower['dependencies'])
  ){
    foreach ( $bower['dependencies'] as $l => $v ){
      $dependencies .= "<div>$l $v</div>";
    }
  }
  if ( !empty($down_url) && !empty($version_name) ){
    // Set the file's path
    $fz = BBN_USER_PATH.'tmp/'.basename($down_url);
    // Download the version file
    file_put_contents($fz, fopen($down_url.'?access_token='.BBN_GITHUB_TOKEN, 'r', false, stream_context_create([
      'http' => [
        'header' => 'User-Agent: UserAgent/1.0',
      ]
    ])));
    if ( is_file($fz) ){
      // Extract the zip file
      $zip = new ZipArchive();
      if ( $zip->open($fz) === true ){
        $path = $model->data['lib_path'].$version_name.'/';
        if ( is_dir($path) ){
          \bbn\file\dir::delete($path);
        }
        if ( \bbn\file\dir::create_path($path) &&
          $zip->extractTo($path)
        ){
          // Delete the zip file
          \bbn\file\dir::delete($fz);
          // Delete the first directory (move its children files|directories to the root version's directory)
          $dirs = \bbn\file\dir::get_dirs($path);
          foreach ( \bbn\file\dir::get_files($dirs[0], true) as $dir ){
            \bbn\file\dir::move($dir, $path.basename($dir));
          }
          \bbn\file\dir::delete($dirs[0]);

          return [
            'success' => true,
            'version' => $version_name,
            'dependencies' => $dependencies
          ];
        }
      }
    }
  }

}
return ['success' => false];