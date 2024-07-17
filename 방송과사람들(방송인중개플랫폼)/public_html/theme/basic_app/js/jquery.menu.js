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

/*/피씨버전 상단메뉴 시작
$(document).ready(function() {	
	$('#gnb .gnb_1dli').hover(function() {
		$('ul.gnb_2dul', this).slideDown(200);
		$('ul.gnb_2dul', this).css('display','block');
		//$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul.gnb_2dul', this).slideUp(200);
		$('ul.gnb_2dul', this).css('display','none');
		//$(this).children('a:first').removeClass("hov");		
	});
});
//피씨쪽 상단메뉴 끝*/


/*/피씨버전 전체상단메뉴 시작
$(document).ready(function() {	
	//PC 전체메뉴 슬라이드업다운
	$('nav#gnb').hover(function() {
		$('#sub').slideToggle("normal")
	}, function() {
		$('#sub').hide();
	});
	//닫기버튼
	$(".close").click(function(){
		$("#sub").hide();
	});

});*/

/*/3차메뉴 탭패널
$(function(){
	$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
	$("ul.tab li a").click(function(){
		$("ul.tab li a").removeClass("selected");
		$(this).addClass("selected");
		$("ul.panel li").hide();
		$($(this).attr("href")).show();
		return false;
		})
})

//모바일 좌측메뉴 해쉬태그
$(function (){
	hashload();
	//해쉬태그 레이어 슬라이드
	$(window).hashchange(function(){
		var hashTag = location.hash;
		hashAjax(hashTag);

	}).hashchange();
});*/