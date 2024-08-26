<?php
include_once('./_common.php');

$contents = $_POST['contents'];
$ta_idx = $_POST['ta_idx'];
$rating = $_POST['rating'];

// 작성자가 재능 구매자인지 확인
$payment_count = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and substring_index(substring_index(Moid, '-', -2), '-', 1) = {$ta_idx} ")['count'];
$review_count = sql_fetch(" select count(*) as count from new_payment_review where mb_id = '{$_SESSION['ss_mb_id']}' and ta_idx = {$ta_idx} ")['count'];

if($payment_count != 0 && $payment_count > $review_count) { // ex) 구매 3 > 리뷰 2 ==> 작성 가능, 구매 3 > 리뷰 3 => 작성 불가능
    $sql = " insert into new_payment_review set ta_idx = {$ta_idx}, mb_id = '{$_SESSION['ss_mb_id']}', review = '{$contents}', rating = '{$rating}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
    $result = sql_query($sql);

    if($result) {
        die('success');
    }
}
else {
    die('fail');
}
?>
