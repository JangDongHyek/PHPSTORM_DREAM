<?php
include_once('./_common.php');

// 네이버 로그인 후 로그아웃 시 --------------------------
/*$client_id = "zInqfjri754yOtVU81sC";
$client_secret = "CbOurHmTUT";
//$logout_url = "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=".$client_id."&client_secret=".$client_secret."&access_token=".$_SESSION['ss_sns_token']."&service_provider=NAVER"; // 접근 토큰 삭제
$logout_url = "https://nid.naver.com/nidlogin.logout";
$is_post = false;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $logout_url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close ($ch);*/
// 네이버 로그인 후 로그아웃 시 --------------------------

// 이호경님 제안 코드
session_unset(); // 모든 세션변수를 언레지스터 시켜줌
session_destroy(); // 세션해제함

// 자동로그인 해제 --------------------------------
set_cookie('ck_mb_id', '', 0);
set_cookie('ck_auto', '', 0);
// 자동로그인 해제 end --------------------------------

if ($url) {
    $p = @parse_url($url);
    if ($p['scheme'] || $p['host']) {
        alert('url에 도메인을 지정할 수 없습니다.');
    }

    $link = $url;
} else if ($bo_table) {
    $link = G5_BBS_URL.'/board.php?bo_table='.$bo_table;
} else {
    //$link = G5_URL;
    $link = APP_URL.'/login.php';
}

//goto_url($link);

// 앱자동로그인
include_once(G5_THEME_PATH.'/head.sub.php');
?>
<script>
    var userAgent = navigator.userAgent;
    var app_vercode = parseInt("<?=$inapp_vercode?>");
    if (app_vercode > 0) {
        if (userAgent.match(".*Android.*")) { //안드로이드
            saveMemberInfo("");
        } else if (userAgent.match(".*iPhone.*") || userAgent.match(".*iPad.*")) { //아이폰

        }
    }
    location.href = '<?=$link?>';
</script>
<?
include_once(G5_THEME_PATH.'/tail.sub.php');
?>