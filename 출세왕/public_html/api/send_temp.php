<?php
$data = array();
$data['app_id'] = "successking";
$data['device_platform'] = "ALL";
$data['send_type'] = "2"; // 1: 전체 2:단일 (단일시 mem_id첨부필요)
$data['msg'] = "테스트";
$data['mem_id'] = "test";
$url = "https://push.softwow.co.kr/api/send_request.php";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt ($ch, CURLOPT_SSLVERSION,1);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);

curl_setopt ($ch, CURLOPT_TIMEOUT, 300);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
$curl_result = curl_exec ($ch);

?>