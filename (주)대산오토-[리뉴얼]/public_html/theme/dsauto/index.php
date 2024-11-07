<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<section id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeInUp animated">
		<div class="txt">
			<h3>GLOBAL</h3>
			<h2>DAESAN AUTO</h2>
			<p>글로벌 경쟁 시대! 세계로 도약하는 (주)대산오토</p>
            <!--검색-->
            <div id="tnb_sch">
                    <h3>검색</h3>
                    <form name="fsearchbox" id="form2" action="<?php echo G5_BBS_URL ?>/search2.php" onsubmit="return search_submit(this);" autocomplete="off">
                        <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <select name="sfl">
                            <option value="wr_subject||wr_content||wr_1||wr_2||wr_3">전체</option>
                            <option value="wr_1">품번</option>
                            <option value="wr_subject||wr_2">품명</option>
                            <option value="wr_3">차종</option>
                        </select>
                        <!--<input type="hidden" name="sfl" value="wr_subject||wr_content">-->
                        <input type="hidden" name="sop" value="and">
                        <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요.">
                        <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                    </form>
            </div><!--#tnb_sch-->
            <!--//검색-->
		</div>
		<ul class="sliderbx">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
            <li class="mv04"></li>
            <li class="mv05"></li>
        </ul><!--.sliderbx-->

		<div class="line">
			<!--<i class="left"></i>
			<i class="right"></i>-->
			<i class="bottom"></i>
		</div>
		<div class="scrolldown">
			<a href="#content"><i>SCROLL DOWN</i></a>
		</div>


    </div><!-- //visual -->
	
</section><!--  #idx_wrapper -->
<section id="content">

    <!--최신글 추출-->  
    <div class="m_latest wow fadeInUp" data-wow-delay="0.7">  
        <div class="wrapper">
                    
             <div class="tabs05 cf">
                <input name="tabs" id="tab1" type="radio" checked="">
                  <label for="tab1" style="border-left: 1px solid #273169;">에디슨모터스</label>
                <input name="tabs" id="tab2" type="radio">
                  <label for="tab2">대우버스</label>
                <input name="tabs" id="tab3" type="radio">
                  <label for="tab3">두산인프라코어</label>
                <input name="tabs" id="tab4" type="radio">
                  <label for="tab4" style="border-right: 1px solid #273169;">현대/기아</label>
                
                <!--01-->
                <div class="tab-content05" id="tab-content1">
                     <?php echo latest("theme/gallery", 'g_part01', 15, 25); ?>
                </div>
                
                <!--02-->
                <div class="tab-content05" id="tab-content2">
                     <?php echo latest("theme/gallery", 'g_part02', 15, 25); ?>
                </div>
                
                <!--03-->
                <div class="tab-content05" id="tab-content3">
                     <?php echo latest("theme/gallery", 'g_part03', 15, 25); ?>
                </div>
                
                <!--04-->
                <div class="tab-content05" id="tab-content4">
                     <?php echo latest("theme/gallery", 'g_part04', 15, 25); ?>
                </div>
         
            </div><!--//tabs-->
        </div><!--//wrapper-->
    </div><!--//m_latest-->

    <div id="m_content03">
        <div class="r_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_content03_img02.jpg" alt=""></div>
        <div class="area">
            <header>
                  <h3 class="wow fadeInDown" data-wow-delay="0.3s">daesan auto<span>COMPANY story</span></h3>
                  <p class="wow fadeInDown" data-wow-delay="0.5s">버스부품, 엔진부품 전문 유통업체 (주)대산오토 입니다. 고객의 안전과 편의를 위해 최선을 다하여 여행의 길잡이와 추억이 되어가는 길, 그 행복한 노정에서 저희 (주)대산오토는 함께 걷는 동반자의 역할을 맡겠습니다.<br class="hidden-xs" />저희 (주)대산오토는 끊임없이 변화하는 시장에서 고객의 만족을 위하여 품질 개선과 서비스 향상에 노력해 왔으며, 새 천년을 맞아 도전과 창조의 정신으로 버스가 있는 곳이면 어디든지 그 무대를 확장해 나가고 있습니다.</p>
                  <div class="t_margin22 wow bounceIn" data-wow-delay="0.5s"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=introduce01" class="btn_roll02">회사소개 바로가기 <i class="fal fa-arrow-circle-right"></i></a></div>
            </header>
        </div>
    </div>
    
    <?php /*?><div id="m_content05">
        <div class="area">
            <ul>
                 <li class="wow fadeInDown" data-wow-delay="0.1s">
                     <h3>NEWS<span>(주)대산오토 새소식 안내</span></h3>
                     <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice"><div class="more"></div></a>
                 </li>
                 <li class="wow fadeInDown" data-wow-delay="0.3s"><?php echo latest("theme/basic", "b_notice", 3, 30); ?></li>
            </ul>
        </div>
    </div><?php */?>

    <!--<div id="m_content05">
        <div class="area">
            <ul>
                 <li class="wow fadeInDown" data-wow-delay="0.1s">
                     <h3>Order<span>(주)대산오토 부품주문</span></h3>
                     <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_request"><div class="more"></div></a>
                 </li>
                 <li class="wow fadeInDown" data-wow-delay="0.3s"><? /* php echo latest("theme/basic", "b_request", 3, 30); */?></li>
            </ul>
        </div>
        <div class="area">
            <ul>
                 <li class="wow fadeInDown" data-wow-delay="0.1s">
                     <h3>Request<span>(주)대산오토 온라인문의</span></h3>
                     <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_online"><div class="more"></div></a>
                 </li>
                 <li class="wow fadeInDown" data-wow-delay="0.3s"><? /* php echo latest("theme/basic", "b_online", 3, 30); */?></li>
            </ul>
        </div>
    </div>-->


    <div id="business" class="wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1s">
        <h2 class="title">믿음과 신뢰의 기업<strong><?php echo $config['cf_title']; ?></strong><span>고품질의 제품을 신속하고 정확한 서비스로 제공해 드리겠습니다.</span></h2>
        <ul class="sec03_ul">
            <li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s"><div class="ic"><i class="fal fa-handshake-alt"></i></div><span>고객과의 신뢰</span></li>
            <li class="wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="0.8s"><div class="ic"><i class="fal fa-lightbulb-on"></i></div><span>우수한 품질</span></li>
            <li class="wow fadeInUp animated" data-wow-delay="1.0s" data-wow-duration="0.8s"><div class="ic"><i class="fal fa-atom-alt"></i></div><span>최고의 기술력</span></li>
            <li class="wow fadeInDown animated" data-wow-delay="1.4s" data-wow-duration="0.8s"><div class="ic"><i class="fal fa-bezier-curve"></i></div><span>긍정의 조직력</span></li>
        </ul>
        <div class="sec03_link wow flipInX animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_data01">기술자료실 바로가기 →</a>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_data02">정비기술공유 바로가기 →</a>
        </div>
    </div>

</section>


<?php
include_once(G5_PATH.'/tail.php');
?>