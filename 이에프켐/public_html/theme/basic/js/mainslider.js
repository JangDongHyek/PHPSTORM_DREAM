//bx메인배너시작
//$(document).ready(function(){
//  $('.mbn').bxSlider({
//	  responsive : true,            // 반응형
//	  mode : 'horizontal',           // 'horizontal', 'vertical', 'fade'
//	  pager : false,                 // 페이지버튼 사용유무
//	  Controls : true,              // 좌우버튼 사용유무
//	  auto : true,                  // 자동재생
//	  pause : 5000,                  // 자동재생간격
//	  speed : 500,                  // 이미지전환속도
//	  autoControls : true,          // 재생버튼 사용
//	  autoControlsCombine : true,   // 플레이, 스탑버튼 교차
//	  });
//});


//bx메인슬라이더시작
$(document).ready(function(){
  $('.sliderbx').bxSlider({
	  responsive : true,            // 반응형
	  mode : 'fade',           // 'horizontal', 'vertical', 'fade'
	  pager : true,                 // 페이지버튼 사용유무
	  Controls : true,              // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 6000,                  // 자동재생간격
	  speed : 1500,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
	  });
});


//메인/서브 텍스트
$(document).ready(function(){
	//메인 pc
	$('#visual #slogan .img01').delay(500).animate({top:'100px',opacity:'1.0'}, 1000);
	$('#visual #slogan .img02').delay(1000).animate({top:'155px',opacity:'1.0'}, 1200);
	$('#visual #slogan .mt').delay(1500).animate({top:'260px',opacity:'1.0'}, 1200);
	
	//메인 mobile
	$('#visual #mslogan').delay(100).animate({top:'30%',opacity:'1.0'}, 1000);
	
	//서브 pc
	$('.subTop .s_text').delay(300).animate({top:'43px',opacity:'1.0'}, 1000);
	$('.subTop span').delay(300).animate({top:'40px',opacity:'1.0'}, 1000);
	$('.subTop .st01').delay(600).animate({top:'40px',opacity:'1.0'}, 1400);
	$('.subTop .st02').delay(600).animate({top:'40px',opacity:'1.0'}, 1800);
});



