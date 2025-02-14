<?php
include_once('./_common.php');

$mb_no = $_REQUEST['mb_no']; // 선택한 회원 번호

// 비노출 대상 정보
$noshow_idx = sql_fetch(" select * from g5_noshow where mb_no = '{$member['mb_no']}' and noshow_mb_no = '{$mb_no}' ")['idx'];

$result = sql_query(" delete from g5_noshow where idx = {$noshow_idx} ");
if($result) {
    die('success');
}
?>