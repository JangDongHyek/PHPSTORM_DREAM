<?php
include_once('./_common.php');
include_once(G5_MSHOP_PATH.'/settle_inicis.inc.php');
/*$test=implode('',$_REQUEST);
$sql="insert g5_paytest set test='$test'";
sql_query($sql);*/
// 세션 초기화
set_session('P_TID',  '');
set_session('P_AMT',  '');
set_session('P_HASH', '');

$oid  = trim($_REQUEST['P_NOTI']);
$od_id=$oid;

$sql = " select * from {$g5['g5_shop_order_data_table']} where od_id = '$oid' ";
$od = sql_fetch($sql);

$tmp_cart_id = $od[cart_id];
$data = unserialize(base64_decode($od['dt_data']));




if(isset($data['pp_id']) && $data['pp_id']) {
    $order_action_url = G5_HTTPS_MSHOP_URL.'/personalpayformupdate.php';
    $page_return_url  = G5_SHOP_URL.'/personalpayform.php?pp_id='.$data['pp_id'];
} else {
    $order_action_url = G5_HTTPS_MSHOP_URL.'/orderformupdate.php';
    $page_return_url  = G5_SHOP_URL.'/orderform.php';
    if($_SESSION['ss_direct'])
        $page_return_url .= '?sw_direct=1';
}

if($_REQUEST['P_STATUS'] != '00') {
    alert('오류 : '.iconv_utf8($_REQUEST['P_RMESG1']).' 코드 : '.$_REQUEST['P_STATUS'], $page_return_url);
	exit;
} else {
    $post_data = array(
        'P_MID' => $default['de_inicis_mid'],
        'P_TID' => $_REQUEST['P_TID']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $_REQUEST['P_REQ_URL']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false ); // 추가.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);

    if(!$return){
        alert('KG이니시스와 통신 오류로 결제등록 요청을 완료하지 못했습니다.\\n결제등록 요청을 다시 시도해 주십시오.', $page_return_url);
		exit;
	}

    // 결과를 배열로 변환
    parse_str($return, $ret);
    $PAY = array_map('trim', $ret);
    $PAY = array_map('strip_tags', $PAY);
    $PAY = array_map('get_search_string', $PAY);

    if($PAY['P_STATUS'] != '00')
        alert('오류 : '.iconv_utf8($PAY['P_RMESG1']).' 코드 : '.$PAY['P_STATUS'], $page_return_url);

    // TID, AMT 를 세션으로 주문완료 페이지 전달
    $hash = md5($PAY['P_TID'].$PAY['P_MID'].$PAY['P_AMT']);
    set_session('P_TID',  $PAY['P_TID']);
    set_session('P_AMT',  $PAY['P_AMT']);
    set_session('P_HASH', $hash);
}

$g5['title'] = 'KG 이니시스 결제';
$g5['body_script'] = ' onload="setPAYResult();"';
include_once(G5_PATH.'/head.sub.php');

$exclude = array('res_cd', 'P_HASH', 'P_TYPE', 'P_AUTH_DT', 'P_AUTH_NO', 'P_HPP_CORP', 'P_APPL_NUM', 'P_VACT_NUM', 'P_VACT_NAME', 'P_VACT_BANK', 'P_CARD_ISSUER', 'P_UNAME');
$res_cd = $PAY['P_STATUS'];


$tno             = $PAY['P_TID'];
$amount          = $PAY['P_AMT'];
$app_time        = $PAY['P_AUTH_DT'];
$pay_method      = $PAY['P_TYPE'];
$pay_type        = $PAY_METHOD[$pay_method];
$depositor       = $PAY['P_UNAME'];
$commid          = $PAY['P_HPP_CORP'];
$mobile_no       = $PAY['P_APPL_NUM'];
$app_no          = $PAY['P_AUTH_NO'];
$card_name       = $CARD_CODE[$PAY['P_CARD_ISSUER_CODE']];

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

include_once("./order_data.php");
//include_once(G5_MSHOP_PATH.'/orderformupdate2.php');

?>