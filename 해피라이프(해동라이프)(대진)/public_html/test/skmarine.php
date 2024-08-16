<?php
// 제휴회원(SK) 엑셀업로드
include_once('../common.php');

$sql = "SELECT * FROM g5_member WHERE mb_route_input = 'SK해운연합노동조합' AND mb_id LIKE 'sk%' ORDER BY mb_no ASC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

for ($i = 0; $row = sql_fetch_array($result); $i++) {
	// SKMARINE00001
	echo $row['mb_id'];
	$rep_id = str_replace("sk", "SKMARINE00", $row['mb_id']);
	echo "/".$rep_id."<br>";

	$sql = "UPDATE g5_member SET mb_id = '{$rep_id}' WHERE mb_id = '{$row['mb_id']}'";
	//echo sql_query($sql)? "완료" : "실패";

	echo "<hr>";
}