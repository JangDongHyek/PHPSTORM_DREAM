<?php
include_once APPPATH."Views/template/head.sub.php";
helper('header');

$headerData = getAdmPageSettings($pid ?? '');
$header_type = $headerData['header_type'];       // 헤더타입
$footer_type = $headerData['footer_type'];       // 푸터타입
$header_name = $headerData['header_name'];      // 상단페이지명
$lnb_type = $headerData['lnb_type'];            // 좌측메뉴 디자인
$sub_type = $headerData['sub_type'];            // 상단메뉴명 디자인

?>
<link href="<?=base_url()?>css/sidebar.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/adm.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>js/adm/adm_utils.js?<?=JS_VER?>"></script>

<?php if ($header_type == 0) { ?>
<div class="page-wrapper chiller-theme toggled">
    <?php include_once APPPATH."Views/template/adm_sidebar.php"; //사이드메뉴 ?>
    <main class="page-content">
        <header class="flex ai-c jc-sb">
            <h3><?= $header_name ?></h3>
            <div class="flex ai-c">
                <!--<a class="btn btn_mini btn_gray" href="./admInfo"><i class="fa-light fa-gear"></i> 관리자정보</a>-->
                <a class="btn btn_mini btn_gray" href="../logout"><i class="fa-light fa-arrow-right-from-bracket"></i> <span>로그아웃</span></a>
                <a class="btn btn_mini btn_black" href="../" target="_blank"><i class="fa-light fa-browser"></i> <span>사이트 바로가기</span></a>
            </div>
        </header>
        <div class="container-fluid <?php if ($pid == 'homepage_sample') { echo 'sample_bg';} ?>" >
            <div class="title_wrap">
<?php } else { ?>
<?php } ?>
<!--//header_type-->
