<?php
include_once('./_common.php');

/** 관심친구 추가/삭제 (ajax) **/

if($mode == 'add') {
    $result = sql_query(" insert into g5_like_friend set mb_id = '{$member['mb_id']}', friend_mb_id = '{$friend_mb_id}', wr_datetime = '".G5_TIME_YMDHIS."' ");
}
else {
    $result = sql_query(" delete from g5_like_friend where mb_id = '{$member['mb_id']}' and friend_mb_id = '{$friend_mb_id}' ");
}

if($result) {
    echo 1;
    exit;
}