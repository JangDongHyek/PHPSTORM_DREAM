$(document).ready(function(){

/*
	$(window).scroll(function() {
		var currentPage = window.location.pathname; // 현재 페이지 경로 가져오기
		var sct = $(window).scrollTop();

		// 페이지가 '/medicinal2/'가 아닐 때만 스크롤 이벤트 적용
		if (currentPage !== '/medicinal2/') {
			if (sct >= 100) {
				$("#header").addClass("on");
			}
			if (sct <= 100) {
				$("#header").removeClass("on");
			}
		}
	}); // 스크롤 이벤트 끝
*/
    var swiper = new Swiper(".mainSwiper", {
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper = new Swiper(".examSwiper", {
        spaceBetween: 0,
        centeredSlides: true,
		effect:'fade',fadeEffect: { crossFade: true },
		autoHeight : true,
		autoplay: {
            delay: 7500,
            disableOnInteraction: false,
        },
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
			renderBullet: function (index, className) {
				return '<li class="' + className + '"><a>비교 견적 <span>예시&nbsp;' + (index + 1) + "</span></a></li>";
			},
		},
    });


});

$(document).ready(function(){
	// slider random init
	function return_index(div_elmt) {
		// swiper-slide 클래스 선언한 요소(div태그가 아닌 경우엔 해당 태그로) 갯수를 length로 카운트하고 math.random()으로 난수화
		var r_index = Math.floor( Math.random() * ($('div.' + div_elmt + ' .swiper-slide:not(.swiper-slide-duplicate)').length) );
		return parseInt(r_index);
	}

	// slider set
	var swiper_top = new Swiper('.drugs', {
		direction: "vertical",
		loop: true,
		paginationClickable: true,
		autoplay: {
			delay: 1000,
			disableOnInteraction: false,
		},
		initialSlide : return_index("drugs") // initialSlide옵션에 return_index함수 설정.
	});
});
