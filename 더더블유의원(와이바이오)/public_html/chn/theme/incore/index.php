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
        <ul class="dong">
            <li class="wow bounceIn" data-wow-delay="0.1s">Innovative Core<p>Technology</p></li>
            <li class="wow bounceIn" data-wow-delay="0.2s">Mission of Customer<p>Satisfaction</p></li>
            <li class="wow bounceIn" data-wow-delay="0.3s">Innovative Core<p>Technology</p></li>
            <li class="wow bounceIn" data-wow-delay="0.4s">Mission of Customer<p>Satisfaction</p></li>
        </ul>
        <div class="m_text hidden-xs hidden-sm">
                <h3 class="wow fadeInDown" data-wow-delay="0.1s">Innovative Core Technologles Of</h3>
                <h2 class="wow fadeInDown" data-wow-delay="0.3s">Medical Devices</h2>
                <!--<p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>환자의 생활이 불편함이 없도록 모든 부분에 섬세하게 배려하는 엘 앤더슨입니다.</span></p>-->
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide m01"></div>
            <div class="swiper-slide m02"></div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
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
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
		loop:true,
		effect: 'fade'
    });
    </script>

    <div class="blue_area">
    	<h2>Disposable Endoscopic</h2>
        <h3>Instruments</h3>
        <p>The disposable motor-operated medical snare is a disposable device for the removal of<br class="hidden-xs" />
			tissues such as polyps once the site has been entered during endoscopic procedures.</p>
    </div><!--m_blue_area-->
    <div class="gray_area">
    	<h2>We, INCORE Co., Ltd, are a medical consumables manufacturer</h2>
        <h3>with the top notch technology, distributing our products over the world.</h3>
        <ul class="b_dong">
        	<a href="#"><li class="col-md-4 col-xs-12 wow fadeInUp" data-wow-delay='0.1s'>
            	<img src="<?php echo G5_THEME_IMG_URL ?>/main/dong01.png" />
                <p>ENSURE HIGH QUALITY OF PRODUCTS</p>
                <h3>ABOUT US</h3>
                <div>We, INCORE Co., Ltd, are a medical<br class="hidden-xs" />
                    consumables manufacturer with <br class="hidden-xs" />
                    the top notch technology, distributing<br class="hidden-xs" />
                    our products over the world.</div>
            </li></a>
            <a href="#"><li class="col-md-4 col-xs-12 wow fadeInUp" data-wow-delay='0.2s'>
            	<img src="<?php echo G5_THEME_IMG_URL ?>/main/dong02.png" />
                <p>ENSURE HIGH QUALITY OF PRODUCTS</p>
                <h3>INCORE PRODUCTS</h3>
                <div>We, INCORE Co., Ltd, are a medical<br class="hidden-xs" />
                    consumables manufacturer with<br class="hidden-xs" />
                    the top notch technology, distributing <br class="hidden-xs" />
                    our products over the world.</div>
            </li></a>
            <a href="#"><li class="col-md-4 col-xs-12 wow fadeInUp" data-wow-delay='0.3s'>
            	<img src="<?php echo G5_THEME_IMG_URL ?>/main/dong03.png" />
                <p>ENSURE HIGH QUALITY OF PRODUCTS</p>
                <h3>WEB BROCHURE</h3>
                <div>We, INCORE Co., Ltd, are a medical<br class="hidden-xs" />
                    consumables manufacturer with<br class="hidden-xs" />
                    the top notch technology, distributing <br class="hidden-xs" />
                    our products over the world.</div>
            </li></a>
        </ul>
    </div><!--gray_area-->
    
    <div class="m_content_area">
    
         <div class="m_content00">
          <div class="clearfix">
            <div class="col-md-6 col-xs-12 m_box wow fadeInDown" data-wow-delay='0.1s'>
                <div class=""></div>
                <p class="text-left t">INCORE Notice Board</p>
                <p class="text-left c">We are aiming for the best products with our quality policy of<br class="hidden-xs" /> 
providing customers with impressive products.</p>
                <div class="clearfix t_margin40">
                    <div class="col-md-3"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_notice.jpg"></div>
                    <div class="col-md-9"><?php echo latest("theme/basic", "notice_eng", "1", "40");?></div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 m_box wow fadeInDown" data-wow-delay='0.2s'>
                <div class=""></div>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce_eng01"><p class="text-left t">INCORE Introduction</p>
                <p class="text-left c">We, INCORE Co., Ltd, are a medical consumables manufacturer with the top notch  technology, distributing our products over the world.<br class="hidden-xs" /> 
Fully aware that in the 21centuary high quality of a product at a competitive price meets consumers' demand, we are growing to contribute to the society with young human resources and swift market reaction.
</p></a>
            </div>
          </div><!--//clearfix--> 
         </div><!--//m_content00-->
         
         <div class="m_content01">
          <div class="clearfix">
            <div class="col-md-3 col-xs-6 m_box wow fadeInUp" data-wow-delay='0.1s'>
            	<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro02"><p class="text-left t">HR Recruitment</p>
                <p class="text-left c">We look For Valueable Human<br class="hidden-xs" /> Resource Working With us</p></a>
            </div>
            <div class="col-md-3 col-xs-6 m_box clearfix wow fadeInUp" data-wow-delay='0.2s'>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro02"><p class="text-left t">About Our Products</p>
                <p class="text-left c">ORTHOTECH'S Products<br />
                Fractures &amp; Diseases /<br />
                Technologies &amp; Projects</p></a>
            </div>
            <div class="col-md-3 col-xs-6 m_box wow fadeInUp" data-wow-delay='0.3s'>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro02"><p class="text-left t">Brochure</p>
                <p class="text-left c">A Hardcopy Material<br class="hidden-xs" />Incorporating Passion for<br class="hidden-xs" />Contant Challenge</p></a>
            </div>
            <div class="col-md-3 col-xs-6 m_box wow fadeInUp" data-wow-delay='0.4s'>
            	<p class="text-left t">Customer center</p>
                <p class="text-left c">Tel : +82-2-866-3514<br />
Fax : +82-2-6919-1346<br />
E-mail : tak3514@hanmail.net<p>
				<dl>
                	<dt>Business Hours</dt>
                    <dd>09:00~18:00</dd>
                    <dt>Lunch Break</dt>
                    <dd>12:00~13:00</dd>
                    <dt>Sat,Sun/Holidy</dt>
                    <dd>Online Inquiry</dd>
                </dl>
	

            </div>
          </div><!--//clearfix--> 
         </div><!--//m_content00-->
         
         </div>
    </div>

<?php
include_once(G5_PATH.'/tail.php');
?>