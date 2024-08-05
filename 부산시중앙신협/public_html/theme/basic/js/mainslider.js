
$(document).ready(function(){
	$('.mainfull').fullpage({
		autoScrolling:true,
		scrollHorizontally: true,
		anchors:['01', '02','03','04','05','06'],
		navigation: false,
		controlArrows: true,
		responsiveWidth: 1280,
		scrollingSpeed: 500,
		slidesNavigation: true,

		onLeave: function(origin, destination, direction){	
			var leavingSection = this;
		
            if(origin.index == 0 && direction == 'down'){
                $('#section2 .bg').addClass('kenburns-top');
            }            
            else if(origin.index == 1 && direction == 'down'){
                $('.mainvideo .slick-slide').addClass('animate__animated animate__pulse');
				$('#section2 .bg').removeClass('kenburns-top');
           }         
        },
		css3:false,
		scrollOverflow:true,
		normalScrollElements: '#mem_04',		



	});




      var swiper = new Swiper(".mainVisual", {		
			loop:true,
			speed : 1500,
			resistance : true,
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
			delay : 3000,   // 시간 설정					
			disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			},
			
			//pagination: {
			//  el: '.swiper-pagination',
			//		clickable: true,
			//	renderBullet: function (index, className) {
			//	  return '<span class="' + className + '">' + (menu[index]) + '</span>';
			//	},
			//},
			pagination: {
			  el: ".swiper-pagination",
			  type: "fraction",
			},

        grabCursor: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            shadow: true,
            translate: ["0", 0, -1],
          },
          next: {
            translate: ["100%", 0, 0],
          },
        },
loopAdditionalSlides: 1
   
      });

      var swiper = new Swiper(".noti_slide", {
			slidesPerView: 2,
			spaceBetween:30,
			navigation : { // 네비게이션 설정					
				nextEl : '#section4 .swiper-button-next', // 다음 버튼 클래스명				
				prevEl : '#section4 .swiper-button-prev', // 이번 버튼 클래스명				
			},					
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
			delay : 3000,   // 시간 설정					
			disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			},
			  breakpoints: { 
				  768: { slidesPerView:3,spaceBetween:10
				  }
			  }

      });

      var swiper = new Swiper(".lct_slide", {
			slidesPerView: 1,
			speed : 1000,
			navigation : { // 네비게이션 설정					
				nextEl : '.swiper-button-next', // 다음 버튼 클래스명				
				prevEl : '.swiper-button-prev', // 이번 버튼 클래스명				
			},					
			autoplay : {  // 자동 슬라이드 설정 , 비 활성화 시 false					
				delay : 800000,   // 시간 설정					
				disableOnInteraction : false,  // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음					
			}
      });

	$('.membership').fullpage({
		autoScrolling:false,
		scrollHorizontally: true,
		anchors:['01', '02','03','04','05','06'],
		navigation: false,
		navigationTooltips: ['01', '02', '03', '04', '05', '06'],
		controlArrows: true,
		responsiveWidth: 1280,
		scrollingSpeed: 500,
		slidesNavigation: true,
		verticalCentered: false,
		css3:false,
		scrollOverflow:true,
		normalScrollElements: '#mem_04',		

	});



	//main btm style
	$(".main_btn_box ul li").hover(function() {
		$(this).siblings().addClass("off");
		$(this).removeClass("off");
	});
	$(".main_btn_box ul li").mouseleave(function() {
		$(this).siblings().removeClass("off");
		$(this).removeClass("off");
	});

});



$(document).ready(function(){
		$('.membership2').fullpage({
		css3:true,
		scrollHorizontally: true,
		anchors:['01', '02','03','04','05','06'],
		navigation: false,
		navigationTooltips: ['01', '02', '03', '04', '05', '06'],
		controlArrows: true,
		responsiveWidth: 1280,
		scrollingSpeed: 800,
		slidesNavigation: false,
		onLeave: function(origin, destination, direction){	
			var leavingSection = this;
		
            if(origin.index == 0 && direction == 'down'){
                $('.ver_priv h3').addClass('text-focus-in');
            }            
            else if(origin.index == 1 && direction == 'down'){
                $('.ver_golf h3').addClass('text-focus-in');
           }         
            else if(origin.index == 2 && direction == 'down'){
                $('.ver_trav h3').addClass('text-focus-in');
           }         
            else if(origin.index == 3 && direction == 'down'){
                $('.ver_cafe h3').addClass('text-focus-in');
           }         
            else if(origin.index == 4 && direction == 'down'){
                $('.ver_card h3').addClass('text-focus-in');
           }         
        },

	})
});




setTimeout(function(){
	$('#fullpage #section0').addClass('ver2');
}, 4000);


setTimeout(function(){
	$('#fullpage #section0').addClass('ver3');
}, 6500);