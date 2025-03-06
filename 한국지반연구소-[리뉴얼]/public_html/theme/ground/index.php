<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper" >
    <div id="visual">
       <div id="slogan">
          <div class="img01 wow fadeInDown animated" data-wow-delay="1.2s" data-wow-duration="0.8s">KOREA INSTITUTE OF GEOTECHNICS</div>
          <div class="img02 wow fadeInDown animated" data-wow-delay="1.5s" data-wow-duration="0.8s">지반과 기술의 대화로 안전을 설계하다</div>
          <div class="img03 wow fadeInDown animated" data-wow-delay="1.8s" data-wow-duration="0.8s">지반 정보기술의 대한민국 대표 브랜드가 되겠습니다.</div>
        </div><!--#slogan-->
        
        <!--메인슬라이더 시작-->
        <ul class="sliderbx wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.5s">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
			<li class="mv04"></li>
        	<!--<li class="mv04"></li>-->
        </ul><!--.sliderbx-->
        <div class="bx-pager bx-default-pager wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.8s"></div>
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="middle">
	<div id="middle_in">
            <div class="mid mid01 wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1">
            	<div class="mb_title">지표지질조사<span><?php echo $config['cf_title']; ?></span></div>
                <p>광역지질조사 / 광물 및 암석 분석</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid01-->
            
            <div class="mid mid02 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1">
            	<div class="mb_title">지반조사<span><?php echo $config['cf_title']; ?></span></div>
                <p>시추조사 / 현장시험</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid02-->
            
            <div class="mid mid03 wow fadeInDown animated" data-wow-delay="0.7s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_1">
            	<div class="mb_title">지구물리탐사<span><?php echo $config['cf_title']; ?></span></div>
                <p>GPR탐사 / 탄성파탐사 / 표면파탐사 / 전기비저항탐사 / 전기탐사 / 자력탐사 / 전자탐사</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid03-->
            
            <div class="mid mid04 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.5s">
            	<a href="javasctipr:void(0);">
            	<div class="mb_title">현장 및 수리시험<span><?php echo $config['cf_title']; ?></span></div>
                <!--<p>위성영상 및 DEM분석 / 항공사진 분석 / 지표지질조사 등 과업지역의 광역적인 지형 특성 파악 및 거시적인 발달 상태 분석하는 분야</p>-->
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid4-->
		
            <div class="mid mid05 wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_1">
            	<div class="mb_title">지하수 영향조사/평가<span><?php echo $config['cf_title']; ?></span></div>
                <p>지하수영향조사 / 지하수영향평가 / 지하수모델링</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid01-->

            <div class="mid mid06 wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_1">
                    <div class="mb_title">지하안전평가/점검<span><?php echo $config['cf_title']; ?></span></div>
                    <p>지하안전점검 / 지하안전평가</p>
                    <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid01-->

            <div class="mid mid07 wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_1">
                    <div class="mb_title">환경/재해영향평가<span><?php echo $config['cf_title']; ?></span></div>
                    <p>환경영향평가 / 재해영향평가</p>
                    <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid01-->

            <div class="mid mid08 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.5s">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business11_1">
                    <div class="mb_title">토취장/석산(채석) 평가<span><?php echo $config['cf_title']; ?></span></div>
                    <p>토취장/석상(채석) 매장량 및 경제성 평가</p>
                    <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid06-->
            
            <div class="mid mid09 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.5s">
            	<a href="javasctipr:void(0);">
            	<div class="mb_title">안전진단<span><?php echo $config['cf_title']; ?></span></div>
                <!--<p>위성영상 및 DEM분석 / 항공사진 분석 / 지표지질조사 등 과업지역의<br class="hidden-xs"> 광역적인 지형 특성 파악 및 거시적인 발달 상태 분석하는 분야</p>-->
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid02-->
            
            <div class="mid mid10 wow fadeInDown animated" data-wow-delay="0.7s" data-wow-duration="0.5s">
            	<a href="javasctipr:void(0);">
            	<div class="mb_title">내진성능평가<span><?php echo $config['cf_title']; ?></span></div>
                <!--<p>위성영상 및 DEM분석 / 항공사진 분석 / 지표지질조사 등 과업지역의 광역적인 지형 특성 파악 및 거시적인 발달 상태 분석하는 분야</p>-->
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid03-->
            
            <div class="mid mid11 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_1">
            	<div class="mb_title">안정성검토<span><?php echo $config['cf_title']; ?></span></div>
                <p>비탈면 / 저수지&middot;제발 / 원격영상분석 / 터널 / 기초</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid4-->
    
            <div class="mid mid12 wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business07_1">
            	<div class="mb_title">급경사지 점검 및 상시 자동화 계측<span><?php echo $config['cf_title']; ?></span></div>
                <!--<p>위성영상 및 DEM분석 / 항공사진 분석 / 지표지질조사 등 과업지역의 광역적인 지형 특성 파악 및 거시적인 발달 상태 분석하는 분야</p>-->
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid05-->
            

            
            <!--div class="mid mid07 wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="0.5s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=go06">
            	<div class="mb_title">어촌이주 정착단계<span><?php echo $config['cf_title']; ?></span></div>
                <p>주기적이고 체계적으로 귀어귀촌인들을 위한 실질적 도움을 줄수 있는 전문가 멘토 운영합니다.</p>
                <div class="mb_link"><i class="fal fa-plus"></i></div>
                </a>
            </div>.mid07-->
    </div><!--#middle_in-->
