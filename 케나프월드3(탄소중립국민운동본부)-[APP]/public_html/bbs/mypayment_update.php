<?php
include_once('./_common.php');

$wl_tel = $_POST['wl_tel'];
$wl_money = $_POST['wl_money'];
$mb_id = $member['mb_id'];

if(!$wl_tel){
	alert("전화번호를 입력해주세요.", G5_BBS_URL."/mypayment.php");
	exit;
}

if(!$wl_money){
	alert("결제 캐시를 입력해주세요.", G5_BBS_URL."/mypayment.php");
	exit;
}

if(!$mb_id){
	alert("로그인 후 이용해주세요.", G5_BBS_URL."/mypayment.php");
	exit;
}

if($wl_money > $member['mb_point_l']){
	alert("캐시가 부족합니다. 충전 후 이용해주세요.", G5_BBS_URL."/mypayment.php");
	exit;
}
$use_money = $wl_money * (-1);

$sql="select * from g5_member where mb_id='$wl_tel'";
$row=sql_fetch($sql);


insert_point_l($mb_id, $use_money, $row[mb_name].'님에게 결제', '@payment', $mb_id, $mb_id."_".G5_TIME_YMDHIS);
insert_point_l($wl_tel, $wl_money, $member[mb_name].'님에게 받음', '@payment', $mb_id, $mb_id."_".G5_TIME_YMDHIS);

if($member['mb_recommend']){
	insert_point_l($member['mb_recommend'], ($wl_money * 0.02), $mb_id."님이 ".$row[mb_name].'님에게 결제', '@bonus', $member['mb_recommend'], $member['mb_recommend']."_".G5_TIME_YMDHIS);
}

goto_url(G5_BBS_URL."/mypayment.php");
?>