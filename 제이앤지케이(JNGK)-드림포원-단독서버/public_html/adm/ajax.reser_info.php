<?php
include_once("./_common.php");

/** 달력에 레슨 있는 날짜 표시하기 위한 데이터 구함 (주 단위의 다음주 데이터 포함) **/

$pro_mb_no = $_POST['pro_mb_no'];
//$last_day = $_POST['last_day'];
$year_month = $_POST['year_month'];

$sql = " select re.reser_date from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = {$pro_mb_no} and re.reser_date like '{$year_month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         group by re.reser_date order by re.reser_date ";
$result = sql_query($sql);

$state = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $date = explode('.',$row['reser_date'])[2];

    array_push($state, ['date'=>$date]);
}

die(json_encode($state));
?>