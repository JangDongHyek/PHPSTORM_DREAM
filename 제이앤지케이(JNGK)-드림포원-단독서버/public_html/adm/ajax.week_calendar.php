<?php
include_once("./_common.php");

/** 달력에 레슨 있는 날짜 표시하기 위한 데이터 구함 (주 단위의 이번주 데이터 포함) **/

$pro_mb_no = $_POST['pro_mb_no'];
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

$op = $_POST['op'];
$set_date = sql_fetch(" SELECT ADDDATE( date_format(curdate(), '%Y-%m-%d'), - WEEKDAY(date_format(curdate(), '%Y-%m-%d')) + 0 ) as monday from dual ")['monday']; // 이번주의 월요일

$sql = "select
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) - 1 ) as sunday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 0 ) as monday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 1 ) as tuesday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 2 ) as wednesday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 3 ) as thursday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 4 ) as friday,
	    adddate( date_format('{$set_date}', '%Y-%m-%d'), - weekday(date_format('{$set_date}', '%Y-%m-%d')) + 5 ) as saturday
        from dual ";
$dayofweek = sql_fetch($sql);

$today_year_month = str_replace('.','-',$year_month);
if($today_year_month != substr($dayofweek['sunday'], 0, 7)) {
    $show1 = 'hide';
}
if($today_year_month != substr($dayofweek['monday'], 0, 7)) {
    $show2 = 'hide';
}
if($today_year_month != substr($dayofweek['tuesday'], 0, 7)) {
    $show3 = 'hide';
}
if($today_year_month != substr($dayofweek['wednesday'], 0, 7)) {
    $show4 = 'hide';
}
if($today_year_month != substr($dayofweek['thursday'], 0, 7)) {
    $show5 = 'hide';
}
if($today_year_month != substr($dayofweek['friday'], 0, 7)) {
    $show6 = 'hide';
}
if($today_year_month != substr($dayofweek['saturday'], 0, 7)) {
    $show7 = 'hide';
}

$sun = explode('-',$dayofweek['sunday'])[2];
$mon = explode('-',$dayofweek['monday'])[2];
$tue = explode('-',$dayofweek['tuesday'])[2];
$wed = explode('-',$dayofweek['wednesday'])[2];
$thu = explode('-',$dayofweek['thursday'])[2];
$fri = explode('-',$dayofweek['friday'])[2];
$sat = explode('-',$dayofweek['saturday'])[2];

$add_class = ' week-today ';

for($k=0; $k<count($state); $k++) {
    if($state[$k]['date'] == $sun) {
        $add_div1 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $mon) {
        $add_div2 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $tue) {
        $add_div3 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $wed) {
        $add_div4 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $thu) {
        $add_div5 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $fri) {
        $add_div6 = '<div class="les_yes"></div>';
    }
    if($state[$k]['date'] == $sat) {
        $add_div7 = '<div class="les_yes"></div>';
    }
}

// 0 붙으면 한자리수로 만듬
$sun2 = substr($sun,0,1) == '0' ? substr($sun,1,1) : $sun;
$mon2 = substr($mon,0,1) == '0' ? substr($mon,1,1) : $mon;
$tue2 = substr($tue,0,1) == '0' ? substr($tue,1,1) : $tue;
$wed2 = substr($wed,0,1) == '0' ? substr($wed,1,1) : $wed;
$thu2 = substr($thu,0,1) == '0' ? substr($thu,1,1) : $thu;
$fri2 = substr($fri,0,1) == '0' ? substr($fri,1,1) : $fri;
$sat2 = substr($sat,0,1) == '0' ? substr($sat,1,1) : $sat;
?>

<tr>
    <td><div class="week-day <?=$sun?> <?=$show1?> <?php if($sun == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$sun?>');"><?=$sun2?></div><?=$add_div1?></td>
    <td><div class="week-day <?=$mon?> <?=$show2?> <?php if($mon == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$mon?>');"><?=$mon2?></div><?=$add_div2?></td>
    <td><div class="week-day <?=$tue?> <?=$show3?> <?php if($tue == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$tue?>');"><?=$tue2?></div><?=$add_div3?></td>
    <td><div class="week-day <?=$wed?> <?=$show4?> <?php if($wed == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$wed?>');"><?=$wed2?></div><?=$add_div4?></td>
    <td><div class="week-day <?=$thu?> <?=$show5?> <?php if($thu == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$thu?>');"><?=$thu2?></div><?=$add_div5?></td>
    <td><div class="week-day <?=$fri?> <?=$show6?> <?php if($fri == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$fri?>');"><?=$fri2?></div><?=$add_div6?></td>
    <td><div class="week-day <?=$sat?> <?=$show7?> <?php if($sat == date('d')) { echo $add_class; } ?>" onclick="lessonInfo('<?=$sat?>');"><?=$sat2?></div><?=$add_div7?></td>
</tr>