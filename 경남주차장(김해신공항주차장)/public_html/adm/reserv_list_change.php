<?php
include_once('./_common.php');
$sql = " select * from g5_write_b_reserv";
$result=sql_query($sql);
while($row=sql_fetch_array($result)){
	$wr_1=$row[wr_19];
	$wr_2=$row[wr_20];
	$sql="update g5_write_b_reserv set wr_1='$wr_1',wr_2='$wr_2' where wr_id='$row[wr_id]'";
	sql_query($sql);
}

?>