<?php
    //kakao_login.php

	$restAPIKey = "cea3bb6eaee50270e40650c353c167a9"; //본인의 REST API KEY를 입력해주세요
	$callbacURI = urlencode("http://www.elflower.co.kr/market/member/kakao_login_callback.php"); //본인의 Call Back URL을 입력해주세요
	$kakaoLoginUrl = "https://kauth.kakao.com/oauth/authorize?client_id=".$restAPIKey."&redirect_uri=".$callbacURI."&response_type=code";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	
	<body>
		<a href="<?= $kakaoLoginUrl ?>">
			kakao login
		</a>
	</body>
</html>


