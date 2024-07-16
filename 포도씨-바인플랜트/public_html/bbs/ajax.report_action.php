<?php
include_once("./_common.php");

/** 신고하기 (ajax) **/

$sql = " insert into g5_report set mb_id = '{$member['mb_id']}', target_mb_id = '{$target_mb_id}', reason = '{$reason}', contents = '{$contents}', wr_datetime = '".G5_TIME_YMDHIS."', rel_table = '{$rel_table}', rel_idx = '{$rel_idx}' ";
$result = sql_query($sql);

if($result) {
    echo 'success';
    exit;
}