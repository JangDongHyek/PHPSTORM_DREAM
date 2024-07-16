<?php
include_once ('./_common.php');
/**
 * 푸시알림
 * $push_status : 발송상황
 */

$message = array();
//$sql_search = " and fcm.mb_id in ('test01') ";
$message['subject'] =  $push_data['subject']; // 푸시 제목
$message['goUrl'] = $push_data['url']; // 푸시 선택 시 이동 페이지

switch ($push_status) {
    case "notice": // 공지사항 (write_update.php)
        $message['message'] = '새로운 공지사항이 올라왔어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 ";
        break;
    case "question": // 기업미니홈피-문의하기 (ajax.company_question.php)
        $message['message'] = '새 문의가 들어왔어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and mb.mb_no = '{$push_data['mb_no']}' ";
        break;
    case "bunker_gift": // 벙커 선물하기
        $mb_id = getNickOrId($push_data['mb_id']); // 닉네임 or 아이디 (ajax.gift_bunker.php)
        $message['subject'] = 'For you';
        $message['message'] = $push_data['giver'].'님이 '.number_format($bunker).'벙커를 선물했어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'direct_inquiry': // 기업미니홈피-바로의뢰 (ajax.company_write_update.php)
        $message['message'] = '바로의뢰가 왔어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and mb.mb_no = '{$push_data['mb_no']}' ";
        break;
    case 'estimate': // 견적보내기 (ajax.company_estimate_update.php)
        $message['message'] = '새로운 견적이 있어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'estimate_select': // 견적선택 (ajax.estimate_select.php)
        $message['message'] = '제출한 견적이 채택되었어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'review': // 마이페이지-나의의뢰-요청의뢰-거래후기보내기 (ajax.inquiry_review.php - select)
        $message['message'] = '후기가 올라왔어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'thanks': // 마이페이지-나의의뢰-보낸견적-감사인사보내기 (ajax.inquiry_review.php - thanks)
        $message['subject'] = 'Thank you';
        $message['message'] = $member['mb_id'].'님께 감사인사를 받았어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'chatting': // 채팅 (chat.js, ajax.chat_push.php)
        $message['message'] = $push_data['message'];
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'resume': // 이력서 지원 (ajax.resume_update.php)
        $message['message'] = '새 이력서가 있어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
    case 'helpme': // 헬프미 답변 작성 (help_view_update.php)
        $message['message'] = '새 답변이 달렸어요!';
        $sql = " select fcm.* from g5_fcm as fcm left join g5_member as mb on mb.mb_id = fcm.mb_id where token != '' and mb_level != 1 and fcm.mb_id = '{$push_data['mb_id']}' ";
        break;
}
//$message['subject'] = '['.$message['subject'].']';

//if($private) { echo $sql;exit; }
$push_result = sql_query($sql);

$tokens = array(); // 푸시발송토큰
for($i=0; $row=sql_fetch_array($push_result); $i++) {
    // 푸시 DB 등록
    $sql = "insert into g5_push_list SET 
            mb_id = '{$row['mb_id']}',
            subject = '{$message['subject']}',
            content = '{$message['message']}',
            url = '{$message['goUrl']}',
            regdate = '".G5_TIME_YMDHIS."',
            regdateTS = '".time()."',
            token_idx = '{$row['idx']}',
            ref_idx = '{$push_data['ref_idx']}',
            ref_case = '{$push_status}',
            ref_table = '{$push_data['ref_table']}'
            ";
    sql_query($sql);

    array_push($tokens, $row['token']);
}
//$tokens = array_unique($tokens);
//$tokens = array_values($tokens);

if(!$private) {
    sendFcm($tokens, $message);
}
