<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<link href="<?php echo G5_THEME_CSS_URL; ?>/ani/fullpage.css" rel="stylesheet" type="text/css"><!--메인컨텐츠-->

	<!-- mobile Ver -->
	<div id="mobile_main" class="mobVer">
		<p class="top_title">부산시중앙신협멤버스</p>
		<div class="box">
			<h1 class="text-focus-in"> <img src="<?php echo G5_THEME_IMG_URL ?>/m/m_main_logo.svg" alt="부산시중앙신협멤버스"></h1>
			<ul class="mobile_main_list">
				<li>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center"><span>PRIVATE </span>CENTER</a>
				</li>
				<li class="animate__delay-_3s" >
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center"><span>Golf </span>CENTER</a>
				</li>
				<li class="animate__delay-_6s">
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center"><span>cu</span>culture</a>
				</li>
				<li class="animate__delay-_9s">
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=trv_service"><span>travel </span>service</a>
				</li>
			</ul>
		</div>
		<div id="btm_nav">
			<ul class="btm_gnb">
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center"><i class="fa"></i>문화센터<span></span></a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center">골프센터<span></span></a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=trv_service">여행센터<span></span></a></li>
				<li><a href="javascript:alert('준비중입니다')">마이페이지</a></li>
			</ul>
		</div>
	</div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<!-- pc ver -->
	<div id="fullpage" class="mainfull pcVer"> 

		<section class="section " id="section0" >

				
			<div class="mainVisualWrap">
				<div class="mainVisual swiper-container">
					<div class="swiper-pagination"></div>
					<div class="swiper-wrapper">  
						<div class="swiper-slide">
							<div class="Box fadeUp__item">
								<p class="tit elice text-focus-in"><span class="titillium">vip · vvip</span>를 위한 차별화된<br>고품격 프라이빗 서비스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center_res">프라이빗센터 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual01.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box fadeUp__item">
								<p class="tit elice">하나의 문화를 만들어 가고자하는<br>부산시중앙신협의 CU문화센터</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center_res">문화센터 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual02.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box fadeUp__item">
								<p class="tit elice">부산시 중앙신협 만의<br>프라이빗한 골프서비스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">더 스크린 골프 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual03.jpg">
						</div>
					</div>
				</div>
			</div>


		</section>
		<!-- /main slide -->

		<!-- <section class="section " id="section1_1" >
			<p class="main_title"><img src="<?php echo G5_THEME_IMG_URL ?>/m/m_main_logo.svg" alt="부산시중앙신협멤버스"></p>
			<div class="bg"></div>
		</section> -->
		<!-- / main button -->

		<!-- <section class="section " id="section1_2" >
			<p class="main_title elice"><span class="text-focus-in delay3">Experience</span> <span class="text-focus-in delay1">the</span> <span class="text-focus-in delay2">lifestyle</span></p>
			<div class="bg kenburns-top">
				
			</div>
		</section> -->
		<!-- /main slide -->

		<!-- <section class="section " id="section1_2" >
			<div class="mainVisualWrap">
				<div class="mainVisual swiper-container">
					<div class="swiper-pagination"></div>
					<div class="swiper-wrapper">  
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice text-focus-in"><span class="titillium">vip · vvip</span>를 위한 차별화된<br>고품격 프라이빗 서비스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center_res">프라이빗센터 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual01.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">하나의 문화를 만들어 가고자하는<br>부산시중앙신협의 CU문화센터</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center_res">문화센터 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual02.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">부산시 중앙신협 만의<br>프라이빗한 골프서비스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">더 스크린 골프 예약 바로가기</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual03.jpg">
						</div>
					</div>
				</div>
			</div>
		</section> -->
		<!-- /main slide -->

		<section class="section " id="section2" data-anchor="solution">
			<ul class="mainSurvice autoW">
				<li class="cate01">
					<h2><p>프라이빗 센터</p><span>PRIVATE </span>CENTER</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center">프라이빗센터 예약</a>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center_res">프라이빗센터 안내</a>
					</p>
				</li>
				<li class="cate02 animate__delay-_3s" >
					<h2><p>골프센터</p><span>Golf </span>CENTER</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center">더 스크린골프</a>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">더스크린골프 예약</a>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_info">골프클럽</a>
					</p>
				</li>
				<li class="cate03 animate__delay-_6s">
					<h2><p>CU문화센터</p><span>cu culture </span>CENTER</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center">CU문화센터 안내</a>
						<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=cucenter">수강접수</a>
					</p>
				</li>
				<li class="cate04 animate__delay-_9s">
					<h2><p>여행서비스</p><span>travel </span>service</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=trv_service">여행서비스 안내</a>
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=life_st">라이프스타일 안내</a>
					</p>
				</li>
			</ul>
			
		</section>
		<!-- / main button -->

		<section class="section" id="section3">
			<h2><span class="sebang">MEMBERS</span> <p>VIP·VVIP 만을 위한 부산시중앙신협 멤버스의  다양한 혜택과 프리미엄 서비스를 확인 해보세요.</p></h2>
			<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info" class="newBtn">MORE</a>
			
			<div class="main_memBox">
				<div class="img">
					
				</div>
			</div>
		</section>
		<!-- / main video -->

		<section class="section" id="section4">
			<div class="newsBox" >
				<h2 class="inr"><span class="sebang">EVENT</span>부산시 중앙신협 멤버스만의 특별한 이벤트</h2>
				<div class="swiper-container noti_slide inr">
				<!-- <div class="swiper-button-next">next</div>
				<div class="swiper-button-prev">prev</div> -->
					<ul class="swiper-wrapper">
						<li class="swiper-slide">
							<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">
								<span class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/text_noti.jpg" alt=""></span>
								<span class="cate">#골프센터</span>
								<p class="tit">새롭게 단장한 골프센터와 함께하는 특별한 이벤트!</p>
								<p class="txt">2021.01.01 ~ 2021.12.31</p>
							</a>
						</li>
						<li class="swiper-slide">
							<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">
								<span class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/text_not2.jpg" alt=""></span>
								<span class="cate">#골프센터</span>
								<p class="tit">새롭게 단장한 골프센터와 함께하는 특별한 이벤트!</p>
								<p class="txt">2021.01.01 ~ 2021.12.31</p>
							</a>
						</li>
						<li class="swiper-slide">
							<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">
								<span class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/text_noti3.jpg" alt=""></span>
								<span class="cate">#골프센터</span>
								<p class="tit">새롭게 단장한 골프센터와 함께하는 특별한 이벤트!</p>
								<p class="txt">2021.01.01 ~ 2021.12.31</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- / main news -->
		<section class="section" id="section5">
			<div class="loction inr">
				<p class="tit white">부산시중앙신협은 고객님을 위해 언제나 최선을 다하겠습니다.</p>
				<p class="txt">TEL <span>051. 611.1255</span></p>
				<p class="txt2">부산광역시 남구 용호로 162 본점 부산시중앙신협</p>
			</div>
			<div class="mapbox inr">
				<!-- * 카카오맵 - 지도퍼가기 -->
				<!-- 1. 지도 노드 -->
				<div id="daumRoughmapContainer1640227095979" class="root_daum_roughmap root_daum_roughmap_landing"></div>

				<!--
					2. 설치 스크립트
					* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
				-->
				<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

				<!-- 3. 실행 스크립트 -->
				<script charset="UTF-8">
					new daum.roughmap.Lander({
						"timestamp" : "1640227095979",
						"key" : "28jz5",
						"mapWidth" : "100%",
						"mapHeight" : "360"
					}).render();
				</script>
			</div>
		</section>
		<!-- / main map -->

		<!-- /golf center -->
		<section class="section tc  fp-auto-height" id="section6">
			<div class="footerWrap">
				<? include_once("inc/footer.php") ?>				
			</div>
		</section>

	</div>
	<!-- /mainFull -->



<?php
include_once(G5_PATH.'/tail_sub.php');
?>