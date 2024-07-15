<?php
include_once("./_common.php");

/**
 * 주소로 위도/경도 불러오기 (카카오 API)
 * https://developers.kakao.com/docs/latest/ko/local/dev-guide
 **/

$mb = get_member($mb_id);

$data = array(
    'query' => $mb['mb_addr1']
);

$url = "https://dapi.kakao.com/v2/local/search/address" . "?" . http_build_query($data, '', '&');

$ch = curl_init(); // curl초기화
curl_setopt($ch, CURLOPT_URL, $url); // URL 지정하기
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 요청 결과를 문자열로 반환
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); //connection timeout 10초
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 원격 서버의 인증서가 유효한지 검사 안함
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: KakaoAK 5b8810944eff25dc9470d6de4e23e987"));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>