<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
include_once(G5_PATH."/jl/JlConfig.php");
?>


<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<!-- 상단 시작(쌩코딩) -->
<header id="header">
    <h2>메인메뉴</h2>
    <div class="hd_inner">
        <h1 class="logo">
            <a href="<?php echo G5_URL ?>">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>">
            </a>
        </h1><!-- //logo -->

        <div class="gnb_wrap" >
            <ul>
                <li>
                    <a style="cursor:pointer">회사소개</a>
                    <ul>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">인사말</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">회사소개</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">찾아오시는길</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a style="cursor:pointer">사업분야</a>
                    <ul>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1">광역지질조사</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1">광역지질조사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_2">광물 및 암석 분석</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1">지반조사</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1">시추조사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_2">현장시험</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_1">지구물리탐사</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_1">GPR탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_2">탄성파탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_3">표면파탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_4">전기비저항탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_5">전기탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_6">자력탐사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_7">전자탐사</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_1">지구물리검층</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_1">하향식탄성파탐사/S-PS검층</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_2">크로스홀테스트</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_3">시추공영상촬영/초음파주사검층</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_4">음파검층/밀도검층</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_5">시추공자력검층</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_1">지반안정성검토</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_1">비탈면</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_2">저수지/제방</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_3">원격영상분석</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_4">터널</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_5">기초</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_1">지하안전점검 및 지하안전평가</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_1">지하안전점검</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_2">지하안전평가</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business07_1">상시자동화계측</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business07_1">자동화계측장비</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_1">환경/재해영향평가</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_1">환경영향평가</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_2">재해영향평가</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_1">지하수</a>
                            <ul>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_1">지하수영향조사</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_2">지하수영향평가</a></li>
                                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_3">지하수모델링</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business10_1">문화재 지반탐사</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business11_1">토취장/석상(채석) 매장량 및 경제성 평가</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a style="cursor:pointer">사업실적</a>
                    <ul>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company01">사업실적</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a style="cursor:pointer">커뮤니티</a>
                    <ul>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=data">자료실</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=activity">기술자문활동</a>
                        </li>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna">견적문의</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- //gnb_wrap -->


        <div class="hd_right">
            <div id="topm">
                <ul id="tnb">
                    <div class="tnb_box">
                        <!--<li><a href="<?php /*echo G5_URL */?>" class="home"><i class="fas fa-h-square"></i> 처음으로</a></li>-->
                        <?php if ($is_member) {  ?>
                            <?php if ($is_admin) {  ?>
                            <?php }  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fa-solid fa-lock-open"></i>로그아웃</a></li>
                        <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fa-solid fa-lock"></i>로그인</a></li>
                        <?php }  ?>
                    </div>
                </ul>
            </div><!--//topm-->

            <div class="all_menu_btn" style="cursor:pointer">
                <a href="#">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
            </div><!-- //all_menu_btn -->
        </div>


        <div class="hd_all_menu">
            <ul class="hd_tab_menu">
                <li>
                    <a href="" class="active">회사소개</a>
                </li>
                <li>
                    <a href="" class="">사업분야</a>
                </li>
                <li>
                    <a href="" class="">사업실적</a>
                </li>
                <li>
                    <a href="" class="">커뮤니티</a>
                </li>
            </ul>
            <div class="hd_tab active">
                <ul>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01" class="">인사말</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">DS파워</a>
                            </li>
                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02" class="">회사소개</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">22DS파워</a>
                            </li>
                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03" class="">찾아오시는길</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">333</a>
                            </li>

                        </ul> -->
                    </li>
                </ul>

                <div id="admin">
                    <?php if ($is_member) {  ?>
                        <?php if ($is_admin) {  ?>
                        <?php }  ?>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="far fa-power-off"></i> 로그아웃</a>
                    <?php } else {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="far fa-power-off"></i> 로그인</a>
                    <?php }  ?>
                </div>
            </div>
            <div class="hd_tab">
                <ul>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">광역지질조사</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_1">광역지질조사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business01_2">광물 및 암석 분석</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지반조사</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_1">시추조사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business02_2">현장시험</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지구물리탐사</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_1">GPR탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_2">탄성파탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_3">표면파탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_4">전기비저항탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_5">전기탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_6">자력탐사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business03_7">전자탐사</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지구물리검층</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_1">하향식탄성파탐사/S-PS검층</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_2">크로스홀테스트</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_3">시추공영상촬영/초음파주사검층</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_4">음파검층/밀도검층</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business04_5">시추공자력검층</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지반안정성검토</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_1">비탈면</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_2">저수지/제방</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_3">원격영상분석</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_4">터널</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business05_5">기초</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지하안전점검 및 지하안전평가</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_1">지하안전점검</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business06_2">지하안전평가</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="" class="">상시자동화계측</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business07_1">자동화계측장비</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">환경/재해영향평가</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_1">환경영향평가</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business08_2">재해영향평가</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth">
                        <a href="javascript:void(0);" class="">지하수</a>
                        <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_1">지하수영향조사</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_2">지하수영향평가</a>
                            </li>
                            <li>
                                <a target="" href="<?php echo G5_BBS_URL ?>/content.php?co_id=business09_3">지하수모델링</a>
                            </li>
                        </ul>
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business10_1" class="">문화재 지반탐사</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#"></a>
                            </li>
                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=business11_1" class="">토취장/석상(채석) 매장량 및 경제성 평가</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#"></a>
                            </li>
                        </ul> -->
                    </li>
                </ul>
            </div>
            <div class="hd_tab">
                <ul>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company01" class="">사업실적</a>
                         <!--<ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">사업실적</a>
                            </li>
                        </ul>-->
                    </li>
                </ul>
            </div>
            <div class="hd_tab">
                <ul>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="">공지사항</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">DS파워</a>
                            </li>
                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=data" class="">자료실</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">22DS파워</a>
                            </li>
                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=activity" class="">기술자문활동</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">333</a>
                            </li>

                        </ul> -->
                    </li>
                    <li class="depth noPluse">
                        <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna" class="">견적문의</a>
                        <!-- <ul class="react-slidedown closed">
                            <li>
                                <a target="" href="#">333</a>
                            </li>

                        </ul> -->
                    </li>
                </ul>
            </div>
            <div class="hd_all_close">
                <a href="#">
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div><!-- //오른쪽사이드메뉴 -->
    </div>
