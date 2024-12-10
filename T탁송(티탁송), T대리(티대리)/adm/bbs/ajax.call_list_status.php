<?php
/************************************************
콜내역
- 뒤로가기로 콜내역왔을때 상태 업데이트
************************************************/
include_once('./_common.php');

$arr = array();
$arr['result'] = "F";

// 상태반환
$row = sql_fetch("SELECT call_status FROM g5_call WHERE idx = '{$idx}'");

if ($row) {
	$arr['result'] = "T";
	$arr['status'] = $row['call_status'];
} 
echo json_encode($arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>