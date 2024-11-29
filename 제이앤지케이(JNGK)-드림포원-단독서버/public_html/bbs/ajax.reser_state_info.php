<?php
include_once("./_common.php");

/** 회원 - 레슨예약 - 달력에 예약 현황 표시 (ajax) **/

$pro_mb_no = $_POST['pro_mb_no'];
$last_day = $_POST['last_day'];
$year_month = $_POST['year_month'];

$sql = " select * from g5_lesson_reser where mb_no = {$member['mb_no']} and history_idx = '{$member['history_idx']}' and reser_date like '{$year_month}%' order by reser_date, reser_time ";
$result = sql_query($sql);

$state = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $date = explode('.',$row['reser_date'])[2];

    /*for($i=1;$i<=$last_day;$i++) {
        if($i < 10) {
            $i = '0'.$i;
        }
        $temp = $year_month.'.'.$i;
    }*/

    array_push($state, ['date'=>$date, 'state'=>$row['reser_state']]);
}

die(json_encode($state));
?>