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
?>

<div id="aside">
    <ul>
        <li><a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="far fa-bars"></i></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=case"><img src="<?php echo G5_THEME_IMG_URL ?>/main/aside_icon01.png" class="icon"><p>적용사례</p></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=news"><img src="<?php echo G5_THEME_IMG_URL ?>/main/aside_icon02.png" class="icon"><p>고객지원</p></a></li>
        <li class="call">
            <span class="txt_mapo">CMD</span><br><strong class="txt_blue">055.</strong><br>905.<br>2098
        </li>
        <li><a href="#hd" class="topHd"><i class="far fa-chevron-up"></i></a></li>
    </ul>
</div>

<!-- 상단 시작 { -->
<div id="hd" <?php if(!defined('_INDEX_')){ echo "class='sub'"; } ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
        <div id="logo">
            <a class="white" href="<?php echo G5_URL ?>/index2.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>"></a>
            <a class="color" href="<?php echo G5_URL ?>/index2.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->

        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

                for ($i=0; $row=sql_fetch_array($result); $i++) {
                ?>
                <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
                    <?php
                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul class="gnb_2dul">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    }

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
                <?php
                }

                if ($i == 0) {  ?>
                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
            <div id="tnb">
                <a class="hd_btn" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">FAQ</a>
                <div class="nav_open">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <i class="far fa-bars"></i>
                    </a>
                </div><!--모바일메뉴버튼-->

                <!--<div class="hd_sch">
                    <button type="button" id="hd_sch_open" class="hd_opener"><i class="fa-light fa-magnifying-glass"></i><span class="sound_only"> 열기</span></button>
                    <div id="hd_sch" class="hd_div">
                        <h2>사이트 내 전체검색</h2>
                        <form name="fsearchbox" action="<?php /*echo G5_BBS_URL */?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                            <input type="hidden" name="sfl" value="wr_subject||wr_content">
                            <input type="hidden" name="sop" value="and">
                            <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요" required maxlength="20">
                            <input type="submit" value="검색" id="sch_submit">
                        </form>

                        <script>
                            function fsearchbox_submit(f)
                            {
                                if (f.stx.value.length < 2) {
                                    alert("검색어는 두글자 이상 입력하십시오.");
                                    f.stx.select();
                                    f.stx.focus();
                                    return false;
                                }

                                // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                                var cnt = 0;
                                for (var i=0; i<f.stx.value.length; i++) {
                                    if (f.stx.value.charAt(i) == ' ')
                                        cnt++;
                                }

                                if (cnt > 1) {
                                    alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                                    f.stx.select();
                                    f.stx.focus();
                                    return false;
                                }

                                return true;
                            }
                        </script>
                    </div>
                    <script>
                        $(function () {
                            $(".hd_opener").on("click", function() {
                                var $this = $(this);
                                var $hd_layer = $this.next(".hd_div");

                                if($hd_layer.is(":visible")) {
                                    $hd_layer.hide();
                                    $this.find("span").text("열기");
                                } else {
                                    var $hd_layer2 = $(".hd_div:visible");
                                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                                    $hd_layer2.hide();

                                    $hd_layer.show();
                                    $this.find("span").text("닫기");
                                }
                            });

                            $(".hd_closer").on("click", function() {
                                var idx = $(".hd_closer").index($(this));
                                $(".hd_div:visible").hide();
                                $(".hd_opener:eq("+idx+")").find("span").text("열기");
                            });
                        });
                    </script>
                </div>-->
                <div class="hd_sch">
                    <a href="#hash-search" class="hd_opener" id="hash_search" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="fa-light fa-magnifying-glass"></i></a>
                </div>
                <ul class="area_login">
                    <?php if ($is_member) {  ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fa-light fa-unlock-alt"></i></a></li>
                        <?php if ($is_admin) {  ?>
                            <li><a href="<?php echo G5_ADMIN_URL ?>/member_list.php" title="관리자페이지" target="_blank"><b><i class="fa-light fa-gear"></i></b></a></li>
                        <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u" title="정보수정"><i class="fa-light fa-user"></i></a></li>
                        <?php } ?>
                    <?php } else {  ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fa-light fa-lock-alt"></i></a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_form.php" title="회원가입"><i class="fa-light fa-user"></i></a></li>
                    <?php } ?>
                </ul>
                <ul class="area_sns">
                    <li><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_ka.png"></li>
                    <li><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_bl.png"></li>
                </ul>
            </div>
        </nav>


    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼-->
     <div id="svisual">
		<div class="s_text">
            <span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="1.2s">THE BEST OF CMD TECHNOLOGY</span>
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">
                <?php if($bo_table || $co_id){ ?>
                    <?php
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;

                    if($sm_tid)
                        echo submenu($sm_tid, 'title', G5_THEME_PATH);
                    ?>
                <?php } else { ?>
                    씨엠디테크놀로지
                <?php } ?>
            </h3>
        </div><!--.s_text-->
     </div><!--svisual-->
	<div id="container">
        <?php
        if(empty(strpos($_SERVER['PHP_SELF'],"search.php"))){
        ?>
        <div class="lnb_wrap wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.5s">
            <div class="inr">
                <div>
                <!--서브메뉴-->
                <?php
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
                if($sm_tid)
                    echo submenu($sm_tid, 'basic', G5_THEME_PATH);
                ?>
                </div>
                <div class="flex">
                    <!--메뉴로케이션-->
                    <?php

                    if(!$is_register || $w){
                        if(!$sm_tid)	$sm_tid = $co_id;
                        if(!$sm_tid)	$sm_tid = $bo_table;
                        if($sm_tid)
                            echo submenu($sm_tid, 'location', G5_THEME_PATH);
                    }
                    ?>
                    <a class="home" href="<?php echo G5_URL ?>/index2.php"><i class="fa-light fa-home"></i></a>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="inr">
				<!--서브타이틀-->
                <div class="container_title">
                      <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                    </div>
				<!--//서브타이틀-->
	<? } ?>
