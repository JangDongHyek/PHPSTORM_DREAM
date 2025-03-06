<?php
include_once('./_common.php');
$sql="update g5_write_{$bo_table} set wr_3='1' where wr_id='$wr_id'";
sql_query($sql);
?>