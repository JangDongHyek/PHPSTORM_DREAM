<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 거래 회사 선택 (ajax) **/

$sql = " update g5_company_estimate set ce_selection = 'Y' where idx = '{$estimate_idx}' ";
$result = sql_query($sql);

// 견적 선택 시 선택한 견적 회사에 푸시
$estimate = sql_fetch("select * from g5_company_estimate where idx = '{$estimate_idx}' "); // 견적정보
$inquiry = sql_fetch("select * from g5_company_inquiry where idx = '{$estimate['company_inquiry_idx']}'"); // 의뢰정보
$push_status = "estimate_select";
$push_data = array('subject'=>$inquiry['ci_subject'], 'url'=>G5_BBS_URL."/mypage_company02.php", 'ref_idx'=>$estimate_idx, 'ref_table'=>'g5_company_estimate', 'mb_id'=>$estimate['mb_id']);
@include_once(G5_BBS_PATH.'/send_push.php');

if($result) {
    echo 1;
    exit;
}