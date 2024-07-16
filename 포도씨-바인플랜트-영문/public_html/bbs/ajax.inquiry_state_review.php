<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 거래 후기 보내기 (ajax) (사용 X) ==> ajax.inquiry_review.php 합침 **/

// 선택된 거래 상대 회사에 거래 후기 보내기
$sql = " insert into g5_company_inquiry_result set type = '거래후기', mb_id = '{$member['mb_id']}', inquiry_idx = '{$idx}', estimate_idx = '{$estimate_idx}', star_score = '{$star_score}', review = '{$checked}', review_etc = '{$etc}', wr_datetime = '".G5_TIME_YMDHIS."' ";
$result = sql_query($sql);

if($result) {
    echo 1;
    exit;
}