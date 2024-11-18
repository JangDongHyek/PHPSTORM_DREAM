<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<!--24-06-14-->
    <script>
        <!-- Google Tag Manager -->
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-M25D5RZ');
        <!-- End Google Tag Manager -->
    </script>


<!-- 구글 리마케팅 태그 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-939026787"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-939026787');
  gtag('config', 'AW-405412175');
</script>
<!-- 구글 리마케팅 태그 끝 -->


<!-- Event snippet for 페이지 조회_Event conversion page -->
<script> 
  gtag('event', 'conversion', {'send_to': 'AW-405412175/aFhICKnElogDEM-yqMEB'});
</script>


<!-- 네이버 애널리틱스 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "1ce59c9d33c0f20";
if(window.wcs) {
  wcs_do();
}
</script>
<!-- 네이버 애널리틱스 끝 -->


<!-- Event snippet for 페이지 조회_Main conversion page [이벤트 페이지에만 적용] -->
<? if($bo_table == "event02"){ ?>
<script>
  gtag('event', 'conversion', {'send_to': 'AW-405412175/KigCCLDCx4gDEM-yqMEB'});
</script>
<?php } ?>



<span itemscope="" itemtype="http://schema.org/Organization">
<link itemprop="url" href="http://www.60chicken.com/">
<a itemprop="sameAs" href="https://www.youtube.com/channel/UCXNmso1xB-gKWIqne25hfIA"></a>
<a itemprop="sameAs" href="https://www.instagram.com/60chicken/"></a>
<a itemprop="sameAs" href="https://blog.naver.com/60gye"></a>
</span>




<meta charset="utf-8">
<META NAME="GOOGLEBOT" CONTENT="NOINDEX, NOFOLLOW">
<META NAME="GOOGLEBOT" CONTENT="NOSNIPPET">



<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=1.0">
<?php
if (G5_IS_MOBILE) {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">'.PHP_EOL;
}

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;


?>
<title><?php echo $g5_head_title; ?></title>
<link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부트스트랩-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/font-awesome.min.css" rel="stylesheet" type="text/css"><!--폰트어썸-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/animate.min.css" rel="stylesheet" type="text/css"><!--애니메이트-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/all.min.css" rel="stylesheet" type="text/css"><!--폰트어썸-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/font.css" rel="stylesheet" type="text/css"><!--폰트-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/main.css" rel="stylesheet" type="text/css"><!--메인컨텐츠-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/sub.css" rel="stylesheet" type="text/css"><!--서브페이지-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/common.css" rel="stylesheet" type="text/css"><!--공통-->


<?php
if (defined('G5_IS_ADMIN')) {
    if(!defined('_THEME_PREVIEW_'))
        echo '<link rel="stylesheet" href="'.G5_ADMIN_URL.'/css/admin.css">'.PHP_EOL;
} else {
    echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'.css">'.PHP_EOL;
}
?>
<link rel="stylesheet" href="<?php echo G5_CSS_URL; ?>/board.css"><!--게시판공통-->

<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
</script>
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.min.js"></script><!--메인슬라이더에 필요한 js-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.menu.js"></script><!--상단메뉴(pc및모바일) 및 그외 JS추가부분-->
<script src="<?php echo G5_JS_URL ?>/common.js"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery-1.9.1.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script><!--부트스트랩-->
<script src="<?php echo G5_THEME_JS_URL ?>/wow.min.js"></script><!--와우js-->
<script src="<?php echo G5_THEME_JS_URL ?>/ui.js"></script><!--공통-->

<script src="<?php echo G5_THEME_JS_URL ?>/jquery.ba-hashchange.1.3.min.js"></script><!--Hash 체크 JS파일-->
<script src="<?php echo G5_THEME_JS_URL ?>/hash.eazy-0.3.js"></script><!--HASH 이동 JS파일-->

<?php
if(defined('_INDEX_')) {
    echo '<script src="'.G5_THEME_JS_URL.'/jquery.bxslider.min.js"></script><!--메인슬라이드-->'.PHP_EOL; // overflow scroll 감지
    /*echo '<script src="'.G5_THEME_JS_URL.'/jquery.fitvids.js"></script><!--메인슬라이드-->'.PHP_EOL; // overflow scroll 감지
    echo '<script src="'.G5_THEME_JS_URL.'/jquery.easing.1.3.js"></script><!--메인슬라이드-->'.PHP_EOL; // overflow scroll 감지
    echo '<script src="'.G5_THEME_JS_URL.'/mainslider.js"></script><!--메인슬라이드-->'.PHP_EOL; // overflow scroll 감지*/
}
?>
<?php
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- 인트로 페이지 -->
<?php /*?><script>
var ua = window.navigator.userAgent.toLowerCase();
if ( /iphone/.test(ua) || /android/.test(ua) || /opera/.test(ua) || /bada/.test(ua) ) {
	var is_intro = sessionStorage.getItem("is_intro");
	if(!is_intro){
		sessionStorage.setItem("is_intro", "intro");
		location.replace('<?php echo G5_URL ?>/intro.php');
	}
}
</script><?php */?>
<!-- 인트로 페이지 -->

</head>
<body>
<!--24-06-14-->
<!-- Google Tag Manager (noscript) -->
<noscript>iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M25D5RZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>