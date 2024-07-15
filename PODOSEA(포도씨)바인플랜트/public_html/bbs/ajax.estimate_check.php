<?php
include_once('./_common.php');

// 견적보내기 - 이미 보낸 견적이 있는지 확인
$estimate_flag = true;
if(selectCount('g5_company_estimate', 'company_inquiry_idx', $idx, 'mb_id', $member['mb_id']) > 0) {
    $estimate_flag = false;
}

echo $estimate_flag; exit;