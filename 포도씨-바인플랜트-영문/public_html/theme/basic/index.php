<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
        <div id="slogan">
            <div class="img01 wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="0.8s">지역혁신·사회연대 및 지역경제 활성화를 위한</div>
            <div class="img02 wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">재단법인<strong>부산형 사회연대기금</strong></div>
            <!--div class="mt wow fadeInUp animated" data-wow-delay="1.1s" data-wow-duration="0.8s">중소기업체 및 소상공인 활성화를 위한 지원사업</div-->
        </div><!--#slogan-->
        <ul class="sliderbx">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="middle">
	<div id="middle_in">
        <div class="abox abox01">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/abox01_img.jpg" alt="" /></div>
            <dl>
                <dt>재단소개</dt>
                <dd>
                지역사회, 경제 활성화로 다양한 일자리 창출,<br class="hidden-xs" />
                중소기업의 성장으로 지역사회가 상생하도록<br class="hidden-xs" />
                저희 재단이 함께 노력하겠습니다.
                </dd>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01" class="mbtn">자세히보기 &nbsp;<i class="fas fa-angle-right"></i></a>
            </dl>
        </div><!--.abox-->
        
        <div class="abox abox02">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/abox02_img.jpg" alt="" /></div>
            <dl>
                <dt>재단 사업안내</dt>
                <dd>
                지역혁신, 사회연대 및 지역경제 활성화를 위한 <br class="hidden-xs" />
                정책 연구 지원, 일자리 창출 및 청년 취업 지원,<br class="hidden-xs" />
                중소기업체 및 사회적 기업 발굴, 육성 사업
                </dd>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=busi" class="mbtn">자세히보기 &nbsp;<i class="fas fa-angle-right"></i></a>
            </dl>
        </div><!--.abox-->
        
        <div class="abox abox03">
        	<div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/abox03_img.jpg" alt="" /></div>
            <dl>
                <dt>재단 고객문의</dt>
                <p>친절한 상담으로 언제나 함께 하겠습니다.</p>
                
                <div class="cf">
                    <div class="tel_icon"><i class="fas fa-phone"></i></div>
                    <div class="tel_wrap">
                    <a href="tel:051-819-8151" class="tel">051.819.8151</a>
                    <a class="fax"><span>fax.</span> 051-819-8152</a>
                    <a href="mailto:bsfund2019@daum.net" class="mail">bsfund2019@daum.net</a>
                    </div>
                </div>
            </dl>
        </div><!--.abox-->
    </div><!--#middle_in-->
</div><!--#middle-->

<div id="middle2">
	<div id="middle2_in">
        <div class="abox abox01">
            <?php echo latest("theme/basic", "b_notice",5, 23); ?>
        </div><!--.abox-->
        
        <div class="abox abox02">
            <?php echo latest("theme/basic", "b_news",5, 23); ?>
        </div><!--.abox-->
        
        <div class="abox abox03">
            <?php echo latest("theme/gallery", "b_gallery",3, 20); ?>
        </div><!--.abox-->
    </div><!--#middle2_in-->
</div><!--#middle2-->




<div id="banner_wrap">
	<div id="banner">
        <div class="nav">
            <button onClick="moveType=0;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/mbn_left.gif" alt="왼쪽으로"/></button>  
            <button onClick="moveType=1;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/mbn_right.gif" alt="오른쪽으로"/></button>  
            <button onClick="movePause=true;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/mbn_stop.gif" alt="일시정지"/></button>  
            <button onClick="goMove();"><img src="<?php echo G5_THEME_IMG_URL ?>/common/mbn_play.gif" alt="움직이기"/></button>  
        </div>
        <div class="RollDiv"> 
          <div>  
            <a href="https://www.busanbank.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/banner01.gif" alt=""/></a>  
            <a href="https://www.skshipping.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/banner02.gif" alt=""/></a>  

        </div> 
    </div><!--#banner-->
</div><!--#banner_wrap-->



<?php
include_once(G5_PATH.'/tail.php');
?>