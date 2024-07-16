<?php
include_once('./_common.php');
/**
 * 관리자 - 기업의뢰 - 기업의뢰전달
 */

$mb = get_member($mb_id); // 의뢰를 전달할 회사 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = '{$idx}' ");

// 중복체크
$tmp = explode(',', $ci['target_mb_no']);
if(in_array($mb['mb_no'], $tmp)) {
    die('fail');
}

$target_mb_no = $ci['target_mb_no'];
if(!empty($target_mb_no)) {
    $target_mb_no = $target_mb_no.','.$mb['mb_no'];
} else {
    $target_mb_no = $mb['mb_no'];
}

// target_mb_no에 전달할 업체의 mb_no를 넣어서 마이페이지-나의의뢰-받은의뢰에서 조회할 수 있도록 함
$sql = " update g5_company_inquiry set target_mb_no = '{$target_mb_no}', pass_yn = 'Y', pass_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ";
$result = sql_query($sql);

if($result) {
    die('success');
}