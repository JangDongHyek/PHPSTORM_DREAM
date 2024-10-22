var hover=0;
$(document).ready(function() {

	$(document).ready(function() {
		//PC 전체메뉴 슬라이드업다운
		$('#gnb').hover(function() {
			if(hover==0){
				$('.gnb_2dul').slideDown("normal")
				//$('#hd_wrapper').css({background:"rgba(255, 255, 255, 1)"});
				$('#hd').addClass('on');
			}
			setTimeout(function(){
				hover=0;
			},"1000");
			hover++;
		}, function() {

			$('.gnb_2dul').hide();
			$('#hd_wrapper').animate({background:"transparent"},3000);
			$("#hd").removeClass("on");

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




});
