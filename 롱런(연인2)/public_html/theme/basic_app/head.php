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

<!-- 상단 시작 { -->
<div id="hd" class="web <?php if(!defined('_INDEX_')){ echo 'on sub'; } ?>">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">

        <a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_IMG_URL ?>/logo.svg" alt="<?php echo $config['cf_title']; ?>" class="logo"></a>
        
        <div class="btn_down">
            <a href="javascript:alert('준비중입니다.')"><i class="fa-brands fa-google-play"></i></a>
            <a href="javascript:alert('준비중입니다.')"><i class="fa-brands fa-apple"></i></a>
        </div>
    </div><!--//hd_wrapper-->
    
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<? if(defined('_INDEX_')) {?>

        <div id="idx_wrapper">

<? } else { ?>
        <div id="wrapper">

            <div id="container_title">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?>
            </div><!--//container_title"-->

<? } ?>
