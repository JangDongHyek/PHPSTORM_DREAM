<?
include_once("./common.php");

$is_pass = true;
$buy_no = $MOID;

$sql = "select * from `g5_order_list` where `buy_no` = '$buy_no'";
$order_row = sql_fetch($sql);
$write_id = sql_real_escape_string(get_text(trim($order_row['write_id'])));

$bo_table = trim($order_row['bo_table']);
$wr_id = trim($order_row['wr_id']);
$db_table = "g5_write_".$bo_table;
$sql = "select * from `$db_table` where `wr_id` = '$wr_id'";
$item_row = sql_fetch($sql);

if(empty($item_row)){
    $is_pass = false;
}

$item_cost = 0;
$ship_cost = 0;
$add_cost = 0;

if($bo_table == "edu" || $bo_table == "certify" || $bo_table == "academy"){
    if(empty($item_row['wr_5'])){
        $is_pass = false;
    }

    if($order_row['item_cost'] != $item_row['wr_5']){
        $is_pass = false;
    }

    $item_cost = $item_row['wr_5'];
} else {
    if(empty($item_row['wr_10'])){
        $is_pass = false;
    }

    if($order_row['item_cost'] != $item_row['wr_10']){
        $is_pass = false;
    }

    $item_cost = $item_row['wr_10'];
    $ship_cost = $item_row['wr_9'];
    $add_cost = $item_row['wr_8'];
}
$item_count = $order_row['item_count'];
$sum_cost = $item_count * $item_cost + $ship_cost + $add_cost;

if($order_row['sum_cost'] != $sum_cost){
    $is_pass = false;
}

if($Amt != $sum_cost){
    $is_pass = false;
}

if($is_pass){
        $sql = "UPDATE g5_order_list
        SET 
        `state` = '1',
        `PayMethod` = '$PayMethod',
        `MID` = '$MID',
        `TID` = '$TID',
        `mallUserID` = '$mallUserID',
        `Amt` = '$Amt',
        `name` = '$name',
        `GoodsName` = '$GoodsName',
        `OID` = '$OID',
        `MOID` = '$MOID',
        `AuthDate` = '$AuthDate',
        `AuthCode` = '$AuthCode',
        `ResultCode` = '$ResultCode',
        `ResultMsg` = '$ResultMsg',
        `VbankNum` = '$VbankNum',
        `MerchantReserved` = '$MerchantReserved',
        `MallReserved` = '$MallReserved',
        `SUB_ID` = '$SUB_ID',
        `fn_cd` = '$fn_cd',
        `fn_name` = '$fn_name',
        `CardQuota` = '$CardQuota',
        `BuyerEmail` = '$BuyerEmail',
        `BuyerAuthNum` = '$BuyerAuthNum',
        `ErrorCode` = '$ErrorCode',
        `ErrorMsg` = '$ErrorMsg',
        `FORWARD` = '$FORWARD'
        WHERE `buy_no` = '$buy_no';";
        sql_query($sql);




} else {
    $objData = array(
        "mid" => $_GET['MID'],
        "tid" => $_GET['TID'],
        "svcCd" => "01",
        "cancelAmt" => $_GET['Amt'],
        "cancelMsg" => $msg,
        "cancelPwd" => $CANCEL_PASSWORD
    );
    $jsonData = json_encode($objData);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.innopay.co.kr/api/cancelApi",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json; charset=utf-8"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
}



?>

<script src="<?php echo G5_JS_URL ?>/jquery-1.9.1.min.js"></script>
<script>

    let userAgent = navigator.userAgent || navigator.vendor || window.opera;
    let isAndroid = /android/i.test(userAgent);
    let isiOS = /iPad|iPhone|iPod/.test(userAgent) && !window.MSStream;

    $(document).ready(function() {
        <? if($is_pass == true) { ?>
        opener.document.location.href="<?php echo G5_URL?>/bbs/mypage.php";
        self.close();
        <?} else { ?>
        alert("오류가 발생하였습니다. <?=$msg?>" );
        opener.document.location.href="<?php echo G5_URL?>";
        self.close();
        <?}?>
    });
</script>
