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

    <div id="rolling_tab" class="swiper-container hidden-xs hidden-sm">
        <div class="swiper-wrapper">
            <div class="swiper-slide m01">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">도심속 숲속 병원 <br /><span>L-ANDERSON Hospital in Forest</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>환자의 생활이 불편함이 없도록 모든 부분에 섬세하게 배려하는 엘 앤더슨입니다.</span></p>
        	</div>-->
            </div>
        </div>
        <!-- Add Pagination -->
        <!--<div class="swiper-pagination"></div>-->
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>-->
    </div>

    <div id="rolling_mtab" class="swiper-container hidden-lg hidden-md" style="padding:0 ;">
        <div class="line wow fadeInUp"></div>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/mobile_m_img01.jpg" style="width:100%">
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>-->
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

    <div class="m_content_area">
         <div class="m_content00">
          <div class="clearfix">
            <div class="col-md-3 col-xs-6 m_box">
                <div class=""></div>
                <p class="text-left t">SERVICE</p>
                <p class="text-left c">Our team  has the expertise <br />
and knowledge to help your <br />
company succeed globally!<br /></p>
                <div class="text-left t_padding15"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=service"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_btn01.png" alt=""></a></div>
            </div>
            <div class="col-md-3 col-xs-6 m_box clearfix">
                 <div class="col-md-6 col-xs-6 text-center"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_icon01.png" alt="" style="height:37px"><p class="t_margin7 t16">Overseas Market <br />Development</p></div>
                 <div class="col-md-6 col-xs-6 text-center"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_icon02.png" alt="" style="height:37px"><p class="t_margin7 t16">Partnership <br />&nbsp;<br />&nbsp;</p></div>
                 <div class="col-md-6 col-xs-6 text-center t_margin30"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_icon03.png" alt="" style="height:37px"><p class="t_margin7 t16">Vendor<br />Registration</p></div>
                 <div class="col-md-6 col-xs-6 text-center t_margin30"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_icon04.png" alt="" style="height:37px"><p class="t_margin7 t16">Corporate<br />Consulting</p></div>
            </div>
            <div class="col-md-3 col-xs-6 m_box">
                <div class=""></div>
                <p class="text-left t">CONTACT</p>
                <p class="text-left call">051-710-9889</p>
                <p class="text-left fax">FAX : 051-718-1415</p>
                <p class="text-left c">Email : blue@diamondbridge.co.kr</p>
                <div class="text-left t_padding15"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=contact"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_btn02.png" alt=""></a></div>
            </div>
            <div class="col-md-3 col-xs-6 m_box">
                <div class=""></div>
                <p class="text-right t2">DIAMOND <br />BRIDGE <br />NEWS</p>
                <p class="text-right c">Diamond Bridge News & Events</p>
                <div class="text-right t_padding15"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_news"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_btn01.png" alt=""></a></div>
            </div>
          </div><!--//clearfix--> 
          <div class="clearfix">
            <div class="col-md-6 m_banner clearfix">
              <div class="col-md-8 col-xs-8 t_margin30 l_padding40"> 
                <p class="t text-left">Diamond Bridge +</p>
                <p class="c text-left">Diamond Bridge Consulting is a leading international 
business development and marketing consulting firm 
that specialize in helping small and medium-sized enterprises
(SMEs) create sustainable growth through successful expansion 
into international markets.</p>
                <div class="text-left t_padding15"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_btn03.png" alt=""></a></div>
              </div>
            </div>
            <div class="col-md-6 m_banner clearfix">
              <div class="col-md-12 col-xs-12 t_margin30"> 
                <p class="c text-left"><?php echo latest("theme/basic", "b_news", "2", "70");?></p>
              </div>
            </div>
           </div><!--//clearfix--> 
         </div>
         </div>
    </div>

<?php
include_once(G5_PATH.'/tail.php');
?>