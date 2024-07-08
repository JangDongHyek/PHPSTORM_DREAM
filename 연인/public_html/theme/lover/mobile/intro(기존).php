<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_THEME_PATH.'/head.sub.php');
?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/mobile.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

<div class="intro_btn"> 
    <ul>
        <li><a href="<?=G5_BBS_URL?>/login.php">로그인</a></li><!--
        --><li><a href="<?=G5_BBS_URL?>/register_form.php">회원가입</a></li>
    </ul>
</div>

<div id="idx_container">

	 <div class="visual">
        <div class="intro_con_area">
            <p class="b_margin10">담당 헬퍼시스템으로 원하시는 이상형을<br />실시간으로 소개해 드리고 있습니다.</p>
            <h3><span>"연인"</span>에서 만나 인연이 연인으로</h3>
        </div>
     </div>
    
    <!--인트로 롤링 비주얼--> 
     <div id="rolling_tab" class="swiper-container">
		<div class="swiper-wrapper">
			 <div class="swiper-slide"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll01.png" alt="" style="width:100%"/></a></div>
             <div class="swiper-slide"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll02.png" alt="" style="width:100%"/></a></div>
             <div class="swiper-slide"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll03.png" alt="" style="width:100%"/></a></div>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<!--<div class="swiper-button-next hidden-lg hidden-md"></div>
		<div class="swiper-button-prev hidden-lg hidden-md"></div>-->
    </div>
    <!--//인트로 롤링 비주얼-->

	<script>;
    var swiper = new Swiper('#rolling_tab', {
		pagination: '.swiper-pagination',
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',
		paginationClickable: true,
		speed: 1200,
		spaceBetween: 0,
		centeredSlides: true,
		autoplay: 5000,
		//mousewheelControl: true,
		autoplayDisableOnInteraction: false,
		loop:true,
	});
    </script>
    
    
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>