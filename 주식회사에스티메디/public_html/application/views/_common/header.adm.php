<?php
include_once VIEWPATH . "_common/head.sub.php";

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
    case "adm_index" :
        $header_type = 0;
        $footer_type = 0;
        $header_name = "STmedi";
        break;
    case "adm_member" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "회원관리";
        break;
    case "adm_member_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "회원등록";
        break;
    case "adm_agency" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "에이전시 관리";
        break;
    case "adm_agency_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "에이전시 등록";
        break;
    case "adm_agency_fee" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "에이전시 정산";
        break;
    case "adm_product" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "상품관리";
        break;
    case "adm_product_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "상품등록";
        break;
    case "adm_order" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "주문배송관리";
        break;
    case "adm_order_view" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "주문상세";
        break;
    case "adm_misu" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "미수관리";
        break;
    case "adm_misu_detail" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "미수 상세정보";
        break;
    case "adm_popup" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "팝업관리";
        break;
    case "adm_popup_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "팝업등록";
        break;
    case "adm_esti_sample" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "비교견적 예시";
        break;
    case "adm_esti_sample_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "비교견적 예시등록";
        break;
    case "adm_product_request" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "제품문의 요청";
        break;
    case "adm_main_banner" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "메인 배너";
        break;
    case "adm_main_banner_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "메인 배너 등록";
        break;
}

$CI =& get_instance();
$CI->load->vars(['header_name' => $header_name]);

?>
<link href="<?=ASSETS_URL?>/css/adm.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<?php include_once MODAL_PATH. "adm_info_modal.php" // 관리자 정보수정 모달 ?>

<div id="adm" class="warpper">

    <header id="header">
        <h1 id="hd_h1" class="logo">
			<a href="<?=PROJECT_URL?>" target="_blank"><img src="<?=ASSETS_URL?>/img/common/logo_w.png" title=""/></a>
            <p>관리자페이지</p>
			<button type="button" class="btn" data-toggle="modal" data-target="#adminfo01">정보수정</button>
		</h1>
        <div id="hd_wrapper">
            <div id="gnb" class="hd_div">
                <ul id="gnb_1dul">
                    <li class="gnb_1dli">
                        <a class="gnb_1da"><i class="fa-light fa-sidebar"></i> 사이트관리</a>
                        <ul class="gnb_2dul">
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/member" class="gnb_2da">전체회원</a></li>
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/agency" class="gnb_2da">에이전시</a></li>
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/agencyFee" class="gnb_2da">에이전시 정산</a></li>
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/popup" class="gnb_2da">팝업목록</a></li>
							<li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/estiSample" class="gnb_2da">견적예시</a></li>
							<li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/mainBanner" class="gnb_2da">메인배너</a></li>
                        </ul>
                    </li>
                    <li class="gnb_1dli"><a class="gnb_1da"><i class="fa-light fa-bag-shopping"></i> 쇼핑몰관리</a>
                        <ul class="gnb_2dul">
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/product" class="gnb_2da">전체상품</a></li>
                            <!--
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/productKeyword" class="gnb_2da">상품 키워드관리</a></li>
                            -->
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/order" class="gnb_2da">주문배송</a></li>
							<li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/productRequest" class="gnb_2da">제품문의 요청</a></li>
                        </ul>
                    </li>
                    <!--li class="gnb_1dli"><a class="gnb_1da"><i class="fa-light fa-credit-card"></i> 결제관리</a>
                        <ul class="gnb_2dul">
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/adm/misu" class="gnb_2da">미수관리</a></li>
                        </ul>
                    </li-->
                </ul>
            </div>
        </div>
    </header>
    <?php if ($header_type == 0) { ?>
    <div id="wrapper" class="index">
        <?php } else if ($header_type == 1) { ?>
        <div id="wrapper">
            <div class="container">
                <div class="area_title">
                    <h2><?=$header_name?></h2>
                </div>

                <?php } else { ?>
                <?php } ?>
