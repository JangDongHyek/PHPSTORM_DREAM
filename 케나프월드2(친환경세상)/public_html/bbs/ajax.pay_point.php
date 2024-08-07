<?php
include_once("./_common.php");

$sql="select mb_point from g5_member where mb_id = '{$_POST['mbid']}'";
$result = sql_fetch($sql);

$rest = $result['mb_point'] - $_POST['value'];
$value = -$_POST['value'];
$wr_id =0;

$sql = "update g5_member set mb_point = {$rest} where mb_id = '{$_POST['mbid']}'";
sql_query($sql);

$date = Date('Y-m-d h:i:s');

$sql = "insert into g5_point set mb_id = '{$_POST['mbid']}', po_content = '정보등록 사용', po_datetime='{$date}', po_point = {$value}, po_mb_point = {$rest}, po_rel_table='@paybusi', po_rel_id='{$_POST['mbid']}',  po_wrid={$wr_id}";
echo $sql;
sql_query($sql);

$sql = "insert into g5_pay_business set mb_id = '{$_POST['mbid']}', amount = {$_POST['value']}, startdate='{$date}', enddate = '{$_POST['enddate']}'";
sql_query($sql);



?>