


////패밀리사이트
$(document).ready(function(){
	$(".fs dt").click(function(){
		$(".fs dd").toggle();
	});
	$(".fs dd").click(function(){
		$(this).hide();
	});
});



$(window).load(function  () {
	$('.line1').each(function () {
		 $( this ).addClass( "on");
		});
  });




//내용 탭패널
$(function(){
	$("ul.panel li:not("+$("ul.tab li a.selected").attr("href")+")").hide();
	$("ul.tab li a").click(function(){
		$("ul.tab li a").removeClass("selected");
		$(this).addClass("selected");
		$("ul.panel li").hide();
		$($(this).attr("href")).show();
		return false;
		})
})

//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});


//와우js
$(document).ready(function(){
	new WOW().init();
});








$(document).ready(function(){

      var swiper = new Swiper(".imgList", {
			
			slidesPerView: "2.5",
			spaceBetween:50,	
			speed:800,
			centeredSlides: true,
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
				delay : 10000,   // 시간 설정					
				disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			},
			  breakpoints: { 
				  768: {
						slidesPerView: 1.5,
						spaceBetween:10,	
	
					  }

			  },


      })

      var swiper = new Swiper(".imgList2", {
			
			slidesPerView: "1.3",
			spaceBetween:50,	
			speed:500,
			centeredSlides: true,
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
				delay : 10000,   // 시간 설정					
				disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			},
			  breakpoints: { 
				  768: {
						slidesPerView: 1.5,
						spaceBetween:10,	
	
					  }

			  },


      })
      var swiper = new Swiper(".imgList3", {
			
			slidesPerView: "2",
			 loop : true,
			spaceBetween:10,	
			speed:500,
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
				delay : 10000,   // 시간 설정					
				disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			},
			  breakpoints: { 
				  768: {
						slidesPerView: 1,
						spaceBetween:0,	
	
					  }

			  },


      });









});







