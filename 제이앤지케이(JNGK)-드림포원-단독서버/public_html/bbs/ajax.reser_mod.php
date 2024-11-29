<?php
include_once("./_common.php");

/** 회원 - 레슨예약 - 레슨 예약 수정 시 DB UPDATE 및 푸시 **/

// adm/ajax.reser_action.php, bbs/ajax.reser_request.php -- 현재 파일 수정 시 왼쪽 파일 같이 수정

$mb_no = $member['mb_no'];
$reser = sql_fetch(" select * from g5_lesson_reser where idx = {$_POST['idx']}; "); // 예약정보

// 21.12.07 프로가 이미 예약을 승인했을 경우 수정 불가
if($reser['reser_state'] == '예약완료') {
    die('fail');
}

// =====================
// 22.06.09 예약 전 프로 휴무일인지 체크
// ---------------------
$cnt = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['count'];
if($cnt > 0) { // 특정 일자의 예약 가능 시간 별도 설정
    $set_date = str_replace('.', '-', $reser_date);
    $chk = sql_fetch(" select * from g5_lesson_time_set_pro_not where mb_no = '{$pro_mb_no}' and time_set_idx = '{$time_set_idx}' and set_date = '{$set_date}' ");
    // 프로 휴무일(휴무시간)에 예약하였으면
    if($chk['idx']) die('error2');
} else {
    $chk = sql_fetch(" select * from g5_lesson_time_set_pro where mb_no = '{$pro_mb_no}' and use_yn = 'N' and time_set_idx = '{$time_set_idx}' ");
    // 프로 휴무일(휴무시간)에 예약하였으면
    if($chk['idx']) die('error2');
}
// =====================

// 동시에 예약할 수 있으므로 예약하고자 하는 시간 재확인
$count = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소'; ")['count'];

if($count == 0) {
    $sql = " update g5_lesson_reser 
             set 
             time_set_idx = '{$_POST['time_set_idx']}', reser_time = '{$_POST['reser_time']}', mod_date = now() 
             where idx = {$_POST['idx']} ";
    sql_query($sql);

    // 21.02.05 푸시
    $mb = get_member_no($mb_no);
    $pro_mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb['pro_mb_no']} ")['mb_id'];
    $reser = sql_fetch(" select * from g5_lesson_reser where idx = {$_POST['idx']}; "); // 예약정보

    $sql="select * from g5_fcm where mb_id = '{$pro_mb_id}'"; // 예약 수정 시 담당 프로에게 알림 (프로 id 필요)
    $fRow=sql_fetch($sql);
    $tokens=array($fRow[token]);
    $message=array(
        "subject"=>"예약신청",
        "message"=>"{$mb['mb_name']} 회원님의 {$reser['reser_date']}/{$reser['reser_time']} 예약신청이 있습니다.",
        //"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_date={$reser_date}&end_date={$reser_date}",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);

    die('success');
}
else {
    die('error');
}
?>
