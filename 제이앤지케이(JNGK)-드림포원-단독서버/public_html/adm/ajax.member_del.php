<?php
include_once('./_common.php');

$mb_no = $_POST['mb_no'];
$center_code = $member['center_code'];

$sql = " update g5_member set use_yn = 'N', use_yn_date = '".G5_TIME_YMDHIS."' where mb_no = {$mb_no} and center_code = '{$center_code}' ";
$result = sql_query($sql);

die($result);
?>