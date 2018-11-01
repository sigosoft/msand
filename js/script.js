

/*----------------------------------------------------*/
/*	header effact
/*----------------------------------------------------*/

function init() {
window.addEventListener('scroll', function(e){
var distanceY = window.pageYOffset || document.documentElement.scrollTop,
shrinkOn = 300,
header = document.querySelector("header");
if (distanceY > shrinkOn) {
classie.add(header,"smaller");
} else {
if (classie.has(header,"smaller")) {
classie.remove(header,"smaller");
}
}
});
}
window.onload = init();



/*--------------------------------------------------*/
/* Counter
/*--------------------------------------------------*/

$('.timer').countTo();
$('.counter-item').appear(function() {
$('.timer').countTo();
},{
accY: -100
});


/*----------------------------------------------------*/
/*	Nice-Scroll
/*----------------------------------------------------*/

$("html").niceScroll({
scrollspeed: 100,
mousescrollstep: 38,
cursorwidth: 10,
cursorborder: 0,
cursorcolor: '#6b1b78',
autohidemode: true,
zindex: 999999999,
horizrailenabled: false,
cursorborderradius: 0,
});

/*----------------------------------------------------*/
/*	jquery-accordion-menu
/*----------------------------------------------------*/

jQuery(document).ready(function () {
	jQuery("#jquery-accordion-menu").jqueryAccordionMenu();

});

$(function(){
	//顶部导航切换
	$("#demo-list li").click(function(){
		$("#demo-list li.active").removeClass("active")
		$(this).addClass("active");
	})
})






(function($) {
$.expr[":"].Contains = function(a, i, m) {
	return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};
function filterList(header, list) {
	//@header 头部元素
	//@list 无需列表
	//创建一个搜素表单
	var form = $("<form>").attr({
		"class":"filterform",
		action:"#"
	}), input = $("<input>").attr({
		"class":"filterinput",
		type:"text"
	});
	$(form).append(input).appendTo(header);
	$(input).change(function() {
		var filter = $(this).val();
		if (filter) {
			$matches = $(list).find("a:Contains(" + filter + ")").parent();
			$("li", list).not($matches).slideUp();
			$matches.slideDown();
		} else {
			$(list).find("li").slideDown();
		}
		return false;
	}).keyup(function() {
		$(this).change();
	});
}
$(function() {
	filterList($("#form"), $("#demo-list"));
});
})(jQuery);
