<?php
include_once("./_common.php");

$wl_id	= $_GET['wl_id'];
$v		= $_GET['v']; 

$result = array();

if(!$wl_id || !$v){
	$result['success'] = false;
	$result['msg'] = "값이 모두 넘어오지 않았습니다. 확인 후 다시 시도해주세요.";
}else{
	
	$sql = " update g5_wallet set wl_status = '{$v}' where wl_id = '{$wl_id}' ";
	sql_query($sql);
	
	if($v == "수락"){
		$row = sql_fetch("select mb_id, wl_money from g5_wallet where wl_id = '{$wl_id}'");
		$mb_id = $row['mb_id'];
		$point = $row['wl_money'];
		$po_id = insert_point($mb_id, $point*0.5, '포인트 충전', '@wallet', $mb_id, $wl_id);
		$po_id_l = insert_point_l($mb_id, $point*0.5, '포인트 충전', '@wallet', $mb_id, $wl_id);
		/*
		$sql="select * from g5_member where mb_id='$mb_id'";
		$row=sql_fetch($sql);
		$mb_name = $row[mb_name];

		$mb_recommend=$row[mb_recommend];
		for($i=1;$i<=10;$i++){
			if($mb_recommend){
				$spoint=$point*$pointSaveArr[$i];
				$po_id = insert_point($mb_recommend, $spoint*0.5, $i."대".$mb_name.'님 포인트 구매', '@wallet', $mb_id, $wl_id);
				$po_id_l = insert_point_l($mb_recommend, $spoint*0.5, $i."대".$mb_name.'님 포인트 구매', '@wallet', $mb_id, $wl_id);
			}
			$sql="select * from g5_member where mb_id='$mb_recommend'";
			$row2=sql_fetch($sql);
			$mb_recommend=$row2[mb_recommend];
			

		}*/

		
		if($po_id > 0){
			sql_query(" update g5_wallet set po_id = '{$po_id}', po_datetime = '".G5_TIME_YMDHIS."' where wl_id = '{$wl_id}'");
		}
	}

	$result['success'] = true;
}

echo json_encode($result);
?>