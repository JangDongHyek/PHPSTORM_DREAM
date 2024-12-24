<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if($w == "c"){
	$row = sql_fetch("select wr_subject, wr_content, mb_id from {$write_table} where wr_id = '{$wr_id}'");
	$asset = $wr_content;
	$wecash = $row['wr_content'];
	$wl_tel = $row['mb_id'];

	$mb_id = $member['mb_id'];

	/*
	$row = sql_fetch("select sum(wr_content) as sum from {$write_table} where wr_parent = '{$wr_id}'");
	$sum = $row['sum'];

	if($asset <= $sum){
		sql_query("update {$write_table} set wr_1 = '1' where wr_id = '{$wr_id}'");
	}
	*/

	$use_money = $asset * $wecash * (-1);

	insert_point($mb_id, $use_money, $wl_tel.'님에게 에셋(단가:'.number_format($wecash).'원)  결제', '@asset', $mb_id, $mb_id."_".G5_TIME_YMDHIS);

	$gu = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$comment_id}' ");
	$pa = sql_fetch("select * from g5_write_asset as a left join g5_member as b on a.mb_id = b.mb_id where wr_id = '{$gu['wr_parent']}'");

	$po_asset = $gu['wr_content'] * (-1);
	$wecash = $pa['wr_content'];
	$use_money = $gu['wr_content'] * $pa['wr_content'];

	insert_point($pa['mb_id'], $use_money, $gu['mb_id'].'님에게 에셋(단가:'.number_format($wecash).'원) 판매', '@asset', $pa['mb_id'], $pa['mb_id']."_".G5_TIME_YMDHIS);

	//판매자 마이너스
	insert_asset($pa['mb_id'], $po_asset, "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 판매", '@passive', $pa['mb_id'], $pa['mb_id'].'-'.uniqid(''), $expire);

	//구매자 플러스
	insert_asset($gu['mb_id'], $gu['wr_content'], "[".$pa['wr_id']."-".$gu['wr_id']."] ".number_format($gu['wr_content'])." 에셋(단가:".number_format($pa['wr_content'])."원) 구매", '@passive', $gu['mb_id'], $gu['mb_id'].'-'.uniqid(''), $expire);
	
	//$sql = "select sum(CONVERT(wr_content, SIGNED) as sum from g5_write_asset where wr_parent = '{$pa['wr_id']}' and wr_is_comment = '1'";	// 쿼리안됨;
	$sql = "select sum(wr_content + 0) as sum from g5_write_asset where wr_parent = '{$pa['wr_id']}' and wr_is_comment = '1'";
	$sum = sql_fetch($sql);

	/*
	if($pa['wr_subject'] <= $sum['sum']){
		$sql = "update g5_write_asset set wr_1 = 'end' where wr_id = '{$pa['wr_id']}''";
		sql_query($sql);
	}
	*/

	// 190219 잔여량 업데이트 추가 (정렬시 완료는 제거하기 위함)
	$wr_remainCnt = (int)$pa['wr_subject'] - (int)$sum['sum'];
	$addColumn = "";
	if((int)$sum['sum'] < 1) $addColumn = ", wr_1 = 'end' ";

	$sql = "update g5_write_asset set wr_remainCnt = '{$wr_remainCnt}' {$addColumn} where wr_id = '{$pa['wr_id']}'";
	sql_query($sql);


	goto_url(G5_BBS_URL."/board.php?bo_table=".$bo_table);
}

?>