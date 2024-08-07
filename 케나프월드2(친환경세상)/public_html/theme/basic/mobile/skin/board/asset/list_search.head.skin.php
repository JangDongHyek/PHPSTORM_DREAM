<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($my_trade)
	$sql_search .= " and mb_id = '{$member['mb_id']}' and wr_is_comment = 0";
else
	$sql_search .= " and (wr_1 = '' or wr_1 = 'end') and wr_remainCnt > 0";
?>