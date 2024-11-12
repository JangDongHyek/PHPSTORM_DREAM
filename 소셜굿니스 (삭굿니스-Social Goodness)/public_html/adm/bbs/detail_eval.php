<?php
$sub_id = "detail_eval";
include_once('./_common.php');

$g5['title'] = '상세 평가 하기';
include_once('./_head.php');

$mb_no = $_GET['mb_no'];
$te_no = $_GET['te_no'];

// 리뷰 이력이 있을 경우
$eval_sql = " select count(*) as count from g5_place_eval where mb_no = {$mb_no} and te_no = {$te_no} and categoty = '리뷰' ";
$eval_row = sql_fetch($eval_sql);
$eval_count = $eval_row['count'];

include_once($member_skin_path.'/detail_eval.skin.php');

include_once('./_tail.sub.php');
?>
