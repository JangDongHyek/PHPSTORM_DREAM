<?php
include_once('./_common.php');

if ($_REQUEST["ios_payment_test"] == "Y"){
    $sql = "update g5_member set mb_leave_date = '".G5_TIME_YMD."' where mb_id = '{$member["mb_id"]}' ";
    sql_query($sql);
}

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
    $link = G5_URL;
}
// 로그아웃 시 로그인 페이지로 이동 ==> 로그아웃 시 메인페이지로 이동
//$link = G5_BBS_URL . '/login.php';
if(empty($_GET['param'])) {
    $link = G5_URL . '/index.php';
} else { // 관리자에서 로그아웃 시 로그인페이지로 이동
    $link = G5_BBS_URL . '/login.php';
}

goto_url($link);
?>
