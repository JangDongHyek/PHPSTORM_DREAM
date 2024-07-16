<?php
include_once('./_common.php');

/** 자료시 찜 추가/삭제 (ajax) **/

if($mode == 'add') {
    $result = sql_query(" insert into g5_like_reference set mb_id = '{$member['mb_id']}', reference_idx = '{$idx}', wr_datetime = '".G5_TIME_YMDHIS."' ");
    if($result) echo 1;exit;
}
else if($mode == 'del') {
    $result = sql_query(" delete from g5_like_reference where mb_id = '{$member['mb_id']}' and reference_idx = '{$idx}' ");
    if($result) echo 1;exit;
}
else if($mode == 'count') {
    $count = sql_fetch(" select count(*) as count from g5_like_reference as a right outer join g5_reference_room as b on a.reference_idx = b.idx where a.mb_id = '{$member['mb_id']}' and b.del_yn = 'N' ")['count'];
    echo $count;exit;
}
