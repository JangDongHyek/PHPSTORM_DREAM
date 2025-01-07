<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/main.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css"><!-- Rolling css -->
<!--메인페이지-->

<section id="section1" class="cd-section wow fadeInUp">
	<div class="content-wrapper">
        
        <!--<canvas id="canvas" class="" style="width:100%; height:100%"></canvas>//dot animation-->
        
		<h2 class="hidden">INTRO</h2>
        <div class="slogan">
           <p class="t0 text-left wow fadeInDown" data-wow-delay="0.1s">Blu Shaak COFFEE</p>
           <!--<p class="t1 text-center wow fadeInUp" data-wow-delay="0.3s">아이티포원이 고객님께 드리는 믿음과 의지입니다.</p>-->
           <p class="t2 text-left wow fadeInDown" data-wow-delay="0.5s"><span>저희가 사용할 수 있는<br />최상의 재료로 정성껏 만들었습니다.</span></p>
           <!--<p class="bar wow bounceIn"  data-wow-delay="1.3s"></p>-->
        </div>
        
        <!--공지추출-->
        <div class="m_latest wow fadeInUp" data-wow-delay=".2s">
            <?php echo latest("theme/basic", "b_news", "1", "30");?>
        </div>
        
        <a href="#section2" class="cd-scroll-down wow fadeInUp" data-wow-delay=".4s">
            <div class="mouse hidden-sm hidden-xs"></div>
            <p class="t_padding10 hidden-sm hidden-xs" style="font-size:1.0em; font-weight:400; line-height:1.0em; color:#fff">Scroll</p>
        </a>
	</div>
    
    

    <div id="idx_wrapper">
        <!--메인슬라이더 시작-->
        <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
            <ul class="sliderbx">
                <li class="mv01"></li>
                <li class="mv02"></li>
            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div><!--  #idx_wrapper -->
    
</section><!-- cd-section -->

<article>
   <div class="m_call wow fadeInUp" data-wow-delay="0.4s">
           <p class="t1 text-center"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="" style="color:#fff !important" data-transition="slide"><?php echo $config['cf_title']; ?> 창업상담&nbsp;<i class="fa fa-phone-square"></i></a></</p>
           <p class="t0 text-center"><?php echo $config['cf_4']; ?></p>
           <div class="menu_roll">
                 <img src="<?php echo G5_THEME_IMG_URL;?>/main/symbol.png" alt="">
           </div>
        </div>
</article>

<!-- 배너 -->
<section id="section2" class="cd-section wow fadeInUp" data-wow-delay="0.1s">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Franchising Business</h2>
        <p class="ht wow fadeInDown t_padding20" data-wow-delay="0.5s">점주님의 성공을 함께합니다.</p>
		<p class="wow fadeInUp">점주님의 환경에 맞추어 컨설팅 및 서비스에 최선을 다하고 있습니다.</p>
    
        <div class="m_content02 clearfix t_margin50 b_margin50">
                        <div class="mbanner_list">
                            <ul>
                                <li class="wow fadeInDown" data-wow-delay="0.6s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">CREATIVE IDEAS</p>
                                     <p class="cont text-center">점주님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.7s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">BLU SHAAK</p>
                                     <p class="cont text-center">더 나은 BLU SHAAK을 위해<br />끊임 없는 연구 개발을 진행중입니다.</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.8s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">COOPERATION</p>
                                     <p class="cont text-center">점주님과의 상생협력을<br /> 그 무엇보다 소중히 생각하고 있습니다.</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.9s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">BRENDING</p>
                                     <p class="cont text-center"> 브라질,콜롬비아,엘살바도르,에티오피아<br /> 블렌딩 원두를 로스팅 합니다.</p>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Swiper -->
                        <div class="swiper-container mbanner_list02">
                            <ul class="swiper-wrapper">
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">CREATIVE IDEAS</p>
                                     <p class="cont text-center">점주님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">BLU SHAAK</p>
                                     <p class="cont text-center">더 나은 BLU SHAAK을 위해<br />끊임 없는 연구 개발을 진행중입니다.</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">COOPERATION</p>
                                     <p class="cont text-center">점주님과의 상생협력을<br /> 그 무엇보다 소중히 생각하고 있습니다.</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">BRENDING</p>
                                     <p class="cont text-center">  브라질,콜롬비아,엘살바도르,에티오피아<br /> 블렌딩 원두를 로스팅 합니다.</p>
                                </li>
                            </ul>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>                                  
          </div>
    
	</div>
</section>
<!-- //배너 -->

