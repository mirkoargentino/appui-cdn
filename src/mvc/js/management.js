// CDN tabstrip
var isActivated = false,
    cdnTabStrip = $("#pe49ajAssj3knvVvn323").kendoTabStrip({
      animation:  {
        open: {
          effects: "fadeIn"
        }
      },
      activate: function(a){
        if ( !isActivated ){
          bbn.fn.analyzeContent($("#pe49ajAssj3knvVvn323"), true);
          configurationsGridInit();
          librariesGridInit();
          isActivated = true;
          bbn.fn.analyze
        }
      }
    }).data("kendoTabStrip");

cdnTabStrip.trigger("activate");

// Main TabStrip container padding fix
$("#pe49ajAssj3knvVvn323").closest("div.k-content").css("padding", 0);