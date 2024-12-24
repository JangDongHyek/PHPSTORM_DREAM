<?php
include_once('./_common.php');


$sql = "SELECT * FROM g5_write_asset WHERE wr_is_comment = 0 order by wr_content+0 desc";
$result = sql_query($sql);
$count = sql_num_rows($result);			

for ($i = 0; $row = sql_fetch_array($result); $i++) { 

	$sql2 = "SELECT IFNULL(sum(wr_content), 0) as cnt from g5_write_asset 
			where wr_parent = '".$row["wr_id"]."' and wr_is_comment = '1' and (wr_1 = '' or wr_1 = 'success') ";
	$row2 = sql_fetch($sql2);
	$cnt = $row2["cnt"];

	$reCnt = (int)$row["wr_subject"] - (int)$cnt;

	echo "<strong>".($i + 1)."</strong> ";
	echo "wr_id : ". $row["wr_id"];
	echo " // 수량 : ".$row["wr_subject"]." // 단가 : ".$row["wr_content"] . " // 팔린수량 : " . $cnt . " // 잔여 : " . $reCnt;

	$addColumn = "";
	if($reCnt == 0) $addColumn = ", wr_1 = 'end' ";


	$sql3 = "UPDATE g5_write_asset SET wr_remainCnt = '".$reCnt."' {$addColumn} WHERE wr_id = '".$row["wr_id"]."'";
	$result2 = sql_query($sql3);

	echo ($result2)? " ------ 성공" : " ------ 실패★";
	echo "<br>";
}



?>

