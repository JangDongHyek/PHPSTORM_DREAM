<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<link href='https://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/scroll.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mouse.css"> <!-- mouse animate style -->
<script src="<?php echo G5_THEME_JS_URL ?>/modernizr.js"></script> <!-- Modernizr -->
<!--메인페이지-->

<!--cate-->
<!--<nav class="cd-vertical-nav">
	<ul>
		<li><a href="#section1"><span class="label">Intro</span></a></li>
		<li><a href="#section2"><span class="label">BUSINESS</span></a></li>
		<li><a href="#section3"><span class="label">PORTFOLIO</span></a></li>
		<li><a href="#section4"><span class="label">CUSTOMER</span></a></li>
	</ul>
</nav>-->
<!--//cate-->

<!--section--><!--<button class="cd-nav-trigger cd-image-replace" style="width:auto"><span aria-hidden="true"></span></button>-->

<section id="section1" class="cd-section">
	<div class="content-wrapper">
        
        <!--<canvas id="canvas" class="" style="width:100%; height:100%"></canvas>//dot animation-->
        
		<h2 class="hidden">INTRO</h2>
        <div class="slogan">
           <p class="t0 text-left wow fadeInDown" data-wow-delay="0.1s">CREATIVE GROUP</p>
           <!--<p class="t1 text-center wow fadeInUp" data-wow-delay="0.3s">아이티포원이 고객님께 드리는 믿음과 의지입니다.</p>-->
           <p class="t2 text-left wow fadeInDown" data-wow-delay="0.5s"><span>정도를 걷는기업<br />아이티포원이 지향하는 길입니다.</span></p>
           <p class="bar wow bounceIn"  data-wow-delay="1.3s"></p>
        </div>
           <!--cube 애니메이션-->
                <div class="mod">
                  <div class="cube">
                    
                    <div class="faces f1">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                    
                    <div class="faces f2">
                      
                      <div class="dot p10"></div>
                      <div class="dot p11"></div>
                      <div class="dot p12"></div>
                      <div class="dot p13"></div>
                  
                    </div>
                    
                    <div class="faces f3">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                  
                    <div class="faces f4">
                      
                      <div class="dot p10"></div>
                      <div class="dot p11"></div>
                      <div class="dot p12"></div>
                      <div class="dot p13"></div>
                  
                    </div>
                  
                    <div class="faces f5">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                  
                    <div class="faces f6">
                      
                      <div class="dot p10"></div>
                      <div class="dot p11"></div>
                      <div class="dot p12"></div>
                      <div class="dot p13"></div>
                  
                    </div>
                  
                    <div class="faces f7">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                  
                    <div class="faces f8">
                      
                      <div class="dot p10"></div>
                      <div class="dot p11"></div>
                      <div class="dot p12"></div>
                      <div class="dot p13"></div>
                  
                    </div>
                  
                    <div class="faces f9">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                  
                    <div class="faces f10">
                      
                      <div class="dot p10"></div>
                      <div class="dot p11"></div>
                      <div class="dot p12"></div>
                      <div class="dot p13"></div>
                  
                    </div>
                  
                    <div class="faces f11">
                      
                      <div class="dot p1"></div>
                      <div class="dot p2"></div>
                      <div class="dot p3"></div>
                      
                      <div class="dot p4"></div>
                      <div class="dot p5"></div>
                      <div class="dot p6"></div>
                      
                      <div class="dot p7"></div>
                      <div class="dot p8"></div>
                      <div class="dot p9"></div>
                  
                    </div>
                    
                  </div>                  
                </div>
           <!--//cube 애니메이션-->
		<a href="#section2" class="cd-scroll-down cd-image-replace wow bounceIn" data-wow-delay="1.0s">
             <div class="mouse hidden-sm hidden-xs"></div><!--<p class="t_padding10 hidden-sm hidden-xs" style="font-size:1.20em; font-weight:500; line-height:1.0em; color:#fff">Scroll<br />Down</p>--></a>
	</div>
</section><!-- cd-section -->

<article>
   <div class="m_call wow fadeInUp" data-wow-delay="0.4s">
           <p class="t1 text-center"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="" style="color:#fff !important" data-transition="slide">웹사이트 및 프로그램 제작문의&nbsp;<i class="fa fa-phone-square"></i></a></</p>
           <p class="t0 text-center">051.891.0087</p>
           <p class="t1 text-center">수정관련상담 : 051-891-0088</p>
        </div>
</article>

