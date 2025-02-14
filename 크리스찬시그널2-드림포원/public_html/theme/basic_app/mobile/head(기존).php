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
?>

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
	
    
<?php if(defined('_INDEX_')) { ?>
    <div id="hd_wrapper" class="main">
        <div id="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <span></span><span></span><span></span>
            </a>
        </div><!--#nav_open-->
        <div id="logo"><a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" title="크리스천시그널"/></a></div>
        <?php if(basename($_SERVER["PHP_SELF"]) != 'register.php' && basename($_SERVER["PHP_SELF"]) != 'register_form.php') { ?>
            <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage.php"><i class="far fa-user"></i></a></div>
        <?php } ?>
    </div><!--hd_wrapper-->
    
    <!--카테고리메뉴부분-->
    <div id="nav_wrap" class="nav_cate">
        <div class="left-blur"></div>
        <div class="right-blur"></div>
        <div class="cate_list">
            <div id="cate_list01" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01" class="active">크리스천 시그널이어야만 하는 이유</a>
            </div>
            <div id="cate_list02" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">크리스천 시그널 협력사</a>
            </div>
            <div id="cate_list03" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">크리스천 시그널 가족</a>
            </div>
            <div id="cate_list04" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet04">크리스천 시그널의 슬로건</a>
            </div>
            <div id="cate_list05" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet05">크리스천 시그널 인사말</a>
            </div>
            <div id="cate_list06" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet06">나만의 프로필 작성해보기</a>
            </div>
            <div id="cate_list07" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07">운영목적</a>
            </div>
            <div id="cate_list08" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet08">크리스천의 특혜</a>
            </div>
            <div id="cate_list09" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet09">크리스천 시그널의 비전</a>
            </div>
        </div>
    </div><!--nav-wrap-->
    <!--카테고리메뉴부분-->
<?php } else { ?>
    <div id="hd_wrapper">
        <div id="hd_back">
            <?php if(basename($_SERVER["PHP_SELF"]) != 'register_result.php' && basename($_SERVER['PHP_SELF']) != 'my_profile_end.php') { ?>
            <a href="javascript:history.back();">
            <i class="far fa-chevron-left"></i><span class="sound_only">뒤로</span>
            </a>
            <?php } ?>
        </div><!--#nav_open-->
        <div id="title"><?php echo $g5['title'] ?></div>
        <?php if(basename($_SERVER["PHP_SELF"]) != 'register.php' && basename($_SERVER["PHP_SELF"]) != 'register_form.php' && basename($_SERVER["PHP_SELF"]) != 'register_result.php'
            && basename($_SERVER["PHP_SELF"]) != 'my_profile01.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile02.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile03.php'
            && basename($_SERVER["PHP_SELF"]) != 'my_profile_end.php') { ?>
            <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage.php"><i class="far fa-user"></i></a></div>
        <?php } ?>
    </div><!--hd_wrapper-->
<?php } ?>


</header><!--hd-->

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