<?php

// stdClass -> Array 로 변경
function objectToArray($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }
 
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

// Array -> stdClass 로 변경
function arrayToObject($d) {
    if (is_array($d)) {
        return (object) array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

//계정명 
$temp = explode("/", $_SERVER['SCRIPT_FILENAME']);
$account = $temp[2];
$curl_handle = curl_init();
curl_setopt ($curl_handle, CURLOPT_URL,"http://dreamforone.com/~api/count/index.php?services=count&account={$account}"); //접속할 URL 주소
curl_setopt ($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
curl_setopt ($curl_handle, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
curl_setopt ($curl_handle, CURLOPT_HEADER, 0); // 헤더 출력 여부
curl_setopt( $curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt ($curl_handle, CURLOPT_TIMEOUT, 10); // TimeOut 값
curl_setopt ($curl_handle, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
$result = curl_exec ($curl_handle);

if(curl_errno($curl_handle)) var_dump(curl_error($curl_handle));

curl_close ($curl_handle);

$result = json_decode($result);		//json stdClass 변환
$result = objectToArray($result);	//json Array 변환

print_r($result);
?>