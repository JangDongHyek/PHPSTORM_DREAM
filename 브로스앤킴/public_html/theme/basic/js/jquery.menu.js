//모바일 왼쪽날개메뉴
$(document).ready(function(){
	
	//모바일 왼쪽날개in 트리메뉴
	$(function(){
		$("ul.gnb_2dul").css("display","none");
		//$("ul.gnb_2dul:not(:first)").css("display","none");
		//$("a.gnb_1da:first").addClass("selected")
		$("a.gnb_1da").click(function(){
			if($("+ul.gnb_2dul", this).css("display")=="none"){
				$("ul.gnb_2dul").slideUp(300);
				$("+ul.gnb_2dul", this).slideDown(300);
				$("a.gnb_1da").removeClass("selected");
				$(this).addClass("selected");				
				}
			})
	});


	//window.onload = function(){
	//	var wrapHeight = $('body').height();
	//	$('#navtoggle').css("height", wrapHeight);
	//};
	/*$(window).resize(function() {
		var wrapHeight = $('body').height();
		$('#navtoggle, #mask').css("height", wrapHeight);
	});
	$('.nav_open').click(function(){
		var maskHeight = $('body').height();
		var maskWidth = $(window).width();
		var nav =  $('#navtoggle');
		$('#mask').css({
			'display'	: 'block',
			'opacity'	: 0.7,
			'height'	: maskHeight,
			'width'		: maskWidth
		})
		nav.css('display','block');
		nav.animate({width:"80%",right:"0" }, 200);
		$('.inner').animate({right:"0"}, 200);
		$("body").css({overflow:'hidden',position:'fixed'})
	});
	$('.nav_close, #mask').click(function(){
		var nav =  $('#navtoggle');
		$('#mask').css('display','none');
		$('.inner').animate({right:"0"}, 200);
		nav.animate({
			width		:"0",
		}, 200, function(){nav.css('display','none')});
		$("body").css({overflow:'auto',position:'relative'})
	});*/





});	
