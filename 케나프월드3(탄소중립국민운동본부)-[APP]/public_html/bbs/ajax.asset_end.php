<?php
include_once("./_common.php");

$wr_id = $_GET['wr_id'];
$en = $_GET['en'];

sql_query("update g5_write_asset set wr_1 = '{$en}' where wr_id = '{$wr_id}'");

?>