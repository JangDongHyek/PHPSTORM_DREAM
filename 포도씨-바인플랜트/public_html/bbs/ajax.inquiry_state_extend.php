<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 기업의뢰 - 견적 기한 연장 (ajax) **/

if($state == 'ok') { // 견적기한 연장
    $sql = " update g5_company_inquiry set ci_deadline_date = '{$date}', ci_state = '접수대기' where idx = '{$idx}' ";
}
else { // 의뢰 종료
    $sql = " update g5_company_inquiry set ci_state = '마감' where idx = '{$idx}' ";
}
$result = sql_query($sql);

if($result) {
    echo 1;
    exit;
}