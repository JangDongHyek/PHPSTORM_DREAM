<?php


//SSL 리다이렉트
if(!isset($_SERVER["HTTPS"]) || strpos($_SERVER["HTTP_HOST"],'www.') !== false) {header('Location: https://'.str_replace('www.','',$_SERVER["HTTP_HOST"]).$_SERVER['REQUEST_URI'],true,301);}
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
		$header_name = "(주)청하생률";
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
    case "greet" :
        $header_type = 1;
        $footer_type = 1;
        $header_name = "회사소개";
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
}

$CI =& get_instance();
$member = $CI->session->userdata('member');

?>

<?php include_once VIEWPATH . "component/layer_popup.php" // 팝업 ?>

<link href="<?=ASSETS_URL?>/css/layout.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<link href="<?=ASSETS_URL?>/css/main.css?v=<?=CSS_VER?>" rel="stylesheet" type="text/css"/>
<header id="header">
    <div class="hd_banner">영양적가치가 높은 <strong>(주)청하생률의 먹거리</strong>, 고객만족서비스를 우선으로 합니다.</div>
	<h1 id="hd_h1">(주)청하생률</h1>
	<div id="hd_wrapper">
		<div class="area_top flex js">
			<div class="logo">
				<a href="<?=PROJECT_URL?>">
				    <img src="<?=ASSETS_URL?>/img/common/logo.svg"/>
				    <strong>(주)청하<span class="color_laghtgreen">생률</span></strong>
				</a>
			</div>
			<div class="tnb">
				<?php if (empty($member)) {?>
                <a href="<?=PROJECT_URL?>/order">주문조회</a>
				<a href="<?=PROJECT_URL?>/login">로그인</a>
				<?php } else { ?>
				<a href="<?=PROJECT_URL?>/logout">로그아웃</a>
				<a href="<?=PROJECT_URL?>/mypage">내정보수정</a>

                <?php if($member['mb_level'] >= 10){ ?>
                <!--관리자이상만 보이게-->
				<a href="<?=PROJECT_URL?>/adm/member">관리자화면</a>
				 <?php } ?>
				
				<?php }?>
                <!--
				<a href="<?=PROJECT_URL?>/greet">회사소개</a>
				<a href="<?=PROJECT_URL?>/board">고객센터</a>
                -->
			</div>
		</div>
		<div class="area_bottom flex js">
			<nav>
				<ul>
					<li>
						<!--<a href="#hash-menu" id="hash_menu" data-role="button" data-url="../hash/" data-ref="1" data-animation="fade"><i class="fa-light fa-bars"></i> 전체보기</a>-->
						<a href="javascript:void(0)" id="hash_menu" onclick="toggleSideNav()"><i class="fa-light fa-bars"></i></a>
					</li>
					<li><a href="<?=PROJECT_URL?>/greet" class="new">회사소개</a></li>
					<li><a href="<?=PROJECT_URL?>/medicinal" class="new">제품소개</a></li>
					<li><a href="<?=PROJECT_URL?>/board/?cate=review" class="new">구매후기</a></li>
					<li><a href="<?=PROJECT_URL?>/board/?cate=notice" class="new">공지사항</a></li>
					<li><a href="<?=PROJECT_URL?>/order" class="new">마이페이지</a></li>
				</ul>
			</nav>
			<div class="flex">
				<div class="hd_search">
					<form autocomplete="off" onsubmit="return mallCommonSearch(this)">
					<input type="search" name="hstx" placeholder="원하시는 제품을 검색하세요" value="<?=$_GET['hstx']?>">
					<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
					</form>
				</div>
				<a href="<?=PROJECT_URL?>/cart" class="cart_btn"><i class="fa-light fa-cart-shopping"></i></a>
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
