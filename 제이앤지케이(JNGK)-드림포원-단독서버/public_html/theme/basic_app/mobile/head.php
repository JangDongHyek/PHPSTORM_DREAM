<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/latest.lib.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/poll.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
include_once(G5_LIB_PATH . '/submenu.lib.php');
?>

<script>
<?php if(0 < strpos($_SERVER['HTTP_USER_AGENT'], "OSJNGK")) { ?>
//webkit.messageHandlers.scriptHandler.postMessage(true); // 세로모드
<?php } ?>
</script>

<header id="hd" <?php if (defined('_INDEX_')) {
    echo "class='idx'";
} ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if (defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH . '/newwin.inc.php'; // 팝업레이어
    } ?>

    <?php if (defined('_INDEX_')) { ?>
        <div id="hd_wrapper">
            <a id="logo" href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>">
            </a>
            <?php ?>
            <div id="hd_nb" class="nav_open hd_icon">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL; ?>/hash/"
                   data-ref="1" data-animation="left">
                    <span class="hd_open2"></span><span class="hd_open2"></span><span class="hd_open2"></span>
                </a>
            </div><?php ?>
        </div>
    <?php } else { ?>
        <div id="hd_wrapper">
            <div id="hd_back" class="hd_icon">
                <?php if (basename($_SERVER["PHP_SELF"]) != 'register_result.php') { ?>
                    <a href="javascript:history.back();">
                        <i class="fal fa-arrow-left"></i><span class="sound_only">뒤로</span>
                    </a>
                <?php } ?>
            </div>
            <div id="title"><?php echo $g5['title'] ?></div>
        </div>
    <?php } ?>
</header>

<div id="wrapper">
    <? if (defined('_INDEX_')) { ?>
    <div id="idx_container">
        <? } else { ?>
        <!--서브메뉴-->
        <?php /*?><?php

        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)
        echo submenu($sm_tid, 'basic', G5_THEME_MOBILE_PATH);
    ?><?php */ ?>
        <div id="container">
            <?php } ?>
