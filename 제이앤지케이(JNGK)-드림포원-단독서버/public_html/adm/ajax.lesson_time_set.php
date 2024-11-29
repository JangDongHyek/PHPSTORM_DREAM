<?php
include_once("./_common.php");

/**
 * 프로 - 레슨예약 - 예약 신청 또는 예약 수정 시 예약 가능 시간 데이터 조회 (ajax) *
 * 22.06.09 수정 - 속도 개선
 */

// bbs/lesson_time_set.php -- 현재 파일 수정 시 왼쪽 파일 같이 확인

$reser_date = $_POST['reser_date'];
$reser_time = $_POST['reser_time'];
$pro_mb_no = $_POST['pro_mb_no'];
$mode = $_POST['mode']; // 예약신청 or 예약수정(u) or 팀장-프로관리-프로레슨현황 ==> 예약 가능한 시간(pro)

// === 프로가 설정한 예약 시간 ===
$sql_add = '';
$count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['count'];
if($count > 0) { // 특정 일자의 예약 가능 시간 별도 설정
    $time_set_idx = sql_fetch(" select group_concat(time_set_idx) as time_set_idx from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['time_set_idx'];
    $sql_add = 'not';
}
else {
    $time_set_idx = sql_fetch(" select group_concat(time_set_idx) as time_set_idx from g5_lesson_time_set_pro where mb_no = {$pro_mb_no} and use_yn = 'Y' ")['time_set_idx'];
}

// === 해당 날짜의 예약된 예약 시간 idx 배열 ===
$tmp = sql_fetch(" select group_concat(time_set_idx) as time_set_idx from g5_lesson_reser where reser_date = '{$reser_date}' and pro_mb_no = '{$pro_mb_no}' ")['time_set_idx'];
$tmp_time = explode(',', $tmp);

// === 예약 가능 시간 조회 ===
$sql = " select tset.idx, tset.set_time ";
$sql .= " from g5_lesson_time_set as tset ";
$sql .= " where tset.idx {$sql_add} in ({$time_set_idx}) ";
//$sql .= " and tset.idx not in ({$tmp}) ";
$sql .= " order by tset.set_time ";
// if($private) { echo $sql; }
$result = sql_query($sql);

if($mode == 'pro')
{
    // 예약 가능한 시간 -- 예약된 시간은 나오지 않음
    for($i=1; $row=sql_fetch_array($result); $i++) {
        if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간 체크
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
            if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간 체크
            ?>
            <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['set_time']?>" onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['set_time']?></div></label>
            <?php
            }
        }
    }
    // 예약수정 -- 예약되지 않은 시간 + 본인이 예약한 시간
    else {
        for($i=1; $row=sql_fetch_array($result); $i++) {
            if(!in_array($row['idx'], $tmp_time)) { // 예약되지 않은 시간 체크
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
