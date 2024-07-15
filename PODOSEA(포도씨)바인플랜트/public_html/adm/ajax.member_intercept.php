<?php
include_once ('./_common.php');
/**
 * 관리자 - 회원관리 - 이용정지/이용정지해제
 */

$mb = get_member($mb_id);

// 이용정지일이 없으면 이용정지 처리
if(empty($mb['mb_intercept_date'])) {
    $intercept_date = date("Ymd", G5_SERVER_TIME);
    $sql = " update g5_member set mb_intercept_date = '{$intercept_date}' where mb_id = '{$mb['mb_id']}' ";
}
else { // 이용정지일이 있으면 이용정지해제 처리
    $sql = " update g5_member set mb_intercept_date = '' where mb_id = '{$mb['mb_id']}' ";
}
$result = sql_query($sql);

if($result) {
    echo 'success';
    exit;
}