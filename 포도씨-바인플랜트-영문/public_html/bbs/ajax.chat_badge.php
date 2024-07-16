<?php
include_once('./_common.php');

/** 상단에 채팅 수신 여부 표시 (ajax) **/

$sql = "select count(*) as cnt from chat_message_log where user_id = '{$member['mb_id']}' and read_status = '0'"; // 메세지 로그 (안읽은 배지 표시 위함)
$log = sql_fetch($sql);
$cnt = $log['cnt']; // 안읽은 메세지 개수

echo $cnt;