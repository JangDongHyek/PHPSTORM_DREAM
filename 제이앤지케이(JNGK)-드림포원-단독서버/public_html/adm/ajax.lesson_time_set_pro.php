<?php
include_once("./_common.php");

/**
 * 프로 - 레슨예약 - 시간 설정 모달 데이터 (ajax) *
 * 22.06.09 쿼리 수정 - 속도 개선
 */

$pro_mb_no = $_POST['pro_mb_no'];
$reser_date = $_POST['reser_date'];

// 프로가 특정 일자의 예약 가능한 시간을 설정한 기록이 있으면
$count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['count'];
if($count > 0) {
    $set_date = str_replace('.','-', $reser_date);

    // 예약 불가한 시간 idx
    $no_idx = sql_fetch(" select group_concat(time_set_idx) as no_idx from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['no_idx'];
} else {
    // 예약 불가한 시간 idx
    $no_idx = sql_fetch(" select group_concat(time_set_idx) as no_idx from g5_lesson_time_set_pro where mb_no = {$pro_mb_no} and use_yn = 'N' ")['no_idx'];
}
$no_idx = explode(',', $no_idx);

$sql = " select * from g5_lesson_time_set ";
$result = sql_query($sql);

$chkall = 'Y';
for($i=1; $row=sql_fetch_array($result); $i++) {
    $checked = '';
    if(!in_array($row['idx'], $no_idx)) {
        $checked = 'checked';
    } else {
        $chkall = 'N';
    }
?>
<input type=checkbox name="ck_set_time" id="set_time<?=$i?>" value="<?=$row['idx']?>" <?=$checked?>><label for="set_time<?=$i?>"><div style="font-size: 20px; margin-top:-4px;"><?=$row['set_time']?></div></label>
<?php
}
?>
<input type="hidden" id="hide_set_date" name="hide_set_date" value="<?=$set_date?>"> <!--지정휴무일-->
<input type="hidden" id="hide_chkall" name="hide_chkall" value="<?=$chkall?>"> <!--전체체크or전체해제-->
