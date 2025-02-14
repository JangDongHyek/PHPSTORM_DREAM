<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no'];
$message = $_REQUEST['message'];


// 수신인 아이디
$mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb_no}; ")['mb_id'];
$mb = get_member($mb_id);
// 23.10.24 메세지만나 array로빼줌 wc
$manna = $manna_arr['message'];

//***************메세지 보낼 경우 만나 차감
$acc_point = $member['cw_point'] - $manna;
$point_content = $mb['mb_nick'] ." 회원에게 메세지 전송";

//관리자에게 보낼 경우 차감 X
if ($mb["mb_level"] != 10 && $member["mb_level"] != 10){

    // 포인트 없을 시 조회 불가
    if($member['cw_point'] < $manna && !$ios_payment_test) {
        die('fail');
    }

    // 회원 포인트 이력
    $sql = " insert into g5_member_point set profile_name = '메세지전송',mb_id = '{$member["mb_id"]}', point_category = '차감', point = $manna, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '".G5_TIME_YMDHIS."', rel_mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);

    // 회원 포인트 업데이트
    $sql = " update g5_member set cw_point = cw_point - $manna where mb_id = '{$member["mb_id"]}' ";
    $result = sql_query($sql);
    //**********************메세지 보낼 경우 만나 차감 끝
}
// 메세지 저장
$sql = " insert into g5_message set
         send_mb_no = {$member['mb_no']}, send_mb_id = '{$member['mb_id']}', receive_mb_no = {$mb_no}, receive_mb_id = '{$mb_id}', message = '{$message}', message_date = now() ";
sql_query($sql);

// 21.03.08 푸시
$mb = get_member($mb_id);
if($mb['alarm'] == 'ON') {
    $sql="select * from g5_fcm where mb_id = '{$mb_id}' "; // 메세지 발송 시 수신 회원에게 푸시
    $fRow=sql_fetch($sql);
    $tokens=array($fRow[token]);
    $message=array(
        "subject"=>"크리스찬시그널",
        "message"=>"새로운 메세지가 있습니다.",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);
    $fcm=sendFcmIOS($tokens, $message);
}

die('success');
?>