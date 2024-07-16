<?php
include_once('./_common.php');
/**
 * 회원탈퇴 신청
 */

$sql = " update g5_member set secession = 'Y', secession_date = '".G5_TIME_YMDHIS."' where mb_id = '{$member['mb_id']}' ";
$result = sql_query($sql);

die($result);