<?php
include_once("./_common.php");
/**
 * 프로 - 레슨예약 - 시간설정 모달창 - 설정완료
 */
$set_time = $_POST['set_time'];
$set_date = $_POST['set_date'];

/*// 예약시간설정 g5_lesson_time_set_pro (오전 6시~오후 11시 기본 설정)
$cnt = sql_fetch(" select count(*) as cnt from g5_lesson_time_set_pro where mb_no = '{$member['mb_no']}' ")['cnt'];
if($cnt == 0) {
    $rlt = sql_query(" select * from g5_lesson_time_set; ");
    for($i=0; $row=sql_fetch_array($rlt); $i++) {
        $sql = " insert into g5_lesson_time_set_pro set mb_no = {$member['mb_no']}, time_set_idx = {$row['idx']}, use_yn = 'Y', reg_date = now(); ";
        sql_query($sql);
    }
}*/

if(empty($set_date)) { // 일자를 입력하지 않으면 전체 일자의 예약 시간 설정
    sql_query(" update g5_lesson_time_set_pro set use_yn = 'Y', mod_date = now() where mb_no = {$member['mb_no']}; "); // 전체 Y로 변경

    for($i=0; $i<count($set_time); $i++) {
        sql_query(" update g5_lesson_time_set_pro set use_yn = 'N', mod_date = now() where mb_no = {$member['mb_no']} and time_set_idx = {$set_time[$i]}; "); // 체크 해제한 시간만 N로 변경
    }
}
else { // 일자 지정 시 입력 일자의 예약 시간 설정
    $count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$member['mb_no']} and set_date = '{$set_date}' ")['count'];
    if($count > 0) {
        sql_query(" delete from g5_lesson_time_set_pro_not where mb_no = {$member['mb_no']} and set_date = '{$set_date}' ");
    }

    for($i=0; $i<count($set_time); $i++) {
        sql_query(" insert into g5_lesson_time_set_pro_not set mb_no = {$member['mb_no']}, time_set_idx = {$set_time[$i]}, set_date = '{$set_date}', reg_date = now() ");
    }
}

die('success');
?>
