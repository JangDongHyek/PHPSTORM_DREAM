<?php
include_once("./_common.php");

/**
 * 프로 - 레슨 스케줄 ==> 날짜 선택 시 레슨 리스트 보여줌
 * 22.06.14 속도 저하로 인한 쿼리 수정 (백업본 - ajax.pro_lesson_220614bak.php)
 */

$reser_date = $_POST['reser_date'];
$pro_mb_no = $_POST['pro_mb_no'];

//if($private) { $pro_mb_no = 68; }

$sql = " select count(*) as count from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = {$pro_mb_no} and re.reser_date = '{$reser_date}' and (re.reser_state = '예약완료' || re.reser_state = '노쇼') ";
$count = sql_fetch($sql)['count'];

$sql = " select re.*, mb.mb_name, mb.mb_id_no
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = {$pro_mb_no} and re.reser_date = '{$reser_date}' and (re.reser_state = '예약완료' || re.reser_state = '노쇼')
         order by re.reser_date, re.reser_time ";
//if($private) { echo $sql; }
$result = sql_query($sql);

$noshow_count = 0;
for($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['reser_state'] == '노쇼') {
        ++$noshow_count;
    }
?>
<li>
    <div class="lc_date"><?=$row['reser_date']?></div>
    <div class="lc_time"><i class="far fa-clock"></i> <?=$row['reser_time']?></div>
    <div class="lc_member" style="cursor: pointer;" onclick="open_lesson_diary('<?=$row['mb_no']?>')" ><span style="<?php if($row['one_point'] == 'Y') { echo 'color: #f3d421'; } ?>"><?=$row['mb_id_no']?> <?=$row['mb_name']?> 고객님</span>
        <?php if(!empty($row['diary_idx']) && $row['reser_state'] != '노쇼') { echo '<span class="le_comp">레슨완료</span>'; } ?>
        <?php if($row['reser_state'] == '노쇼') { echo '<span class="noshow">노쇼</span>'; } ?>
    </div>
</li>
<?php
}
if($i == 0) {
?>
<!--예약자 없을때-->
<div class="psch_no"><i class="fal fa-comments"></i> 선택한 날짜에 레슨이 없습니다.</div>
<?php
}
?>
<div class="lc_count" style="display: none"><?=$count?></div>
<div class="lc_noshow_count" style="display: none"><?=$noshow_count?></div>
