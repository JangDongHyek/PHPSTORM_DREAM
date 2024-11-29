<?php
include_once("./_common.php");

$center_code = $_GET['center_code'];

if(!empty($center_code)) {
    $sql = " select * from g5_member where center_code = '{$center_code}' and mb_category = '팀장' ";
}
else {
    $sql = " select * from g5_member where mb_level = 10 ";
}
$mb = sql_fetch($sql);

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// 회원번호 세션 생성
set_session('ss_mb_no', $mb['mb_no']);
// 회원카테고리 세션 생성
set_session('ss_mb_cate', $mb['mb_category']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

goto_url(G5_ADMIN_URL);
?>