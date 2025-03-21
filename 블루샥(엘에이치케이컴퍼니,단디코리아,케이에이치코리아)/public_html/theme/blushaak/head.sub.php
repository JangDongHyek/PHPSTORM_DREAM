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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3L4C1LXJF9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3L4C1LXJF9');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MB9XVHBK');</script>
<!-- End Google Tag Manager -->

<meta charset="utf-8">

<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<?php
if (G5_IS_MOBILE) {
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">'.PHP_EOL;
}

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>



<script type="application/ld+json">
{
 "@context": "http://schema.org",
 "@type": "Organization",
 "name": "블루샥",
 "url": "http://www.blushaak.co.kr",
 "sameAs": [
   "https://www.instagram.com/blushaak",
   "https://blog.naver.com/blueshaak"
 ]
}
</script>






<span itemscope="" itemtype="http://schema.org/Organization">
<link itemprop="url" href="http://www.blushaak.co.kr">
<a itemprop="sameAs" href="https://www.instagram.com/blushaak"></a>
<a itemprop="sameAs" href="https://blog.naver.com/blueshaak"></a>
</span>






<title><?php echo $g5_head_title; ?></title>
<?php
if (defined('G5_IS_ADMIN')) {
    if(!defined('_THEME_PREVIEW_'))
        echo '<link rel="stylesheet" href="'.G5_ADMIN_URL.'/css/admin.css">'.PHP_EOL;
} else {
    echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'.css?version=2">'.PHP_EOL;
}
?>
<link rel="shortcut icon" href="<?php echo G5_THEME_IMG_URL; ?>/favicon.ico"/>
<link href="<?php echo G5_THEME_CSS_URL; ?>/animate.min.css" rel="stylesheet" type="text/css"><!--애니메이션-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부트스트랩 css-->
<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/all.min.css"><!--폰트어썸-->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/sub.css"><!--서브 내용-->
<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/swiper.min.css"><!--스와이프css-->
<link href="<?php echo G5_THEME_CSS_URL ?>/font.css" rel="stylesheet" type="text/css"><!--코어고딕css-->
<link href="<?php echo G5_THEME_CSS_URL ?>/mouse.css" rel="stylesheet" type="text/css"><!--마우스css-->
<link href="<?php echo G5_CSS_URL ?>/board.css" rel="stylesheet" type="text/css">
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
<script src="<?php echo G5_THEME_JS_URL ?>/jquery-2.1.4.min.js"></script><!--jquery library js-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.menu.js"></script>
<script src="<?php echo G5_JS_URL ?>/common.js"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
<?php
if(defined('_INDEX_')) {
	echo '<script src="'.G5_THEME_JS_URL.'/jquery.min.js"></script>'.PHP_EOL; // 감지
	echo '<script src="'.G5_THEME_JS_URL.'/jquery.bxslider.min.js"></script>'.PHP_EOL; // 감지
    echo '<script src="'.G5_THEME_JS_URL.'/mainslider.js"></script>'.PHP_EOL; // 감지
}
if (!defined('G5_IS_ADMIN')) {
    if(!defined('_THEME_PREVIEW_'))
    echo '<!--<script src="'.G5_JS_URL.'/ui.js"></script>-->'.PHP_EOL; // 감지
}
if(G5_IS_MOBILE) {
    echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1046412876461096');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1046412876461096&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MB9XVHBK"
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
<div data-role="page">