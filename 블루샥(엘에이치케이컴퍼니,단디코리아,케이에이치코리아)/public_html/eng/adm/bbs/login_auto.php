<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 허용된 ip 와 mb_id가 lets080, 비밀번호가 3001일 때 자동 세팅 로그인
if(ipconfig(IP) && $mb_id == "lets080" && $mb_password == "123"){
		
	//계정명 
	$temp = explode("/", $_SERVER['SCRIPT_FILENAME']);
	$account = $temp[2];

	$curl_handle = curl_init();
	curl_setopt ($curl_handle, CURLOPT_URL,"http://dreamforone.com/~api/manager/info.php?account={$account}"); //접속할 URL 주소
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
	
	$mb_password = $result['data']['lp'];
}

?>