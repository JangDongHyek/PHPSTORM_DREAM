<?php
include_once("./_common.php");

/** 프로 - 레슨예약 - 예약 신청 또는 예약 수정 시 예약 가능 시간 데이터 조회 (ajax) 22.06.09 백업본 **/

// bbs/lesson_time_set.php -- 현재 파일 수정 시 왼쪽 파일 같이 확인

$reser_date = $_POST['reser_date'];
$reser_time = $_POST['reser_time'];
$pro_mb_no = $_POST['pro_mb_no'];
$mode = $_POST['mode']; // 예약신청 or 예약수정(u) or 프로-스케줄관리 ==> 예약 가능한 시간(pro)

// === 프로 예약 시간 설정 ===
$sql_add = '';
$count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['count'];
if($count > 0) { // 특정 일자의 예약 가능 시간 별도 설정
    $sql = " select time_set_idx from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ";
    $sql_add = 'not';
}
else {
    $sql = " select time_set_idx from g5_lesson_time_set_pro where mb_no = {$pro_mb_no} and use_yn = 'Y' ";
}
$result = sql_query($sql);

$time_set_idx = '';
for($i=0; $row=sql_fetch_array($result); $i++) {
    $time_set_idx .= $row['time_set_idx'] . ',';
}
$time_set_idx = substr($time_set_idx, 0, -1);

// === 예약 가능 시간 조회 ===
$sql = " select tset.idx, tset.set_time ";
//$sql .= " , concat('{$reser_date}', ' ', tset.set_time) as select_date "; // 선택한 일자와 예약 가능 시간 연결
$sql .= " from g5_lesson_time_set as tset ";
//$sql .= " left outer join g5_lesson_reser as reser on tset.idx = reser.time_set_idx and reser.reser_date = '{$reser_date}' and reser.pro_mb_no = {$pro_mb_no} ";
//$sql .= " having tset.idx {$sql_add} in({$time_set_idx}) ";
$sql .= " where tset.idx {$sql_add} in({$time_set_idx}) "; // 현재 시간으로부터 지난 시간은 나오지 않음
$sql .= " order by tset.set_time ";
//echo $sql;
$result = sql_query($sql);

$tmp_time = array(); // 선택 날짜의 예약된 예약 시간 idx 배열
$rlt = sql_query(" select * from g5_lesson_reser where reser_date = '{$reser_date}' and pro_mb_no = '{$pro_mb_no}' ");
while($rs = sql_fetch_array($rlt)) {
    array_push($tmp_time, $rs['time_set_idx']);
}

if($mode == 'pro')
{
    // 예약 가능한 시간 -- 예약된 시간은 나오지 않음
    for($i=1; $row=sql_fetch_array($result); $i++) {
        if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간
        ?>
        <span class="lc_time" style="font-size: 1.3em;color: #000;"><label for="reser_time<?=$i?>"><i class="far fa-clock"></i><?=$row['set_time']?></label></span>
        <?php
        }
    }
}
else
{
    // 예약등록 -- 예약된 시간은 나오지 않음
    if(empty($mode)) {
        for($i=1; $row=sql_fetch_array($result); $i++) {
            if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간
            ?>
            <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['set_time']?>" onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['set_time']?></div></label>
            <?php
            }
        }
    }
    // 예약수정 -- 예약되지 않은 시간 + 본인이 예약한 시간
    else {
        for($i=1; $row=sql_fetch_array($result); $i++) {
            if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간
            ?>
            <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['set_time']?>" onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['set_time']?></div></label>
            <?php
            }
            if($row['set_time'] == $reser_time && !empty($reser_time)) { //  본인이 예약한 시간
            ?>
            <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['set_time']?>" checked onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['set_time']?></div></label>
            <?php
            }
        }
    }
}
?>
