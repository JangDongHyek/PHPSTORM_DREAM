<?php
include_once("./_common.php");
$sql="update g5_write_b_customer set wr_10='$wr_10' where wr_id='$wr_id'";
echo $sql;
sql_query($sql);
?>