<!-- 배너 -->
<section id="section2" class="cd-section wow fadeInUp" data-wow-delay="0.1s">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">WEB Business</h2>
        <p class="ht wow fadeInDown t_padding20" data-wow-delay="0.5s">고객님의 성공을 함께합니다.</p>
		<p class="wow fadeInUp">비즈니스 환경에 맞추어 컨설팅 및 서비스에 최선을 다하고 있습니다.</p>
    
        <div class="m_content02 clearfix t_margin50 b_margin50">
                        <div class="mbanner_list swiper-container">
                            <ul class="swiper-wrapper">
                                <li class="wow fadeInDown swiper-slide" data-wow-delay="0.6s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">CREATIVE IDEAS</p>
                                     <p class="cont text-center">고객님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
                                </li>
                                <li class="wow fadeInDown swiper-slide" data-wow-delay="0.7s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">BRAND BUILDER</p>
                                     <p class="cont text-center">차별화된 고객님의 온라인 브랜드를<br /> 제시해 드리고 있습니다.</p>
                                </li>
                                <li class="wow fadeInDown swiper-slide" data-wow-delay="0.8s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">WEB/MARKETING</p>
                                     <p class="cont text-center">철저한 일정관리를 통해<br /> 성공적인 웹사이트 제작을 진행하고 있습니다.</p>
                                </li>
                                <li class="wow fadeInDown swiper-slide" data-wow-delay="0.9s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">E-BUSINESS GROUP</p>
                                     <p class="cont text-center"> 지속적인 트렌드에 맞는 제안으로<br /> 고객님의 E-BUSINESS에 날개를 달아 드리고 있습니다.</p>
                                </li>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </ul>
                        </div>
          </div>
    
	</div>
</section>
<!-- //배너 -->

<!-- 포트포리오 -->
<section id="section3" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">PORTFOLIO</h2>
	</div>
</section>
<!-- //포트포리오 -->

<!-- 파트너사 -->
<section id="section4" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">BUSINESS FAMILY</h2>
		<h2 class="wow bounceIn" data-wow-delay="0.3s">PARTNER CORPORATE</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">최고의 온/오프라인 서비스 제공</p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">아이티포원과 함께 하는 기업입니다.</p>
        <div class="partnerLink">
             <ul>
                  <li class="wow fadeInDown" data-wow-delay="0.1s"><a href="http://dreamforone.co.kr/"><img src="<?php echo G5_THEME_IMG_URL;?>/link/01.png" alt="드림포원" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.2s"><a href="http://www.innopost.com/"><img src="<?php echo G5_THEME_IMG_URL;?>/link/02.png" alt="이노포스트" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.3s"><a href="https://www.sejongtelecom.net/"><img src="<?php echo G5_THEME_IMG_URL;?>/link/03.png" alt="세종텔레콤" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="http://web.innopay.co.kr/"><img src="<?php echo G5_THEME_IMG_URL;?>/link/04.png" alt="이노페이" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.5s"><a href="https://www.nsu.ac.kr/"><img src="<?php echo G5_THEME_IMG_URL;?>/link/05.png" alt="남서울대학교" /></a></li>
             </ul>
        </div>
	</div>
</section>
<!-- //파트너사 -->

<!--회사정보-->
<section id="section5" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Customer</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">철저한 사후관리/ 체계적인 유지보수 </p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">합리적인 가격과 최상의 디자인 퀄리티로 항상 고객만족에 힘쓰고 있습니다. </p>
        
            <div class="container">
                <div class="pt_150">    
                    <div class="direct_wrap">
                        <div class="map_box wow fadeInLeft" data-wow-delay="0.2s">
                            <!-- * Daum 지도 - 지도퍼가기 -->
                            <!-- 1. 지도 노드 -->
                            <div id="daumRoughmapContainer1586240443194" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100% !important"></div>
        
                            <!--
                                2. 설치 스크립트
                                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                            -->
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://spi.maps.daum.net/imap/map_js_init/roughmapLoader.js"></script>
        
                            <!-- 3. 실행 스크립트 -->
                            <script charset="UTF-8">
                                new daum.roughmap.Lander({
                                    "timestamp" : "1586240443194",
                                    "key" : "xtjd",
                                    "mapWidth" : "100%",
                                    "mapHeight" : "500"
                                }).render();
                            </script>
                        </div>
                        
                        <div class="direct_box wow fadeInRight" data-wow-delay="0.3s">
                            <ul class="direct_ul">
                                <li><i class="fal fa-home-lg"></i><?php echo $config['cf_title']; ?></li>
                                <li><i class="fal fa-user-check"></i><?php echo $config['cf_3']; ?></li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_5']; ?> (대표전화) </li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_4']; ?> (제작관련전문상담) </li>		
                                <li><i class="fal fa-fax"></i><?php echo $config['cf_6']; ?> (팩스)</li>
                                <li><i class="fal fa-map-marker-alt"></i>
                                    <?php echo $config['cf_1']; ?><br>
                                    <span class="bg1">2호선 센텀시티역 </span> 4번출구 도보 10분거리<br>
                                    <span class="bg2">동해선 벡스코역</span> 4번출구 도보 10분거리
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
        
	</div>
</section>
<!--//회사정보-->

<!--//section-->

<!--//메인페이지-->

<!-- Initialize Swiper -->
<script>
var swiper = new Swiper('.swiper-container', { //배너 슬라이더
    pagination: '.swiper-pagination',
    paginationClickable: true,
    slidesPerView: 4,
    spaceBetween: 50,
    breakpoints: {
        1024: {
            slidesPerView: 4,
            spaceBetween: 40
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        320: {
            slidesPerView: 1,
            spaceBetween: 10
        }
    }
});
</script>



<script src="<?php echo G5_THEME_JS_URL ?>/circle_animate.js"></script> <!-- 애니메이션 -->
<script src="<?php echo G5_THEME_JS_URL ?>/main.js"></script> <!-- Resource jQuery -->
<script src="<?php echo G5_THEME_JS_URL ?>/script.js"></script> <!-- Resource jQuery -->
<?php
include_once(G5_PATH.'/tail.php');
?>