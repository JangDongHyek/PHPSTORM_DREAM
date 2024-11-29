<?php
include_once("./_common.php");

// bbs/ajax.lesson_pro_info.php -- 현재 파일 수정 시 왼쪽 파일 같이 수정

$idx = $_POST['idx'];

$sql = " select mb.mb_name, mb.mb_no, re.reser_date, re.reser_time from g5_lesson_reser as re
         left join g5_member mb on re.mb_no = mb.mb_no
         where re.idx = {$idx} order by reser_time ";
$reser = sql_fetch($sql);
$reser_time = $reser['reser_time'];

$sql = " select info.*, reser.idx as reser_idx, reser.mb_no as reser_mb_no
         from g5_lesson_pro_info as info
         left join g5_lesson_reser as reser on info.idx = reser.pro_info_idx and reser.reser_state != '예약취소'
         where info.mb_no = {$member['mb_no']} and info.reser_date = '{$reser['reser_date']}' order by reser_time ";
$result = sql_query($sql);

// 예약되지 않은 시간 + 본인이 예약한 시간
for($i=1; $row=sql_fetch_array($result); $i++) {
    if(empty($row['reser_idx']) || $row['reser_time'] == $reser_time) { // 예약되지 않은 시간 || 본인이 예약한 시간
        $checked = '';
        if(!empty($row['reser_idx'])) { $checked = 'checked'; }
        ?>
        <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['reser_time']?>" <?=$checked?> onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['reser_time']?></div></label>
        <?php
    }
}
?>