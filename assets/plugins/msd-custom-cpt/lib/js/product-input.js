(function($){
    $.fn.collapsible = function(options) {
                // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            header: "h3",
        }, options );
        $(this).addClass("ui-accordion ui-widget ui-helper-reset");
        var headers = $(this).find(settings.header);
        headers.addClass("accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all");
        headers.append('<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e">');
        headers.each(function(){
            $(this).next().hide();
        });
        headers.click(function() {
            var header = $(this);
            var panel = $(this).next();
            var isOpen = panel.is(":visible");
            if(isOpen)  {
                panel.slideUp("fast", function() {
                    panel.hide();
                    header.removeClass("ui-state-active")
                        .addClass("ui-state-default")
                        .children("span").removeClass("ui-icon-triangle-1-s")
                            .addClass("ui-icon-triangle-1-e");
              });
            }
            else {
                panel.slideDown("fast", function() {
                    panel.show();
                    header.removeClass("ui-state-default")
                        .addClass("ui-state-active")
                        .children("span").removeClass("ui-icon-triangle-1-e")
                            .addClass("ui-icon-triangle-1-s");
              });
            }
        });
        return true;
    }; 
}(jQuery));

jQuery(function($){
    $( "#wpa_loop-applications" )
      .collapsible({
        header: ".section_handle"
      });
          
    $("#postdivrich").after($("#_page_sectioned_metabox"));
});