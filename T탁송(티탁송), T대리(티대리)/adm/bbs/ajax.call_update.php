<?php
/************************************************
$mode
insert : 주소검색후 탁송/대리 요청하기 DB등록
status : 콜내역 상세화면 상태변경
************************************************/
include_once('./_common.php');

$json = array();
$mode = $_POST['mode'];

if ($mode == "insert") {
	$call_dist = preg_replace("/[^0-9]*/s", "", $call_dist);
	$call_time = preg_replace("/[^0-9]*/s", "", $call_time);

	$call_price = preg_replace("/[^0-9]*/s", "", $call_price);
	$call_pass_price = preg_replace("/[^0-9]*/s", "", $call_pass_price);
	$call_pass_call_price = preg_replace("/[^0-9]*/s", "", $call_pass_call_price);
	$call_5t_price = preg_replace("/[^0-9]*/s", "", $call_5t_price);
	$call_total_price = preg_replace("/[^0-9]*/s", "", $call_total_price);

	$call_status = 0; // 대기

	$sql = "INSERT INTO g5_call SET
			agency_no = '{$member['agency_no']}',
			mb_id = '{$member['mb_id']}',
			mb_hp = '{$member['mb_hp']}',
			start_place = '{$_POST['start_place']}',
			start_lat = '{$_POST['start_lat']}',
			start_lng = '{$_POST['start_lng']}',
			end_place = '{$_POST['end_place']}',
			end_lat = '{$_POST['end_lat']}',
			end_lng = '{$_POST['end_lng']}',
			pass_place = '{$_POST['pass_place']}',
			pass_lat = '{$_POST['pass_lat']}',
			pass_lng = '{$_POST['pass_lng']}',
			call_dist = '{$call_dist}',
			call_time = '{$call_time}',
			call_price = '{$call_price}',
			call_pass_price = '{$call_pass_price}',
			call_pass_call_price = '{$call_pass_call_price}',
			call_5t_price = '{$call_5t_price}',
			call_total_price = '{$call_total_price}',
			call_kind = '{$call_kind}',
			call_status = '{$call_status}',
			call_payment = '{$call_payment}',
			call_type = '{$call_type}',
			driver_id = '',
			cancel_reason = '',
			call_memo = '{$call_memo}'
			";

	$json['result'] = "F";

	if (sql_query($sql)) {
		// 북마크&히스토리 등록
		$history = array(
			"start"=>array("place"=>$start_place, "lat"=>$start_lat, "lng"=>$start_lng),
			"pass"=>array("place"=>$pass_place, "lat"=>$pass_lat, "lng"=>$pass_lng),
			"end"=>array("place"=>$end_place, "lat"=>$end_lat, "lng"=>$end_lng)
		);

		setBookmark($member['mb_id'], $history);

		// 포인트차감
		if($call_payment == "P") {
			$sql = "SELECT idx FROM g5_call WHERE mb_id = '{$member['mb_id']}' AND agency_no = '{$member['agency_no']}' 
					ORDER BY idx DESC LIMIT 0, 1";
			$rs = sql_fetch($sql);
			$idx = $rs['idx'];

			insert_point($member['mb_id'], "-".$call_total_price, "대리 및 탁송요청하기", "call", $idx, '요청');
		}
		$json['result'] = "T";
	} 

} else if ($mode == "status") {
	
	$json['result'] = "F";
	$idx = $_POST['idx'];
	$sql = "UPDATE g5_call SET 
			call_status = '{$status}', ";

	switch ($status) {
		case "-1" :		// -1) 고객 대리취소
			$sql .= "cancel_reason = '{$cancel_reason}',
					 cancel_date = now()
					 WHERE idx = '{$idx}'";
			break;

		case "1" :		// 1) 기사 수락함
			$sql .= "driver_id = '{$member['mb_id']}'
					 WHERE idx = '{$idx}'";
			break;

		case "2" :		// 2) 기사 진행완료
			$sql .= "success_date = now()
					 WHERE idx = '{$idx}'";
	}

	//$json['sql'] = $sql;

	if (sql_query($sql)) {
		$json['result'] = "T";
	}
}

echo json_encode($json);



?>