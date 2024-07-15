<?php
include_once('./_common.php');
/**
 * 기업 마이페이지 - 나의 문의 - 처리중/처리완료 모달 처리
 */

$sql = " update g5_company_question set state = '{$state}' where idx = '{$idx}' ";
$result = sql_query($sql);

if($result) {
    die('success');
}