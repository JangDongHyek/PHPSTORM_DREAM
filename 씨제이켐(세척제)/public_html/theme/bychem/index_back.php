<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/jquery.pwstabs.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/owl.carousel.min./kor/theme/zenfixd/img/sub/icon_sitemap.pngss"><!--//제품 슬라이드 css-->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/owl.theme.default.min.css"><!--//제품 슬라이드 css-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.pwstabs.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/owl.carousel.js"></script><!--//제품 슬라이드 js-->


    <div id="rolling_tab" class="swiper-container wow fadeInDown" data-wow-delay="0.2s">
        <ul class="swiper-wrapper">
            <li class="swiper-slide slide_li1">
				<div class="big_txt">bsc series distribution center <span>cjchem</span></div>
				<div class="mid_txt">TCE, MC, MPBr, DCP 대체 친환경성 산업용 세정제 BCS 판매점</span></div>
				<div class="slide_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pro.png"></div>
            </li>
            <li class="swiper-slide slide_li2">
				<div class="big_txt">bsc series distribution center <span>cjchem</span></div>
				<div class="mid_txt">TCE, MC, MPBr, DCP 대체 친환경성 산업용 세정제 BCS 판매점</span></div>
				<div class="slide_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pro.png"></div>
            </li>
        </ul>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div><!--rolling_tab-->

    <!--//m_content02--> 
    <div id="m_content01">
    	<div id="m_cont">
			<div class="mpro">
               <ul class="clearfix"><!--4줄까지나오게-->
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.1s">
                      <p class="t">제품소개</p>
                      <p class="c"> 
							· 오존층파괴 NO!<br>
							· 지구온난화 NO!<br>
							· 광학스모그유발 NO!<br>
							· 인체발암성 NO! 
					   </p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.2s">
                      <p class="t">BCS-NEW1000</p>
                      <p class="c">바이크린 시리즈 중 가장 범용적으로 사용가능한 세척제로서 침적, 스프레이, 증기탈지 세척이 가능...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product01">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.3s">
                      <p class="t">BCS-5500</p>
                      <p class="c">BCS-5500은 범용성과 난연성이 우수하고 전기전자부품 소재 플럭스 제거용 및 증기탈지 세척용...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product02">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.4s">
                      <p class="t">BCS-5000</p>
                      <p class="c">바이크린 시리즈 중 가장 품질이 우수한 세척제로서 불연성이고 저취형이며 유독물질 및 발암물질...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product03">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.5s">
                      <p class="t">BCS-3000</p>
                      <p class="c">친환경성 세척제로써 세척성 및 기화성이 우수하고 자연건조가 가능하며, KBV 126 으로 TCE와 동등한...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product04">MORE+</a></p>
                   </li>
                   <li class="col-md-2 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.6s">
                      <p class="t">BCS-1000</p>
                      <p class="c">TCE 및 MC, NPBr을 대체할 수 있고 PCB 플럭스 제거 및 자동차 부품오일 탈지, 광학소재 세척용등으로...</p>
					   <p class="more"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=product05">MORE+</a></p>
                   </li>
               </ul>
            </div><!--//.mpro-->
            
            
            <div class="text-center t_margin50 b_margin40 t_padding15 b_padding15">
                <p class="t1 wow fadeInRight" data-wow-delay="0.1s" style="word-break: keep-all;">고객 감동을 위해 신뢰를 우선으로 삼고, 고객의 요구를 수용하고자</p>
                <p class="t16 wow fadeInLeft" data-wow-delay="0.2s" style="word-break: keep-all;">항상 고객의 입장에서 고객만족경영을 실천하기 위해 끊임없이 노력하고 있습니다. </p>
            </div>
            <dl class="clearfix">
                <dd class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="0.1s">
                   <div>
                        <!-- * Daum 지도 - 지도퍼가기 -->
						<!-- 1. 지도 노드 -->
						<div id="daumRoughmapContainer1521185124201" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%!important;"></div>

						<!--
							2. 설치 스크립트
							* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
						-->
						<script charset="UTF-8" class="daum_roughmap_loader_script" src="http://dmaps.daum.net/map_js_init/roughmapLoader.js"></script>

						<!-- 3. 실행 스크립트 -->
						<script charset="UTF-8">
							new daum.roughmap.Lander({
								"timestamp" : "1521185124201",
								"key" : "n9aa",
								"mapWidth" : "100%",
								"mapHeight" : "260"
							}).render();
						</script>
                </dd>
                <dd class="col-md-4 col-sm-4  col-xs-9 wow fadeInDown" data-wow-delay="0.2s">
                   <ul class="map_info">
					   <li>상호. <span>씨제이켐</span></li>
					   <li>대표. <span>박상훈</span></li>
					   <li>주소. <span>경기도 안산시 단원구 풍전로 37-9</span></li>
					   <li>전화. <span>031.364.8867</span></li>
					   <li>팩스. <span>0303.3444.8867</span></li>
					   <li>메일. <span><a href="mailto:cj_chem@naver.com">cj_chem@naver.com</a></span></li>
                   </ul> 
                </dd>
                <dd class="col-md-2 col-sm-2  col-xs-3  wow fadeInDown" data-wow-delay="0.2s">
                   <ul class="customer">
					   <li class="cscenter hidden-xs">
						   <h1>CUSTOMER</h1>
						   <p class="st1">T. 031-364-8867</p>
						   <p class="st2">P. 010-7607-4341</p>
					   </li>
					   <li class="kakao"><a href="https://open.kakao.com/o/sQfVbyG" target="_blank">
						   <p class="katalk">카카오톡문의</p>
						   <img src="<?php echo G5_THEME_IMG_URL ?>/kakao.jpg"></a>
					   </li>
					   <li class="brochure"><a href="../../../file/BCS_NEW1000.pdf" download>
						   <img src="<?php echo G5_THEME_IMG_URL ?>/brochure.png" />
						   <p class="bro_txt">NEW-1000</p></a>
					   </li>
					</ul> 
                </dd>
            </dl>
        </div><!--#m_cont-->
    </div>
    <!--//m_content01--> 


    <!-- Swiper JS -->
    <script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('#rolling_tab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
		speed: 1200,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
		//mousewheelControl: true,
        autoplayDisableOnInteraction: false,
		loop:true,
    });
    var swiper = new Swiper('#rolling_mtab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
		speed: 1200,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
		loop:true,
    });
    </script>


<?php
include_once(G5_PATH.'/tail.php');
?>