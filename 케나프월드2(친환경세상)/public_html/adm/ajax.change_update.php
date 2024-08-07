<?php
include_once("./_common.php");

$ch_id	= $_GET['ch_id'];
$v		= $_GET['v']; 

$result = array();

if(!$ch_id || !$v){
	$result['success'] = false;
	$result['msg'] = "값이 모두 넘어오지 않았습니다. 확인 후 다시 시도해주세요.";
}else{
	
	$sql = " update g5_change set ch_status = '{$v}' where ch_id = '{$ch_id}' ";
	sql_query($sql);
	
	if($v == "수락"){
		$row = sql_fetch("select mb_id, ch_money from g5_change where ch_id = '{$ch_id}'");
		$mb_id = $row['mb_id'];
		$point = $row['ch_money'] * (-1);
		$po_id = insert_point($mb_id, $point, '포인트 환전', '@member', $mb_id, $ch_id);
		
		if($po_id > 0){
			sql_query(" update g5_change set po_id = '{$po_id}', po_datetime = '".G5_TIME_YMDHIS."' where ch_id = '{$ch_id}'");
		}
	}

	$result['success'] = true;
}

echo json_encode($result);
?>