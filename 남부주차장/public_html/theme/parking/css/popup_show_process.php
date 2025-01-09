<?php
	include_once("./_common.php");
	$sql = "update g5_popup set hide = ".$_POST["data"];
	$result = sql_query($sql);
?>