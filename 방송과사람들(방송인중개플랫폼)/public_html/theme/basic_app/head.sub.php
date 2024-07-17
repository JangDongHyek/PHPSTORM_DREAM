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
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes,target-densitydpi=medium-dpi">
<meta property="og:image" content="<?php echo G5_THEME_URL ?>/img/common/ogimage.jpg">
<!-- favicon -->
<link rel="shortcut icon" href="<?php echo G5_THEME_URL ?>/img/favicon.jpg"/>

<?php
if (G5_IS_MOBILE) {
    //echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
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
<?php /*?><link href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css" rel="stylesheet" type="text/css"><?php */?><!--스와이퍼-->
<link href="<?php echo G5_THEME_CSS_URL; ?>/mobile.css?v=<?=G5_CSS_VER?>" rel="stylesheet" type="text/css">
<?php
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/font.css">', 0);//폰트
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/animate.min.css">', 0);//애니메이트
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/all.min.css">', 0);//폰트어썸
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/main.css?ver='.G5_CSS_VER.'">',2);//메인
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/sub.css?ver='.G5_CSS_VER.'">',3);//서브
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/common.css?v='.G5_CSS_VER.'">', 10);//공통
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/swiper.min.css">', 0);//스와이프
//add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/mobile.css?ver='.G5_CSS_VER.'">',1);
add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/board.css">', 10);//게시판공통
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>


<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
</script>
<script src="<?php echo G5_JS_URL ?>/jquery-1.9.1.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/common.js?v=<?=G5_JS_VER?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>

<script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/wow.min.js"></script><!--와우js-->
<script src="<?php echo G5_THEME_JS_URL ?>/ui.js?v=<?=G5_JS_VER?>"></script> 
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.menu.js?v=<?=G5_JS_VER?>"></script> 

<script src="<?php echo G5_THEME_JS_URL ?>/jquery.ba-hashchange.1.3.min.js"></script><!--Hash 체크 JS파일-->
<script src="<?php echo G5_THEME_JS_URL ?>/hash.eazy-0.3.js"></script><!--HASH 이동 JS파일-->
<script src="<?php echo G5_THEME_JS_URL ?>/hash.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php
if(G5_IS_MOBILE) {
    echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>

<script>
// 뒤로가기후 페이지 load시 hash닫기
var curUrl = window.location.href;
if(curUrl.indexOf("#hash-menu") != "-1"){
	window.location.href = g5_url;
}

<?php /**************************** 인앱기능 START ****************************/ ?>
<?php // 앱 공유하기 ?>
function appShare(title, txt) {
	window.Android.doShare(title, txt);
}

<?php // FCM 토큰설정 ?>
function fcmKey(token, agent) {
	// $.ajax({
	// 	type : "post",
	// 	url : g5_bbs_url + "/ajax.fcm_key.php",
	// 	data : {token : token, agent: agent},
	// 	dataType : "text",
	// }).done(function(data, textStatus, xhr) {
	// });
}

<?php // 로그인데이터 앱저장 ?>
function saveMemberInfo(mb_id) {
	window.Android.updateLoginInfo(mb_id);
}

<?php /**************************** 인앱기능 END ****************************/ ?>
</script>

</head>

<!--<body <?php if(defined('_INDEX_')){ echo "class='idx_body'"; } ?> >-->
<body>

<script>


$(document).ready(function(){
	var agent = navigator.userAgent.toLowerCase();

	if (agent.indexOf("msie") > -1 || agent.indexOf("trident") > -1) {
		$('body').addClass('ie');
	} else if ( agent.search( "edge/" ) > -1 ){
		$('body').addClass('ie_edge');
	} else {

	}
});
	
</script>

<script>

//table scroll
$(function(){
	if(!($('table.scroll').length > 0)) return;
	$('table.scroll').wrap('<div class="scrollTable"></div>');
	$('.scrollTable').before('<p class="mob_info"><span class="kr">좌우로 스크롤 하시면 확인이 가능합니다.</span>');
});
</script>