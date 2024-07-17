<?php
include_once ('./_common.php');
/**
 * 채팅 왔을 때 푸시 (채팅 보낼 때 상대방에게 푸시)
 */

//print_r($_REQUEST);exit;

// 내 정보
$mb = get_member($mb_id);
// 방이름 - 상대방에게 보여지는 발신자
if($mb['mb_level'] == 3) { $room_name = $mb['mb_company_name']; }
else { $room_name = getNickOrId($mb_id); }

// 채팅 상대방 정보 (chat_room_user에서 나를 제외한 데이터가 상대방 정보)
$you = sql_fetch(" select cru.user_id, mb.mb_level, mb.mb_id, mb_company_name from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_idx}' and user_id != '{$mb_id}' ");
// 푸시 보낼 아이디
$you_mb_id = $you['user_id'];

if(!empty($message)) {
    $push_status = "chatting";
    $push_data = array('subject'=>$room_name, 'message'=>$message, 'url'=>G5_BBS_URL."/chat.php?you_mb_id=".$mb_id, 'ref_idx'=>$room_idx, 'ref_table'=>'g5_chat_room', 'mb_id'=>$you_mb_id);
    @include_once(G5_BBS_PATH.'/send_push.php');
}

die();