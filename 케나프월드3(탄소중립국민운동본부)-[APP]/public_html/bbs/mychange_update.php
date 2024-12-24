<?php
include_once('./_common.php');

$ch_money = $_POST['ch_money'];
$mb_id = $member['mb_id'];

if(!$ch_money){
	alert("신청 캐시를 입력해주세요.", G5_BBS_URL."/mychange.php");
	exit;
}

if(!$mb_id){
	alert("로그인 후 이용해주세요.", G5_BBS_URL."/mychange.php");
	exit;
}

if($member['mb_point'] < $ch_money ){
	alert("환전할 위캐시가 부족합니다. 확인 후 다시 입력해주세요.", G5_BBS_URL."/mychange.php");
	exit;
}


sql_query("insert g5_change set ch_money = '{$ch_money}', ch_datetime = '".G5_TIME_YMDHIS."', mb_id = '{$mb_id}'");

goto_url(G5_BBS_URL."/mychange.php");
?>