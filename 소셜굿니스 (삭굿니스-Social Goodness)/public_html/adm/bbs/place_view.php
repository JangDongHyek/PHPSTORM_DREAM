<?php
$sub_id = "place_view";
include_once('./_common.php');

$mb_no = $_GET['mb_no'];
$te_no = $_GET['te_no'];

$sql = " select * from g5_tes where te_category = '장소' and te_no = {$te_no} ";
$row = sql_fetch($sql);

$end_date = strtotime($row['te_review_end_date']);
$today = strtotime(date('Y-m-d H:i'));

$diff = $end_date-$today;

$day = floor(($diff)/(60*60*24));
$hour = floor(($diff-($day*60*60*24))/(60*60));
$minute  = floor(($diff-($day*60*60*24)-($hour*60*60))/(60));

if($diff < 0) {
    $review_end_date = '평가 불가능';
} else {
    $review_end_date = $day . '일 ' . $hour . '시간 ' . $minute . '분';
}

$file_sql = " select * from g5_file where tb_no = {$te_no}";
$file_result = sql_query($file_sql);

// 평가 이력이 있을 경우
$eval_sql = " select count(*) as count from g5_place_eval where mb_no = {$mb_no} and te_no = {$te_no} ";
$eval_row = sql_fetch($eval_sql);
$eval_count = $eval_row['count'];

$eval_finger = '';
if($eval_count > 0) {
    // 평가 점수
    $eval_sql = " select * from g5_place_eval where mb_no = {$mb_no} and te_no = {$te_no} ";
    $eval_row = sql_fetch($eval_sql);
    $eval_finger = $eval_row['finger_option'];
}

$g5['title'] = $row['te_name']; // 관광지명
include_once('./_head.php');

include_once($member_skin_path.'/place_view.skin.php');

include_once('./_tail.sub.php');
?>
