<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');

//현재주소를 불러옴
$uri = $_SERVER['REQUEST_URI'];

$back_div = "";
if (strpos($uri, 'my_service_ok.php') == false && strpos($uri, 'register')  == false ){
    $back_div = ' <div id="hd_back">
            <a href="javascript:history.back();">
            <i class="far fa-chevron-left"></i><span class="sound_only">뒤로</span>
            </a>
        </div>';
}

?>



<?php if ($member['mb_level'] == 2  || $is_guest){ ?>
<!--고객용 상단-->
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
	
    
<?php if(defined('_INDEX_')) { ?>
    <div id="hd_wrapper">
        <div id="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <span></span><span></span><span></span>
            </a>
        </div><!--#nav_open-->
        <div id="logo"><a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" title="출세왕"/></a></div>
        <?php if ($is_member){?>
        <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage.php"><i class="far fa-user"></i></a></div>
        <?php }?>
    </div><!--hd_wrapper-->
<?php } else { ?>
    <div id="hd_wrapper">
        <?= $back_div ?>
        <div id="title"><?php echo $g5['title'] ?></div>
        <?php if ($is_member){ ?>
        <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage.php"><i class="far fa-user"></i></a></div>
        <?php }?>
    </div><!--hd_wrapper-->
<?php } ?>
</header>
<!--고객용 상단-->
<?php } ?>


<?php if ($member['mb_level'] >= 3){ ?>
<!--매니저용 상단-->
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
	
    
<?php if(defined('_INDEX_')) { ?>
    <div id="hd_wrapper">
        <div id="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <span></span><span></span><span></span>
            </a>
        </div>
        <div id="logo"><a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" title="출세왕"/></a></div>
        <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage_manager.php"><i class="far fa-user"></i></a></div>
    </div>
<?php } else { ?>
    <div id="hd_wrapper">
        <?= $back_div ?>
        <div id="title"><?php echo $g5['title'] ?></div>
        <?php if ($is_member){ ?>
        <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage_manager.php"><i class="far fa-user"></i></a></div>
        <?php } ?>
    </div>
<?php } ?>
</header>
<!--매니저용 상단-->
<?php } ?>



<div id="wrapper">
	<? if(defined('_INDEX_')) {?>
        <div id="idx_container">
	<? }else { ?>
    <!--서브메뉴-->
    <?php 
                    
        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)		
        echo submenu($sm_tid, 'basic', G5_THEME_MOBILE_PATH); 
    ?>
        <div id="container">
    <?php } ?>