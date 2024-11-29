<?php
include_once("./_common.php");

//$sql = "SELECT
//    mb.mb_no,
//    one_point_le_date,
//    mb.lesson_start_date,
//    mb.lesson_end_date,
//    no_register_date,
//    mb.history_idx,
//    his.idx
//FROM
//    jngk.g5_member as mb
//    left join g5_lesson_diary as ld on mb.history_idx = ld.history_idx
//    left join g5_member_history as his on mb.history_idx = his.idx
//WHERE
//    mb.mb_state = 'one_point_lesson' and mb.lesson_start_date = '0000-00-00'";
//$result = sql_query($sql);
//
//for($i=0; $row=sql_fetch_array($result); $i++) {
//    $sql = "update g5_member set lesson_start_date = '{$row['lesson_end_date']}'
//            where mb_state = 'one_point_lesson' AND lesson_start_date = '0000-00-00' and mb_no = {$row['mb_no']}";
//    sql_query($sql);
//
//    $sql = "update g5_member_history set lesson_start_date = '{$row['lesson_end_date']}', lesson_end_date = '{$row['lesson_end_date']}' where idx = {$row['history_idx']}";
//    $result3 = sql_query($sql);
//}
//
//echo $result3;
?>