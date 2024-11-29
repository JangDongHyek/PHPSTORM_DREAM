<?php
include_once("./_common.php");

/**
 * 사용안함
 */
// adm/ajax.lesson_info.php -- 현재 파일 수정 시 왼쪽 파일 같이 수정

$reser_date = $_POST['reser_date'];
$reser_time = $_POST['reser_time'];
$pro_mb_no = $_POST['pro_mb_no'];
$mode = $_POST['mode']; // 예약신청 or 예약수정(u)
$option = $_POST['option']; // 예약가능시간조회 or 예약가능시간설정(setting)

$sql = " select info.*, reser.idx as reser_idx, reser.mb_no as reser_mb_no 
         from g5_lesson_pro_info as info
         left join g5_lesson_reser as reser on info.idx = reser.pro_info_idx and reser.reser_state != '예약취소'
         where info.mb_no = {$pro_mb_no} and info.reser_date = '{$reser_date}' order by reser_time ";
$result = sql_query($sql);

if(empty($option))
{
    // 날짜 선택 -- 예약된 시간은 나오지 않음
    if(empty($mode)) {
        for($i=1; $row=sql_fetch_array($result); $i++) {
            if(empty($row['reser_idx'])) {
                ?>
                <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['reser_time']?>" onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['reser_time']?></div></label>
                <?php
            }
        }
    }
    // 예약 수정 -- 예약되지 않은 시간 + 본인이 예약한 시간
    else {
        for($i=1; $row=sql_fetch_array($result); $i++) {
            if(empty($row['reser_idx']) || $row['reser_time'] == $reser_time) { // 예약되지 않은 시간 || 본인이 예약한 시간
                $checked = '';
                if(!empty($row['reser_idx'])) { $checked = 'checked'; }
                ?>
                <input type=checkbox name="ck_reser_time" id="reser_time<?=$i?>" value="<?=$row['reser_time']?>" <?=$checked?> onclick="reser_select(this.value, '<?=$row['idx']?>');"><label for="reser_time<?=$i?>"><div><?=$row['reser_time']?></div></label>
                <?php
            }
        }
    }
}
else
{
    for($i=1; $row=sql_fetch_array($result); $i++) {
    ?>
    <li id="time_<?=$i?>" class="u"><?=$row['reser_time']?> <a class="btn_tset" onclick="del_time('<?=$i?>', '<?=$row['idx']?>')">삭제</a></li>
    <?php
    }
}
?>
