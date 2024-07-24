// JavaScript Document
$(function(){ // 실행틀 시작

	
	var menu = $(".gnb ul li");
	var contents = $("#content>section");
	
	$(window).scroll(function(){
       var sct = $(window).scrollTop();
       contents.each(function(){
         var tg = $(this);
         var i = tg.index() - 1;
			if($("#profile").offset().top-20>=sct){
					menu.find("a").removeClass('on');
			}
         if(tg.offset().top-20 <= sct){
         		menu.find("a").removeClass('on');
         		menu.find("a").eq(i).addClass('on');
         }
      });
    });

	
	$(".gnb li a").click(function(){
			var $anchor = $(this);
			var top = $("html, body").scrollTop();
			if( top == 0 ) top = $("body").scrollTop();
			$("html, body").stop().animate({scrollTop: $($anchor.attr("href")).offset().top}, 500,'swing');
			$(".gnb li a").removeClass("on");
			$anchor.addClass("on");
			return false;
	});
	$(".logo a").click(function(){
			var $anchor = $(this);
			var top = $("html, body").scrollTop();
			if( top == 0 ) top = $("body").scrollTop();
			$("html, body").stop().animate({scrollTop: $($anchor.attr("href")).offset().top}, 500,'swing');
			return false;
	});	
	$("#gobtn").click(function(){
			var $anchor = $(this);
			var top = $("html, body").scrollTop();
			if( top == 0 ) top = $("body").scrollTop();
			$("html, body").stop().animate({scrollTop: $($anchor.attr("href")).offset().top}, 500,'swing');
			return false;
	});	
	

}) // 실행틀 끝

$(document).ready(function() {	
	$('.gnb_1dli').hover(function() {
		$('ul.gnb_2dul', this).slideDown(200);
		$('ul.gnb_2dul', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul.gnb_2dul', this).slideUp(200);
		$('ul.gnb_2dul', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
});

$(document).ready(function() {
	//모바일 좌측메뉴 해쉬태그
	$(function (){
		hashload();
		//해쉬태그 레이어 슬라이드
		$(window).hashchange(function(){
			var hashTag = location.hash;
			hashAjax(hashTag);
	
		}).hashchange();
	});
	
});