<?php
include_once("./_common.php");
$bo_table = $_GET['bo_table'];
$wr_id = $_GET['wr_id'];
$amount = $_GET['amount'];

$return = array();
$row = sql_fetch("select wr_subject, wr_content from {$write_table} where wr_id = '{$wr_id}'");
$asset = $row['wr_subject'];
$wecash = $row['wr_content'];

$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = '1' and (wr_1 = '' or wr_1 = 'success')");
$sum = $row['wr_content'] + $amount;

$tr_cash = $amount * $wecash;

if($asset < $sum){
	$return['success'] = false;
	$return['msg'] = "거래가능한 에셋보다 결제에셋이 많습니다. 확인 후 다시 시도해주세요.";
}else if($tr_cash > $member['mb_point']){
	$return['success'] = false;
	$return['msg'] = "위캐시가 부족합니다. 확인 후 다시 시도해주세요.";
}else{
	$return = $row;
	$return['success'] = true;
}

echo json_encode($return);
?>