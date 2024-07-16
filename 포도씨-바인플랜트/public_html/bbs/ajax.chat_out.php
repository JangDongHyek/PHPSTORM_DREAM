<?php
include_once('./_common.php');
/**
 * 채팅방 나가기
 */

// 채팅방정보
$info = sql_fetch("select * from chat_room where id = '{$room_idx}' ");

$user_out = '';
if(empty($info['user_out'])) { // 한사람만 나가면 user_out 컬럼에 업데이트
    $user_out = $member['mb_id'];

    sql_query(" update chat_room set user_out = '{$user_out}' where id = '{$room_idx}' ");
    sql_query(" update chat_message set user_out = '{$user_out}' where room_idx = '{$room_idx}' ");
    sql_query(" update chat_message_log set user_out = '{$user_out}' where room_idx = '{$room_idx}' ");

} else { // 둘다 나가면 delete
    //$user_out = $info['user_out'].','.$member['mb_id'];

    // 채팅 데이터 삭제
    sql_query(" delete from chat_message_log where room_idx = '{$room_idx}' ");
    sql_query(" delete from chat_message where room_idx = '{$room_idx}' ");
    sql_query(" delete from chat_room_user where room_idx = '{$room_idx}' ");
    sql_query(" delete from chat_room where id = '{$room_idx}' ");
}

echo 'success';exit;