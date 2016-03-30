function strripos(haystack, needle, offset) {
  //  discuss at: http://phpjs.org/functions/strripos/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Onno Marsman
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //    input by: saulius
  //   example 1: strripos('Kevin van Zonneveld', 'E');
  //   returns 1: 16

  haystack = (haystack + '')
    .toLowerCase();
  needle = (needle + '')
    .toLowerCase();

  var i = -1;
  if (offset) {
    i = (haystack + '')
      .slice(offset)
      .lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
    // while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
    if (i !== -1) {
      i += offset;
    }
  } else {
    i = (haystack + '')
      .lastIndexOf(needle);
  }
  return i >= 0 ? i : false;
}

jQuery(document).ready(function($) {	
    $('*:first-child').addClass('first-child');
    $('*:last-child').addClass('last-child');
    $('*:nth-child(even)').addClass('even');
    $('*:nth-child(odd)').addClass('odd');
	
    var numwidgets = $('.footer-widgets section.widget').length;
    $('.footer-widgets').addClass('cols-'+numwidgets);
    var cols = 12/numwidgets;
    $('.footer-widgets section.widget').addClass('col-sm-'+cols);
    $('.footer-widgets section.widget').addClass('col-xs-12');
	
	//special for lifestyle
	$('.ftr-menu ul.menu>li').after(function(){
		if(!$(this).hasClass('last-child') && $(this).hasClass('menu-item') && $(this).css('display')!=='none'){
			return '<li class="separator">|</li>';
		}
	});

    $('.gform_footer').append(function(){
        return $(this).parent().find('.gform_body .move-to-gform-footer');
    });
    
    var formwrapper = $('.site-header .wrap .header-widget-area .gform_widget .gform_wrapper');
    $('.site-header .wrap .header-widget-area .gform_widget .widget-title,.site-header .gform_widget .gform_post_footer .button,.site-header .gform_widget .gform_post_footer .button').click(function(){
        if(!formwrapper.hasClass('open_form')){
            formwrapper.addClass('open_form');
        } else {
            formwrapper.removeClass('open_form');
        }
    });
});
