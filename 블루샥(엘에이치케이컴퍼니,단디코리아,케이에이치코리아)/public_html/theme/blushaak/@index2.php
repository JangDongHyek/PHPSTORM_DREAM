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
<link href="<?php echo G5_THEME_CSS_URL ?>/slick.css" rel="stylesheet" type="text/css" />
<link href="<?php echo G5_THEME_CSS_URL ?>/slick-theme.css" rel="stylesheet" type="text/css" />
<script src="<?php echo G5_THEME_JS_URL ?>/slick.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/modernizr.js"></script> <!-- Modernizr -->

<!--메인페이지-->

<!--cate-->
<nav class="cd-vertical-nav">
	<ul>
		<li><a href="#section1"><span class="label">Intro</span></a></li>
		<li><a href="#section2"><span class="label">BUSINESS</span></a></li>
		<li><a href="#section3"><span class="label">PORTFOLIO</span></a></li>
		<li><a href="#section4"><span class="label">CUSTOMER</span></a></li>
	</ul>
</nav>
<!--//cate-->

<!--section--><button class="cd-nav-trigger cd-image-replace" style="width:auto"><span aria-hidden="true"></span></button>

<section id="section1" class="cd-section">
	<div class="content-wrapper">
        
        <!--<canvas id="canvas" class="" style="width:100%; height:100%"></canvas>//dot animation-->
        
		<h2 class="hidden">INTRO</h2>
        <div class="slogan">
           <p class="t0 text-center wow fadeInDown" data-wow-delay="0.1s">CREATIVE GROUP</p>
           <!--<p class="t1 text-center wow fadeInUp" data-wow-delay="0.3s">아이티포원이 고객님께 드리는 믿음과 의지입니다.</p>-->
           <p class="t2 text-center wow fadeInDown" data-wow-delay="0.5s"><span>정도를 걷는기업<br />아이티포원이 지향하는 길입니다.</span></p>
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
        </div>
		<a href="#section2" class="cd-scroll-down cd-image-replace wow bounceIn" data-wow-delay="1.0s"><div class="mouse"></div><!--<p class="t_padding10 hidden-sm hidden-xs" style="font-size:1.20em; font-weight:500; line-height:1.0em; color:#fff">Scroll<br />Down</p>--></a>
	</div>
</section><!-- cd-section -->

<article>
   <div class="m_call wow fadeInUp" data-wow-delay="0.4s">
           <p class="t1 text-center"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="" style="color:#fff !important" data-transition="slide">웹사이트 및 프로그램 제작문의&nbsp;<i class="fa fa-phone-square"></i></a></</p>
           <p class="t0 text-center">051.891.0087</p>
           <p class="t1 text-center">수정관련상담 : 051-891-0088</p>
        </div>
</article>


<section id="section2" class="cd-section wow fadeInUp" data-wow-delay="0.1s">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">WEB Business</h2>
        <p class="ht wow fadeInDown t_padding30" data-wow-delay="0.5s">고객님의 성공을 함께합니다.</p>
		<p class="wow fadeInUp">비즈니스 환경에 맞추어 컨설팅 및 서비스에 최선을 다하고 있습니다.</p>
    
  <div class="m_content02 clearfix t_margin50 b_margin50">
  
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp"  data-wow-delay="0.2s">
     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth"></div>
     <p class="title text-center t_margin20">CREATIVE IDEAS</p>
     <p class="cont text-center">고객님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>
     
     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.4s">
     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth"></div>
     <p class="title text-center t_margin20">BRAND BUILDER</p>
     <p class="cont text-center">차별화된 고객님의 온라인 브랜드를<br /> 제시해 드리고 있습니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>

     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.6s">
     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth"></div>
     <p class="title text-center t_margin20">WEB/MARKETING</p>
     <p class="cont text-center">철저한 일정관리를 통해<br /> 성공적인 웹사이트 제작을 진행하고 있습니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>

     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.8s">
     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth"></div>
     <p class="title text-center t_margin20">E-BUSINESS GROUP</p>
     <p class="cont text-center"> 지속적인 트렌드에 맞는 제안으로<br /> 고객님의 E-BUSINESS에 날개를 달아 드리고 있습니다.</p>
     </div>
     
  </div>

  <div class="divider_content">
            <div class="experience_list">
                <ul>
                    <li>
                         <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth"></div>
                         <p class="title text-center t_margin20">CREATIVE IDEAS</p>
                         <p class="cont text-center">고객님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
                    </li>
                    <li>
                         <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth"></div>
                         <p class="title text-center t_margin20">BRAND BUILDER</p>
                         <p class="cont text-center">차별화된 고객님의 온라인 브랜드를<br /> 제시해 드리고 있습니다.</p>
                    </li>
                    <li>
                         <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth"></div>
                         <p class="title text-center t_margin20">WEB/MARKETING</p>
                         <p class="cont text-center">철저한 일정관리를 통해<br /> 성공적인 웹사이트 제작을 진행하고 있습니다.</p>
                    </li>
                    <li>
                         <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth"></div>
                         <p class="title text-center t_margin20">E-BUSINESS GROUP</p>
                         <p class="cont text-center"> 지속적인 트렌드에 맞는 제안으로<br /> 고객님의 E-BUSINESS에 날개를 달아 드리고 있습니다.</p>
                    </li>
                </ul>
            </div>
	</div>

	</div>
</section><!-- cd-section -->

<section id="section3" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">PORTFOLIO</h2>
	</div>
</section><!-- cd-section -->

<section id="section4" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Customer</h2>
        <p class="ht_g wow fadeInDown t_padding30" data-wow-delay="0.5s">철저한 사후관리/ 체계적인 유지보수 </p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">합리적인 가격과 최상의 디자인 퀄리티로 항상 고객만족에 힘쓰고 있습니다. </p>
        
        <!--회사정보 박스-->
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
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con1.png" alt="상호명" /><?php echo $config['cf_title']; ?></li>
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con2.png" alt="대표명" /><?php echo $config['cf_3']; ?></li>
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con3.png" alt="전화" /><?php echo $config['cf_5']; ?> (대표전화) </li>
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con3.png" alt="전화" /><?php echo $config['cf_4']; ?> (제작관련전문상담) </li>		
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con4.png" alt="팩스" /><?php echo $config['cf_6']; ?></li>
                                <li><img src="<?php echo G5_THEME_URL ?>/img/direc_con5.png" alt="주소" />
                                    <?php echo $config['cf_1']; ?><br>
                                    <span class="bg1">2호선 센텀시티역 </span> 4번출구 도보 10분거리<br>
                                    <span class="bg2">동해선 벡스코역</span> 4번출구 도보 10분거리
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
        <!--//회사정보 박스-->
        
	</div>
</section><!-- //cd-section -->
<!--//section-->

<!--//메인페이지-->
<script src="<?php echo G5_THEME_JS_URL ?>/circle_animate.js"></script> <!-- 애니메이션 -->
<script src="<?php echo G5_THEME_JS_URL ?>/main.js"></script> <!-- Resource jQuery -->
<script src="<?php echo G5_THEME_JS_URL ?>/script.js"></script> <!-- Resource jQuery -->
<?php
include_once(G5_PATH.'/tail.php');
?>