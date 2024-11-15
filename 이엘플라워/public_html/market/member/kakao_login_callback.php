<?php
    //kakao_login_callback.php

	$returnCode = $_GET["code"]; // ������ ���� ��ū�� �߱޹��� �� �ִ� �ڵ带 �޾ƿɴϴ�
	$restAPIKey = "cea3bb6eaee50270e40650c353c167a9"; // ������ REST API KEY�� �Է����ּ���
	$callbacURI = urlencode("http://www.elflower.co.kr/market/member/kakao_login_callback.php"); // ������ Call Back URL�� �Է����ּ���

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
	
    $accessToken= json_decode($loginResponse)->access_token; //Access Token�� ���� ��

	
	$header = "Bearer ".$accessToken; // Bearer ������ ���� �߰�
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
	
	var_dump($profileResponse); // Kakao API ������ ���� �޾ƿ� ��
	
	$profileResponse = json_decode($profileResponse);
	
	$userId = $profileResponse->id;
	$userName = $profileResponse->properties->nickname;
	$userEmail = $profileResponse->kakao_account->email;
	
	echo "<br><br> userId : ".$userId;
	echo "<br> userName : ".$userName;
	echo "<br> userEmail : ".$userEmail;
?>


