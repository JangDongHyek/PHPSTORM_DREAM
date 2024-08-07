<?php
require_once("../common.php");
require_once('../head.sub.php');

/**
 * 헤더타입
 * 0 : 헤더없음
 * 1 : 푸시아이콘, 앱이름, 마이페이지
 * 2 : 뒤로가기, 상단페이지명
 */
$header_type = 0;       // 헤더타입
$footer_type = 0;       // 푸터타입
$header_name = "";      // 상단페이지명
$lnb_name = "";      // 서브페이지명
$content_id = "";       // div id
$content_class = "";    // div class

switch ($pid) {
    case "index" :  // 메인
        $header_type = 1;
		$footer_type = 2;
		$header_name = " ";
        break;
    case "now" :  // 
        $header_type = 2;
		$footer_type = 2;
		$header_name = "배송현황";
        break;
    case "pay" :  // 
        $header_type = 2;
		$footer_type = 2;
		$header_name = "인수증 발급";
        break;
    case "done" :  // 
        $header_type = 3;
		$footer_type = 2;
		$header_name = "인수증 확인";
        break;
    case "map" :  // 
        $header_type = 4;
		$footer_type = 2;
		$header_name = "";
        break;
    case "admin" :  // 
        $header_type = 5;
		$footer_type = 2;
		$header_name = "";
    break;
}

/* APP 계정으로 로그인 안 되어 있을 경우 direction 
   알림톡 배송 조회의 경우에는 바로 보이게 처리
*/

if($header_type != 5){
    if($member['mb_id'] == '' && explode('/', $_SERVER['REQUEST_URI'])[2] != 'bbs' && $pid != 'map'){
        header('Location: '.G5_BBS_URL.'/login.php');
        exit;
    }else if($member['mb_id'] == 'admin'){
//        header('Location: '.ADMIN_URL);
//        exit;
    }
}    
?>

<script>
    /* APP 기본적으로 앱 새로고침 안 되게 */
    setIsRefresh(false);
</script>
<? if ($header_type == 1) { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-3">
                <a href="./index.php" id="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" class=""></a>
            </div>
            <div class="col-xs-6" style="padding:0;">
				 <div id="title">
					<?=$header_name?>
                    </div>
            </div>
    		<div class="col-xs-3" style="padding-left: 0">
                <div id="hd_nb" class="hd_icon">
                   <button type="button" class="mobile-menu"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } else if ($header_type == 2) { ?>
<header id="hd" class="">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-3">
                <a href="./index.php" id="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" class=""></a>
            </div>
            <div class="col-xs-6" style="padding:0;">
				 <div id="title">
					<?=$header_name?>
                    </div>
            </div>
    		<div class="col-xs-3" style="padding-left: 0">
                <div id="hd_nb" class="hd_icon">
                    <a href="javascript:history.back();">
                    <i class="fa-light fa-angle-left"></i>
                    </a>
                   <button type="button" class="mobile-menu"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } else if ($header_type == 3) { ?>
<header id="hd" class="t2">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-3">
                <a href="./index.php" id="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_g.svg" class=""></a>
            </div>
            <div class="col-xs-6" style="padding:0;">
				 <div id="title">
					<?=$header_name?>
                    </div>
            </div>
    		<div class="col-xs-3" style="padding-left: 0">
                <div id="hd_nb" class="hd_icon">
                    <a href="javascript:history.back();">
                    <i class="fa-light fa-angle-left"></i>
                    </a>
                   <button type="button" class="mobile-menu"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } else if ($header_type == 4) { ?>
<header id="hd" class="t3">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-3">
                 <a href="javascript:history.back();">
                    <button type="button" class="btn-map"><i class="fa-solid fa-angle-left"></i></button>
                    </a>
            </div>
            <div class="col-xs-6" style="padding:0;">
            </div>
    		<div class="col-xs-3" style="padding-left: 0">
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } else if ($header_type == 5) { ?>
	
<div id="wrapper">

<? } else { ?>
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div class="to_content"><a href="#container">본문 바로가기</a></div>
    <div id="hd_wrapper">
        <div class="row">
            <div class="col-xs-2">
            	<div id="hd_back" class="hd_icon">
                    <a href="javascript:history.back();">
                    <i class="fa-light fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="col-xs-8" style="padding:0;">
                    <div id="title">
					<?php echo $g5['title'] ?>
                    </div>
            </div>
    		<div class="col-xs-2">
                <div id="hd_nb" class="hd_icon">
                    <?php /*?><a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="fa-regular fa-bars"></i><span class="sound_only">메뉴</span></a><?php */?>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper">
<? } ?>
