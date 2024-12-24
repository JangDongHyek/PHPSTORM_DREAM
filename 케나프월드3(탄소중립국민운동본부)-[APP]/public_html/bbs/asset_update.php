<?php
include_once('./_common.php');

$wl_tel = $_POST['wl_tel'];
$wl_money = $_POST['wl_money'];
$mb_id = $member['mb_id'];

if(!$wl_tel){
	alert("전화번호를 입력해주세요.", G5_BBS_URL."/myasset.php");
	exit;
}

if(!$wl_money){
	alert("골드에셋을 입력해주세요.", G5_BBS_URL."/myasset.php");
	exit;
}

if(!$mb_id){
	alert("로그인 후 이용해주세요.", G5_BBS_URL."/myasset.php");
	exit;
}

if($wl_money > $member['mb_asset']){
	alert("골드에셋이 부족합니다. 충전 후 이용해주세요.", G5_BBS_URL."/myasset.php");
	exit;
}

$row = sql_fetch("select * from g5_member where mb_id = '{$wl_tel}'");
if(!$row){
	alert("해당하는 회원이 없습니다.");
	exit;
}

$use_money = $wl_money * (-1);

insert_asset($mb_id, $use_money, '[보냄] '.$use_money.' 에셋('.$wl_tel.') 보냄', '@payment', $mb_id, $mb_id."_".G5_TIME_YMDHIS);
insert_asset($wl_tel, $wl_money, '[받음] '.$wl_money.' 에셋('.$mb_id.') 받음', '@payment', $mb_id, $mb_id."_".G5_TIME_YMDHIS);

goto_url(G5_BBS_URL."/board.php?bo_table=asset");
?>