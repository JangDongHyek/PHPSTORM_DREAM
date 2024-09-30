<?php
include_once ("../common.php");

// 인앱체크 // 앱자동로그인
$is_inapp = false;
$inapp_vercode = 0;
$is_aos = false;
if (strpos($_SERVER['HTTP_USER_AGENT'], "JUNDORISAK") !== false) { // AOS
    $is_inapp = true;
    $is_aos = true;
    // 앱버전확인
    $_tmp = explode("JUNDORISAK/APP_VER=", $_SERVER['HTTP_USER_AGENT']);
    $inapp_vercode = (int)$_tmp[1];
}

$is_ios = false;
if (strpos($_SERVER['HTTP_USER_AGENT'], "IOS") !== false) { // IOS
    $is_inapp = true;
    $is_ios = true;
}

/*
if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103" || $_SERVER['REMOTE_ADDR'] == "218.146.133.107" || $is_inapp) {
    // 아이티포원 or 인앱이면 패스

} else if ($pid == "login" || $pid == "provision" || $pid == "privacy") {
    // 로그인, 개인정보취급방침등 페이지 제외

} else {
    die("잘못된 접근입니다.");
}
*/
