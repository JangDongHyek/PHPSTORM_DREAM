<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$row = sql_fetch("select wr_subject, wr_content from {$write_table} where wr_id = '{$wr_id}'");
$asset = $row['wr_subject'];
$wecash = $row['wr_content'];

$tr_cash = $amount * $wecash;

$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = '1' and (wr_1 = '' or wr_1 = 'success')");
$sum = $row['wr_content'] + $wr_content;

if($asset < $sum){
	alert("거래가능한 에셋보다 결제에셋이 많습니다. 확인 후 다시 시도해주세요.");
	exit;
}

if($tr_cash > $member['mb_point']){
	alert("위캐시가 부족합니다. 확인 후 다시 시도해주세요.");
	exit;
}
?>