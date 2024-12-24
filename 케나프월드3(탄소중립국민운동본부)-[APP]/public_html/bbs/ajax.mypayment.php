<?php 
include_once("./_common.php");

$wr_id = $_GET['wr_id'];
$t = $_GET['t'];

if($t == "수락")
	$wr_1 = "success";
else if($t == "거절")
	$wr_1 = "failed";
else if($t == "취소")
	$wr_1 = "cancel";

$gu = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$wr_id}' ");
$pa = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$gu['wr_parent']}'");

$po_asset = $gu['wr_content'] * (-1);
$wecash = $pa['wr_content'];
$use_money = $gu['wr_content'] * $pa['wr_content'];

if($wr_1 == "success"){
	insert_point($pa['mb_id'], $use_money, $gu['mb_id'].'님에게 에셋(단가:'.number_format($wecash).'원) 판매', '@asset', $pa['mb_id'], $pa['mb_id']."_".G5_TIME_YMDHIS);

	//판매자 마이너스
	insert_asset($pa['mb_id'], $po_asset, "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 판매", '@passive', $pa['mb_id'], $pa['mb_id'].'-'.uniqid(''), $expire);

	//구매자 플러스
	insert_asset($gu['mb_id'], $gu['wr_content'], "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 구매", '@passive', $gu['mb_id'], $gu['mb_id'].'-'.uniqid(''), $expire);
}else{
	if($t == "취소"){
		insert_point($gu['mb_id'], $use_money, $pa['mb_id'].'님에게 에셋(단가:'.number_format($wecash).'원) 구매취소', '@asset', $gu['mb_id'], $gu['mb_id']."_".G5_TIME_YMDHIS);
	}
}

sql_query("update `g5_write_asset` set wr_1 = '{$wr_1}' where wr_id = '{$wr_id}'");
?>