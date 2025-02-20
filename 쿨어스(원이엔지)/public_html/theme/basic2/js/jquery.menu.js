$(document).ready(function() {
	var w = $(window).width();
	if(w < 1700){
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

	} else if (w > 1700) {
	
		$(document).ready(function() {	
			//PC 전체메뉴 슬라이드업다운
			$('#hd').hover(function() {
				$('#sub').slideToggle("normal")
				$('#hd_wrapper').css({background:"#fff"});
				$('#hd').addClass('on');
			}, function() {
				$('#sub').hide();
				$('#hd_wrapper').css({background:"transparent"});
					if(sct>=130){
						// #header에 클래스on이 추가됨.
						$("#hd").addClass("on");
						};
					// 만약 sct의 값이 150미만이면
					if(sct<=130){
						$("#hd").removeClass("on");
						}
			});
		});
	}
	

});


