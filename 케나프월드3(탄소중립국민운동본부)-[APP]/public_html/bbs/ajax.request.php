<?php 
include_once("./_common.php");

$wr_id = $_GET['wr_id'];

$row = sql_fetch("select wr_subject, wr_content from g5_write_asset where wr_id = '{$wr_id}'");
$wr_subject = $row['wr_subject'];
$wr_content = $row['wr_content'];
$row = sql_fetch("select sum(wr_content) as wr_content from g5_write_asset where wr_parent = '{$wr_id}' and wr_is_comment = '1' and (wr_1 = '' or wr_1 = 'success')");
$sum = $wr_subject - $row['wr_content'];

$return = array();
$return['sum'] = number_format($sum);
$return['sel'] = number_format($wr_content);

echo json_encode($return);
?>