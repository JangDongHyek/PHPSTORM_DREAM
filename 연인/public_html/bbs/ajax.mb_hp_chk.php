<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$mb_hp = preg_replace("/\s+/","", $_POST['reg_mb_hp']);
$mb_hp = preg_replace("/[^0-9]*/s", "", $mb_hp);

if ($msg = valid_mb_hp($mb_hp)) die($msg);

/*
$sql = " SELECT COUNT(*) AS cnt FROM g5_member WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' ";
$row = sql_fetch($sql);
$cnt = $row["cnt"];

echo ($cnt == 0)? "T" : "이미 등록된 휴대폰번호 입니다.";
*/

$sql = " SELECT mb_status FROM g5_member WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' ";
$row = sql_fetch($sql);
$mb_status = $row['mb_status'];

if ($mb_status != "") {
	echo ($mb_status == "탈퇴")? "leave" : "이미 등록된 휴대폰번호 입니다.";
} else {
	echo "T";
}




?>