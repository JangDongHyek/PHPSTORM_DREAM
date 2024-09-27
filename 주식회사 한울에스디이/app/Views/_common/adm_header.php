<?php
include_once APPPATH."Views/_common/head.sub.php";
helper('header');

$headerData = getAdmPageSettings($pid ?? '');
$header_type = $headerData['header_type'];       // 헤더타입
$footer_type = $headerData['footer_type'];       // 푸터타입
$header_name = $headerData['header_name'];      // 상단페이지명
$lnb_type = $headerData['lnb_type'];            // 좌측메뉴 디자인
$sub_type = $headerData['sub_type'];            //  상단메뉴명 디자인

?>
<link href="<?=base_url()?>css/adm.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />

<?php if ($header_type == 0) { ?>
    <!--헤더없음-->
<?php } else if ($header_type == 1) { ?>
<div class="page-wrapper chiller-theme toggled">
    <?php include_once APPPATH."Views/_common/adm_sidebar.php"; //사이드메뉴 ?>
    <header>
        <div class="tnb">
            <!--
            <a href=""><i class="fa-light fa-list-check"></i> 프로젝트 관리</a>

            <a href="./mypage"><i class="fa-light fa-gear"></i> 내 정보 관리</a>-->
            <a href=""><i class="fa-light fa-circle-info"></i> 이용가이드</a>
            <a href="../logout"><i class="fa-light fa-arrow-right-from-bracket"></i> 로그아웃</a>
        </div>
    </header>
    <main class="page-content">
        <div class="container-fluid <?php if ($pid == 'homepage_sample') { echo 'sample_bg';} ?>" >
            <div class="title_wrap">
                <?php if ($sub_type == 0) { ?>
                    <h3><?= $header_name ?></h3>
                <?php } else if ($sub_type == 1) { ?>
                    <h2 data-toggle="modal" data-target="#moveModal" class="i_green"><span tooltip="클릭시 프로젝트 이동 가능" flow="up">당진 수청지구 공동1블럭</span>
                        <?php if($pid == "overall") { ?><span class="icon icon_line">종합 공정 현황</span><?php } ?>
                    </h2>
                    <?php if ($lnb_type == 0) { ?>
                        <?php if($pid != "overall") { ?><h3><?= $header_name ?></h3><?php } ?>
                    <?php } else if ($lnb_type == 1) { ?>
                        <?php include_once APPPATH."Views/_common/lnb.php"; //상단서브메뉴 ?>
                    <?php } ?>
                <?php } ?>
                <?php } else { ?>
                <?php } ?>
                <!--//header_type-->