</header><!-- //header -->
<!-- } 상단 끝 -->



<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
        
	<!--서브컨테이너 부분-->
	<? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼-->
     <div id="svisual" class="wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="0.8s">
        <div class="s_text wow fadeInDown animated" data-wow-delay="1.2s" data-wow-duration="0.8s">
            <div class="img02">믿음직한 기술로 미래를 만들다</div>
            <div class="img01">혁신과 전문 기술이 어우러진 창조적 파트너십 한국지반연구소</div>
            <div class="mt"></div>
        </div>
     </div><!--svisual-->

    <!--서브메뉴(쌩코딩)-->
        <div id="subnav">
            <inc-sub-nav></inc-sub-nav>
        </div>


        <?
        $jl->vueLoad('subnav');
        $jl->componentLoad('inc');
        ?>

      
      
    
	<div id="container">
    <!--서브메뉴-->
		<? if($bo_table || $co_id){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
        
			<div id="scont">
				<!--서브타이틀-->
				<div id="sub_title">
                    <div class="container_title">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                    </div>
                    
				</div><!--#sub_title-->
				<!--서브타이틀-->

                <!--콘텐츠 시작-->
                <?php if($co_id == "business10_1") { ?>
                    <?php if($_SERVER['REMOTE_ADDR']=="112.160.220.208"){ ?>

                    <?php }?>
                <? } ?>

                <?php if($co_id == "business11_1") { ?>
                    <?php if($_SERVER['REMOTE_ADDR']=="112.160.220.208"){ ?>

                    <?php }?>
                <? } ?>
        <? } ?>
