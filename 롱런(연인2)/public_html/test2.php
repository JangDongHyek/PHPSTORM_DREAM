<?php


// 아이리시스 알림톡 테스트
include_once ("common.php");

define('WIDESHOT_SENDERKEY2', '34bc713468d068185a22d6115926385b904e1583'); // 발신프로필키
define('WIDESHOT_PULSFRIEND2', '@아이리시스'); // 카카오톡 채널 아이디
define('WIDESHOT_KEY2', 'MXVzQXluK1RVejNXazlyNEZ1cHFHZXpoSnhnYTlvS0tRaStSN1dqWm42STZTVS9ZYmJ6MUJrVFU4K1p6QTlNVQ=='); // 인증키
define('WIDESHOT_SERVER2', 'https://apimsg.wideshot.co.kr');


// 카카오알림톡 발송
// params:템플릿변수, hp:휴대폰, idx: 참고idx
function sendAlimTalkTest($params, $mb_hp, $idx) {
    $contents = "[아이리시스]\n";

    $contents .= "\n1. 고객정보\n";
    $contents .= "- 이름 : {$params['user_name']}\n";
    $contents .= "- 연락처 : {$params['user_tel']}\n";
    $contents .= "- 모델명 : {$params['user_product']}\n";
    $contents .= "- 시리얼넘버 : {$params['user_serial_no']}\n";

    $contents .= "\n2. 결제정보\n";
    $contents .= "- 카드사 : {$params['AcquCardName']}\n";
    $contents .= "- 할부정보 : {$params['CardQuota']}\n";

    $contents .= "\n3. 설치기사\n";
    $contents .= "- 이름 : {$params['mb_name']} \n";
    $contents .= "- 연락처 : {$params['mb_hp']}\n";

    $contents .= "\n4. APP\n";
    $contents .= "- ID : {$params['app_id']}\n";
    $contents .= "- PW : {$params['app_pw']} (초기에는 0000)\n";

    $contents .= "\n▶앱 다운로드 방법\n";
    $contents .= "안드로이드: 구글 플레이스토어에서 [아이리시스 IoT 솔루션] 검색 후 다운로드\n";
    $contents .= "아이폰: 앱스토어에서 [아이리시스 IoT] 솔루션 검색 후 다운로드";

    // $contents = "회원가입이 완료되었습니다!\n";
    // $contents .= "\n감사합니다.";
    // $btnArr = array(
    //     0 => array(
    //         'name' => urlencode('채널 추가'),
    //         'type' => 'AC'
    //     )
    // );

    $data = array(
        'plusFriendId' => WIDESHOT_PULSFRIEND2,
        'senderKey' => WIDESHOT_SENDERKEY2,
        'templateCode' => 'SJB_071956',
        'contents' => $contents,
        'receiverTelNo' => $mb_hp,
        'userKey' => getRandomString(12),
        // 'attachment' => getAlimtalkButtons($btnArr)
    );

    $res_data = curlWideShot($data);

    // DB저장
    // $sql = "INSERT INTO log_kakao_alim SET
    // 		ref_idx = '{$idx}',
    // 		template = '{$data['templateCode']}',
    // 		mb_hp = '{$mb_hp}',
    // 		req_data = '".json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."',
    // 		res_code = '{$res_data['code']}',
    // 		res_sendCode = '{$res_data['sendCode']}',
    // 		reg_date = '".G5_TIME_YMDHIS."'
    // 		";
    // sql_query($sql);

    return $res_data;
}

// 카카오알림톡 발송
function curlWideShot($data) {
    $url = WIDESHOT_SERVER2."/api/v1/message/alimtalk";
    $headers = array("sejongApiKey: ".WIDESHOT_KEY2);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_POST, true);

    $res = curl_exec($ch);

    if ($res === false) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($res, true);
}



// 발송
$params = [
    'user_name' => '윤지영',
    'user_tel' => '010-2612-0220',
    'user_product' => '테스트 모델',
    'user_serial_no' => 'NO123456',

    'AcquCardName' => '신한',
    'CardQuota' => '일시불',

    'mb_name' => '홍길동',
    'mb_hp' => '010-2222-0000',

    'app_id' => 'test01',
    'app_pw' => '0000',
];

$response = sendAlimTalkTest($params, '01026120220', 0);
echo "<pre>";
print_r($response);
echo "</pre>";