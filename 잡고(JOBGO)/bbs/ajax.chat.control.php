<?php
include_once('./_common.php');

/**
 ** 채팅방이 없는 상태면 채팅방 생성 후 채팅방 번호 리턴, 있으면 해당 채팅방 번호 리턴
 **/

// 채팅방 있는지 확인
$count = sql_fetch(" select count(*) as count from chat_room where ta_idx = '{$ta_idx}' and master_id = '{$master_id}' ")['count'];

if($count == 0) { // 채팅방 없으면 생성
    $sql = "insert into chat_room set room_id = '{$member['mb_id']}', ta_idx = '{$ta_idx}', master_id = '{$master_id}', room_name = '{$room_name}', sub_id = '{$sub_id}', createdAt = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $room_id = sql_insert_id(); // char_room - id

    // 채팅방 회원 등록 (회원(질문자)과 전문인(답변자))
    // 일반인 정보
    $mb = get_member($master_id);
    sql_query(" insert into chat_room_user set room_idx = {$room_id}, room_name = '{$room_name}', user_id = '{$master_id}', user_name = '{$mb['mb_name']}', createdAt = '".G5_TIME_YMDHIS."'");

    // 전문인 정보
    $pro = get_member($sub_id);
    sql_query(" insert into chat_room_user set room_idx = {$room_id}, room_name = '{$room_name}', user_id = '{$sub_id}', user_name = '{$pro['mb_name']}', createdAt = '".G5_TIME_YMDHIS."' ");
}
else { // 채팅방 있으면 해당 채팅방 불러옴
    $room_id = sql_fetch(" select id from chat_room where ta_idx = '{$ta_idx}' and master_id = '{$master_id}' ")['id']; // char_room - id
}

echo $room_id; // char_room - id
?>