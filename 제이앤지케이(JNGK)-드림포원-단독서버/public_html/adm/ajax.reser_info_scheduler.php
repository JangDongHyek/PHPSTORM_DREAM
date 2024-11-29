<?php
include_once("./_common.php");

/**
 * 프로관리-전체스케줄-스케줄러 달력에 예약 표시
 **/

$year_month = $_POST['year_month'];

$sql = " select * from g5_member where mb_category = '프로' and mb_center = '{$member['mb_center']}' and center_code = '{$member['center_code']}' ";
$result = sql_query($sql);

$pro_mb_no = '';
for($i=0; $row=sql_fetch_array($result); $i++) {
    $pro_mb_no .= $row['mb_no'] . ',';
}
$pro_mb_no = substr($pro_mb_no, 0, -1);

$sql = " select re.reser_date from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no in ({$pro_mb_no}) and re.reser_date like '{$year_month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼' || re.reser_state = '예약대기')
         group by re.reser_date order by re.reser_date ";
$result = sql_query($sql);

$state = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $date = explode('.',$row['reser_date'])[2];

    array_push($state, ['date'=>$date]);
}

die(json_encode($state));
?>