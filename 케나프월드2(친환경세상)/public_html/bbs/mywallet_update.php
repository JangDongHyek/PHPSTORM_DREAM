<?php
include_once('./_common.php');

$wl_money = $_POST['wl_money'];
$mb_id = $member['mb_id'];

if(!$wl_money){
	alert("신청 캐시를 입력해주세요.", G5_BBS_URL."/mywallet.php");
	exit;
}

if(!$mb_id){
	alert("로그인 후 이용해주세요.", G5_BBS_URL."/mywallet.php");
	exit;
}

sql_query("insert g5_wallet set wl_money = '{$wl_money}', wl_datetime = '".G5_TIME_YMDHIS."', mb_id = '{$mb_id}'");

include_once('./_head.php');

include_once($mypage_skin_path.'/mywallet_update.skin.php');

include_once('./_tail.php');

//goto_url(G5_BBS_URL."/mywallet.php");
?>