<?php
include_once('./_common.php');
$sql="select * from g5_fcm where mb_id='$member[mb_id]'";
$row=sql_fetch($sql);
if($row[idx]){
	$sql="update g5_fcm set token='$token' where mb_id='$member[mb_id]'";
}else{
	$sql="insert g5_fcm set token='$token',mb_id='$member[mb_id]'";
}
sql_query($sql);
?>