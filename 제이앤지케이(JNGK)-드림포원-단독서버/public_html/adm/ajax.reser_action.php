<?php
include_once("./_common.php");

// bbs/ajax.reser_request.php, bbs/ajax.reser_mod.php -- 현재 파일 수정 시 왼쪽 파일 같이 수정

$mb = get_member_no($_POST['mb_no']);

// 동시에 예약할 수 있으므로 예약하고자 하는 시간 재확인
$count = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소'; ")['count'];

if($count == 0) {
    if($_POST['mode'] == 'u') {
        $sql = " update g5_lesson_reser 
                 set 
                 time_set_idx = '{$_POST['time_set_idx']}', reser_date = '{$_POST['reser_date']}', reser_time = '{$_POST['reser_time']}', mod_date = now() 
                 where idx = {$_POST['idx']} ";
        sql_query($sql);
    }
    else {
        $one_point = '';
        if(!empty($_POST['mb_state'])) {
            $one_point = 'Y';
        }
        $sql = " insert into g5_lesson_reser 
                 set
                 history_idx = '{$mb['history_idx']}', pro_mb_no = {$_POST['pro_mb_no']}, center_code = '{$_POST['center_code']}', lesson_code = '{$_POST['lesson_code']}', 
                 mb_no = {$_POST['mb_no']}, time_set_idx = '{$_POST['time_set_idx']}', reser_date = '{$_POST['reser_date']}', reser_time = '{$_POST['reser_time']}', reg_date = now(), one_point = '{$one_point}', reg_mb_id = '{$member['mb_id']}'; ";
        sql_query($sql);
    }

    // == 22.01.18 같은 일자/시간에 예약 건 있는지 확인 (초단위까지 동시 예약된 건이 있어 예약 후 재확인)
    // 22.09.21 추가 ==> 프로와 회원이 동시에 예약하는 경우 발행
    $count2 = sql_fetch(" select count(*) as count from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소'; ")['count'];
    if ($count2 > 1) { // 1건만 있어야 함, 1건 초과면 동시예약
        $reser = sql_fetch(" select * from g5_lesson_reser where pro_mb_no = {$_POST['pro_mb_no']} and time_set_idx = '{$_POST['time_set_idx']}' and reser_date = '{$_POST['reser_date']}' and reser_state != '예약취소' order by idx desc limit 1; ");
        if ($reser['mb_no'] == $_POST['mb_no']) { // 동시 예약된 데이터가 현재 예약하려고 하는 회원과 동일하면
            sql_query(" delete from g5_lesson_reser where idx = {$reser['idx']} "); // 같은 시간에 예약 건 삭제
            die('error');
        }
    }
    // == 같은 일자/시간에 예약 건 있는지 확인

    /*// 21.02.05 푸시
    $mb = get_member_no($_POST['mb_no']);

    $sql="select * from g5_fcm where mb_id = '{$mb['mb_id']}'"; // 프로가 회원 예약 시 회원에게 알림 (회원 id 필요)
    $fRow=sql_fetch($sql);
    $tokens=array($fRow[token]);
    $message=array(
        "subject"=>"예약신청",
        "message"=>"{$mb['mb_name']} 회원님 {$_POST['reser_date']}/{$_POST['reser_time']} 예약 되었습니다.",
        "goUrl"=>"",
    );
    $fcm=sendFcm($tokens, $message);*/

    die('success');
}
else {
    die('error');
}
?>
