<?php
    //kakao_login.php

	$restAPIKey = "cea3bb6eaee50270e40650c353c167a9"; //������ REST API KEY�� �Է����ּ���
	$callbacURI = urlencode("http://www.elflower.co.kr/market/member/kakao_login_callback.php"); //������ Call Back URL�� �Է����ּ���
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


