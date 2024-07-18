<?php
include_once('./_common.php');

$msg = "";

$sql = "select * from `g5_order_list` where `buy_no` = '$moid'";
$order_row = sql_fetch($sql);
if(!empty($order_row)){
    $buy_no = $moid;

    if($status != "25" && $status != '85'){
        $msg .= " 결제오류 ";
        $is_pass = false;
    }

    if($status == "25"){
        if($order_row['MID'] != ""){
            $sql = " update `g5_order_list` set
                        `state` = '2' where `buy_no` = '$buy_no'";
            sql_query($sql);
        } else {
            $AuthDate = $pgReqDate.$pgReqTime;

            $sql = " update `g5_order_list` set
                        `state` = '2',
                        `PayMethod` = '{$payMethod}',
                        `MID` = '{$shopCode}',
                        `TID` = '{$transSeq}',
                        `mallUserID` = '{$mallUserId}',
                        `Amt` = '{$goodsAmt}',
                        `name` = '{$buyerName}',
                        `GoodsName` = '{$goodsName}',
                        `OID` = '{$moid}',
                        `MOID` = '{$moid}',
                        `AuthDate` = '{$AuthDate}',
                        `AuthCode` = '{$approvalNo}',
                        `ResultCode` = '{$pgResultCode}',
                        `ResultMsg` = '{$pgResultMsg}',
                        `VbankNum` = '',
                        `MerchantReserved` = '',
                        `MallReserved` = '',
                        `SUB_ID` = '',
                        `fn_cd` = '{$cardIssueCode}',
                        `fn_name` = '{$cardIssueName}',
                        `CardQuota` = '{$cardQuota}',
                        `BuyerEmail` = '{$buyerEmail}',
                        `BuyerAuthNum` = '',
                        `ErrorCode` = '',
                        `ErrorMsg` = '',
                        `FORWARD` = ''
                        where `buy_no` = '$buy_no'";
            sql_query($sql);
            fwrite( $logfile,"sql g5_shop_order insert      : ".$sql."\r\n");
        }

        if($order_row['bo_table'] == "edu"){
            $sql = "UPDATE `g5_write_apply01` SET `wr_7` = '1', `wr_10` = '{$order_row['write_id']}' where `wr_id` = '{$order_row['write_id']}'";
            sql_query($sql);
        } else if($order_row['bo_table'] == "certify"){
            $sql = "UPDATE `g5_write_apply02` SET `wr_7` = '1', `wr_10` = '{$order_row['write_id']}' where `wr_id` = '{$order_row['write_id']}'";
            sql_query($sql);
        } else if($order_row['bo_table'] == "academy"){
            $sql = "UPDATE `g5_write_apply03` SET `wr_7` = '1', `wr_10` = '{$order_row['write_id']}' where `wr_id` = '{$order_row['write_id']}'";
            $re = sql_query($sql);
        }
    }
} else {
    $msg .= " 결제정보없음 ";
}

fwrite( $logfile, $msg."\r\n");
fwrite( $logfile,"************************************************");
fclose( $logfile );

echo "0000";

?>