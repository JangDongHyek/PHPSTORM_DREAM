<?php
$host_name = "localhost";
$user_name = "itforone_test2";
$password = "sbtpsxja!@#";
$database = "itforone_test2";
$connect = mysqli_connect($host_name, $user_name, $password, $database);

// 리턴 해줄 json 데이터
$json = array();
$json['result'] = false;

// DB연결 확인
if (!$connect) {
    $error = mysqli_connect_error(); // 에러메시지
    $errno = mysqli_connect_errno(); // 에러코드 (0:정상, 나머지:오류)

    $json['response_code'] = "E000";
    $json['message'] = "DB 연결에 실패했습니다. {$error}";

    die(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

mysqli_set_charset($connect, "utf8");

// 요청 URL 확인
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //호출한 uri을 가져옴
$uri_arr = explode('/', $uri); //uri을 슬러시('/') 단위로 쪼갬
$uri_arr_last = count($uri_arr) - 1;

echo 123;