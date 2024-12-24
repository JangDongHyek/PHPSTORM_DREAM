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
        <meta property="og:type" content="website">
        <meta property="og:title" content="농업회사법인 친환경세상 주식회사">
        <meta property="og:description" content="농업회사법인 친환경세상 주식회사">
        <meta property="og:image" content="<?php echo G5_URL; ?>/img/logo2.jpg">




        <?php if (preg_match('/(facebook|kakaotalk)/',$_SERVER['HTTP_USER_AGENT']) == true) { ?>
        <?php } ?>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=yes">
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
        <title><?php echo $g5_head_title; ?></title>
        <link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부트스트랩-->
        <link href="<?php echo G5_THEME_CSS_URL; ?>/all.min.css" rel="stylesheet" type="text/css"><!--폰트어썸-->
        <?
        //쇼핑몰일때 css 넣기
        if(0<strpos("/".$_SERVER[PHP_SELF],"/shop")){
            ?>
            <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/jquery.bxslider.css">
            <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/mobile_shop.css">
            <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/sub.css">
            <?
//쇼핑몰 아닐 때 css 넣기
        }else{?>
            <link href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css" rel="stylesheet" type="text/css">
            <?php
            echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'.css">'.PHP_EOL;
            ?>
        <? }?>
        <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/animate.min.css">
        <link href="<?php echo G5_THEME_CSS_URL; ?>/common.css" rel="stylesheet" type="text/css"><!--공통-->

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

        <script src="<?php echo G5_JS_URL ?>/jquery-1.12.4.min.js"></script>
        <script src="<?php echo G5_JS_URL ?>/common.js"></script>
        <script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
        <script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script><!--부트스트랩-->
        <script src="<?php echo G5_THEME_JS_URL ?>/wow.min.js"></script>
        <script src="<?php echo G5_THEME_JS_URL ?>/jquery.ba-hashchange.1.3.min.js"></script><!--Hash 체크 JS파일-->
        <script src="<?php echo G5_THEME_JS_URL ?>/hash.eazy-0.3.js"></script><!--HASH 이동 JS파일-->
        <script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script><!--이미지롤링-->
        <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
        <script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script>
        <script type="text/javascript">
            <? if($member[mb_id]!=""){?>
            function fcmKey(token){

                $.ajax({
                    url:'<?=G5_BBS_URL?>/set_token.php',
                    data:{token:token},
                    type:"POST",
                    dataType:"HTML",
                    success:function(data){
                    }
                });
            }
            <? }?>
        </script>
        <?/*
<script type="text/javascript">
window.addEventListener('load', function(e) {
	window.applicationCache.addEventListener('updateready', function(e) {
		if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			window.applicationCache.swapCache();
			window.location.reload();
		} else {}
	},false);
},false);
</script>*/?>
        <?php /*?><script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script><?php */?><!--폰트어썸-->
        <?php
        if(G5_IS_MOBILE) {
            echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // 감지
        }
        if(!defined('G5_IS_ADMIN'))
            echo $config['cf_add_script'];
        ?>
        <script>
            /*
            var loading = false;
            $(document).on('pjax:send', function() {
                loading = true;
                if(loading)
                    $('#pjax_loading').show();
            })
            $(document).on('pjax:complete', function(e) {
                setTimeout( function (){
                    $('#pjax_loading').hide();
                }, 200);
                loading = false;
            })
            */
            Kakao.init('<?php echo $config['cf_kakao_js_apikey'];?>');
        </script>
    </head>
<body>

<?/*
<div id="pjax_loading">
	<dl class="loading-background">
    <dl class="loading"></dl>
    <dl class="loading-text">loading</dl>
</div>
*/?>
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