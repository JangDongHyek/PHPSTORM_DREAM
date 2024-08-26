<?php
include_once('./_common.php');

$category = $_POST['category'];
$fee = $_POST['fee'];

// 마일리지 부족 확인
if($fee > $member['mb_7']) {
    die('fail1');
}

// 중복 신청 불가
$count = sql_fetch(" select count(*) as count from new_advertisement where mb_id = '{$_SESSION['ss_mb_id']}' and ad_category = '{$category}'and ad_status in ('진행중', '진행대기'); ")['count'];
if($count > 0) {
    die('fail2');
}

// 광고 신청 DB INSERT
$sql = " insert into new_advertisement set mb_id = '{$_SESSION['ss_mb_id']}', ad_category = '{$category}', ad_fee = '{$fee}', ad_status = '진행대기', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
$result = sql_query($sql);
$idx = sql_insert_id();

// 마일리지 차감
$sql = " update g5_member set mb_7 = mb_7 - {$fee} where mb_id = '{$_SESSION['ss_mb_id']}' ";
sql_query($sql);
$mb = get_member($_SESSION['ss_mb_id']);

// 마일리지 DB INSERT
$sql = " insert into new_mileage set mb_id = '{$_SESSION['ss_mb_id']}', category = '사용', ad_idx = {$idx}, mileage = '{$fee}', remain_mileage = '{$mb['mb_7']}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
sql_query($sql);

// 히스토리 (아이디, 내용, 금액, 총합계, 구분값, 마일리지여부)
payment_history($_SESSION['ss_mb_id'],'광고 신청으로 인한 마일리지 차감', $fee, $mb['mb_7'],'@mileage_minus','Y');

if($result) {
    die('success');
}
?>
