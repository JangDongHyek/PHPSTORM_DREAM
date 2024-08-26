<?php
include_once('./_common.php');

$mode = $_REQUEST["mode"];

if ($mode == 'proc_change') {

    $sql = "select * from  new_request_pay where rp_idx = '{$_REQUEST["idx"]}' ";
    $rp = sql_fetch($sql);


    //완료 시 완료일자
    if ($_REQUEST["proc"] == 2) {
        $datetime = ',complete_datetime = "' . G5_TIME_YMDHIS . '" ';
    }

    if ($rp['rp_proc'] == 3) {

        //보류상태였다가 상태값 변경 시 금액 차감
        $sql = "update g5_member set mb_6 = mb_6 - {$rp['rp_amt']} where mb_id = '{$rp['mb_id']}' ";
        $result = sql_query($sql);

        $mb = get_member($rp['mb_id']);
        payment_history($rp['mb_id'], $delay_cancel_content['content'],$rp['rp_amt'],  $mb['mb_6'],'@pay_minus','',$delay_cancel_content['idx'],$_REQUEST["idx"],'new_request_pay');


    }

    $sql = "update new_request_pay set rp_memo = '',rp_proc = '{$_REQUEST["proc"]}', up_datetime = '" . G5_TIME_YMDHIS . "' {$datetime} where rp_idx = {$rp['rp_idx']} ";
    $result = sql_query($sql);

    echo $result;

} elseif ($mode == 'payment_form') {


    $sql = "update {$g5['member_table']} set mb_4 = '{$_REQUEST['mb_4']}' where mb_id = '{$_REQUEST['work_mb_id']}'";
    sql_query($sql);

    $sql = "update {$g5['gisa_pay_table']} set gp_type = '{$_REQUEST['gp_type']}' , up_datetime = '" . G5_TIME_YMDHIS . "' where gp_idx = '{$_REQUEST['idx']}'";
    sql_query($sql);

    goto_url(G5_ADMIN_URL . '/payment_form.php?' . $qstr . '&w=u&idx=' . $_REQUEST['idx']);


} elseif ($mode == 'delay_reason_update') {

    $write_mode = $_REQUEST['write_mode'];
    //보류 시 금액 입금
    if ($write_mode != 'u') {

        $sql = "update g5_member set mb_6 = mb_6 + {$_REQUEST["request_amt"]} where mb_id = '{$_REQUEST['mb_id']}' ";
        $result = sql_query($sql);

        $sql = "update new_request_pay set rp_memo = '{$_REQUEST["rp_memo"]}' ,rp_proc = '3', delay_datetime = '" . G5_TIME_YMDHIS . "' , up_datetime = '" . G5_TIME_YMDHIS . "'   where rp_idx = '{$_REQUEST["rp_idx"]}' ";
        $result = sql_query($sql);

        $mb = get_member($_REQUEST['mb_id']);
        payment_history($_REQUEST['mb_id'], $delay_content['content'], $_REQUEST["request_amt"],  $mb['mb_6'],'@pay_plus','',$delay_content['idx'],$_REQUEST["rp_idx"],'new_request_pay');

    } else {
        $sql = "update new_request_pay set rp_memo = '{$_REQUEST["rp_memo"]}' , up_datetime = '" . G5_TIME_YMDHIS . "' where rp_idx = '{$_REQUEST["rp_idx"]}' ";
        $result = sql_query($sql);

    }

    echo "<script>
         opener.document.location.href =  './payment_list.php?' + '" . $qstr . " ';
         self.close();
        </script>";

} elseif ($mode == 'ad_status_change') { // 광고신청현황 상태 변경
    $idx = $_POST['idx'];
    $status = $_POST['status'];

    $sql_add = '';
    $date = date('Y-m-d');
    if($status == '진행중') {
        // 진행중으로 변경 시 시작일시 입력
        $timestamp = strtotime($date . " + 7 days"); // 광고 종료 일시 계산 (1주일)
        $end_date = date('Y-m-d', $timestamp); // 진행종료일(예정)

        $sql_add = ", ad_start_date = '" . $date . "', ad_end_date = '{$end_date}' ";
    }
    else if($status == '진행대기') {
        $sql_add = ", ad_start_date = '', ad_end_date = '' ";
    }
    else if($status == '진행종료') {
        $sql_add = ", ad_end_date = '{$date}' ";
    }

    $sql = " update new_advertisement set ad_status = '{$status}' {$sql_add} where idx = {$idx} ";
    $result = sql_query($sql);

    die($result);
}elseif ($mode == 'mb_8_change'){

    $mb_8 = $_REQUEST['mb_8'];
    $mb_id = $_REQUEST['mb_id'];

    if ($mb_8 == 2){
        $sql_add = ",mb_leave_date = '".date('Ymd',strtotime(G5_TIME_YMD))."' ";
    }else{
        $sql_add = ",mb_leave_date = '' ";
    }
    $sql = " update {$g5['member_table']} set mb_8 = '{$mb_8}' {$sql_add} where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    echo $result;

}elseif ($mode == 'ad_del'){

    $sql = "delete from new_talent_ad where ad_ta_idx = '{$_REQUEST['idx']}' ";
    $result = sql_query($sql);

    echo $result;
}elseif ($mode == 're_pay'){

    //payment 환불처리 DB남기기
    $sql = "update new_payment set comp_chk = 'c',re_pay_datetime= '".G5_TIME_YMDHIS."' where pa_idx = '{$_REQUEST['pa_idx']}' ";
    $result = sql_query($sql);

    /*****판매자*****/
    // 재능 거래 금액의 3% 마일리지 적립 (판매자에게 적립)
    $mileage = $_REQUEST['Amt'] * 3 / 100;
    $cashe = $_REQUEST['Amt'] * 85 / 100;
    $seller['mb_id'] = $_REQUEST['seller_id'];
    //마일리지 및 캐쉬 차감
    $sql = " update g5_member set mb_7 = mb_7 - {$mileage},  mb_6 = mb_6 - {$cashe} where mb_id = '{$seller['mb_id']}'; ";
    sql_query($sql);
    $mb = get_member($seller['mb_id']);

    // 마일리지 적립 DB INSERT
    $sql = " insert into new_mileage set category = '사용(구매자 취소로 인한 차감)', mb_id = '{$seller['mb_id']}', mileage = {$mileage}, remain_mileage = {$mb['mb_7']}, wr_datetime = '" . G5_TIME_YMDHIS . "'; ";
    sql_query($sql);

    //히스토리
    payment_history($seller['mb_id'], $cancel_content['content'],$cashe,  $mb['mb_6'],'@pay_minus','',$cancel_content['idx'],$_REQUEST['pa_idx'],'new_payment');
    payment_history($seller['mb_id'], $cancel_mileage_content['content'],$mileage,  $mb['mb_7'],'@mileage_minus','Y',$cancel_mileage_content['idx'],'','new_mileage');
    /*****판매자*****/


    echo $result;
}elseif ($mode == "point_setting_update"){

    $_REQUEST["cf_register_point"] = str_replace ( ',' , '', $_REQUEST['cf_register_point']);
    $sql = "update g5_config set cf_register_point = '{$_REQUEST["cf_register_point"]}',cf_point_percent = '{$_REQUEST["cf_point_percent"]}' ";
    sql_query($sql);

    alert("완료되었습니다.",G5_ADMIN_URL."/point_history.php?".$qstr);

}