<!-- 포트포리오 -->
<section id="section3" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s"><?php echo $config['cf_title']; ?> Menu</h2>
        <!--<p class="ht wow fadeInDown t_padding20" data-wow-delay="0.5s">Tea/Beverage/Dessert</p>-->
		<p class="wow fadeInUp">Tea / Beverage / Dessert</p>
        <div class="port">
            <ul>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">샥라떼</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port01.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>샥라떼</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">아이스 아메리카노</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port02.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>아이스 아메리카노</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">카페라떼</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port03.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>카페라떼</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">리얼쇼콜라</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port04.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Beverage</h4>
                        <h2>리얼쇼콜라</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">밀크티&말차라떼</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port05.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Tea</h4>
                        <h2>밀크티&말차라떼</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">레몬얼그레이티</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port06.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Tea</h4>
                        <h2>레몬얼그레이티</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">고르곤졸라 휘낭시에</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port07.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Dessert</h4>
                        <h2>고르곤졸라 휘낭시에</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">까눌래</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port08.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Dessert</h4>
                        <h2>까눌래</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01"></a>
                    </figure>
                </li>
            </ul>
        </div>
        <div class="t_margin30"><p class="more"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=menu01">+ 더 보기</a></p></div>
	</div>
</section>
<!-- //포트포리오 -->

<!-- 파트너사 
<section id="section4" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">BUSINESS FAMILY</h2>
		<h2 class="wow bounceIn" data-wow-delay="0.3s">FAMILY PARTNER BRAND</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">행복한 삶을 추구합니다.</p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">(주)엘에이치케이컴퍼니와 함께 하는 브랜드 입니다.</p>
        <div class="partnerLink">
             <ul>
                  <li class="wow fadeInDown" data-wow-delay="0.1s"><a href="http://www.chunjabeer.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/01.png" alt="오춘자비어" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.2s"><a href="http://www.sumbisori.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/02.png" alt="숨비소리" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.3s"><a href="http://www.pighouse.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/03.png" alt="뚱보집" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="http://www.xn--o39a0so33dnmo.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/04.png" alt="원가회관" /></a></li>
             </ul>
        </div>
	</div>
</section>-->


<!--회사정보-->
<section id="section5" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Customer</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">Blu Shaak 만의 맛을 전해드리기 위해</p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">지금도 많은 연구와 개발을 진행중입니다.</p>
        
            <div class="container">
                <div class="pt_150">    
                    <div class="direct_wrap">
                        <div class="map_box wow fadeInLeft" data-wow-delay="0.2s">
                            <!-- * Daum 지도 - 지도퍼가기 -->
                            <!-- 1. 지도 노드 -->
                            <div id="daumRoughmapContainer1605166388433" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100% !important"></div>
        
                            <!--
                                2. 설치 스크립트
                                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                            -->
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://spi.maps.daum.net/imap/map_js_init/roughmapLoader.js"></script>
        
                            <!-- 3. 실행 스크립트 -->
                            <script charset="UTF-8">
                                new daum.roughmap.Lander({
                                    "timestamp" : "1605166388433",
                                    "key" : "22wcp",
                                    "mapWidth" : "100%",
                                    "mapHeight" : "500"
                                }).render();
                            </script>
                        </div>
                        
                        <div class="direct_box wow fadeInRight" data-wow-delay="0.3s">
                            <ul class="direct_ul">
                                <li><i class="fal fa-home-lg"></i><strong><?php echo $config['cf_title']; ?> - 엘에이치케이컴퍼니/단디코리아</strong></li>
                                <li><i class="fal fa-user-check"></i><?php echo $config['cf_2_subj']; ?><?php echo $config['cf_2']; ?><?php echo $config['cf_3']; ?></li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_3_subj']; ?><?php echo $config['cf_3']; ?></li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_4']; ?> (프랜차이즈 창업 전문상담) </li>		
                                <li><i class="fal fa-envelope-open"></i><?php echo $config['cf_6']; ?></li>
                                <li><i class="fal fa-map-marker-alt"></i>
                                    <?php echo $config['cf_1']; ?><br><br>
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
<!-- Swiper JS -->
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', { //롤링배너
	pagination: '.swiper-pagination',
	paginationClickable: true,
	slidesPerView: 4,
	spaceBetween: 20,
	loop:true,
	autoplay: 2500,
	breakpoints: {
		1024: {
			slidesPerView: 3,
			spaceBetween: 0
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 0
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 0
		},
		380: {
			slidesPerView: 1,
			spaceBetween: 0
		}
	}
});

$(".hover").mouseleave( //포트폴리오
  function () {
    $(this).removeClass("hover");
  }
);
</script>
<script src="<?php echo G5_THEME_JS_URL ?>/main.js"></script> <!-- Resource jQuery -->
<?php
include_once(G5_PATH.'/tail.php');
?>