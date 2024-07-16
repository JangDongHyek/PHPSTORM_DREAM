<?php
include_once("./_common.php");

/** 마이페이지 - 판매대금관리 - 출금신청하기 **/

$account_holder = trim($account_holder); // 계좌번호
$registration_number = Encrypt($reg_number1.'-'.$reg_number2); // 주민번호

$sales_proceeds = str_replace(',', '', $price); // 츌금 판매대금
$remain_sales_proceeds = $member['sales_proceeds'] - $sales_proceeds; // 잔여 판매대금

// 회원 정보에서 판매대금 우선 차감 (계속 신청할 수 있으므로)
$sql = " update g5_member set sales_proceeds = '{$remain_sales_proceeds}' where mb_id = '{$member['mb_id']}' ";
sql_query($sql);

$sql = " insert into g5_reference_room_withdraw set
         mb_id = '{$member['mb_id']}', bank = '{$input_bank}', account_holder = '{$account_holder}', account_number = '{$account_number}', registration_number = '{$registration_number}',
         sales_proceeds = '{$sales_proceeds}', remain_sales_proceeds = '{$remain_sales_proceeds}', state = '대기', wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

alert('신청이 완료되었습니다.', G5_BBS_URL.'/mypage_pay.php', false);
