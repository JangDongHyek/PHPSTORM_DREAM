<?php
include_once("_common.php");
$sql="SELECT *
FROM `g5_write_carte`
WHERE wr_3 REGEXP '^[0-9]+$'";
$result=sql_query($sql);
for($i=0;$row=sql_fetch_array($result);$i++){
	$wr_3=time_convert($row[wr_3]);
	$sql="update `g5_write_carte` set wr_3='$wr_3' where wr_id='$row[wr_id]'";
	sql_query($sql);
}
function time_convert($time){
   $t=( $time- 25569) * 86400-60*60*9;
   $t=round($t*10)/10;
   $t = date('Y-m-d', $t);
   return $t;
}
?>