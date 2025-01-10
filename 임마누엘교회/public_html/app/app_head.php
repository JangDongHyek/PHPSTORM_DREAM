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
    case "login" :
        $header_type = 0;
        $footer_type = 0;
        break;
    case "index" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '';
        break;
    case "prayer" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '도고기도';
        break;
    case "pray_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '도고기도';
        break;
    case "note" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '결단노트';
        break;
    case "note_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '결단노트';
        break;
    case "friend" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '교우소식';
        break;
    case "friend_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '교우소식';
        break;
    case "helper" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = '도우미';
        break;
    case "helper_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '도우미 요청';
        break;
    case "helper_view" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '도우미 내용';
        break;
    case "class" :
        $header_type = 1;
		$footer_type = 1;
		$header_name = 'IMC 속회방';
        break;
    case "class_form" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회보고';
        break;
    case "class_list" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회현황';
        break;
    case "class_noti" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회소식';
        break;
    case "class_list_view" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '교구별 보고현황';
        break;
    case "class_leader" :
        $header_type = 1;
		$footer_type = 2;
		$header_name = '속회 목회자';
        break;
    case "union" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = 'IMC 공동체';
        break;
    case "union_group" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교구방';
        break;
    case "union_small" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '소그룹';
        break;
    case "union_mission" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = 'IMC 선교회';
        break;
    case "union_ministry" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '사역부서';
        break;
    case "union_culture" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '문화부';
        break;
    case "rental" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '대관 신청';
        break;
    case "rental_hall" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '본당 대관';
        break;
    case "hall_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '본당 대관';
        break;
    case "hall_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '본당 대관';
        break;
    case "rental_lecture" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '교육관 대관';
        break;
    case "lecture_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교육관 대관';
        break;
    case "lecture_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '교육관 대관';
        break;
    case "rental_bus" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '버스 사용';
        break;
    case "bus_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '버스 사용';
        break;
    case "bus_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '버스 사용';
        break;
    case "rental_equip" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '비품 대여';
        break;
    case "equip_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '비품 대여';
        break;
    case "equip_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '비품 대여';
        break;
    case "lost" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = '분실물 찾기';
        break;
    case "lost_form" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '분실 등록';
        break;
    case "lost_report" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '습득물 등록';
        break;
    case "lost_view" :
        $header_type = 1;
        $footer_type = 2;
        $header_name = '분실물 내용';
        break;
}


?>


<script src="<?php echo G5_URL; ?>/app/js/sweetalert2.all.min.js"></script>
<script src="<?php echo G5_URL; ?>/app/js/ui.js"></script>
<link href="<?php echo G5_URL; ?>/app/css/style.css?v=<?php echo date('Y h:i:s A'); ?>" rel="stylesheet" type="text/css"><!--app-->
<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<?php if ($header_type == 0) { ?>

<?php } else if ($header_type == 1) { ?>
<header id="header" <? if($pid=='index') { echo 'class="index"';}?>>
    <a class="hd_logo" href="<?php echo G5_URL ?>/app">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="임마누엘 교회">
    </a>
    <a class="hd_title">
        <?=$header_name?>
    </a>
    <label for="sideToggle"><input type="checkbox" id="sideToggle"><i class="fa-solid fa-bars"></i> </label>
</header>
<?php } ?>

<div id="wrapper">

