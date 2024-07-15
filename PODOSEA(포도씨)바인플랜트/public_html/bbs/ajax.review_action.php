<?php
include_once ("./_common.php");
/**
 * 마이페이지 - 자료실 - 리뷰작성 동작
 */

$sql_common = ", score = '{$star_score}', review = '{$review}' ";
if($mode == 'r') { // 등록
    $sql = " insert into g5_reference_room_review set reference_idx = '{$reference_idx}', mb_id = '{$member['mb_id']}', wr_datetime = '".G5_TIME_YMDHIS."' {$sql_common} ";
}
else if($mode == 'u') { // 수정
    $sql = " update g5_reference_room_review set up_datetime = '".G5_TIME_YMDHIS."' {$sql_common} where reference_idx = '{$reference_idx}' and mb_id = '{$member['mb_id']}' ";
}
$result = sql_query($sql);
if($result) die('success');
