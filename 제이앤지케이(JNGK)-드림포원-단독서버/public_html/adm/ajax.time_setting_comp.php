<?php
include_once("./_common.php");
/**
 * 프로 - 레슨예약 - 시간설정 모달창 - 설정완료
 * 22.06.09 수정 - 날짜 지정하여 휴무일 지정 시 휴무일에 예약된 레슨이 있는지 확인
 */
$set_time = $_POST['set_time'];
$set_date = $_POST['set_date'];

$time_set_idx = implode(',', $set_time); // set_time 배열 문자열로 합침

if(empty($set_date)) { // 일자를 입력하지 않으면 전체 일자의 예약 시간 설정
    // 22.06.09 날짜 지정하여 휴무일 지정 시 휴무일에 예약된 레슨이 있는지 확인
    $reser_date = date('Y.m.d'); // 금일
    $reser_time = date('H:i'); // 현재시간
    $chk = sql_fetch(" select count(*) as cnt from g5_lesson_reser where reser_date >= '{$reser_date}' and reser_time > '{$reser_time}' and time_set_idx in ({$time_set_idx}) and pro_mb_no = '{$member['mb_no']}' and reser_state != '예약취소' ")['cnt'];
    if ($chk > 0) {
        //die('fail');
    }

    sql_query(" update g5_lesson_time_set_pro set use_yn = 'Y', mod_date = now() where mb_no = {$member['mb_no']}; "); // 전체 Y로 변경

    for($i=0; $i<count($set_time); $i++) {
        sql_query(" update g5_lesson_time_set_pro set use_yn = 'N', mod_date = now() where mb_no = {$member['mb_no']} and time_set_idx = {$set_time[$i]}; "); // 체크 해제한 시간만 N로 변경
    }
}
else { // 일자 지정 시 입력 일자의 예약 시간 설정
    // 22.06.09 날짜 지정하여 휴무일 지정 시 휴무일에 예약된 레슨이 있는지 확인
    $reser_date = str_replace('-', '.', $set_date);
    $chk = sql_fetch(" select count(*) as cnt from g5_lesson_reser where reser_date = '{$reser_date}' and time_set_idx in ({$time_set_idx}) and pro_mb_no = '{$member['mb_no']}' and reser_state != '예약취소' ")['cnt'];
    if ($chk > 0) {
        //die('fail');
    }

    $count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$member['mb_no']} and set_date = '{$set_date}' ")['count'];
    if($count > 0) {
        sql_query(" delete from g5_lesson_time_set_pro_not where mb_no = {$member['mb_no']} and set_date = '{$set_date}' ");
    }

    for($i=0; $i<count($set_time); $i++) {
        $time = sql_fetch(" select * from g5_lesson_time_set where idx = '{$set_time[$i]}' ")['set_time'];
        sql_query(" insert into g5_lesson_time_set_pro_not set mb_no = {$member['mb_no']}, time_set_idx = {$set_time[$i]}, set_time = '{$time}', set_date = '{$set_date}', reg_date = now() ");
    }
}

die('success');
?>
