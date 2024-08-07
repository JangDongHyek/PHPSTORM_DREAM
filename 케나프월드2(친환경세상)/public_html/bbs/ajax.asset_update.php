<?php
include_once("./_common.php");

$wr_id = $_GET['wr_id'];
$wr_1 = $_GET['wr_1'];

$sql = "update g5_write_asset set wr_1 = '{$wr_1}' where wr_id = '{$wr_id}'";
sql_query($sql);

if($wr_1 == "success"){
	$gu = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$wr_id}' ");
	$pa = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$gu['wr_parent']}'");

	$po_asset = $gu['wr_content'] * (-1);

	//판매자 마이너스
	insert_asset($pa['mb_id'], $po_asset, "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 판매", '@passive', $pa['mb_id'], $pa['mb_id'].'-'.uniqid(''), $expire);

	//구매자 플러스
	insert_asset($gu['mb_id'], $gu['wr_content'], "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 구매", '@passive', $gu['mb_id'], $gu['mb_id'].'-'.uniqid(''), $expire);
}
?>