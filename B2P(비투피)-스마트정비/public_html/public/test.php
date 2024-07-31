<?php

function callApi($searchDate) {
    // API URL 설정
    $url = "https://t-api.autooasis.com:32443/ap/stor"; // 개발 URL
    // $url = "https://api.autooasis.com:32443/ap/stor"; // 운영 URL

    // 요청 데이터 설정
    $data = array("searchDe" => $searchDate);
    $data_json = json_encode($data);

    // 요청 헤더 설정
    $headers = array(
        "Content-Type: application/json",
        "authKey: ao8d058mipnhyzs5o2upf6caeeg4obpg" // 실제 제공받은 키로 대체
    );

    // cURL 초기화
    $ch = curl_init($url);

    // cURL 옵션 설정
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // API 호출
    $response = curl_exec($ch);

    // 에러 체크
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    // cURL 종료
    curl_close($ch);

    // 응답 반환
    return $response;
}

// 예제 호출
$searchDate = "20230807";
$response = callApi($searchDate);
echo $response;

?>
