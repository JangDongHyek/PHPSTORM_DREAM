<?php
include_once('./_common.php');

// 탈퇴회원 확인
$sql = " SELECT mb_status FROM g5_member WHERE REPLACE(mb_hp, '-', '') = '{$reg_mb_hp}' ";
$row = sql_fetch($sql);
$mb_status = $row['mb_status'];

if ($mb_status == "탈퇴") {
	die("leave");
}

// 인증번호 발송
$auth_num = getRandomString(6);
$msg = "[연인] 인증번호 [{$auth_num}]를 입력해 주세요.";
$reg_mb_hp = preg_replace("/[^0-9]*/s", "", $reg_mb_hp);

// (수신번호, 발신번호, 내용)
goSms($reg_mb_hp, COMMON_SEND_NUM, $msg);

echo $auth_num;
?>