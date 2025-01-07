<?php
	include_once("./_common.php");
	$sql="update g5_write_b_order set
			wr_1='$wr_1'
			where wr_id='$wr_id'";
	sql_query($sql);
?>