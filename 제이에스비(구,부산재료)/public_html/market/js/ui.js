//상단메뉴시작
$(document).ready(function() {	
	$('.gnb .m').hover(function() {
		$('.sub', this).slideDown(200);
		$('.sun', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('.sub', this).slideUp(200);
		$('.sub', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
});
//상단메뉴끝




//메인슬라이드시작
$(function(){ // 실행시작
	
	 $(".main_slider").slidesjs({
	   width:2000,
	   height:480,
	   navigation : {
		 active : true, // 좌우버튼사용하면 true, 아니면 false
		 //effect : "fade" // 좌우버튼 사용시 발생되는 효과지정.
	   }, pagination : {
		 active : true,
		 //effect : "fade"
	   }, play : {
		 active : true,
		// effect : "fade",
		 auto : true ,
		 interval: 5000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 3000,
				crossfade: true
		 } 
	   }
	 })
}) // 실행끝
//메인슬라이드끝





