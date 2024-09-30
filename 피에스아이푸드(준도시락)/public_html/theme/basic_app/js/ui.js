//와우js
$(document).ready(function(){
	new WOW().init();
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

$(document).ready(function(){
  $('.sliderbx').bxSlider({
	  responsive : true,            // 반응형
	  mode : 'fade',           // 'horizontal', 'vertical', 'fade'
	  pager : true,                 // 페이지버튼 사용유무
	 //Controls : false,            // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 5000,                  // 자동재생간격
	  speed : 1000,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
	  });
});

 $(document).ready(function(){
     //    slick
     $('.slider_img').slick();
 });

