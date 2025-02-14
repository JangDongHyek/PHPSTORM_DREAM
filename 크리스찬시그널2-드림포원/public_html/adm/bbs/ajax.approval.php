<?php

include_once('./_common.php');
$wr_id = $_REQUEST['wr_id'];
$bo_table = $_REQUEST['bo_table'];
$status = $_REQUEST['status'];

$sql = "update g5_write_{$bo_table} set wr_1 = '{$status}' where wr_id = '{$wr_id}'";
$result = sql_query($sql);
echo $result;