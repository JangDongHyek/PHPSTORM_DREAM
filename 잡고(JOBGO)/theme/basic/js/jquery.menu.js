$(document).ready(function() {	
	$('.gnb_1dli').hover(function() {
		//$('ul.gnb_2dul', this).fadeIn(400);
		$('ul.gnb_2dul', this).fadeIn(0);
		$('ul.gnb_2dul', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		//$('ul.gnb_2dul', this).fadeOut(400);
		$('ul.gnb_2dul', this).fadeOut(0);
		$('ul.gnb_2dul', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});

	$('.gnb_1dli.all_menu > .gnb_2dul > .gnb_2dli').hover(function() {
		$(this).children('.gnb_2dli_list').css('display','block');
	}, function() {
		$('.gnb_2dli_list').css('display','none');
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