<?php
include_once('./_common.php');

// 전체 읽지 않은 메세지 수
$no_read_badge = sql_fetch("select count(*) as cnt from chat_message_log where user_id='{$member['mb_id']}' and read_status='0'")['cnt']; // 메세지 로그

echo $no_read_badge;
?>