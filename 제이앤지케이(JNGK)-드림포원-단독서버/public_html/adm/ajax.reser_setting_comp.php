<?php
include_once("./_common.php");

$add_time = $_POST['add_time'];
$delete_time = $_POST['delete_time'];

// 시간 삭제 -- 삭제하고자 하는 시간에 남은 예약 정보가 있는지 확인 -- 있으면 삭제 못하게 함
$now = date('Y.m.d');
for($i=0; $i<count($delete_time); $i++) {
    $sql = " select count(*) as count from g5_lesson_reser where pro_info_idx = '{$delete_time[$i]}' and reser_date >= '{$now}'  ";
    $count = sql_fetch($sql)['count'];

    if($count > 0) {
        die('del_fail');
    }
    else {
        $sql = " delete from g5_lesson_pro_info where idx = '{$delete_time[$i]}' ";
        sql_query($sql);
    }
}

// 시간 추가 -- 중복된 시간이 있는지 확인 -- 있으면 등록 못하게 함
for($i=0; $i<count($add_time); $i++) {
    $sql = " select count(*) as count from g5_lesson_pro_info where reser_date = '{$_POST['reser_date']}' and reser_time = '{$add_time[$i]}' ";
    $count = sql_fetch($sql)['count'];

    if($count == 0) {
        $sql = " insert into g5_lesson_pro_info set mb_no = '{$member['mb_no']}', reser_date = '{$_POST['reser_date']}', reser_time = '{$add_time[$i]}', reg_date = now() ";
        sql_query($sql);
    }
}

die('success');
?>