</div><!--#middle-->

<div id="mbanner" class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
	<div class="mb_text">
        <strong>한국지반연구소: 혁신의 엔진, 미래의 힘</strong>
    	<p>끊임 없는 기술 개발을 통해 여러 분야에서 도전할 수 있도록 노력하겠습니다</p>
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02"">회사소개 바로가기</a>
    </div><!--.mb_text-->
</div><!--#mbanner-->

<div id="mv_ban" >
	<div class="mv_box mv_box1 wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
    	<div class="tbbs fl">
        	<div class="tab on">
            	<h3 class="t1">공지사항</h3>
                <div class="pannel">
                <!-- 최신글 시작 { -->
                <?php echo latest('theme/basic', 'b_notice', 5, 27); ?>
                <!-- } 최신글 끝 -->
                </div>
            </div><!--.tab-->
        	<div class="tab">
            	<h3 class="t2">보도자료</h3>
                <div class="pannel">
                <!-- 최신글 시작 { -->
                <?php echo latest('theme/basic', 'b_news', 5, 27); ?>
                <!-- } 최신글 끝 -->
                </div>
            </div><!--.tab-->
        	<div class="tab">
            	<h3 class="t3">문의하기</h3>
                <div class="pannel">
                <!-- 최신글 시작 { -->
                <?php echo latest('theme/basic', 'b_qna', 5, 27); ?>
                <!-- } 최신글 끝 -->
                </div>
            </div><!--.tab-->
        </div><!--bbs-->
	</div><!--.mv_box1-->
</div><!--#mv_ban-->
  
<div id="m_content05">
		<div class="grid_wrap">
			<div class="wow fadeInLeft cs" data-wow-delay="0.3s">
				<h2><span><strong>한국지반연구소</strong> 고객센터</span></h2>
				<p>평일 : 09:00 - 18:00   &nbsp;&nbsp;점심 : 12:00 ~ 13:00 &nbsp;&nbsp; 휴무 : 토,일, 공휴일</p>
				<h1><?php echo $config['cf_4']; ?></span></h1>
				<h6>FAX : <?php echo $config['cf_5']; ?></h6>
				<h6>Email : <?php echo $config['cf_6']; ?></h6>
				<div class="btn_wrap">
					<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna" class="cs_ban ver1">견적문의<img src="<?php echo G5_THEME_IMG_URL ?>/main/ic01.png" alt=""></a>
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=activity" class="cs_ban ver2">기술자문활동<img src="<?php echo G5_THEME_IMG_URL ?>/main/ic02.png" alt=""></a>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company01" class="cs_ban ver3"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ic03.png" alt="">사업실적</a>
				</div>
			</div>
			<div class="wow fadeInRight health_info" data-wow-delay="0.3s">
				<h2>
					<span><strong>한국지반연구소</strong> 공지사항</span>
					<span class="btn_moreview" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=notice'">더보기<i class="fa-regular fa-plus"></i></span>
				</h2>
				<?php echo latest("theme/basic", "b_notice", 8, 50); ?>
			</div>
		</div>
</div>
    



<?php
include_once(G5_PATH.'/tail.php');
?>