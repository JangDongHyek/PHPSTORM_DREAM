<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

// 대리점명, 대표번호
$rs = sql_fetch("SELECT mb_nick, mb_11 FROM g5_member WHERE mb_no = '{$_SESSION['myAgency']}'");
$agency_hd_title = ($rs['mb_nick'] != "")? $rs['mb_nick'] : "T탁송";
$agency_hd_tel = ($rs['mb_11'] != "")? $rs['mb_11'] : "1599-1009";

if ($member['mb_level'] == "10") {
	// admin은 $_SESSION['myAgency']가 없음
}

?>
<header id="hd" class="<?php if(!defined('_INDEX_')){ echo 'sub'; } ?> <?php if(defined('_INDEX_')){ echo 'wow fadeInDownBig animated'; } ?>" data-wow-delay="0s" data-wow-duration="0s">

    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
    <div id="hd_wrapper" class="cf">
    
    	<div class="back_icon col-xs-4">
			<?php if(defined('_INDEX_')) { ?>
                <div style="font-size:14px; line-height:24px; font-weight:900;"><a href="tel:<?=preg_replace("/[^0-9]*/s", "", $agency_hd_tel)?>" style="color:#eb0101"><?=$agency_hd_tel?></a></div>
            <?php } else { ?>
                <!--<a href="" class="bell_btn"><i class="far fa-bell"></i></a> -->
                <a onclick="history.back();" class="back_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/back.png"></a>
            <?php } ?>
        </div>
		
        <div id="logo" class="col-xs-4">
			<? if ($bo_table || $co_id){ ?>
           	<span><? echo $bo_table? $board['bo_subject'] : $g5['title']; ?></span>
			<? } else { ?>
			<a href="<?php echo G5_URL ?>/index.php"><!--<img src="<?php echo G5_IMG_URL ?>/logo.png">--><?=$agency_hd_title?></a>
            <? } ?>
        </div>
        
        <div class="hash_icon col-xs-4">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
               <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/menu.png" alt="open">
            </a>
            <div class="point">
                <span>충전금</span>
                <p id="my_pt"><?=number_format($member[mb_point])?></p>
            </div>
        </div>
  
    </div>
    <!--//hd_wrapper-->
    
</header>


<? if($bo_table!="service"){?>
<div id="wrapper">
    <div id="container">
        <? if($bo_table || $co_id){ ?>
        <div id="container_title"><?php //echo $g5['title'] ?></div>
        <? } else {?>
		<?php }} ?>
