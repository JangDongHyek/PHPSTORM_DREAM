<?php
include_once('./_common.php');

/** 푸시 **/

// 1. 첫 메세지일 때 푸시
// 2. 메세지 전송 시 상대방이 채팅방에 없을 때 푸시

// 채팅방 회원 정보 (상대방)
$you_info = sql_fetch(" select cru.in_out, mb.mb_id from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_id}' and mb_nick != '{$member['mb_nick']}' ; ");

// 채팅방 정보
$ta_idx = sql_fetch(" select * from chat_room where id = '{$room_id}' ")['ta_idx'];

// 1. 첫 메세지 일 경우 상대방에세 새로운 채팅 알림
$message_count = sql_fetch(" select count(*) as count from chat_message where room_idx = '{$room_id}'; ")['count'];
if($message_count == 1) {
    $gourl = G5_BBS_URL.'/chat_room.php?room_id='.$room_id.'&ta_idx='.$ta_idx;

    $sql = " select * from g5_fcm where mb_id = '{$you_info['mb_id']}' ";
    $fRow = sql_fetch($sql);
    $tokens = array($fRow[token]);
    $message =array(
        "subject"=>"JOBGO",
        "message"=>"새로운 채팅이 있습니다.",
        "goUrl"=>$gourl,
    );
    $fcm=sendFcm($tokens, $message);
}
else {
    // 2. 메세지 전송 시 상대방이 채팅방에 없을 때
    if($you_info['in_out'] == 0) {
        $gourl = G5_BBS_URL.'/chat_room.php?room_id='.$room_id.'&ta_idx='.$ta_idx;

        $sql = " select * from g5_fcm where mb_id = '{$you_info['mb_id']}' ";
        $fRow = sql_fetch($sql);
        $tokens = array($fRow[token]);
        $message =array(
            "subject"=>"JOBGO",
            "message"=>"새로운 채팅이 있습니다.",
            "goUrl"=>$gourl,
        );
        $fcm=sendFcm($tokens, $message);
    }
}
?>