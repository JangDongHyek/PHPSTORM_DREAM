<?php
include_once('./_common.php');

if($member[mb_id] != ""){
	$mb_id = $member[mb_id];
}

$sql = "select * from `g5_fcm` where `token` = '$token'";
$row = sql_fetch($sql);

//var_dump($row);

if($row[idx] == "" || $row[idx] == null){
	$sql = "insert into `g5_fcm` set `token` = '$token', `mb_id` = '$mb_id'";
} else {
	$sql = "update `g5_fcm` set `token` = '$token', `mb_id` = '$mb_id' where `token` = '$token'";
}
echo $sql;
sql_query($sql);
?>