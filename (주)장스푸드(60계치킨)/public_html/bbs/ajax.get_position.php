<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit;
include_once(G5_LIB_PATH.'/latest.tabs.lib.php'); //최근글

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // AJAX 요청으로부터 위도와 경도를 받음
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // 세션에 위치 정보 저장
    $_SESSION['latitude'] = $latitude;
    $_SESSION['longitude'] = $longitude;

    $latest_tabs = latest_tabs('latest_cate', "store", 200, 50, $latitude . ',' . $longitude);

    // HTML 문자열을 직접 반환
    echo $latest_tabs;
    exit; // 추가 처리 방지
}
?>