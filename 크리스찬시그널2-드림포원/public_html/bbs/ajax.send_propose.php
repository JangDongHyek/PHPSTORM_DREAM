<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no'];

// 수신인 아이디
$mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb_no}; ")['mb_id'];

// 수신인이 데이트 신청 거절 설정 시 return
$propose = sql_fetch(" select propose from g5_member where mb_no = {$mb_no}; ")['propose'];
if($propose == 'OFF') {
    die('fail');
}

// 23.11.16 푸시 wc
$mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 프로필사진 회원정보
if($mb['alarm'] == 'ON') {
    $sql = " select * from g5_fcm where mb_id = '{$mb['mb_id']}' ";
    $fRow = sql_fetch($sql);
    $tokens = array($fRow[token]);
    $message = array(
        "subject"=>"크리스찬시그널",
        "message"=>"데이트신청이 왔습니다.",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);
    $fcm=sendFcmIOS($tokens, $message);
}

// 데이트 저장
$sql = " insert into g5_propose set 
         send_mb_no = {$member['mb_no']}, send_mb_id = '{$_SESSION['ss_mb_id']}', receive_mb_no = {$mb_no}, receive_mb_id = '{$mb_id}', propose_date = now() ";
sql_query($sql);

die('success');
?>