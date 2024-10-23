<?php

//SSL 리다이렉트
if(!isset($_SERVER["HTTPS"]) || strpos($_SERVER["HTTP_HOST"],'www.') !== false || strpos($_SERVER["HTTP_HOST"],'stmedi.com') !== false) {header('Location: https://'.str_replace('www.','',"stmedi.co.kr").$_SERVER['REQUEST_URI'],true,301);}
//SSL 리다이렉트 끝
include_once VIEWPATH . "_common/head.sub.php";

/**
 * 헤더타입
 * 0 : 헤더없음
 * 1 : 푸시아이콘, 앱이름, 마이페이지
 * 2 : 뒤로가기, 상단페이지명
 */
$header_type = 0;       // 헤더타입
$footer_type = 0;       // 푸터타입
$header_name = getMallHeaderName($pid);      // 상단페이지명
$lnb_name = "";      // 서브페이지명
$content_id = "";       // div id
$content_class = "";    // div class

switch ($pid) {
	case "index" :
		$header_type = 0;
		$footer_type = 0;
		$header_name = "STmedi";
		break;
	case "login" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "로그인";
		break;
	case "find_account" :
	case "reset_pw" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "아이디/비밀번호 찾기";
		break;
	case "signup" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "회원가입";
		break;
    case "event" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "기획전";
        break;
	case "product_list" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "제품리스트";
		break;
	case "medicinal_list" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "제품리스트";
		break;
	case "medicinal_search" :
		$header_type = 0;
		$footer_type = 0;
		$header_name = "제품리스트";
		break;
	case "product_view" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "제품상세보기";
		break;
	case "cart" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "장바구니";
		break;
	case "order_sheet" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "주문서";
		break;
	case "order" :
		$header_type = 1;
		$footer_type = 1;
		$header_name = "주문배송조회";
		break;
    case "order_view" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "주문상세";
        break;
    case "board_list" :
	case "board_view" :
	case "board_form" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "고객센터";
        break;
    case "guide" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "이용안내";
        break;
    case "privacy" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "개인정보취급(처리)방침";
        break;
    case "provision" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "서비스 이용약관";
        break;
    case "estimate" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "견적서";
        break;
    case "estimate_print" :
        $header_type = 0;
        $footer_type = 0;
        $header_name = "견적서";
        break;
}

$CI =& get_instance();
$member = $CI->session->userdata('member');

?>

<?php include_once VIEWPATH . "component/layer_popup.php" // 팝업 ?>

<link href="<?=ASSETS_URL?>/css/layout.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<link href="<?=ASSETS_URL?>/css/style.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<header id="header">
	<h1 id="hd_h1">에스티메디(STMEDI)</h1>
	<div id="hd_wrapper">
		<div class="area_top flex js">
			<div class="logo">
				<a href="<?=PROJECT_URL?>"><img src="<?=ASSETS_URL?>/img/common/logo.png" alt="에스티메디"></a>
				<?/*php if (!empty($member)) {?>
                        <!--
					<a href="<?=PROJECT_URL?>/#first02" onclick="fncChked()">비교견적</a>
                        -->
					<a href="<?=PROJECT_URL?>?first02=true" onclick="fncChked()">비교견적</a>
				<?php }*/?>
			</div>
			<div class="tnb">
				<?php if (empty($member)) {?>
					<!--a href="<?=PROJECT_URL?>/guide">이용안내</a-->
					<a href="<?=PROJECT_URL?>/board">고객센터</a>
					<a href="<?=PROJECT_URL?>/login"><b>로그인</b></a>
					<a href="<?=PROJECT_URL?>/signUp"><b class="txt_blue">회원가입</b></a>
				<?php } else { ?>
					<a href="<?=PROJECT_URL?>/mypage">정보수정</a>
					<!-- href="<?=PROJECT_URL?>/guide">이용안내</a-->
					<a href="<?=PROJECT_URL?>/board">고객센터</a>
					<a href="<?=PROJECT_URL?>/estimate" class="cart_btn"><i class="fa-regular fa-memo-pad"></i></a>
					<a href="<?=PROJECT_URL?>/cart" class="cart_btn"><i class="fa-solid fa-cart-shopping"></i></a>
					<a href="<?=PROJECT_URL?>/order"><i class="fa-solid fa-truck"></i></a>
					<a href="<?=PROJECT_URL?>/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
				<?php }?>
			</div>
		</div>
		<div class="area_bottom flex js">
			<nav>
				<ul>
					<li>
						<!--<a href="#hash-menu" id="hash_menu" data-role="button" data-url="../hash/" data-ref="1" data-animation="fade"><i class="fa-light fa-bars"></i> 전체보기</a></a>-->
						<a href="javascript:void(0)" id="hash_menu" onclick="toggleSideNav()"><i class="fa-light fa-bars"></i> <span>전체보기</span></a></a>
					</li>
					<li><a href="<?=PROJECT_URL?>/medicinal/" class="<?php if ($pid == 'product_list') { echo 'new';} ?>">의약품</a></li>

					<li><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="<?php if ($pid == 'event') { echo 'new';} ?>">기획전</a></li>
					<?/*=PROJECT_URL? >/event*/?>
					<li><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="">소모품</a></li>
				</ul>
			</nav>
			<div class="hd_search">
				<img src="<?=ASSETS_URL?>/img/common/logo_0.png"/>
				<form autocomplete="off" onsubmit="return mallCommonSearch(this)">
					<input type="search" name="hstx" placeholder="원하시는 제품을 검색하세요" value="<?=$_GET['hstx']?>">
					<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
				</form>
			</div>
		</div>
	</div>

</header>


<?php if ($header_type == 0) { ?>
<div id="wrapper" class="index">
<?php } else if ($header_type == 1) { ?>
<div id="wrapper">
	<div class="container">
<?php } else { ?>
<?php } ?>
