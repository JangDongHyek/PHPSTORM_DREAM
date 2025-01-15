<?php
include_once ('../../../../../common.php');

header("Content-Type:application/json");

$date_arr = explode('-',$_POST['date_data']);
$year = $date_arr[0];
$sel_mon = $date_arr[1];
$now_day = $date_arr[2];

$query = "SELECT * FROM $write_table WHERE wr_5 like '{$year}-{$sel_mon}-{$now_day}%' and wr_1 !='1' ORDER BY wr_id ASC";
$result = sql_query($query);
for($i=0; $i<$row = sql_fetch_array($result); $i++){
	$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
}

echo json_encode($list);
?>