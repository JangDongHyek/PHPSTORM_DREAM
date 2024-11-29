<?php
include_once("./_common.php");

/** 팀장 - 프로관리 ==> 스케줄관리 예약 리스트 (ajax) **/

$year_month = $_POST['year_month'];
$pro_mb_no = $_POST['pro_mb_no'];
$today = date('Y.m.d');

// $sql = " select count(*) as count
//          from g5_lesson_reser as re
//          left join g5_member as mb on mb.mb_no = re.mb_no
//          where re.pro_mb_no = '{$pro_mb_no}' and re.reser_date like '{$year_month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
// $count = sql_fetch($sql)['count'];

$sql = " select re.reser_date, re.reser_time, date_format(re.reg_date, '%Y.%m.%d') as reg_date, mb.mb_name, mb.mb_id_no, le.lesson_name, le.lesson_count
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         left join g5_lesson as le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code
         where re.pro_mb_no = '{$pro_mb_no}' and re.reser_date like '{$year_month}%' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         order by re.reser_date desc, re.reser_time desc ";
$result = sql_query($sql);

$count = 0;
for($i=0; $row=sql_fetch_array($result); $i++) {
    $class = '';
    if($today > $row['reser_date']) {
        $class = 'li_past';
    } else if($today == $row['reser_date']) {
        $class = 'li_today';
    }
?>
<li class="<?=$class?>">
    <div class="lc_date"><?=$row['reser_date']?></div>
    <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
    <div class="lc_member"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님</div>
</li>
<?php
    $count++;
}
if($i==0) {
?>
<li>예약이 없습니다.</li>
<?php
}
?>
<div class="lc_count" style="display: none"><?=$count?></div>
