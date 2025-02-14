<?php
	include_once("./_common.php");
	$sql="select * from g5_member where mb_id='$_POST[mb_id]'";
	$row=sql_fetch($sql);
	$jsonArray=array();
	if($row[mb_id]){
		$jsonArray["success"]="true";
		$jsonArray["login"]="ok";
	}else{
		$jsonArray["success"]="false";
		$jsonArray["login"]="no";
	}
	$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
	echo $output;
?>