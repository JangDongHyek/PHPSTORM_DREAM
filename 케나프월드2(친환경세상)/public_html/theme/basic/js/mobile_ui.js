//2017-07-04

//모바일-상단토글메뉴 시작
$(document).ready(function(){
	$(".btnMenu .bt1").click(function(){
		$(".blackBG").css("display","block");
		$(".side1").animate({left:0},500);
	   //$("움직일대상").animate({스타일속성:"값"},속도, 콜백함수)
		return false;
	});
	
	$(".side1 .closed").click(function(){
		$(".blackBG").css("display","none");
		$(".side1").animate({left:-300},500);
		return false;
	});

	$(".blackBG").click(function(){
		$(".blackBG").css("display","none");
		$(".side1").animate({left:-300},500);
		return false;
	});
});	
//모바일-상단토글메뉴 끝



//모바일-상하단버튼 시작
$(document).ready(function(){
	if($("#gobtn").length > 0) $("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		if($("#gobtn").length > 0){
			$(window).scroll(function () {
				if ($(this).scrollTop() > 50) {
					$('#gobtn').fadeIn();
				} else {
					$('#gobtn').fadeOut();
				}
			});
		}
	});

	$('.goHd').click(function($e){
		$('html, body').animate({scrollTop:0}); return false
	});
});	
//모바일-상하단버튼 끝



//갤러리썸네일 시작
$(document).ready(function(){
	$('.gallery_thumb').find('a').bind('click', function(){
		$('.gallery_img').find('img').attr('src',$(this).find('img').attr('src'));

		return false;
	});
});	
//갤러리썸네일 끝