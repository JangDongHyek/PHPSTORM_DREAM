//bx메인슬라이더시작
$(function(){
  $('.sliderbx').bxSlider({
	  //responsive : true,            // 반응형
	  mode: 'horizontal',          // 'horizontal', 'vertical', 'fade'
	  pager : true,                 // 페이지버튼 사용유무
	  Controls : true,              // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 3000,                  // 자동재생간격
	  speed : 1500,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
	  });
	  
});
