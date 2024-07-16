<?php
include_once("./_common.php");

/** 마이페이지 - 판매자신청 **/

$account_holder = trim($account_holder);
$registration_number = Encrypt($reg_number1.'-'.$reg_number2);

// 신청내역이 있는지 확인
$cnt = sql_fetch(" select count(*) as cnt from g5_reference_room_seller where mb_id = '{$member['mb_id']}' ")['cnt'];
if($cnt > 0) alert('이미 신청한 내역이 있습니다.', G5_URL, false);

// 판매자신청 DB
$sql = " insert into g5_reference_room_seller set mb_id = '{$member['mb_id']}', mb_name = '{$mb_name}', mb_hp = '{$mb_hp}', bank = '{$bank}', account_holder = '{$account_holder}', account_number = '{$account_number}', registration_number = '{$registration_number}', state = '승인대기', wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

alert('신청이 완료되었습니다.', G5_URL, false);
