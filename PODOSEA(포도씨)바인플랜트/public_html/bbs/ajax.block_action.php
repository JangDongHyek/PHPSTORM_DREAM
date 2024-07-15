<?php
include_once("./_common.php");

/** 숨김/차단 (ajax) **/

$sql = " insert into g5_block set mb_id = '{$member['mb_id']}', target_mb_id = '{$target_mb_id}', wr_datetime = '".G5_TIME_YMDHIS."', rel_table = '{$rel_table}', rel_idx = '{$rel_idx}' ";
$result = sql_query($sql);

if($result) {
    echo 'success';
    exit;
}