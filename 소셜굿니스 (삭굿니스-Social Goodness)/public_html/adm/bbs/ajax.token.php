<?php
include_once('./_common.php');
//회원 아이디로 쿼리문 돌리기

$sql="select * from fcm_member where DeviceID='$DeviceID'";
$result=sql_query($sql);
$count=sql_num_rows($result);
if(!$count){
	if($token){
		$sql="delete from fcm_member where mb_id='$member[mb_id]'";
		sql_query($sql);
		$sql="insert fcm_member set mb_id='$member[mb_id]',
																DeviceID='$DeviceID',
																token='$token'";
		sql_query($sql);
	}
}else{
	$sql="update fcm_member set token='$token',mb_id='$member[mb_id]' where DeviceID='$DeviceID'";
	sql_query($sql);
}
?>