<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if($member['mb_id'] != $view['mb_id'] && $is_member && !$is_admin){
	$sql = " select * from g5_viewer_business where mb_id = '{$member['mb_id']}' and wr_date = '".G5_TIME_YMD."'";
	$row = sql_fetch($sql);

	if(!$row){
		$sql = " insert into g5_viewer_business set
				wr_id = '{$wr_id}',
				mb_id = '{$member['mb_id']}',
				wr_date = '".G5_TIME_YMD."',
				wr_datetime = '".G5_TIME_YMDHIS."'
				";
		sql_query($sql);
		insert_point($member['mb_id'], $view['wr_cash'], $view['subject'].' 캐시백', '@cashback', $member['mb_id'], $wr_id);
		$cash_back = $view['wr_cash'] * -1;
		insert_point($view['mb_id'], $cash_back, $view['subject'].' 캐시백 지급', '@cashback', $member['mb_id'], $wr_id);
	}
}


?>