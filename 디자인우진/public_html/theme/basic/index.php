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
        <div class="txt">
            <h3 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">공익센터, 복지기관, 대학 및 교육기관 대상 전문기업</h3>
            <h2 class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">디자인 우진</h2>
            <p class="wow fadeInUp animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
                <b>견적문의</b> 상담 <span>051.731.4631</span>
            </p>
        </div>
        <ul class="sliderbx">
            <li class="mv01">
                <!--
                <div class="txt">
                    <h3 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">BOOK</h3>
                    <h2 class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">KBS 부산재발견팀 도서</h2>
                    <p class="wow fadeInUp animated" data-wow-delay="0.9s" data-wow-duration="0.8s">WE ARE THE DISTINGUISHED COMPANY</p>
                </div>
-->
            </li>
            <li class="mv02"></li>
            <li class="mv03"></li>
            <li class="mv04"></li>
            <li class="mv05"></li>
            <li class="mv06"></li>
            <li class="mv07"></li>
        </ul>
        <!--.sliderbx-->

        <div class="scrolldown">
            <a href="#content"><i>SCROLL DOWN</i></a>
        </div>


    </div><!-- //visual -->

</div><!--  #idx_wrapper -->
<div id="content">


    <div id="area_board">
        <div class="inr">
            <div class="greet">
                <h2 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">디자인우진은 고객의 수청 요청건에 대해 최대한 고객의 입장에서 반영해 드리고있습니다.<br>
                합법적 이미지, 폰트 사용으로 작업에 임하고 있습니다</h2>
                <h2 class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
                </h2>
                <div class="info_location">
                </div>
                <div class="img_wrap">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet00.jpg">
                </div>
                <a class="area_btn wow fadeInLeft animated" data-wow-delay="1.2s" data-wow-duration="0.8s" href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">ABOUT <i class="fal fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    <div id="gall_board">
        <div class="area_gall">
            <?php echo latest("theme/gallery", "certi",6, 23); ?>
        </div>
    </div>
    <div id="area_company">
        <div class="inr">
            <div class="area_location">
                <h2 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">PORTFOLIO</h2>
                <em class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">포트폴리오</em>
                <div class="tab_content">
                    <ul class="list">
                        <li class="wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet01.jpg">
                            </div>
                            <em>강남장애인복지관 (서울)</em>
                            <h2>10주년 연구보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet02.jpg">
                            </div>
                            <em>강남장애인복지관 (서울)</em>
                            <h2>소식지</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet03.jpg">
                            </div>
                            <em>경성대학교</em>
                            <h2>용호동 골목시장 스토리텔링 북</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet04.jpg">
                            </div>
                            <em>부산남구노인복지관</em>
                            <h2>10주년 기념보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet05.jpg">
                            </div>
                            <em>과천시건강가정지원센터</em>
                            <h2>2020년 사업보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet06.jpg">
                            </div>
                            <em>국립수산물품질관리원</em>
                            <h2>수산물 정밀분석 메뉴얼</h2>
                        </li>
                        
                        <li class="wow fadeInLeft animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet07.jpg">
                            </div>
                            <em>동서대학교</em>
                            <h2>융합형 크로스오버 운영보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="1.5s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet08.jpg">
                            </div>
                            <em>부산사회복지공동모금회</em>
                            <h2>2017 연간보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="1.8s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet09.jpg">
                            </div>
                            <em>부산사회복지관협회</em>
                            <h2>2020년 사업성과보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="2.1s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet10.jpg">
                            </div>
                            <em>성모자애복지관 (서울)</em>
                            <h2>2017년 연간사업보고서</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="2.4s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet11.jpg">
                            </div>
                            <em>과천시건강가정지원센터</em>
                            <h2>쇼핑백</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="2.7s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet12.jpg">
                            </div>
                            <em>부산저작권서비스센터</em>
                            <h2>안내 리플렛</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="3s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet13.jpg">
                            </div>
                            <em>종로장애인복지관 (서울)</em>
                            <h2>사업안내서 브로슈어</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="3.3s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet14.jpg">
                            </div>
                            <em>부산종합사회복지관 (초록우산)</em>
                            <h2>소식지</h2>
                        </li>
                        <li class="wow fadeInLeft animated" data-wow-delay="3.6s" data-wow-duration="0.8s">
                            <div class="img_wrap">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/greet15.jpg">
                            </div>
                            <em>해운대구 복지박람회</em>
                            <h2>초대장 및 관련 인쇄물 기획</h2>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include_once(G5_PATH.'/tail.php');
?>
