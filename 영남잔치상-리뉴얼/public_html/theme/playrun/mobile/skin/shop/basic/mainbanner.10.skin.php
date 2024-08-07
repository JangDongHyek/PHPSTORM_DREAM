<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/swiper.min.css">', 10);
add_javascript('<script src="'.G5_THEME_JS_URL.'/swiper.min.js"></script>', 10);

?>
<style>
	.swiper-slide{overflow:hidden; border-radius:5px}
</style>  

<div class="swiper-container main_bnr_slide wow fadeInDown">

    <div class="swiper-wrapper">
        <!--<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/mainvisual.jpg" alt="">
             <div class="m_text">
                <p>딱 하나뿐인 나만의 원목가구</p>
            				<h2>Hestia Gagu Gallery</h2>
            </div> 
        </div>-->
        <!--<div class="swiper-slide">
					<img src="<?php echo G5_THEME_IMG_URL; ?>/main/mainvisual.jpg" alt="">

             <div class="m_text">
                <p>딱 하나뿐인 나만의 원목가구</p>
            				<h2>Hestia Gagu Gallery</h2>
            </div> 
        </div>-->
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows 
    <div class="swiper-button-next hidden-lg hidden-md"></div>
    <div class="swiper-button-prev hidden-lg hidden-md"></div>
	-->
</div>

<script>
    var swiper = new Swiper('.main_bnr_slide', {
      spaceBetween: 0,
      centeredSlides: true,
    paginationClickable: true,
    speed: 1200,
    spaceBetween: 0,
    centeredSlides: true,
    autoplay: 5000,
    //mousewheelControl: true,
    autoplayDisableOnInteraction: false,
    loop:true,
      //autoplay: {
      //  delay: 2500,
      //  disableOnInteraction: false,
      //},
      pagination: {
        el: '.main_bnr_slide .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.main_bnr_slide .swiper-button-next',
        prevEl: '.main_bnr_slide .swiper-button-prev',
      },
    });
</script>
