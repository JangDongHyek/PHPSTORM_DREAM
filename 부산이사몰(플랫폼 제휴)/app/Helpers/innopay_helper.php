<?php
/**
 * 이노페이 자동결제 헬퍼
 */

use Config\Services;

// 공통 API
function callRegAutoIpayApi($post = [], $path = ''): array
{
    if ($path == '') return [];

    $client = Services::curlrequest();
    $host = IPAY_AUTO_HOST . '/' . $path;

    // 실행
    $response = $client->post($host, [
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer YOUR_API_TOKEN' // 필요한 경우 API 토큰 추가
        ],
        'json' => $post // 배열 JSON 으로 자동변환
    ]);

    // API 응답
    $body = $response->getBody();

    if (isJsonString($body)) {
        $resultData = json_decode($body, true);

    } else {
        $resultData = ['resultCode' => '9999', 'resultMsg' => '서버와의 통신에 실패했습니다.<br>잠시 후 다시 시도해 주세요.'];
    }

    write_server_log($resultData, 'ipay', $path);
    return $resultData;
}

// 자동결제용 카드등록
// https://web.innopay.co.kr/guide/auto_api/ (2. 결제등록 API)
function registerAutoBill($member = array(), $post = array()): array
{
    $moid = 'A' . date('ymdHi') . '-' . getRandomString(4, 'int'); // 주문번호
    $buyerHp = !empty($member['mb_hp']) ? $member['mb_hp'] : $post['cpTel'];
    if (empty($buyerHp)) $buyerHp = '0519041414'; // 부산이사 번호

    // 결제등록 전문
    $cardData = [
        'mid' => IPAY_AUTO_MID,
        'arsUseYn' => 'N',
        'billKey' => '',
        'arsConnType' => 'N',
        'buyerHp' => extractNumbers($buyerHp, false, false),
        'buyerName' => $member['mb_name'],
        'moid' => $moid,
        'payExpDate' => '',
        'userId' => $member['mb_id'] . '_' . date('Ymd_His'),
        'mbIdx' => $member['idx'],
        'buyerEmail' => (!empty($member['mb_email'])) ? $member['mb_email'] : '',
        'cardNum' => implode("", str_split($post['cardNumber'])), // 	카드번호
        'cardExpire' => ($post['cardYy'] . $post['cardMm']), // 유효기간
        'cardPwd' => $post['cardPwd'],
        'idNum' => $post['idNum'],
    ];

    // API 호출
    $response = callRegAutoIpayApi($cardData, 'regAutoCardBill');

    return [
        'isSuccess' => $response['resultCode'] == '0000', // 결제성공여부
        'response' => $response,
        'cardData' => $cardData,
    ];
}

// 자동결제 승인요청
// https://web.innopay.co.kr/guide/auto_api/ (4. 결제승인 API)
function paymentAutoBill($cardData = array(), $selectPlanData = array()): array
{
    $moid = 'M' . date('ymdHi') . '-' . getRandomString(4, 'int');
    $amt = $selectPlanData['amt'];

    // 승인요청 전문
    $autoPayData = [
        'mid' => IPAY_AUTO_MID,
        'moid' => $moid,
        'amt' => $amt,
        'dutyFreeAmt' => '',
        'billKey' => $cardData['bill_key'],
        'arsConnType' => 'N',
        'buyerHp' => $cardData['buyer_hp'],
        'buyerName' => $cardData['buyer_name'],
        'goodsName' => $selectPlanData['goodsName'],
        'payExpDate' => '',
        'userId' => $cardData['mb_id'],
        'buyerEmail' => '',
        'cardQuota' => $cardData['cardQuota']
    ];

    // API 호출
    $response = callRegAutoIpayApi($autoPayData, 'payAutoCardBill');
    $isSuccess = $response['resultCode'] == '0000';

    // 결제 DB 생성
    $payData = [
        'pay_status' => $isSuccess ? 'Y' : 'N',
        'pay_method' => 'CARD',
        'mb_id' => $cardData['mb_id'],
        'goods_cnt' => 1,
        'goods_name' => $autoPayData['goodsName'],
        'amt' => $autoPayData['amt'],
        'moid' => $autoPayData['moid'],
        'tid' => $response['tid'],
        'auth_date' => $response['authDate'],
        'result_code' => $response['resultCode'],
        'result_msg' => $response['resultMsg'],
        'acqu_card_code' => $response['acquCardCode'],
        'acqu_card_name' => $response['acquCardName'],
        'card_quota' => $response['cardQuota'],
        'mid' => $autoPayData['mid'],
        // 'mbship_yn' => 'Y',
    ];

    // API 성공시
    if ($isSuccess) {
        //추가작업 필요시
    }

    return [
        'isSuccess' => ($isSuccess), // 결제성공여부
        'response' => $response,
        'payData' => $payData,
        'planDetailData' => $planDetailData ?? [],
    ];
}

// 자동결제 승인취소
// https://web.innopay.co.kr/guide/cancle/
function cancelAutoBill($tid = '', $amt = 0): array
{
    $cancelData = [
        'mid' => IPAY_AUTO_MID,
        'tid' => $tid,
        'svcCd' => '01', // 01:신용카드
        'cancelAmt' => $amt,
        'cancelMsg' => '광고 DB등록 실패',
        'cancelPwd' => IPAY_AUTO_CANCEL_PW,
        'currency' => 'KRW',
    ];
    $response = callRegAutoIpayApi($cancelData, 'cancelApi');

    return [
        'response' => $response,
    ];
}