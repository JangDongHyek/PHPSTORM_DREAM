<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$currentUrl = "$protocol://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if (strpos($currentUrl, 'chachaclean.com') !== false) {
    header("Location: $protocol://chachaclean.com/landing");
    exit; // 리다이렉션 후 스크립트 종료
}
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


/*
if(!ipconfig($ip)){
    goto_url('./_blank/');
}
*/
?>

<?
if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
n
?>
