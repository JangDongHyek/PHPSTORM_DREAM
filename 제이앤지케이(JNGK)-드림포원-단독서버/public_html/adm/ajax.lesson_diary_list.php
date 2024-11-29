<?php
include_once('./_common.php');

/** 프로 - 레슨스케줄 - 회원명 선택 > 레슨일지작성 - 레슨일지 리스트 (ajax) **/

// 회원, 레슨정보
$sql = " select mb.*, le.* from g5_member as mb left join g5_lesson as le on le.lesson_code = mb.lesson_code and le.center_code = mb.center_code where mb.mb_no = '{$mb_no}' ";
$mb = sql_fetch($sql);

// 레슨일지 수
$count = sql_fetch( " select count(*) as count from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = {$mb['history_idx']} ")['count'];

// 레슨일지 정보
$rlt = sql_query(" select * from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}' order by idx desc ");
$k = $count;
while($row = sql_fetch_array($rlt)) {
    $video_sql = " select * from g5_lesson_video where diary_idx = '{$row['idx']}' ";
    $video = sql_fetch($video_sql);
    $video_src = '';
    if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) {
        $video_src = G5_DATA_URL . '/file/lesson/' . $video['img_file'];
    }
?>
<tr>
    <td><?=$k?></td>
    <td><?=$mb['mb_name']?></td>
    <td><?=$mb['lesson_name']?> / <?=$mb['lesson_time']?> / <?=$mb['lesson_count']?> / <?=number_format($mb['lesson_price'])?></td>
    <td><?=$row['lesson_date']?></td>
    <td><?=$row['lesson_count']?>회</td>
    <td><?php if($video['img_file'] && file_exists(G5_DATA_PATH . '/file/lesson/' . $video['img_file'])) { ?>○<?php } else { ?>X<?php } ?></td>
    <td><?=$row['lesson_memo']?></td>
    <td>
        <a href="javascript:void(0);" class="btn_remo" onclick="lesson_diary_info(this,'<?=$row['idx']?>', '<?=$video_src?>', '<?=$row['reser_idx']?>')">수정</a>
    </td>
</tr>
<?php
    $k--;
}
if($count == 0) {
    echo "<tr><td colspan='8' class=\"empty_table\">자료가 없습니다.</td></tr>";
}
?>
