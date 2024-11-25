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
            <div class="title wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/big_logo.png"></div>
            <div class="stitle wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="0.8s">외식이용과 홀덤이벤트를 한 공간에서 즐기는</div>
            <div class="con wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.8s"><?php echo $config['cf_title']; ?>은 멈추지 않는 도전과 차별화된 전략으로 <br class="hidden-xs" />진실된 외식사업을 만들어 나가겠습니다.</div>
        </div><!--#slogan-->
        <ul class="sliderbx">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->



<div id="big_ban" class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
        <h3><strong>Pub</strong>처럼 신나게, <strong>Hof</strong>처럼 저렴하게, <strong>Restaurant</strong>처럼 고급스럽게</h3>
        <div class="con"><strong>KMGM홀덤이벤트펍</strong>은 Restaurant, Hof, Pub의 각 컨셉의 단점을 보완하고<br class="hidden-xs" />
           외식이용과 홀덤이벤트를 한 공간에서 즐기실 수 있는 자유로운 문화 입니다.
    </div>
        <ul class="list cf">
            <li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/business01.jpg" alt=""></div><!--over-->
                <div class="tx"><span class="cons">동료, 친구, 연인들과 함께 즐길 수 있는<strong>스페셜한 오락공간</strong></span></div>
            </li>
            <li class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/business02.jpg" alt=""></div><!--over-->
                <div class="tx"><span class="cons">국내대회, 국제대회에도 참여할 수 있는<strong>다양한 이벤트 참여</strong></span></div>
            </li>
            <li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/business03.jpg" alt=""></div><!--over-->
                <div class="tx"><span class="cons">위스키, 샴페인, 맥주, 소주, 칵테일 등<strong>다양한 음료와 음식</strong></span></div>
            </li>
            <li class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="1s">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/business04.jpg" alt=""></div><!--over-->
                <div class="tx"><span class="cons">이색 데이트 장소, 이색 모임장소로<strong>탁월한 선택</strong></span></div>
            </li>
        </ul>
</div><!--big_ban-->




<div id="business" class="wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1s">
	<h2 class="title">CUSTOMER CENTER</strong><span>새로운 외식 창업 패러다임</span></h2>
	<h3 class="tel"><?php echo $config['cf_4']; ?></h3>
    <div class="cs">
        <strong>매장영업시간</strong>평일.주말 19:00~03:00<br />
        <!--<strong>쇼핑몰상담시간</strong>평일 09:00~17:00-->
    </div>
    <div class="sec03_link wow flipInX animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=fran_qna">창업문의 바로가기 →</a>
        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">이벤트 바로가기 →</a>
	</div>
</div>




<?php
include_once(G5_PATH.'/tail.php');
?>