
$(document).ready(function() {
	subHeader();
});


//subHeader
function subHeader(){
	if(($('#mainbanner').length > 0)) return;
	$('.ft_info').attr('data-show','active');
}


$(document).ready(function() {
	
	//피씨버전 상단메뉴 시작
	$('#gnb .gnb_1dli').hover(function() {
		$('ul.gnb_2dul', this).slideDown(200);
		$('ul.gnb_2dul', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul.gnb_2dul', this).slideUp(200);
		$('ul.gnb_2dul', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
	//피씨쪽 상단메뉴 끝

	//모바일 좌측메뉴 해쉬태그
	$(function (){
		hashload();
		//해쉬태그 레이어 슬라이드
		$(window).hashchange(function(){
			var hashTag = location.hash;
			hashAjax(hashTag);
	
		}).hashchange();
	});


    //답변 열고닫기
    $('.shipFaq dt').click(function(){
        if($('+dd',this).is(':hidden')){
            $('.shipFaq dt').removeClass('on').next().slideUp('fast');
            $(this).toggleClass('on').next().slideDown('fast');
        } else {
            $(this).toggleClass('on').next().slideUp('fast');
        }
        return false;
    });




});

$(document).ready(function() {
			//REVIEW
	  var swiper = new Swiper(".photo_slide", {
			spaceBetween: 20,
			loop:false,
			autoplay: {
              delay: 6000,
              disableOnInteraction: false,
			},
			slidesPerView :'3',
			 scrollbar: {
			  el: ".swiper-scrollbar",
			  hide: true,
			},

			breakpoints: {
			  640: {
				slidesPerView: 1,
				spaceBetween: 20,
			  },
			  950: {
				slidesPerView: 2,
				spaceBetween: 20,
			  },
			},
	  });


  });