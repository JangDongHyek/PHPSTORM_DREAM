<?php
$text = "{\"user_idx\":\"31\",\"compete_idx\":\"16\",\"description\":\"\\\"\",\"status\":\"\"}";
//$obj = stripslashes("{\"user_idx\":\"31\",\"compete_idx\":\"16\",\"description\":\"\\\"\",\"status\":\"\"}");
//echo $obj;
//// JSON 문자열 (이스케이프된 형태 그대로)
//$jsonString = '{"user_idx":"31","compete_idx":"16","description":"\"","status":""}';
//
//// json_decode를 사용하여 바로 디코딩
$decodedJson = json_decode($text, true);
//
//// 디코딩 결과 확인
if (json_last_error() === JSON_ERROR_NONE) {
    print_r($decodedJson);
} else {
    echo "JSON decode error: " . json_last_error_msg();
}
?>