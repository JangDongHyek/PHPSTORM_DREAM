<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

    <div id="rolling_tab" class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide m01">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">도심속 숲속 병원 <br /><span>L-ANDERSON Hospital in Forest</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>환자의 생활이 불편함이 없도록 모든 부분에 섬세하게 배려하는 엘 앤더슨입니다.</span></p>
        	</div>-->
            </div>
            <div class="swiper-slide m02">
            <!--<div class="m_text hidden-xs hidden-sm" style="background:rgba(255,255,255,0.7); padding:30px; width: 50%; margin: 120px 25% 0 25%; box-shadow: rgb(0,0,0,0.5) 1px 1px 5px;">
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s" style="color:#454e59; font-size:3.5em; line-height: 1.0em;">숲치료는 몸과 마음을 푸르게 합니다. <br /><span style="background:rgba(69,78,89,0.7); font-size:0.4em">We exist to help those in need.</span></h2>
                <p class="t_margin10 wow fadeIn"  data-wow-delay="0.7s"><span style="color:#454e59; font-size:1.2em">우리는 어려움에 처한 이들을 돕기 위해 존재합니다.</span></p>
        	</div>-->
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('#rolling_tab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 100,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
		loop:true,
		effect: 'fade'
    });
    </script>

    <div class="m_content_area text-center">
         <div class="m_content00">
          <div class="clearfix">
            <div class="col-md-3 col-xs-6 m_box">
                <div class="t_margin50 b_margin15"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_box_item01.png" alt="김이미지"></div>
                <p class="text-center t">김에 대한 정보</p>
                <p class="text-center c">김양식과정/김에관한 상식 및 <br />김요리법등을 제공해드립니다.</p>
            </div>
            <div class="col-md-3 col-xs-6 m_box">
                <div class="t_margin50 b_margin15"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_box_item02.png" alt="한울식품 제품이미지"></div>
                <p class="text-center t">제품소개</p>
                <p class="text-center c">조미김/건어물세트 및 수출품목 등<br /> 한울식품의 제품을 소개해드립니다.</p>
            </div>
            <div class="col-md-3 col-xs-6 m_box">
                <div class="t_margin50 b_margin15"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_box_item03.png" alt="한울식품 제품이미지"></div>
                <p class="text-center t">취급품목 안내</p>
                <p class="text-center c">한울식품이 취급하는 상품을<br />자세히 안내해드립니다.</p>
            </div>
            <div class="col-md-3 col-xs-6 m_box">
                <div class="t_margin50 b_margin15"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_box_item03.png" alt="한울식품 제품이미지"></div>
                <p class="text-center t">취급품목 안내</p>
                <p class="text-center c">한울식품이 취급하는 상품을<br />자세히 안내해드립니다.</p>
            </div>
          </div><!--//clearfix--> 
          <div class="clearfix">
            <div class="col-md-6 m_banner clearfix">
              <div class="col-md-8 col-xs-8 t_margin30 l_padding40"> 
                <p class="t text-left">제품주문 서비스 +</p>
                <p class="c text-left">온라인으로 제품을<br />주문하실 수 있습니다.</p>
              </div>
              <div class="co-md-4 col-xs-4 text-center"><div class="t_margin40"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_banner_icon01.png" alt=""></div></div> 
            </div>
            <div class="col-md-6 m_banner clearfix">
              <div class="col-md-8 col-xs-8 t_margin30 l_padding40"> 
                <p class="t text-left">김해관광정보 +</p>
                <p class="c text-left">김해관광을 쉽게 하실 수<br />있는 정보를 제공합니다.</p>
              </div>
              <div class="co-md-4 col-xs-4 text-center"><div class="t_margin40"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_banner_icon02.png" alt=""></div></div> 
            </div>
            <div class="col-md-4 m_banner">
              <div class="t_margin40 l_padding40">  
                 <div class="m_tel text-left ">055-328-0551</div>
                 <div class="text-left t_margin10 "><span class="e_box">E-mail</span><span class="f_num">hnfood@kotis.net</span></div>
              </div> 
            </div>
           </div><!--//clearfix--> 
         </div>
         </div>
    </div>

<?php
include_once(G5_PATH.'/tail.php');
?>