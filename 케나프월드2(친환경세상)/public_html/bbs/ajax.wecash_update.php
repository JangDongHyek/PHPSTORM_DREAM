<?php
include_once("./_common.php");

$wp = $_GET['wp'];
$wr_id = $_GET['wr_id'];
$mb_id = $member['mb_id'];

$result = array();

if(!$wp || !$wr_id){
	$result['success'] = false;
	$result['msg'] = "값이 모두 넘어오지 않았습니다. 확인 후 다시 시도해주세요.";
}else if($wp > $member['mb_point']){
	$result['success'] = false;
	$result['msg'] = "포인트가 부족합니다. 충전 후 이용해주세요.";
}else{
	
	$use_wp = $wp * (-1);
	$view = sql_fetch("select wr_subject, mb_id from {$write_table} where wr_id = '{$wr_id}'");
	
	insert_point($mb_id, $use_wp, $view['wr_subject'].' 위캐시 결제', '@payment', $mb_id, $wr_id."_".G5_TIME_YMDHIS);
	insert_point($view['mb_id'], $wp, $view['wr_subject'].' 위캐시 받음', '@payment', $mb_id, $wr_id."_".G5_TIME_YMDHIS);

	if($member['mb_recommend']){
		insert_point($member['mb_recommend'], ($wp * 0.02), $mb_id."님이 ".$view['mb_id'].'님에게 위캐시 결제', '@bonus', $member['mb_recommend'], $member['mb_recommend']."_".G5_TIME_YMDHIS);
	}

	$result['success'] = true;
}


echo json_encode($result);
?>