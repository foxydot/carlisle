jQuery(document).ready(function($){$("p:empty").remove(),$("body *:first-child").addClass("first-child"),$("body *:last-child").addClass("last-child"),$("body *:nth-child(even)").addClass("even"),$("body *:nth-child(odd)").addClass("odd"),$("body").css("opacity","1");var s=$("#footer-widgets div.widget").length;$("#footer-widgets").addClass("cols-"+s),$.each(["show","hide"],function(s,a){var e=$.fn[a];$.fn[a]=function(){return this.trigger(a),e.apply(this,arguments)}}),$(".nav-header ul.menu>li").after(function(){if(!$(this).hasClass("last-child")&&$(this).hasClass("menu-item")&&"none"!=$(this).css("display"))return'<li class="separator">|</li>'}),$(".nav-footer ul.menu>li").after(function(){if(!$(this).hasClass("last-child")&&$(this).hasClass("menu-item")&&"none"!=$(this).css("display"))return'<li class="separator">|</li>'}),$(".nav-primary .menu>li.menu-item>.sub-menu").css("width",function(){return $(this).parent(".menu-item").width()+"px"}),$(".section.expandable .expand").click(function(){var s=$(this).parents(".section-body").find(".content");console.log(s),s.hasClass("open")?(s.removeClass("open"),$(this).html('MORE <i class="fa fa-angle-down"></i>')):(s.addClass("open"),$(this).html('LESS <i class="fa fa-angle-up"></i>'))}),$('a[href$=".pdf"]').prop("target","_blank")});