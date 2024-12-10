<?php
include_once ("./common.php");


// die();

// 좌표로 상세주소
$path = '/v2/local/geo/coord2address';
$content_type = 'json'; // json or xml
$params1 = http_build_query(array('x' =>'126.8918847', 'y'=>'37.489855',));
$decode1 = kakaoRestApi($path, $params1, $content_type);

print_r($decode1);

// $startAddress = $decode1['documents'][0]['address']['address_name'];
// echo !empty($startAddress)? 'O' : 'X';



die();

$agent_list = array("AOS", "IOS");
$message = array();
$tokens = array();

// 테스트
$tokens[] = "fghWG04bS52zWEEvZ5ba4N:APA91bHWZ6OJg_u84UDhfmlKzLNQAPS6BBx1kkfO3ck8733hFOI5V9Z3yO9fnwrbltSgKKCvBITW2DRKzDIcokCYb-RUPI4CDjqhI5HuR2JFLB9Ox8DarGhmYzkvXsbEwFYLbHZwsCLS";
$tokens[] = "fFpOu6ocRBeROmI14qeSnD:APA91bG1a-NJF4WfetITpDzbhnOyriFD7n7b8bpVwNgV6UKiVp9j9s-0GUXoIaW3K3rII7er-BztyHv2ivl6-_l2w6vs6onS3qNsO527n4Z1-XoqksGiCOXSO8ZVKcdZcRZ24M8lcurh";

$message['subject'] = "[T탁송] 대리콜 신청이 있습니다.";
$message['message'] = "";
$message['goUrl'] = G5_BBS_URL."/call_view.php?idx=200";

sendFcm($tokens, $message, 'AOS');

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
    print_r($result);

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


//01091196888
//goSms("01026120220","0518910088","[T탁송] 테스트님이 탁송 요청하였습니다.");