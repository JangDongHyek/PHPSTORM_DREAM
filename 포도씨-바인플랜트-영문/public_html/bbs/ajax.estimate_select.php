<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 거래 회사 선택 (ajax) **/

$sql = " update g5_company_estimate set ce_selection = 'Y' where idx = '{$estimate_idx}' ";
$result = sql_query($sql);

if($result) {
    echo 1;
    exit;
}