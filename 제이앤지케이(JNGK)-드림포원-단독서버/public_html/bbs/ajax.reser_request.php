<?php
include_once("./_common.php");

/** 회원 - 레슨예약 - 레슨 예약 완료 시 DB INSERT 및 푸시 **/

// adm/ajax.reser_action.php, bbs/ajax.reser_mod.php -- 현재 파일 수정 시 왼쪽 파일 같이 수정

$mb_no = $member['mb_no'];

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

// 레슨 정보 DB 생기면 레슨 정보도 추가해야 함.
// 동시에 예약할 수 있으므로 예약하고자 하는 시간 재확인
$count = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소'; ")['count'];

if($count == 0) {
    $one_point = '';
    if(!empty($_POST['mb_state'])) {
        $one_point = 'Y';
    }
    $sql = " insert into g5_lesson_reser
             set
             history_idx = '{$member['history_idx']}', pro_mb_no = {$_POST['pro_mb_no']}, center_code = '{$_POST['center_code']}', lesson_code = '{$_POST['lesson_code']}',
             mb_no = {$mb_no}, time_set_idx = {$_POST['time_set_idx']}, reser_date = '{$_POST['reser_date']}', reser_time = '{$_POST['reser_time']}', reg_date = now(), one_point = '{$one_point}', reg_mb_id = '{$member['mb_id']}'; ";
    sql_query($sql);

    // == 22.01.18 같은 일자/시간에 예약 건 있는지 확인 (초단위까지 동시 예약된 건이 있어 예약 후 재확인)
    $count2 = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소'; ")['count'];
    if ($count2 > 1) { // 1건만 있어야 함, 1건 초과면 동시예약
        $reser = sql_fetch(" select * from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소' order by idx desc limit 1; ");
        if ($reser['mb_no'] == $member['mb_no']) {
            sql_query(" delete from g5_lesson_reser where idx = {$reser['idx']} "); // 같은 시간에 예약 건 삭제
            die('error');
        }
    }
    // == 같은 일자/시간에 예약 건 있는지 확인

    $sql = " select * from g5_lesson_reser where mb_no = {$mb_no} and reser_date = '{$_POST['reser_date']}' order by idx desc ";
    $result = sql_query($sql);

    // 21.02.05 푸시
    $mb = get_member_no($mb_no);
    $pro_mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb['pro_mb_no']} ")['mb_id'];
    $reser_date = str_replace('.', '-', $_POST['reser_date']);

    $sql="select * from g5_fcm where mb_id = '{$pro_mb_id}'"; // 예약 신청 시 담당 프로에게 알림 (프로 id 필요)
    $fRow=sql_fetch($sql);
    $tokens=array($fRow[token]);
    $message=array(
        "subject"=>"예약신청",
        "message"=>"{$mb['mb_name']} 회원님의 {$_POST['reser_date']}/{$_POST['reser_time']} 예약신청이 있습니다.",
        //"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_date={$reser_date}&end_date={$reser_date}",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);

    die('success');
} else {
    die('error');
}
?>
