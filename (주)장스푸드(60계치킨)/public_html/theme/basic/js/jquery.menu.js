$(document).ready(function() {
	
	/*/PC 전체메뉴 슬라이드업다운
	$('nav#gnb').hover(function() {
		$('#sub').slideToggle("normal")
	}, function() {
		$('#sub').hide();
	});
	//닫기버튼
	$(".close").click(function(){
		$("#sub").hide();
	});*/

	//메인 탭패널
	$(function(){
		$("ul.idx_panel > li:not("+$("ul.idx_tab > li > a.selected").attr("href")+")").hide();
		$("ul.idx_tab > li > a").click(function(){
			$("ul.idx_tab > li > a").removeClass("selected");
			$(this).addClass("selected");
			$("ul.idx_panel > li").hide();
			$($(this).attr("href")).show();
			return false;
			})
	})

	//3차메뉴 탭패널
	$(function(){
		$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
		$("ul.tab li > a").click(function(){
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
	});
	
});