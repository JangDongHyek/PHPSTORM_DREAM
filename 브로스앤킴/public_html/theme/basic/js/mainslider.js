//bx메인슬라이더시작
$(document).ready(function(){
  $('.sliderbx').bxSlider({
	  responsive : true,            // 반응형
	  mode : 'fade',           		// 'horizontal', 'vertical', 'fade'
	  pager : true,                 // 페이지버튼 사용유무
	  Controls : false,              // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 5000,                  // 자동재생간격
	  speed : 1000,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
	  });
});