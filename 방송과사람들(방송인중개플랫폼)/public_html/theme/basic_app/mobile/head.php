<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($_SESSION['ss_mb_id']) {
    if (!$member["mb_profile"] && (int)$member["mb_level"] < 4) {
        $profileUrl = "/bbs/mypage_profile.php";
        if (strpos($_SERVER['SCRIPT_FILENAME'], $profileUrl) == false) {
            if ($_SERVER['HTTP_HOST'] == "itforone.com") {
                $profileUrl = "/~broadcast" . $profileUrl;
            }
            alert("프로필 입력을 해야 이용가능합니다.", $profileUrl);
        }
    }
}
include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/latest.lib.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/poll.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
include_once(G5_LIB_PATH . '/submenu.lib.php');

$big_ctg = ctg_list(0);

if(empty($_GET['category_idx'])) $category_idx = $_GET['ctg'];
?>

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if (defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH . '/newwin.inc.php'; // 팝업레이어
    } ?>


    <div id="hd_wrapper" <?php if (defined('_INDEX_')) {
        echo "class='idx wow fadeInDown animated'";
    } ?> data-wow-delay="0.5s" data-wow-duration="0.3s">

        <div class="hd_idx">
            <div class="logo">
                <a href="<?php echo G5_URL ?>/index.php">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.svg" alt="<?php echo $config['cf_title']; ?>">
                </a>
            </div><!--logo-->
            <div class="hd_icon_right">
                <?php if ($is_member) { ?>
                    <?php if ($member['mb_level'] > 2) { ?>
                        <a href="<?php echo G5_BBS_URL ?>/item_write01.php" class="btn btn-xs">서비스등록</a>
                    <?php } ?>
                <?php } ?>
                <?php if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") { ?>
                    <a><i class="fa-sharp fa-solid fa-bell"></i></a>
                <?php } ?>
                <a href="#hash-search" id="hash_search" data-role="button" data-url="<?php echo G5_PLUGIN_URL; ?>/hash/"
                   data-ref="1" data-animation="left"><i class="fa-light fa-magnifying-glass"></i></a>
            </div>
        </div><!--idx-->

        <div id="hd_back" class="hd_icon">
            <a class="hd_icon01" href="javascript:history.back();">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_back.svg"><span class="sound_only">뒤로</span>
            </a>
            <a class="hd_icon02" href="javascript:history.back();">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_back_wt.svg"><span class="sound_only">뒤로</span>
            </a>
            <div id="title"><?php echo $g5['title'] ?></div>
        </div>

        <!--
		<div class="hd_ring">					
			<a href="">
				<img class="wt" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_ring_wt.svg">
				<img class="bk" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_ring.svg">
				<i class="ring"></i>
			</a>
		</div>
		-->


        <div class="hd_sch">
            <input type="text" placeholder="검색어를 입력해주세요.">
            <button type="submit"></button>
            <!--<a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_sch.svg"></a>-->
        </div>

        <!--
		<div class="left_menu">
			
			<div class="menu">
				<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL; ?>/hash/" data-ref="1" data-animation="left"><?php ?>
				<!--<a onclick="swal('준비 중입니다');return false;">
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
				</a>
			</div>
        </div><!--.left_menu-->

        <div class="area_uill">
            <ul class="utill_list">

                <?php if ($is_admin) { ?>
                    <li><a href="<?php echo G5_ADMIN_URL ?>">관리자</a></li>
                <?php } ?>
                <?php if ($is_member) { ?>
                    <?php if ($member['mb_level'] > 2) { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/item_write01.php">서비스등록</a></li>
                    <?php } ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/mypage_jjim.php">마이페이지</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php } ?>
                <?php if (!$is_member) { ?>

                    <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                    <li class="join"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                <?php } ?>
            </ul>
        </div><!--.gnb-->
    </div><!--#hd_wrapper-->
    </div>

</header>
<?php if (!defined('_INDEX_')) { ?>

    <div id="vue_head">
        <head-category category_idx="<?=$category_idx?>"></head-category>
        <!-- 해당코드 component화  -->
        <!--<div id="nav_area">-->
        <!--    <nav id="gnb">-->
        <!--        <h2>메인메뉴</h2>-->
        <!--        <ul id="gnb_1dul">-->
        <!--            <li class="gnb_1dli all_menu">-->
        <!--                <a href="#Link" class="gnb_1da"><i class="fa-light fa-bars"></i> 전체메뉴</a>-->
        <!--                <ul class="gnb_2dul">-->
        <!--                    --><?php //for ($i = 0; $i < count($big_ctg); $i++) {
        //                        $small_ctg = ctg_list($big_ctg[$i]["c_idx"]); ?>
        <!--                        <li class="gnb_2dli">-->
        <!--                            <a href="--><?php //echo G5_BBS_URL ?><!--/item_list.php?ctg=--><?//= $big_ctg[$i]["c_idx"] ?><!--"-->
        <!--                               class="gnb_2da">--><?//= $big_ctg[$i]["c_name"] ?><!--</a>-->
        <!--                            <div class="gnb_2dli_list" style="display:none">-->
        <!--                                <ul class="gnb_2dul ver02" style="display:none">-->
        <!--                                    --><?php //for ($a = 0; $a < count($small_ctg); $a++) { ?>
        <!--                                        <li class="gnb_2dli"><a-->
        <!--                                                    href="--><?php //echo G5_BBS_URL ?><!--/item_list.php?ctg=--><?//= $small_ctg[$a]["c_idx"] ?><!--"-->
        <!--                                                    class="gnb_2da">--><?//= $small_ctg[$a]["c_name"] ?><!--</a></li>-->
        <!--                                    --><?php //} ?>
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                        </li>-->
        <!--                    --><?php //} ?>
        <!---->
        <!--                    <li class="gnb_2dli">-->
        <!--                        <a href="" class="gnb_2da">방송레슨</a>-->
        <!--                        <div class="gnb_2dli_list" style="display:none">-->
        <!--                            <ul class="gnb_2dul ver02" style="display:none">-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">방송댄스레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">음악레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">연기레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">패션레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">뷰티레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">모델레슨</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">악기레슨</a></li>-->
        <!--                            </ul>-->
        <!--                        </div>-->
        <!--                    </li>-->
        <!--                    <li class="gnb_2dli">-->
        <!--                        <a href="" class="gnb_2da">방송알바</a>-->
        <!--                        <div class="gnb_2dli_list" style="display:none">-->
        <!--                            <ul class="gnb_2dul ver02" style="display:none">-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">방송알바</a></li>-->
        <!--                                <li class="gnb_2dli"><a href="" class="gnb_2da">기타알바</a></li>-->
        <!--                            </ul>-->
        <!--                        </div>-->
        <!---->
        <!--                    </li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!---->
        <!--            --><?php //for ($i = 0; $i < count($big_ctg); $i++) {
        //                $on = "";
        //                if ($_REQUEST["ctg"] == $big_ctg[$i]["c_idx"]) {
        //                    $on = 'head_on';
        //                }
        //                ?>
        <!---->
        <!--                <li class="gnb_1dli">-->
        <!--                    <a href="--><?php //echo G5_BBS_URL ?><!--/item_list.php?ctg=--><?//= $big_ctg[$i]["c_idx"] ?><!--"-->
        <!--                       class="gnb_1da --><?//= $on ?><!--">--><?//= $big_ctg[$i]["c_name"] ?><!--<span></span></a>-->
        <!--                </li>-->
        <!--            --><?php //} ?>
        <!---->
        <!--        </ul>-->
        <!--    </nav>-->
        <!--</div>-->
    </div>
<?php } ?>

<?php
include_once(G5_PATH . "/class/Lib.php");
$jl = new JL();
$jl->vueLoad("vue_head");
$jl->includeDir("/component/inc");
?>

<div id="wrapper">
    <? if (defined('_INDEX_')) { ?>
    <div id="idx_container">
        <? }else { ?>
        

        <!--서브메뉴-->

        <?php if ($_SERVER['QUERY_STRING'] == 'co_id=company') { ?>
        <div id="container_wrap">
            <?php } else { ?>
            <div id="container">
                <?php } ?>

                <div class="sub_title"><?php echo $g5['title'] ?></div>

                <?php } ?>

