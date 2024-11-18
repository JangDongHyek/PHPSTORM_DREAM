<?



function requestPost2WithHeaderInJsonObject($url, $header, $body) {
    // cURL 세션 초기화
    $ch = curl_init($url);

    // JSON 형식으로 인코딩된 데이터 설정
    $jsonData = json_encode($body);

    // 헤더 설정
	$headers = array('Content-Type: application/json', 'Accept: application/json');
	array_push($headers, "x-ncp-apigw-api-key: p2fvxnJ1yzOztAwosH2Yt35XgcpcvtTXNwHf6HJM");

    // cURL 옵션 설정
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // HTTP 요청 실행
    $response = curl_exec($ch);

    // 오류 확인
    if (curl_errno($ch)) {
        // 오류 처리
        echo 'Error:' . curl_error($ch);
    } else {
        // 응답 데이터를 JSON 객체로 변환
        $jsonObject = json_decode($response, true);
    }

    // cURL 세션 종료
    curl_close($ch);

    // 변환된 JSON 객체 반환
    return $jsonObject;
}



// API URL
$url = 'https://dev-datahub.jlkgroup.com/ScrapingAPI/JHDstage/nhic/auth/kakao/request';

// 헤더 정보
$headers = array(
    'x-ncp-apigw-api-key: p2fvxnJ1yzOztAwosH2Yt35XgcpcvtTXNwHf6HJM', // 여기에 실제 API 키를 넣으세요.
);

// 바디에 들어갈 데이터
$data = array(
    'phone' => '', // 실제 사용할 데이터로 대체하세요.
    'name' => '',       // 실제 사용할 데이터로 대체하세요.
    'birthday' => ''  // 실제 사용할 데이터로 대체하세요.
);


$result = requestPost2WithHeaderInJsonObject($url, $headers, $data);
print_r($result);