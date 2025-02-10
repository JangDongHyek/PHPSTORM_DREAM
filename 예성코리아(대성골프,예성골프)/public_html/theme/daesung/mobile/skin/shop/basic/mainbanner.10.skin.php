<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/swiper.min.css">', 10);
add_javascript('<script src="'.G5_THEME_JS_URL.'/swiper.min.js"></script>', 10);

?>
<style>
	.swiper-slide{overflow:hidden;}

    #main_box .main-container .swiper-slide a{padding: 0; margin: 0; display: block; width: 100%; height: 100%;}
	.bg01{background: url(<?php echo G5_THEME_IMG_URL; ?>/main/main_visual01.png) no-repeat center center; background-size:cover !important;}
	.bg02{background: url(<?php echo G5_THEME_IMG_URL; ?>/main/main_visual02.png) no-repeat center center; background-size:cover !important;}
	.bg03{background: url(<?php echo G5_THEME_IMG_URL; ?>/main/main_visual03.png) no-repeat center center; background-size:cover !important;}
    @media (max-width: 767px){
        #main_box .main-container .swiper-slide{height: 250px !important;}
        .swiper-slide a img{height: 100%; width: 100%; object-fit: cover;}
    }
</style>  

<div class="main-container wow fadeInDown">

    <div class="swiper-wrapper">
        <div class="swiper-slide slider_size ">
            <a><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual01.png"></a>
            <!--div class="m_text">
				<h2><span class="txt_color01">호떡</span>시리즈</h2>
				<p>선미호떡가루는 반죽이 손에 달라붙지 않아 <br>고소하고 쫄~깃핫 맛을 내는 반죽을 손 쉽게 만들수 있어요!</p>
				<a href="< ?php echo G5_SHOP_URL; ?>/list.php?ca_id=10">상품보기</a>
            </div-->
        </div>
        <div class="swiper-slide slider_size ">
            <a><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual02.png"></a>
        </div>
        <div class="swiper-slide slider_size ">
            <a><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual03.png"></a>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows 	-->
    <div class="swiper-button-next4"></div>
    <div class="swiper-button-prev4"></div>

</div>

<script>
    var swiper = new Swiper('.main-container', {
              slidesPerView : 'auto', 
        spaceBetween : 0,
        loop : true, 
        loopAdditionalSlides : 1, 
        navigation : false, 
        pagination : false, 
        autoplay : {  
          delay : 5000,   
          disableOnInteraction : false,  
        },
        navigation: {  
          nextEl: '.swiper-button-next4',
          prevEl: '.swiper-button-prev4',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },        
        observer: true, 
        observeParents: true,
    });
</script>
