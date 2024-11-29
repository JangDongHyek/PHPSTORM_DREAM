<?php
include_once("./_common.php");

/**
 * 프로 - 레슨예약 레슨예약자 명단 (ajax) ==> 달력 날짜 선택 시 레슨예약자 명단 조회
 * 221026
 */

$reser_date = $_POST['reser_date'];

if(!empty($reser_date2)) $sql_search = " and (re.reser_date >= '{$reser_date}' and re.reser_date <= '{$reser_date2}') and mb.use_yn = 'Y' "; // 검색일 지정 시
else $sql_search = " and re.reser_date = '{$reser_date}' and mb.use_yn = 'Y' ";

$sql = " select re.*, date_format(re.reg_date, '%Y.%m.%d') as reg_date, mb.mb_name, mb.mb_id_no
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$member['mb_no']}' {$sql_search} 
         order by re.reser_date, re.reser_time ";
// if($private) echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 예약완료 상태의 일지 미작성 건수 표시
    // $no_diary = sql_fetch(" select count(*) as cnt from g5_lesson_reser where history_idx = '{$row['history_idx']}' and reser_state = '예약완료' and diary_idx is null ")['cnt'];
?>
<tr>
    <td>
        <input type="hidden" name="idx[<?php echo $i ?>]" value="<?php echo $row['idx'] ?>" id="idx_<?php echo $i ?>">
        <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
    </td>
    <td><?=$row['reser_date']?></td>
    <td><?=$row['reser_time']?></td>
    <td><?=$row['mb_id_no']?></td>
    <td style="cursor: pointer;" onclick="open_lesson_diary('<?=$row['mb_no']?>')"><?=$row['mb_name']?></td>
    <td><?=$row['reg_date']?></td>
    <td <?php echo !empty($no_diary) ? 'style="color: red;"' : ''; ?>><?=$no_diary?></td>
    <td>
        <?php if($row['reser_state'] == '예약대기') { ?><span class="btn_res btn_r01">예약대기</span><?php } ?>
        <?php if($row['reser_state'] == '예약취소') { ?><span class="btn_res btn_r02">예약취소</span><?php } ?>
        <?php if($row['reser_state'] == '노쇼') { ?><span class="btn_res btn_r03">노쇼</span><?php } ?>
        <?php if($row['reser_state'] == '예약완료') { ?><span class="btn_res btn_r04">예약완료</span><?php } ?>
    </td>
    <td>
        <select onchange="state_change('<?=$row['idx']?>',this.value, '<?=$row['reser_state']?>', '<?=$row['mb_no']?>', '<?=$i?>');">
            <option value="예약대기" <?php if($row['reser_state'] == '예약대기') { ?> selected <?php } ?>>승인대기</option>
            <option value="예약취소" <?php if($row['reser_state'] == '예약취소') { ?> selected <?php } ?>>승인취소</option>
            <option value="노쇼" <?php if($row['reser_state'] == '노쇼') { ?> selected <?php } ?>>회원노쇼</option>
            <option value="예약완료" <?php if($row['reser_state'] == '예약완료') { ?> selected <?php } ?>>승인완료</option>
        </select>
    </td>
    <td>
        <a href="javascript:void(0);" class="btn_remo" onclick="reser_mod('<?=$row['idx']?>', '<?=$row['mb_name']?>', '<?=$row['reser_date']?>', '<?=$row['time_set_idx']?>', '<?=$row['mb_id_no']?>', '<?=$row['reser_time']?>', '<?=$row['reser_state']?>');">수정</a>
        <a href="javascript:void(0);" class="btn_remo" onclick="reser_del('<?=$row['idx']?>')">삭제</a>
    </td>
</tr>
<?php
}
if($i==0) {
?>
<tr>
    <td colspan="10">레슨 예약자가 없습니다.</td>
</tr>
<?php
}
?>
