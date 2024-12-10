<?php
// 관리자페이지 기타서비스 - 우선순위 변경
include_once('./_common.php');

$arr = array();
// $arr['post'] = $_POST;

$wr_id_arr = explode(",", $idx_str);
$wr_orderby_arr = explode(",", $order_str);

for ($i = 0; $i < count($wr_id_arr); $i++) {
	$wr_id = preg_replace("/[^0-9]*/s", "", $wr_id_arr[$i]);
	$wr_orderby = preg_replace("/[^0-9]*/s", "", $wr_orderby_arr[$i]);

	$sql = "UPDATE g5_write_{$bo_table} SET 
			wr_orderby = '{$wr_orderby}'
			WHERE wr_id = '{$wr_id}'";

	sql_query($sql);
}

$arr['result'] = "T";
echo json_encode($arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>