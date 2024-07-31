<?php
	
	include_once("./_common.php");

	
	$sql ="select count(*) as cnt from g5_member where mb_2 = '{$val}' ";
	$result_cnt = sql_fetch($sql);
	
	echo $result_cnt['cnt'];


?>