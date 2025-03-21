<?php
include_once('./_common.php');
//**************************************************************************************************************
//NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED

//서비스명 :  체크플러스 - 안심본인인증 서비스
//페이지명 :  체크플러스 - 결과 페이지

//보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 
//**************************************************************************************************************

$sitecode = NICE_CODE;					// NICE로부터 부여받은 사이트 코드
$sitepasswd = NICE_PASSWORD;				// NICE로부터 부여받은 사이트 패스워드

// Linux = /절대경로/ , Window = D:\\절대경로\\ , D:\절대경로\
$cb_encode_path = NICE_PATH;
	
$enc_data = $_REQUEST["EncodeData"];		// 암호화된 결과 데이타

//////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
//if(preg_match('~[^0-9a-zA-Z+/=]~', $enc_data, $match)) {echo "입력 값 확인이 필요합니다 : ".$match[0]; exit;} // 문자열 점검 추가. 
//if(base64_encode(base64_decode($enc_data))!=$enc_data) {echo "입력 값 확인이 필요합니다"; exit;}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
if ($enc_data != "") {
	$plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
	//echo "[plaindata] " . $plaindata . "<br>";

	if ($plaindata == -1){
		$returnMsg  = "암/복호화 시스템 오류";
	}else if ($plaindata == -4){
		$returnMsg  = "복호화 처리 오류";
	}else if ($plaindata == -5){
		$returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
	}else if ($plaindata == -6){
		$returnMsg  = "복호화 데이터 오류";
	}else if ($plaindata == -9){
		$returnMsg  = "입력값 오류";
	}else if ($plaindata == -12){
		$returnMsg  = "사이트 비밀번호 오류";
	}else{
		// 복호화가 정상적일 경우 데이터를 파싱합니다.
		$ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)
		
		$requestnumber = GetValue($plaindata , "REQ_SEQ");
		$errcode = GetValue($plaindata , "ERR_CODE");
		$authtype = GetValue($plaindata , "AUTH_TYPE");
	}
}

$g5['title'] = '회원가입 본인인증 실패';
include_once(G5_PATH.'/head.sub.php');

?>
<script>
document.addEventListener("DOMContentLoaded", function(){
	alert("본인인증에 실패하였습니다. 다시 시도해 주세요.");

	/*if (!mobilecheck()) {
		// 1) PC화면
		opener.document.location.href = g5_bbs_url + "/register.php";
		self.close();
	} else {
		// 2) 모바일
		location.href = g5_url;
	}*/
    location.href = g5_url;
});
</script>

<?php
// alert("본인인증에 실패하였습니다. 다시 시도해 주세요.", G5_URL);
include_once(G5_PATH.'/tail.sub.php');
exit;
?>
<!--
<html>
<head>
    <title>NICE평가정보 - CheckPlus 안심본인인증 테스트</title>
</head>
<body>
    <center>
    <p><p><p><p>
    본인인증이 실패하였습니다.<br>
    <table width=500 border=1>
        <tr>
            <td>복호화한 시간</td>
            <td><?= $ciphertime ?> (YYMMDDHHMMSS)</td>
        </tr>
        <tr>
            <td>요청 번호</td>
            <td><?= $requestnumber ?></td>
        </tr>            
        <tr>
            <td>본인인증 실패 코드</td>
            <td><?= $errcode ?></td>
        </tr>            
        <tr>
            <td>인증수단</td>
            <td><?= $authtype ?></td>
        </tr>
        </tr>
    </table>
    </center>
</body>
</html>-->