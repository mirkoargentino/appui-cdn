<!-- New library -->
<script type="text/html" id="asioajfpasdhua89324hio38w9asdjlk">
  <div id="kjasdy723ri89asdhah8oasdaso892" style="display: none">
    <input type="hidden" name="old_name">
    <div class="appui-form-label appui-r"><?=_("Title")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="title" data-bind="value: title" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Folder name")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="new_name" data-bind="value: name" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Function name")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="fname" data-bind="value: fname" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Description")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="description" data-bind="value: description" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Author")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="author" data-bind="value: author" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Licence")?></div>
    <div class="appui-form-field">
      <select name="licence" data-bind="value: licence" style="width: 50%"></select>
    </div>

    <div class="appui-form-label appui-r"><?=_("Web site")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="website" data-bind="value: website" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Download")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="download_link" data-bind="value: download_link" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("Documentation")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="doc_link" data-bind="value: doc_link" type="text">
    </div>

    <div class="appui-form-label appui-r"><?=_("GitHub")?></div>
    <div class="appui-form-field">
      <input class="k-textbox appui-full-width" name="git" data-bind="value: git" type="text">
      <a class="k-button fa fa-download" title="<?=("Import library's info from GitHub")?>" data-bind="visible: git"></a>
    </div>

    <div class="appui-form-label appui-r"><?=_("Support")?></div>
    <div class="appui-form-field">
      <input class="k-textbox" name="support_link" data-bind="value: support_link" type="text">
    </div>

    <div class="appui-form-label appui-r" data-bind="visible: versions"><?=_("Version")?></div>
    <div class="appui-form-field" data-bind="visible: versions">
      <select name="git_id" style="width: 50%"></select>
    </div>
  </div>
</script>
