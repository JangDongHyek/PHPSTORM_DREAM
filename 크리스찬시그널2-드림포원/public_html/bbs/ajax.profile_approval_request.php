<?php
include_once('./_common.php');

$mb_id = $_REQUEST['mb_id'];

$sql = " update {$g5['member_table']} set mb_approval_request = 'Y' where mb_id = '{$mb_id}' ";
sql_query($sql);

// 승인 요청 후 승인 완료 시 재로그인 필요
// 이호경님 제안 코드
session_unset(); // 모든 세션변수를 언레지스터 시켜줌
session_destroy(); // 세션해제함

// 자동로그인 해제 --------------------------------
set_cookie('ck_mb_id', '', 0);
set_cookie('ck_auto', '', 0);
// 자동로그인 해제 end --------------------------------

die('success');
?>