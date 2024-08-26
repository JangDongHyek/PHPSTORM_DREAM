<?php
include_once('./_common.php');

$pa_idx = $_POST['pa_idx'];
$status = $_POST['status'];

$sql_add = '';
if($status == '진행중') {
    $sql_add = " , start_date = '" . G5_TIME_YMDHIS . "' ";
} else if($status == '완료') {
    $sql_add = " , end_date = '" . G5_TIME_YMDHIS . "' ";
} else if($status == '취소') {
    $sql_add = " , cancel_date = '" . G5_TIME_YMDHIS . "' ";
}

$sql = " update new_payment set status = '{$status}', status_date = '" . G5_TIME_YMDHIS . "' {$sql_add} where pa_idx = {$pa_idx} ";
$result = sql_query($sql);

$d_day = '';


$sql = " select pa.*, pta.pta_select1 from new_payment as pa left join new_pay_talent as pta on pta.pta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', -1) where pa.pa_idx = {$pa_idx} ";
$row = sql_fetch($sql);
$buyer_mb = get_member($row['userId']);
$ta_idx = explode('-',$row['Moid'])[1];

if($status == '진행중') {


    $status_date = substr($row['status_date'],0,10); // 진행시작일

    $timestamp = strtotime($status_date . " +" . $row['pta_select1']*$row['GoodsCnt'] . " days"); // 진행시작일 + 작업일
    $end_date = date('Y-m-d', $timestamp); // 진행종료일(예정)

    $d_day = ( strtotime($end_date) - strtotime(date('Y-m-d')) ) / 86400; // 남은 일자 계산

    //진행중으로 변경할 경우 알림톡 발송
    $seller_mb = get_member($row['seller_id']);
    $arr = array("mb_nick" => $buyer_mb['mb_nick'], "ta_idx" => $ta_idx, "seller_nick" => $seller_mb['mb_nick'], "seller_id" => $seller_mb['mb_id']);
    alimtalk($buyer_mb['mb_hp'], $arr, 'buy_change');

}elseif ($status == '완료'){
    //완료로 변경할 경우 알림톡 발송
    alimtalk($buyer_mb['mb_hp'], array('idx' => $ta_idx,"mb_nick"=>$buyer_mb['mb_nick'] ), 'talent_comp');

}

if($result) {
    die('success_'.$d_day);
}
?>
<!--<input type="hidden" id="hide_d_day" name="hide_d_day" value="--><?//=$d_day?><!--">-->
