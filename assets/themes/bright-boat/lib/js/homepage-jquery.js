jQuery(document).ready(function($) {
    var numwidgets = $('#hp-top section.widget').length;
    $('#hp-top').addClass('cols-'+numwidgets);
    var cols = 12/numwidgets;
    $('#hp-top section.widget').addClass('col-sm-'+cols);
    $('#hp-top section.widget').addClass('col-xs-12');
});