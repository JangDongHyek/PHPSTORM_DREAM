<?php
require_once("../common.php");
require_once('../head.sub.php');
require_once("./__init.php");

// PC접근불가
if (!isMobilePage()) { // 모바일 아니면
    if(strpos($_SERVER['PHP_SELF'], 'login') !== false) {} // 로그인페이지 제외
    else {
        include_once('./app_head.php');
        echo "<div style='padding: 50px 0; font-size: 2em; text-align: center;'>잘못된 접근입니다.</div>";
        include_once('./app_tail.php');
        exit;
    }
}

/**
 * 헤더타입
 * 0 : 헤더없음
 * 1 : 푸시아이콘, 앱이름, 마이페이지
 * 2 : 뒤로가기, 상단페이지명
 */
$header_type = 0;       // 헤더타입
$header_name = "";      // 상단페이지명
$lnb_name = "";      // 서브페이지명
$content_id = "";       // div id
$content_class = "";    // div class

switch ($pid) {
    case "index" :  // 메인
        $header_type = 1;
		$header_name = "준도시락";
        break;
    case "menu_deli" :  // 메뉴안내
        $header_type = 2;
		$header_name = "메뉴안내 및 주문";
		$lnb_name = "정기배달도시락";
        break;
    case "menu_event" :  // 메뉴안내
        $header_type = 2;
		$header_name = "메뉴안내 및 주문";
		$lnb_name = "행사용도시락";
        break;
    case "menu_warm" :  // 메뉴안내
        $header_type = 2;
		$header_name = "메뉴안내 및 주문";
		$lnb_name = "발열도시락";
        break;
    case "menu_salad" :  // 메뉴안내
        $header_type = 2;
		$header_name = "메뉴안내 및 주문";
		$lnb_name = "샐러드팩";
        break;
    case "order_deli" :  // 주문하기
        $header_type = 2;
		$header_name = "주문하기";
        break;
    case "order_event" :  // 주문하기
        $header_type = 2;
		$header_name = "주문하기";
        break;
    case "order_list" :  // 주문내역
        $header_type = 2;
		$header_name = "주문내역";
        break;
    case "cart" :  // 장바구니
        $header_type = 2;
		$header_name = "장바구니";
        break;
    case "privacy" : // 개인정보처리방침
        $header_type = 2;
        $header_name = "개인정보처리방침";
        break;
    case "provision" : // 서비스이용약관
        $header_type = 2;
        $header_name = "서비스이용약관";
        break;
    case "chat" : // 식단표
        $header_type = 2;
        $header_name = "식단표";
        break;
    case "notice" : // 공지사항
        $header_type = 2;
        $header_name = "공지사항";
        break;
    case "rider_order" :  // 기사배달내역
        $header_type = 2;
		$header_name = "";
        break;
    case "adm_order" :  // 관리자주문내역
        $header_type = 2;
		$header_name = "관리자 주문내역";
        break;
    case "cal_order" :  // 주문하기
        $header_type = 2;
		$header_name = "주문하기";
        break;
    case "cal_order_details" :  // 주문내역
        $header_type = 2;
		$header_name = "주문내역";
        break;
    case "guide" :  // 사전안내사항
        $header_type = 2;
		$header_name = "사전안내사항";
        break;
}

// 기사
$gisa = false;
if($member['mb_level'] == 3) { $go_url = APP_URL.'/rider_order.php'; $gisa = true; } // 앱-기사
else if($member['mb_level'] == 9) { $go_url = APP_URL.'/adm_order.php'; } // 앱-관리자(admin2)
else { $go_url = APP_URL.'/cal_order_list.php'; } // 앱-회원
?>
<? if ($header_type == 1) { ?>
<!-- 공통헤더 -->
<div id="hd" class="idx">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-2">
            </div>
            <div class="col-xs-6" style="padding:0;">
            </div>
    		<div class="col-xs-4" style="padding-left:0;">
                <div id="hd_nb" class="nav_open hd_icon">
                    <?php /*?><a onclick="openLeftMenu()"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기"></a>
                     <div id="left_menu">
                        <!-- 메뉴 -->
                        <?php include_once(".G5_URL.'/app/app_left_menu.php"); ?>
                    </div><?php */?>
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기">
                    </a>
					<?php if ($is_member) {  ?>
                    <?php if (!$gisa) { ?><a href="<?php echo $go_url ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="주문내역"></a><?php } ?>
                    <?php } else {  ?>
                    <a href="<?php echo APP_URL ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="로그인"></a>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="idx_wrapper">
<? } else if ($header_type == 2) { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-2">
            	<div id="hd_back">
                    <a href="javascript:history.back();">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_back.png"><span class="sound_only">뒤로</span>
                    </a>
                </div>
            </div>
            <div class="col-xs-6" style="padding:0;">
                    <div id="title">
					<?=$header_name?>
                    </div>
            </div>
    		<div class="col-xs-4" style="padding-left:0;">
                <div id="hd_nb" class="nav_open hd_icon">
                    <?php /*?><a onclick="openLeftMenu()"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기"></a>
                     <div id="left_menu">
                        <!-- 메뉴 -->
                        <?php include_once(".G5_URL.'/app/app_left_menu.php"); ?>
                    </div><?php */?>
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기">
                    </a>
					<?php if ($is_member) {  ?>
                    <?php if (!$gisa) { ?><a href="<?php echo $go_url ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="주문내역"></a><?php } ?>
                    <?php if ($gisa) { ?><a onclick="refresh()"><i class="fa-solid fa-rotate"></i></a><?php } ?>
                    <?php } else {  ?>
                    <a href="<?php echo APP_URL ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="로그인"></a>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } else  { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-2">
            	<div id="hd_back">
                    <a href="javascript:history.back();">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_back.png"><span class="sound_only">뒤로</span>
                    </a>
                </div>
            </div>
            <div class="col-xs-6" style="padding:0;">
                    <div id="title">
					<?php echo $g5['title'] ?>
                    </div>
            </div>
    		<div class="col-xs-4" style="padding-left:0;">
                <div id="hd_nb" class="nav_open hd_icon">
                    <?php /*?><a onclick="openLeftMenu()"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기"></a>
                     <div id="left_menu">
                        <!-- 메뉴 -->
                        <?php include_once(".G5_URL.'/app/app_left_menu.php"); ?>
                    </div><?php */?>
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_menu.png" alt="열기">
                    </a>
                    <?php if ($is_member) {  ?>
                    <?php if (!$gisa) { ?><a href="<?php echo $go_url ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="주문내역"></a><?php } ?>
                    <?php } else { ?>
                    <a href="<?php echo APP_URL ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_user.png" alt="로그인"></a>
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } ?>
