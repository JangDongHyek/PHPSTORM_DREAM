<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<header id="hd" <?php if(defined('_INDEX_')){ echo "class='idx'"; } ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
	
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-2">
            	<div id="hd_back" class="hd_icon">
                    <a href="javascript:history.back();">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/hd_back.png"><span class="sound_only">뒤로</span>
                    </a>
                </div>
            </div>
    
            <div class="col-xs-8" style="padding:0;">
				<?php if(defined('_INDEX_')) { ?>
                    <a id="logo" href="<?php echo G5_URL ?>/index.php">
                        <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>">
                    </a>
                <?php } else { ?>
                    <div id="title" class="ane"><?php echo $g5['title'] ?></div>
                <?php } ?>
            </div>
    		<div class="col-xs-2">
                <div id="hd_nb" class="nav_open hd_icon">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/app/hd_menu.png" alt="열기">
                    </a>
                </div>
            </div>
        </div>
    </div>	
	
</header>

<div id="wrapper">
	<? if(defined('_INDEX_')) {?>
        <div id="idx_container">
	<? }else { ?>
        <div id="aside">
        </div>
        <div id="container">
    <?php } ?>