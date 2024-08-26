<?php
include_once('./_common.php');

$withdraw_fee = $_POST['withdraw_fee'];
$withdraw_fee = str_replace(',','',$withdraw_fee);
$now_fee = $_POST['now_fee'];
$now_fee = str_replace(',','',$now_fee);

if ($member['mb_3'] == ""){
    die('modal');
}
$mb = get_member($_SESSION['ss_mb_id']);

if ($mb["mb_6"] < $withdraw_fee ){
    die("출금요청 금액이 현재보유액 보다 많습니다.");
}


$sql = "select count(*) cnt from new_payment where seller_id = '{$member["mb_id"]}' and ResultCode = '3001' and comp_chk IS NULL and status <> '취소' ";
$payment_result = sql_fetch($sql)['cnt'];

if ($payment_result > 0){
    die('고객이 구매확정하지 않은 작업이 있으면 출금할 수 없습니다.');
}



$sql = " insert into new_request_pay 
         set mb_id = '{$_SESSION['ss_mb_id']}', rp_now_amt = {$now_fee}, rp_amt = {$withdraw_fee}, rp_proc = 1, wr_datetime = '" . G5_TIME_YMDHIS . "',
         mb_1 = '{$mb['mb_1']}', mb_2 = '{$mb['mb_2']}', mb_3 = '{$mb['mb_3']}' ";
$result = sql_query($sql);

$idx = sql_insert_id();
$sql = " update g5_member set mb_6 = mb_6 - {$withdraw_fee} where mb_id = '{$_SESSION['ss_mb_id']}' ";
$result = sql_query($sql);

//히스토리 내역에 추가 $competition_content => common.php에 저장
$minus_fee = $now_fee-$withdraw_fee;
payment_history($member['mb_id'], $payment_content['content'], $withdraw_fee, $minus_fee,'@pay_minus','',$payment_content['idx'],$idx,'new_request_pay');

//출금 요청 시 해당번호로 무자
$hp = '01083263153';
$send_phone = '0415803153';
$msg = "[".$config["cf_title"]."]".$member['mb_name']." 회원님이 ".number_format($withdraw_fee)."원을 출금요청 하였습니다.";
goSms($hp, $send_phone, $msg);

if($result) {
    die('success');
}
?>
