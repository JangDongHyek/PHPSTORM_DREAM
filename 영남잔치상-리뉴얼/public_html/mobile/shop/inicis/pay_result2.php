<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_MSHOP_PATH.'/settle_inicis.inc.php');

// 세션비교
$hash = md5(get_session('P_TID').$default['de_inicis_mid'].get_session('P_AMT'));
if($hash != $P_HASH)
    alert('결제 정보가 일치하지 않습니다. 올바른 방법으로 이용해 주십시오.');

//최종결제요청 결과 성공 DB처리
$tno             = get_session('P_TID');
$amount          = get_session('P_AMT');
$app_time        = $P_AUTH_DT;
$pay_method      = $P_TYPE;
$pay_type        = $PAY_METHOD[$pay_method];
$depositor       = $P_UNAME;
$commid          = $P_HPP_CORP;
$mobile_no       = $P_APPL_NUM;
$app_no          = $P_AUTH_NO;
$card_name       = $P_CARD_ISSUER;
if ($default['de_escrow_use'] == 1)
    $escw_yn         = 'Y';
switch($pay_type) {
    case '계좌이체':
        $bank_name = $P_VACT_BANK;
        break;
    case '가상계좌':
        $bankname  = $P_VACT_BANK;
        $account   = $P_VACT_NUM.' '.$P_VACT_NAME;
        $app_no    = $P_VACT_NUM;
        break;
    default:
        break;
}

// 세션 초기화
set_session('P_TID',  '');
set_session('P_AMT',  '');
set_session('P_HASH', '');
?>