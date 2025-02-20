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
			<h2 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">CHEMICAL<br>SOLUTION LEADER</h2>
            <h3 class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.</h3>
            <!--<p class="wow fadeInUp animated" data-wow-delay="0.9s" data-wow-duration="0.8s">
                <b>견적문의</b> 상담 <?php echo $config['cf_4']; ?>
            </p>-->
            <!--검색-->
            <div id="tnb_sch">
                    <h3>빠른 제품 화학 물질 검색</h3>
                    <form name="fsearchbox" id="form" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);" autocomplete="off">
                        <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <input type="hidden" name="sfl" value="wr_subject||wr_content||wr_2||wr_4">
                        <input type="hidden" name="sop" value="and">
                        <input type="text" name="stx" id="sch_stx" placeholder="국,영문 화학명,이명,cas no. 를 입력하세요.">
                        <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                    </form>
            </div><!--#tnb_sch-->
            <!--//검색-->
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
        </ul>
        <!--.sliderbx-->

        <div class="scrolldown">
            <a href="#content"><i>SCROLL DOWN</i></a>
        </div>


    </div><!-- //visual -->

</div><!--  #idx_wrapper -->
<div id="content">

    <div class="idx_overview">
        <div class="inr">
            <div class="txt">
                <p class="wow fadeInUp" data-wow-delay="0.2s">Eco Friendly Chemical<br>
                    Leading the Chemical Market with Customers</p>
                <span class="wow fadeInDown" data-wow-delay="0.4s">탁월한 기술력과 전문성으로 믿음직한 파트너가 되어드립니다.<br>
                    고객사 만족과 더 나아가 사회 발전에 이바지 할 수 있도록 최선을 다하는 EF CHEM이 되겠습니다.</span>
            </div>
			<div class="btn_area wow bounceIn" data-wow-delay="0.6s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01" >제품보기</a></div>
        </div>
    </div>


    <div class="idx_company">
        <div class="inr">
            <div class="idx_title">
                <h3 class="wow fadeInDown" data-wow-delay="0.2s">About EF CHEM</h3>
            </div>
            <div class="txt">
                <h4 class="wow fadeInDown" data-wow-delay="0.4s">고객과 더불어 화학 시장을 선도하는<br>
                    CHEMICAL SOLUTION LEADER (주)이에프켐 입니다.</h4>
                <p class="wow fadeInDown" data-wow-delay="0.6s">국.내외 네트워크를 통해 경쟁력 있는 화학 제품을 공급하며<br>
                신규 원료 개발과 해외 마케팅 서비스 등 다양한 chemical solution을<br>
                국내외 고객사에게 제공하고 있습니다.</p>
            </div>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02" class="more wow fadeInDown" data-wow-delay="0.8s">자세히 보기 <i class="fal fa-angle-right"></i></i></a>
        </div>
    </div>

    <div class="idx_cs">
        <div class="inr">
            <div class="banner">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <dl onclick="window.open('https://www.youtube.com/channel/UCvgTR3vN9VphvpKqsE-qt-Q')">
                        <dt>유튜브 채널</dt>
                        <dd>(주)이에프켐이 운영중인<br>
                            YOUTUBE 채널 입니다.</dd>
                    </dl>
                </div>
                <div></div>
                <div class="wow fadeInUp" data-wow-delay="0.4s">
                    <dl onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=qna'">
                        <dt>제품문의</dt>
                        <dd>(주)이에프켐 제품에 대해<br>
                            문의사항을 남겨주세요.</dd>
                    </dl>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.6s">
                    <dl onclick="location.href='../theme/basic/down/EF CHEM_K.pdf'">
                        <dt>카탈로그</dt>
                        <dd>(주)이에프켐<br>
                            카탈로그를 확인하세요.</dd>
                    </dl>
                </div>
            </div>
            <div class="latest wow fadeInRight" data-wow-delay="0.8s">
                <?php echo latest('theme/basic', 'b_news', 1, 120); ?>
            </div>
        </div>
    </div>    

</div>


<?php
include_once(G5_PATH.'/tail.php');
?>
