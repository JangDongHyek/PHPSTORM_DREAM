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
    <div id="visual" class="wow fadeInUp animated">
        <div class="area_txt">
			<p class="en">Onboard Carbon Capture System</p>
            <h3 class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.8s">탄소중립 시대 이끌 기술혁신 기업</span></h3>
            <p class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
            주식회사 쿨어스는 선박의 고효율 운영과 친환경 기술 개발로 <br class="hidden-xs">해운 업계의 친환경 목표 달성과 경쟁력 강화를 지원합니다.
        </div>
		<ul class="sliderbx">
        	<li class="mv01">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual01.jpg" alt="" /></div>
            </li>
        	<li class="mv02">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual02.jpg" alt="" /></div>
            </li>
        	<li class="mv03">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual03.jpg" alt="" /></div>
            </li>
        	<li class="mv04">
                <div class="abox_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mvisual04.jpg" alt="" /></div>
            </li>
        </ul><!--.sliderbx-->
		<!--<div class="scrolldown">
			<a href="#content">
				<i class="icon"></i>
				<i class="txt">SCROLL</i>
			</a>
		</div>-->
    </div><!-- //visual -->	
</div><!--  #idx_wrapper -->
<!--<div class="fixed_bg"></div>-->
<!--
		<div class="area_link">
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=contact">견적문의</a>
        </div>
-->

<div id="content">
	<div class="area_business">
		<div class="inr v2">
			<div class="title">
				<h2 class="wow fadeInLeft animated" data-wow-delay="0s" data-wow-duration="0.8s">주식회사 쿨어스는 선박용 냉동공조 장치의 <br>설계-제작-설치-시운전 등의 <span class="unber_bar">Turn key 방식</span>으로 진행하고 있습니다.</h2>
			
                <a class="area_btn" href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">자세히보기 <i class="far fa-arrow-right"></i></a>
			</div>
            

            <ul class="main_certi">
                <li class="wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                   <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">
                    <h4>ESG경영</h4>
                    <h1>
                       'Environment'<br>'Social'<br>'Governance'</h1>
                    </a>                </li>
                <li class="wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                   <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">
                    <h4>2050 탄소중립</h4>
                    <h1>Low-GWP 냉매적용<br>냉동공조 장치</h1>
                    </a>                </li>
                <li class="wow fadeInLeft animated" data-wow-delay="1.0s" data-wow-duration="0.8s">
                   <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">
                    <h4>CCU system</h4>
                    <h1>CCU system <br>
                    Carbon Capture&amp;Utilization</h1>
                    </a>                </li>
            </ul>
		</div>
	</div>


    <div class="list_business">
		<div class="inr v2">
                <div class="area_img wow fadeInLeft animated" data-wow-delay="1.4s" data-wow-duration="0.8s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_business.svg" style="opacity:0.3;"></div>
                <div class="title">
                    <em class="wow fadeInLeft animated" data-wow-delay="0s" data-wow-duration="0.8s">BUSINESS</em>
                    <h2 class="wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="0.8s">주요사업 소개</h2>
                    <p class="wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                        선박용 냉동공조 장치 및 산업용 냉동공조 장치의 <br>
                        새로운 개념의 System을 <br>
                        주식회사 쿨어스에서 찾아보십시오.
                    </p>
                </div>
                <ul class="area_txt">
                    <li class="wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro02_01" class="go">
                            HVAC&R System
                        </a>
                    </li>
                    <li class="wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro03_01" class="go">
                            FACILITY
                        </a>
                    </li>
                    <li class="wow fadeInLeft animated" data-wow-delay="1.0s" data-wow-duration="0.8s">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro04_01" class="go">
                            어선<br>냉동장치
                        </a>
                    </li>
                    <li class="wow fadeInLeft animated" data-wow-delay="1.0s" data-wow-duration="0.8s">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro06_01" class="go">
                            조선/해양/플랜트
                        </a>
                    </li>
                </ul>
			</div>
        </div>
    </div>
    <div class="community">
        <div class="inr">
                <div class="title">
                    <em class="wow fadeInLeft animated" data-wow-delay="0s" data-wow-duration="0.8s">Customer Service</em>
                    <h2 class="wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="0.8s">고객서비스</h2>
                    <p class="wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">
                        쿨어스는 고객을 향한 서비스에 항상 불편함이 없도록 <br>최선을 다해 노력하겠습니다.
                        <br>
                        자세한 내용은 아래 이메일로 문의 하십시오.
                        <a class="mail" href="mailto:oneeng-hvac@one-eng.co.kr"><i class="fas fa-envelope"></i><?php echo $config['cf_6']; ?></a>
                    </p>
                </div>
                <div class="bbs wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
                    
                    <?php echo latest('theme/basic', 'notice',5, 100); ?>
                </div>
        </div>
    </div>



    
</div>


<?php
include_once(G5_PATH.'/tail.php');
?>