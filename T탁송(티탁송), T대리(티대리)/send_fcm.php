<?php
/**
 * FCM 발송
 * $push_status : 발송페이지
 * $push_data : 알림내용
 */
include_once ("./common.php");

$agent_list = array("AOS", "IOS");
$message = array();
$tokens = array();

// 공통쿼리
$sql = "SELECT mb_no,
        (SELECT token FROM g5_fcm_token WHERE mb_id = g5_member.mb_id AND agent = 'AOS' ORDER BY idx DESC LIMIT 0, 1) AS aos_token,
        (SELECT token FROM g5_fcm_token WHERE mb_id = g5_member.mb_id AND agent = 'IOS' ORDER BY idx DESC LIMIT 0, 1) AS ios_token
        FROM g5_member WHERE
        ";

// 콜구분
$call_type_str = $push_data['call_type']=="0"? "탁송콜" : "대리콜";
$call_idx = !empty($push_data['idx'])? $push_data['idx'] : "";

// 쿼리생성 (AOS, IOS)
switch ($push_status) {
    case "customers_request" :  // 0:고객 콜신청시 - 모든기사/사장님에게 푸시발송
        $message['subject'] = "[T탁송] {$call_type_str} 신청이 있습니다.";
        $message['message'] = "";
        $message['goUrl'] = G5_BBS_URL."/call_view.php?idx={$call_idx}";

        $sql .= "(mb_level = 5 AND push_new_call = 'Y') OR mb_id = 'ttaksong' ORDER BY mb_no ASC";
        break;

    case "ready_call" :     // R:관리자 콜접수 - 해당고객에게 푸시발송
        $message['subject'] = "[T탁송] {$call_type_str}이 접수되었습니다.";
        $message['message'] = "";
        $message['goUrl'] = G5_BBS_URL."/call_view.php?idx={$call_idx}";

        $sql .= "mb_id = '{$push_data['consumer_id']}' ORDER BY mb_no ASC";
        break;

    case "driver_apply_call" :  // 1:기사 콜수락시 - 해당고객에게 푸시발송
        $message['subject'] = "[T탁송] 기사가 배정되었습니다.";
        $message['message'] = "";
        $message['goUrl'] = G5_BBS_URL."/call_view.php?idx={$call_idx}";

        $sql .= "mb_id = '{$push_data['consumer_id']}' ORDER BY mb_no ASC";
        break;

    case "end_call" :   // 2:콜완료 - 해당고객,기사에게 푸시발송
        $message['subject'] = "[T탁송] 목적지에 도착했습니다.";
        $message['message'] = "이용해주셔서 감사합니다.";
        $message['goUrl'] = G5_BBS_URL."/call_view.php?idx={$call_idx}";

        $sql .= "mb_id = '{$push_data['consumer_id']}' OR mb_id = '{$push_data['driver_id']}' ORDER BY mb_no ASC";
        break;

    case "cancel_call" :    // -1:콜취소 - 해당고객,기사에게 푸시발송
        $message['subject'] = "[T탁송] {$call_type_str}이 취소되었습니다.";
        $message['message'] = "";
        $message['goUrl'] = G5_BBS_URL."/call_view.php?idx={$call_idx}";

        $sql .= "mb_id = '{$push_data['consumer_id']}' OR mb_id = '{$push_data['driver_id']}' ORDER BY mb_no ASC";
        break;
}
$result = sql_query($sql);

// 토큰 추출
while($row = sql_fetch_array($result)) {
    if ($row['aos_token']) {
        $tokens['AOS'][] = $row['aos_token'];
    }
    if ($row['ios_token']) {
        $tokens['IOS'][] = $row['ios_token'];
    }
}

// 푸시발송 처리 (토큰 존재하면)
foreach ($agent_list AS $key=>$agent) {
    if (count($tokens[$agent]) > 0) {
        sendFcm($tokens[$agent], $message, $agent);
    }
}


// 푸시 발송
function sendFcm($tokens=array(), $message=array(), $agent="")
{
    if ($agent == "") return;

    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $tokens,
        //'content_available'=>true,
        'data' => $message,
        'priority'          => 'high',
        //'notification'      => array( 'title' => '', 'body' => $message['message'])
    );
    if ($agent == 'IOS') {
        $fields['notification'] = array( 'title' => $message['subject'], 'body' => $message['message'], "goUrl"=>$message['goUrl']);
    }

    $headers = array(
        'Authorization:key=AAAAryfKiV4:APA91bGWf8Gg1GN7XoGrGk1D1v88HyY26Gsd0dN5YrCAichu6jK7l7QXdlNvVt9BHX0ts5KFt3IvwlBP85HEvhrkR1vL-QXeT8WGZ1WSsg8XiZLJ7lJe-6nisj_TgstnJxr0fC-efGby' ,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    //print_r($result);

    /*
    if (curl_error($ch)) {
        // 실패
        $err_info['no'] = curl_errno($ch);
        $err_info['msg'] = curl_error($ch);
        print_r($err_info);

        $push_success = "N";

    } else {
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        //$header = substr($result, 0, $header_size);
        $body = substr($result, $header_size);
        print_r($body);

        $push_success = "Y";
    }
    */

    curl_close($ch);
}
