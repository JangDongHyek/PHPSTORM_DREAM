<?php
include_once('./_common.php');
$sql="select * from g5_fcm where token='$token'";
$row=sql_fetch($sql);
if($row[idx]){

}else{
	$sql="insert g5_fcm set token='$token'";
}
sql_query($sql);
?>