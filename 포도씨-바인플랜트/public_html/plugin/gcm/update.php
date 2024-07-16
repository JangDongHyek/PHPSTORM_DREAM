<?
include_once('./_common.php');


$mb_id			=	$_REQUEST['mb_id'];
$DeviceID		=	$_REQUEST['DeviceID'];
$type			=	$_REQUEST['type'];
$state			=	$_REQUEST['state'];
$count			=	$_REQUEST['count'];


$row = sql_fetch("Select * From `gcm_member` Where (`mb_id` = '$mb_id' or `DeviceID` = '$DeviceID') and `type` = '$type'");

if($row != null){
	sql_query("Update `gcm_member` set 
	`state` = '$state',
	`count` = '$count'
	Where (`mb_id` = '$mb_id' or `DeviceID` = '$DeviceID') and `type` = '$type'");
}


?>