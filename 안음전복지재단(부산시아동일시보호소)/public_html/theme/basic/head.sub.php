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
<meta charset="utf-8">


<meta name="description" content="보호소소개,프로그램안내,참여마당,후원,자원봉사안내,시설안내">
<link rel="canonical" href="http://www.illsi.co.kr"/> 

<!--오픈그래프-->
<meta property="og:type" content="website">
<meta property="og:title" content="부산시아동일시보호소">
<meta property="og:description" content="보호소소개,프로그램안내,참여마당,후원,자원봉사안내,시설안내">
<meta property="og:image" content="http://www.illsi.co.kr/theme/basic/img/common/logo.png">
<meta property="og:url" content="http://www.illsi.co.kr">
<!--오픈그래프 끝-->


<!--<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=1.0">-->
<meta name="format-detection" content="telephone=no, address=no, email=no" />
<? /*php
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
*/ ?>
<title><?php echo $g5_head_title; ?></title>
<link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부트스트랩-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/animate.min.css" rel="stylesheet" type="text/css"><!--애니메이트-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/all.min.css" rel="stylesheet" type="text/css"><!--폰트어썸-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css" rel="stylesheet" type="text/css"><!--스오ㅏ이퍼-->
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

<script src="<?php echo G5_JS_URL ?>/jquery-1.9.1.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.min.js"></script><!--메인슬라이더에 필요한 js-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script><!--메인슬라이더에 필요한 js-->
<script src="<?php echo G5_THEME_JS_URL ?>/mainslider.js"></script><!--메인슬라이더에 필요한 js-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.menu.js"></script><!--상단메뉴(pc및모바일) 및 그외 JS추가부분-->
<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
<script src="<?php echo G5_JS_URL ?>/common.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/ui.js"></script><!--공통-->
<!--<script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script>부트스트랩-->
<script src="<?php echo G5_THEME_JS_URL ?>/wow.min.js"></script><!--와우-->
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script><!--스와이퍼-->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.ba-hashchange.1.3.min.js"></script><!--Hash 체크 JS파일-->
<script src="<?php echo G5_THEME_JS_URL ?>/hash.eazy-0.3.js"></script><!--HASH 이동 JS파일-->

<?php
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
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