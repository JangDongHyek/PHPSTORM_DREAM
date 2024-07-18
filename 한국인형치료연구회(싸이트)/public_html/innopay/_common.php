<?php
include_once('../common.php');

$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP,0, 13);

/**********************************************************************************/
//이부분에 로그파일 경로를 수정해주세요.
$LogPath = "/home/kdoll2/public_html/innopay/log/";
if (!is_dir($LogPath)) {
    mkdir($LogPath, 0755, true);
    chmod($LogPath, 0755);
}
/**********************************************************************************/

// 모든정보 db저장
$sql = "INSERT INTO `g5_shop_inopay_noti` SET 
  `trans_seq` = '$transSeq',
  `user_id` = '$userId',
  `user_name` = '$userName',
  `user_phone_no` = '$userPhoneNo',
  `moid` = '$moid',
  `goods_name` = '$goodsName',
  `goods_amt` = '$goodsAmt',
  `buyer_name` = '$buyerName',
  `buyer_phone_no` = '$buyerPhoneNo',
  `pg_code` = '$pgCode',
  `pg_name` = '$pgName',
  `pay_method` = '$payMethod',
  `pay_method_name` = '$payMethodName',
  `pg_mid` = '$pgMid',
  `pg_sid` = '$pgSid',
  `status` = '$status',
  `status_name` = '$statusName',
  `pg_result_code` = '$pgResultCode',
  `pg_result_msg` = '$pgResultMsg',
  `pg_app_date` = '$pgAppDate',
  `pg_app_time` = '$pgAppTime',
  `pg_tid` = '$pgTid',
  `approval_amt` = '$approvalAmt',
  `approval_no` = '$approvalNo',
  `cash_receipt_type` = '$cashReceiptType',
  `cash_receipt_type_name` = '$cashReceiptTypeName',
  `cash_receipt_supply_amt` = '$cashReceiptSupplyAmt',
  `cash_receipt_vat` = '$cashReceiptVat',
  `card_no` = '$cardNo',
  `card_quota` = '$cardQuota',
  `card_issue_code` = '$cardIssueCode',
  `card_issue_name` = '$cardIssueName',
  `card_acquire_code` = '$cardAcquireCode',
  `card_acquire_name` = '$cardAcquireName',
  `cancel_amt` = '$cancelAmt',
  `cancel_msg` = '$cancelMsg',
  `cancel_result_code` = '$cancelResultCode',
  `cancel_result_msg` = '$cancelResultMsg',
  `cancel_app_date` = '$cancelAppDate',
  `cancel_app_time` = '$cancelAppTime',
  `cancel_pg_tid` = '$cancelPgTid',
  `cancel_approval_amt` = '$cancelApprovalAmt',
  `cancel_approval_no` = '$cancelApprovalNo',
  `bill_key` = '$billKey';";
sql_query($sql);

// 모든정보 로그생성

$PageCall = date("Y-m-d [H:i:s]",time());
$logfile = fopen( $LogPath . date("Y-m-d",time()).".log", "a+" );

fwrite( $logfile,"************************************************\r\n");
fwrite( $logfile,"PageCall time : ".$PageCall."\r\n");
foreach ($_REQUEST as $key => $value) {
    fwrite( $logfile,$key."      : ".$value."\r\n");
}



?>