<?php
    //kakao_login_callback.php

	$returnCode = $_GET["code"]; // 서버로 부터 토큰을 발급받을 수 있는 코드를 받아옵니다
	$restAPIKey = "cea3bb6eaee50270e40650c353c167a9"; // 본인의 REST API KEY를 입력해주세요
	$callbacURI = urlencode("http://www.elflower.co.kr/market/member/kakao_login_callback.php"); // 본인의 Call Back URL을 입력해주세요

    $getTokenUrl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=".$restAPIKey."&redirect_uri=".$callbacURI."&code=".$returnCode;
	
	$isPost = false;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $getTokenUrl);
	curl_setopt($ch, CURLOPT_POST, $isPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$headers = array();
	$loginResponse = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);
	
    $accessToken= json_decode($loginResponse)->access_token; //Access Token만 따로 뺌

	
	$header = "Bearer ".$accessToken; // Bearer 다음에 공백 추가
	$getProfileUrl = "https://kapi.kakao.com/v2/user/me";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $getProfileUrl);
	curl_setopt($ch, CURLOPT_POST, $isPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$headers = array();
	$headers[] = "Authorization: ".$header;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$profileResponse = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);
	
	var_dump($profileResponse); // Kakao API 서버로 부터 받아온 값
	
	$profileResponse = json_decode($profileResponse);
	
	$userId = $profileResponse->id;
	$userName = $profileResponse->properties->nickname;
	$userEmail = $profileResponse->kakao_account->email;
	
	echo "<br><br> userId : ".$userId;
	echo "<br> userName : ".$userName;
	echo "<br> userEmail : ".$userEmail;
?>


