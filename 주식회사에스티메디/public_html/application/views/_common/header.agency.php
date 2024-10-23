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
    case "adm_member" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "계약업체";
        break;
    case "agency_list" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "계약업체";
        break;
    case "agency_index" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "에이전시관리";
        break;
    case "agency_member" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "에이전시관리";
        break;
    case "agency_member_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "업체관리";
        break;
    case "agency_account" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "정산관리";
        break;
}

$CI =& get_instance();
$CI->load->vars(['header_name' => $header_name]);

?>
<link href="<?=ASSETS_URL?>/css/agency.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<?php include_once MODAL_PATH. "adm_info_modal.php" // 관리자 정보수정 모달 ?>

<div id="agency">

    <header id="header">
        <h1 id="hd_h1" class="logo flex js">
			<a href="<?=PROJECT_URL?>" target="_blank"><img src="<?=ASSETS_URL?>/img/common/logo_w.png" title=""/></a>
			<button type="button" class="btn" id="btnMenu" onclick="btnCate()">메뉴</button>
		</h1>
        <div id="hd_wrapper" >
            <div id="gnb" class="hd_div">
                <ul id="gnb_1dul">
                    <li class="gnb_1dli" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <a class="gnb_1da"><i class="fa-thin fa-user-tie"></i><p>에이전트</p><?=$member['mb_name']?></a>
                    </li>
                    <li class="gnb_1dli">
                        <a class="gnb_1da"><i class="fa-light fa-sidebar"></i> 관리</a>
                        <ul class="gnb_2dul">
                            <!--
                            <?php if($member['mb_level'] == 10 ){ ?>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/agency/" class="gnb_2da"><span>관리자</span>에이전시관리</a></li>
                            <?php } ?>
                            -->
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/agency/list" class="gnb_2da">계약업체</a></li>
                            <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/agency/account" class="gnb_2da">정산관리</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

		<script>
			function btnCate() {
				var cate = document.getElementById("hd_wrapper");
				var btn = document.getElementById("btnMenu");
				if (cate.classList.contains('off')) {
					cate.classList.remove('off');
					btn.innerText = "메뉴";
				} else {
					cate.classList.add('off');
					btn.innerText = "닫기";
				}
			}
		</script>

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
