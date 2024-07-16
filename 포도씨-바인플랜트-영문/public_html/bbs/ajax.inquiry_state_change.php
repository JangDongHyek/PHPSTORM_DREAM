<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 의뢰 상태 변경 (ajax) **/

$sql = " update g5_company_inquiry set ci_state = '{$state}' where idx = '{$idx}' ";
$result = sql_query($sql);

if($state != '거래완료') {
    sql_query("update g5_company_estimate set ce_state = '{$state}' where company_inquiry_idx = '{$idx}' ");
}

if($result) {
    echo 1;
    exit;
}
