<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
//이니시스 lpay 요청으로 왔다면 $default['de_pg_service'] 값을 이니시스로 변경합니다.
if( $od_settle_case == 'lpay' ){
    $default['de_pg_service'] = 'inicis';
}
// 장바구니가 비어있는가?
if (get_session("ss_direct"))
    $tmp_cart_id = get_session('ss_cart_direct');
else
    $tmp_cart_id = get_session('ss_cart_id');

$i_price     = (int)$_POST['od_price'];
$i_send_cost  = (int)$_POST['od_send_cost'];
$i_send_cost2  = (int)$_POST['od_send_cost2'];
$i_send_coupon  = (int)$_POST['od_send_coupon'];
$i_temp_point = (int)$_POST['od_temp_point'];

if ($od_settle_case == "무통장")
{
    $od_receipt_point   = $i_temp_point;
    $od_receipt_price   = 0;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0) {
        $od_status      = '입금';
        $od_receipt_time = G5_TIME_YMDHIS;
    }
}
else if ($od_settle_case == "계좌이체")
{
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        case 'inicis':
            include G5_SHOP_PATH.'/inicis/inistdpay_result.php';
            break;
				case 'innopay':
							break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $bank_name  = iconv("cp949", "utf-8", $bank_name);
            break;
    }

    $od_tno             = $tno;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $od_settle_case;
    $od_deposit_name    = $od_name;
    $od_bank_account    = $bank_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0)
        $od_status      = '입금';
}
else if ($od_settle_case == "가상계좌")
{
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        case 'inicis':
            include G5_SHOP_PATH.'/inicis/inistdpay_result.php';
            $od_app_no = $app_no;
            break;
				case 'innopay':
							break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $bankname   = iconv("cp949", "utf-8", $bankname);
            $depositor  = iconv("cp949", "utf-8", $depositor);
            break;
    }

    $od_receipt_point   = $i_temp_point;
    $od_tno             = $tno;
    $od_receipt_price   = 0;
    $od_bank_account    = $bankname.' '.$account;
    $od_deposit_name    = $depositor;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
}
else if ($od_settle_case == "휴대폰")
{
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        case 'inicis':
            include G5_SHOP_PATH.'/inicis/inistdpay_result.php';
            break;
				case 'innopay':
							break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            break;
    }

    $od_tno             = $tno;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $commid . ($commid ? ' ' : '').$mobile_no;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0)
        $od_status      = '입금';
}
else if ($od_settle_case == "신용카드")
{

    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        case 'inicis':
            include G5_SHOP_PATH.'/inicis/inistdpay_result.php';
            break;
				case 'innopay':
						break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $card_name  = iconv("cp949", "utf-8", $card_name);
            break;
    }

    $od_tno             = $tno;
    $od_app_no          = $app_no;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $card_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0)
        $od_status      = '입금';
}
else if ($od_settle_case == "간편결제" || ($od_settle_case == "lpay" && $default['de_pg_service'] === 'inicis') )
{
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        case 'inicis':
            include G5_SHOP_PATH.'/inicis/inistdpay_result.php';
            break;
				case 'innopay':
						break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $card_name  = iconv("cp949", "utf-8", $card_name);
            break;
    }

    $od_tno             = $tno;
    $od_app_no          = $app_no;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $card_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0)
        $od_status      = '입금';
}
else if ($od_settle_case == "KAKAOPAY")
{
    include G5_SHOP_PATH.'/kakaopay/kakaopay_result.php';

    $od_tno             = $tno;
    $od_app_no          = $app_no;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $card_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;
    if($od_misu == 0)
        $od_status      = '입금';
}
else
{
    die("od_settle_case Error!!!");
}

$od_pg = $default['de_pg_service'];
if($od_settle_case == 'KAKAOPAY')
    $od_pg = 'KAKAOPAY';

$od_id = $_POST[orderNumber];
$sql = " select * from {$g5['g5_shop_order_data_table']} where od_id = '$od_id' or cart_id='$tmp_cart_id'";

$od = sql_fetch($sql);
$od_id=$od[od_id];