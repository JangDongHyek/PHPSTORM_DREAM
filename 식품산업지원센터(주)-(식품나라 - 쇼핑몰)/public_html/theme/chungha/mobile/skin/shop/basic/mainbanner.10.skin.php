<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/swiper.min.css">', 10);
add_javascript('<script src="'.G5_THEME_JS_URL.'/swiper.min.js"></script>', 10);

?>
<style>
	.swiper-slide {
		overflow: hidden;
	}

	.swiper-slide>img {
		width: 100%;
	}

	.main_slide.mo {
		display: none;
	}

	@media(max-width:768px) {
		.main_slide.pc {
			display: none;
		}

		.main_slide.mo {
			display: block;
		}
	}

</style>

<div class="swiper-container wow fadeInDown">

	<div class="swiper-wrapper">
		<div class="swiper-slide slider_size bg01">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/main_visual01.jpg" class="main_slide pc">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/main_visual01.jpg" class="main_slide mo">
			<!--
            <div class="m_text">
				<h2>영양만점<br>간편간식</h2>
                <h6>남녀노소 누구나 즐기는 생밤</h6>
                <p>
                	몸에도 좋고 맛도 좋고 먹기편한 영양만점 맛밤<br>
					당도가 높고 달콤해서 남녀노소<br>
					누구나 드실 수 있는 자연산 단밤입니다.
                </p>
            </div>
-->
		</div>
		<div class="swiper-slide slider_size bg02">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/main_visual02.jpg" class="main_slide pc">
			<img src="<?php echo G5_THEME_IMG_URL; ?>/main/main_visual02.jpg" class="main_slide mo">
			<!--
            <div class="m_text">
				<h2>영양만점<br>간편간식</h2>
                <h6>남녀노소 누구나 즐기는 생밤</h6>
                <p>
                	몸에도 좋고 맛도 좋고 먹기편한 영양만점 맛밤<br>
					당도가 높고 달콤해서 남녀노소<br>
					누구나 드실 수 있는 자연산 단밤입니다.
                </p>
            </div>
-->
		</div>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>

</div>


<!--     Add Arrows -->
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>

<script>
	var swiper = new Swiper('.swiper-container', {
		spaceBetween: 0,
		centeredSlides: true,
		effect: "creative",
		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		paginationClickable: true,
		speed: 1200,
//		spaceBetween: 50,
		centeredSlides: true,
		autoplay: 5000,
		//mousewheelControl: true,
		autoplayDisableOnInteraction: false,
		loop: true,
		//autoplay: {
		//  delay: 2500,
		//  disableOnInteraction: false,
		//},
		pagination: {
			el: '.swiper-pagination',
			type: "fraction",
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

</script>
