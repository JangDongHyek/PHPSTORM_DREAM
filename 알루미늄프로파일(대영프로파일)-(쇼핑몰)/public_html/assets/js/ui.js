$(document).ready(function(){

	/*/ 스크롤이 발생 될 때
	$(window).scroll(function(){
		var sct = $(window).scrollTop();
		if(sct>=100){
			// #header에 클래스on이 추가됨.
			$("#header").addClass("on");
			};
		// 만약 sct의 값이 150미만이면
		if(sct<=100){
			$("#header").removeClass("on");
			}
	}); //스크롤이벤트끝*/

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




});	
