<?php
include_once('./_common.php');

function insertStockData($mbId, $holdingCount, $stockPrice, $issuanceDate, $paymentReason, $mbRecommend) {
    // 주식 삽입 로직
    if (insertStock($mbId, $holdingCount, $stockPrice, $issuanceDate, $paymentReason, '')) {
            
        if($paymentReason === '회원가입' && $mbRecommend){
            if (insertStock($mbRecommend, $holdingCount, $stockPrice, $issuanceDate, '회원가입 추천', $mbId)) {
                return true;
            } else {
                alert('주식 데이터 등록중 오류가 발생하였습니다. 관리자에게 문의하세요.', G5_BBS_URL.'/login.php');
            }
        }
        return true;

    } else {
        alert('주식 데이터 등록중 오류가 발생하였습니다. 관리자에게 문의하세요.', G5_BBS_URL.'/login.php');
    }
    return false;
}
?>
