<?php
include_once('./_common.php');
include_once('./insert_stock.php'); // insertStockData 함수가 정의된 파일을 포함합니다.

// Ajax 요청으로부터 받은 데이터
$mbId = $_POST['mbId'];
$holdingCount = $_POST['holdingCount'];
$paymentReason = $_POST['paymentReason'];
$mbRegister = $_POST['mbRegister'];
$stockPrice = getStockPrice();
$issuanceDate = G5_TIME_YMD; // 발행 날짜
$mbRecommend = '';

if($mbRegister == 'Y'){
    $get_member = get_member($mbId);
    $mbRecommend = $get_member['mb_recommend'];
    $paymentReason = '회원가입';
}

// 주식 데이터 삽입 함수 호출
$result = insertStockData($mbId, $holdingCount, $stockPrice, $issuanceDate, $paymentReason, $mbRecommend);

// 결과를 JSON 형태로 반환
echo json_encode(['success' => $result]);
?>
