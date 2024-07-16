<?php
include_once('./_common.php');

// 프리미웜 회원 신청

$sql = " insert into g5_premium set 
         mb_id = '{$member['mb_id']}',
         company_name = '{$company_name}',
         mb_name = '{$mb_name}',
         mb_hp = '{$mb_hp}',
         mb_email = '{$mb_email}',
         partner = '{$partner}',
         state = 'Basic',
         wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

alert('프리미엄 회원 신청이 완료되었습니다.', G5_BBS_URL.'/mypage_company.php');