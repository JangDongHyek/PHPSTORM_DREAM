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
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.pwstabs.min.js"></script>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">

    <div id="rolling_tab" class="swiper-container hidden-xs hidden-sm">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background: url(<?php echo G5_THEME_IMG_URL ?>/main/m_img01.jpg) no-repeat center top; width:100%; height:556px">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">HUMAN, TECHNOLOGY<br /><span>& FUTURE</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>전자식 전력량계, 원자력 제품 선도기업 천일계전(주)</span></p>
        	</div>-->
            </div>
            <div class="swiper-slide"  style="background: url(<?php echo G5_THEME_IMG_URL ?>/main/m_img02.jpg) no-repeat center top;  width:100%; height:556px">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">HUMAN, TECHNOLOGY<br /><span>& FUTURE</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>전자식 전력량계, 원자력 제품 선도기업 천일계전(주)</span></p>
        	</div>-->
            </div>
            <div class="swiper-slide"  style="background: url(<?php echo G5_THEME_IMG_URL ?>/main/m_img03.jpg) no-repeat center top;  width:100%; height:556px">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">HUMAN, TECHNOLOGY<br /><span>& FUTURE</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>전자식 전력량계, 원자력 제품 선도기업 천일계전(주)</span></p>
        	</div>-->
            </div>
            <div class="swiper-slide"  style="background: url(<?php echo G5_THEME_IMG_URL ?>/main/m_img04.jpg) no-repeat center top;  width:100%; height:556px">
            <!--<div class="m_text hidden-xs hidden-sm">
                <div class="wow bounceIn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_forest.png"></div>
        		<h2 class="wow fadeInDown" data-wow-delay="0.3s">HUMAN, TECHNOLOGY<br /><span>& FUTURE</span></h2>
                <p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>전자식 전력량계, 원자력 제품 선도기업 천일계전(주)</span></p>
        	</div>-->
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>


    <div id="rolling_mtab" class="swiper-container hidden-lg hidden-md">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/mobile_m_img01.jpg" style="width:100%">
            </div>
            <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/mobile_m_img02.jpg" style="width:100%">
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>-->
    </div>

    <!--//m_content01--> 
    <div class="m_content01">
          <div class="clearfix t_margin50 b_margin50">
  
          
          <div class="col-md-6 r_padding15">
             <div class="wow fadeInUp" data-wow-delay="0.5s">
             <h3 class="title">전자식 전력량계</h3>
             <div class="tabset8">
                <div data-pws-tab="tab111" data-pws-tab-name="고압용 전력량계">
                    <div id="pro_tab01" class="swiper-container">
                           <div class="swiper-wrapper swiper_width">
                                   <div class="rol_box swiper-slide clearfix col-md-12 col-xs-12">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_02.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_03.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>

                           </div>
                   <!-- Add Pagination -->
                     <div class="swiper-pagination" style="bottom: 30px;bottom: 10px;right: 10px !important; left: auto;width: 50px;background:rgb(109,105,103,0.5);background:rgba(109,105,103,0.5);border-radius: 5px;color: #fff;"></div>
                   </div>
         </div>
         <div data-pws-tab="tab222" data-pws-tab-name="저압용 전력량계">
         <div id="pro_tab02" class="swiper-container">
                           <div class="swiper-wrapper swiper_width">
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_02.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide col-md-9 col-xs-9 clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_03.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>

                           </div>
                   <!-- Add Pagination -->
                     <div class="swiper-pagination" style="bottom: 30px;bottom: 10px;right: 10px !important; left: auto;width: 50px;background:rgb(109,105,103,0.5);background:rgba(109,105,103,0.5);border-radius: 5px;color: #fff;"></div>
                   </div>
         </div>
         <div data-pws-tab="tab333" data-pws-tab-name="기타 전력량계">
         <div id="pro_tab03" class="swiper-container">
                           <div class="swiper-wrapper swiper_width">
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_02.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>
                                   <div class="rol_box swiper-slide clearfix">
                                              <div class="col-md-3 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_01_03.png"></div>
                                              <div class="col-md-5 col-xs-7">
                                                    <p class="stitle">전자식 전력량계</p>
                                                    <p class="cont t_margin5">교육용, 아파트 산업용, 변압기 공동 이용 고객의 최대수요 전력량계용(DM계기)으로 사용하는 전력량계 입니다.</p>
                                              </div>
                                   </div>

                           </div>
                   <!-- Add Pagination -->
                     <div class="swiper-pagination" style="bottom: 30px;bottom: 10px;right: 10px !important; left: auto;width: 50px;background:rgb(109,105,103,0.5);background:rgba(109,105,103,0.5);border-radius: 5px;color: #fff;"></div>
                   </div>
         </div>
      </div>
             </div>
             <!--공지사항 추출-->
             <div class="clearfix t_margin50">
                 <div class="col-md-3 col-xs-2" style="background:#ec3238; padding:20px 10px 10px 20px; color:#fff;">
                    <span class="hidden-sm hidden-xs" style=" border-top: 0.1em solid #fff; display: inline-block; line-height: 2.2em;">NEWS & NOTICE</span>
                    <span class="hidden-lg hidden-md" style="display: inline-block; line-height: 0.4em; font-size:3.0em; font-weight: 600; text-align:center">N</span>
                 </div>
                 <div class="col-md-9 col-xs-10 l_padding20"><?php echo latest("theme/basic", "b_notice", 2, 50); ?></div>
             </div>
          </div>
          
          <div class="col-md-6 l_padding15">
             <div class="wow fadeInUp" data-wow-delay="0.7s">
               <h3 class="title">원자력 제품군</h3>
                 <div class="tabset9">
                  <div data-pws-tab="tab111" data-pws-tab-name="스위치류">
                  <div class="clearfix">
                   <div class="rol_box clearfix">
                              <div class="col-md-5 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_02.png"></div>
                              <div class="col-md-7 col-xs-7">
                                 <p class="stitle">스위치류</p>
                                 <p class="cont t_margin5">원자력발전소 프로세서의 제어용 컨트롤 스위치모듈을 포함하여 제어용스위치류 계전기류, 단자대류, LED램프 등의 제품</p>
                              </div>
                   </div>
            </div>         
         </div>
         <div data-pws-tab="tab222" data-pws-tab-name="단자대류">
           <div class="clearfix">
                   <div class="rol_box clearfix">
                              <div class="col-md-5 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_02_02.png"></div>
                              <div class="col-md-7 col-xs-7">
                                 <p class="stitle">단자대류</p>
                                 <p class="cont t_margin5">원자력발전소 프로세서의 제어용 컨트롤 스위치모듈을 포함하여 제어용스위치류 계전기류, 단자대류, LED램프 등의 제품</p>
                              </div>
                   </div>
            </div> 
         </div>
         <div data-pws-tab="tab333" data-pws-tab-name="LED램프">
           <div class="clearfix">
                   <div class="rol_box clearfix">
                              <div class="col-md-5 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_02_03.png"></div>
                              <div class="col-md-7 col-xs-7">
                                 <p class="stitle">LED램프</p>
                                 <p class="cont t_margin5">원자력발전소 프로세서의 제어용 컨트롤 스위치모듈을 포함하여 제어용스위치류 계전기류, 단자대류, LED램프 등의 제품</p>
                              </div>
                   </div>
            </div> 
         </div>
         <div data-pws-tab="tab444" data-pws-tab-name="계전기류">
           <div class="clearfix">
                   <div class="rol_box clearfix">
                              <div class="col-md-5 col-xs-5"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_rol_box_02_04.png"></div>
                              <div class="col-md-7 col-xs-7">
                                 <p class="stitle">계전기류</p>
                                 <p class="cont t_margin5">원자력발전소 프로세서의 제어용 컨트롤 스위치모듈을 포함하여 제어용스위치류 계전기류, 단자대류, LED램프 등의 제품</p>
                              </div>
                   </div>
            </div> 
         </div>
      </div>
             </div>
             
             <!--고객센터-->
             <div class="clearfix t_margin50">
                <div class="col-md-8 col-xs-12">
                   <div class="m_cus_title">CUSTOMER CENTER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>E-mail - chunil_1@naver.com</span></div>
                   <div class="m_cus_tel"> 051.302.7116&nbsp;&nbsp;&nbsp;<span class="m_f_box">FAX</span><span class="m_f_num">051.303.2115 </span></div>
                </div>
                <div class="col-md-4 col-xs-4 hidden-sm hidden-xs text-right"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_cus.png"></div>
             </div>
          </div>    
          
        </div>
        
    </div><!--//m_content01--> 

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
		mousewheelControl: true,
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
	    var swiper = new Swiper('#pro_tab01', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
        paginationType: 'fraction',
		speed: 800,
		autoplay: 2000,
		loop:true,
    });
	    var swiper = new Swiper('#pro_tab02', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
        paginationType: 'fraction',
		autoplay: 5000,
		loop:true,
    });
		var swiper = new Swiper('#pro_tab03', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
        paginationType: 'fraction',
		autoplay: 5000,
		loop:true,
    });	    
	jQuery(document).ready(function ($) { // 탭메뉴 JS
        $('.tabset8').pwstabs({
            effect: 'slideleft',
            defaultTab: 1,
            //containerWidth: '350px',
            tabsPosition: 'vertical',
            verticalPosition: 'left'
        });
        $('.tabset9').pwstabs({
            effect: 'slideleft',
            defaultTab: 1,
            //containerWidth: '350px',
            tabsPosition: 'vertical02',
            verticalPosition: 'left'
        });
    });
    </script>


<?php
include_once(G5_PATH.'/tail.php');
?>