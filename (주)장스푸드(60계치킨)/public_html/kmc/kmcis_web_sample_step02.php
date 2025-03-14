﻿<?php
	//************************************************************************
	//																		//
	//		본 샘플소스는 개발 및 테스트를 위한 목적으로 만들어졌으며,		//
	//																		//
	//		실제 서비스에 그대로 사용하는 것을 금합니다.					//
	//																		//
	//************************************************************************

	//01.입력값 변수로 받기
    $cpId       = $_REQUEST['cpId'];        // 고객사ID
    $urlCode    = $_REQUEST['urlCode'];     // URL 코드
    $certNum    = $_REQUEST['certNum'];     // 요청번호 (본인인증 요청시 중복되지 않게 생성해야함. (예-시퀀스번호))
    $date       = $_REQUEST['date'];        // 요청일시
    $certMet    = $_REQUEST['certMet'];     // 본인확인방법
    $birthDay   = $_REQUEST['birthDay'];	// 생년월일
    $gender     = $_REQUEST['gender'];		// 성별
    $name       = $_REQUEST['name'];        // 성명
    $phoneNo    = $_REQUEST['phoneNo'];		// 휴대폰번호
    $phoneCorp 	= $_REQUEST['phoneCorp'];	// 이동통신사
    $nation     = $_REQUEST['nation'];      // 내외국인 구분
    $plusInfo   = $_REQUEST['plusInfo'];	// 추가DATA정보
   	$tr_url     = $_REQUEST['tr_url'];      // 본인인증 결과수신 POPUP URL
	$tr_add     = $_REQUEST['tr_add'];      // IFrame사용여부
    $extendVar  = "0000000000000000";       // 확장변수

	// Start - [ 입력값 유효성 검증 ]----------------------------------------------------------------------------------
	// 비정상적인 호출, XSS공격, SQL Injection 방지를 위해 입력값 유효성 검증 후 서비스를 호출해야 함

	function paramChk($pattern, $param){
		$result = preg_match($pattern, $param);

		return $result;
	}

	/*
	$patn = "/^[[:upper:]]*$/";
	$patn1 = "/^[0-9]*$/";
	// cpid (영대문자 4자리+숫자 4자리만 유효)
	if( strlen($cpId) == 8 ){
		$engcpId = substr($cpId, 0, 4);
		$numcpId = substr($cpId, 4, 8);
		if( paramChk($patn, $engcpId) == 0 || paramChk($patn1, $numcpId) == 0 ){
			echo("<script>alert('고객사ID 비정상');</script>");
			echo("<script>history.back();</script>");
		}
	} else {
		echo("<script>alert('고객사ID 비정상');</script>");
		echo("<script>history.back();</script>");
	}
	*/

	/*
	// urlcode (숫자 6자리만 유효)
	$patn = "/^[0-9]*$/";
	if(strlen($urlCode) != 6 || paramChk($patn, $urlCode) == 0 ){
		echo("<script>alert('URL코드 비정상');</script>");
		echo("<script>history.back();</script>");
	}
	*/

	/*
    // 요청번호 (최대 40byte까지 유효)
    if(strlen($certNum) > 40 || strlen($certNum) == 0){
		echo("<script>alert('요청번호 비정상');</script>");
		echo("<script>history.back();</script>");
    }
	*/

	/*
    // 요청일시 (숫자 14자리만 유효)
	$patn = "/^[0-9]*$/";
	if(strlen($date) != 14 || paramChk($patn, $date) == 0){
		echo("<script>alert('요청일시 비정상');</script>");
		echo("<script>history.back();</script>");
	}
	*/

	/*
    // 본인확인방법 (영문대문자 1자리만 유효)
	$patn = "/^[[:upper:]]*$/";
    if(strlen($certMet) != 1 || paramChk($patn, $certMet) == 0){
		echo("<script>alert('본인확인방법 비정상');</script>");
		echo("<script>history.back();</script>");
    }
	*/

	/*
    // 추가정보 (값이 있는 경우에는 최대 320byte까지만 유효)
	$patn = "/^[<>]*$/";
    if(strlen($plusInfo) > 0 ){
		if(strlen($plusInfo) > 320 || paramChk($patn, $plusInfo) ){
			echo("<script>alert('추가정보 비정상');</script>");
			echo("<script>history.back();</script>");
		}
    }
	*/

	/*
    // IFrame사용여부 (값이 있는 경우에는 영문대문자 1자리만 유효)
	$patn = "/^[[:upper:]]*$/";
    if(strlen($tr_add) != 0){
		if(strlen($tr_add) != 1 || paramChk($patn, $tr_add) == 0){
			echo("<script>alert('IFrame사용여부 비정상');</script>");
			echo("<script>history.back();</script>");
		}
	}	
	*/
	// End - [ 입력값 유효성 검증 ]---------------------------------------------------------------------------------

    $name = str_replace(" ", "+", $name) ;  //성명에 space가 들어가는 경우 "+"로 치환하여 암호화 처리

	//02. tr_cert 데이터변수 조합 (서버로 전송할 데이터 "/"로 조합)
	$tr_cert	= $cpId . "/" . $urlCode . "/" . $certNum . "/" . $date . "/" . $certMet . "///////" . $plusInfo . "/" . $extendVar;

    //암호화모듈 호출
	if (extension_loaded('ICERTSecu')) {

		//03. 1차암호화
		$enc_tr_cert = ICertSeed(1,0,'',$tr_cert);

		//04. 변조검증값 생성
		$enc_tr_cert_hash = ICertHMac($enc_tr_cert);
		
		//05. 2차암호화
		$enc_tr_cert = $enc_tr_cert . "/" . $enc_tr_cert_hash . "/" . "0000000000000000";

		$enc_tr_cert = ICertSeed(1,0,'',$enc_tr_cert);

	}else{
       echo("암호화모듈 호출 실패!!!");
       return;
	}
?>

<html>
<head>
<title>KMC 본인확인서비스 Sample 화면</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="robots" content="noindex">
<style>
<!--
   body,p,ol,ul,td
   {
	 font-family: 굴림;
	 font-size: 12px;
   }

   a:link { size:9px;color:#000000;text-decoration: none; line-height: 12px}
   a:visited { size:9px;color:#555555;text-decoration: none; line-height: 12px}
   a:hover { color:#ff9900;text-decoration: none; line-height: 12px}

   .style1 {
		color: #6b902a;
		font-weight: bold;
	}
	.style2 {
	    color: #666666
	}
	.style3 {
		color: #3b5d00;
		font-weight: bold;
	}
--> 
</style>

<script language=javascript>
<!--
  window.name = "kmcis_web_sample";
  
  var KMCIS_window;

  function openKMCISWindow(){    

    var UserAgent = navigator.userAgent;
    /* 모바일 접근 체크*/
    // 모바일일 경우 (변동사항 있을경우 추가 필요)
    if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
      document.reqKMCISForm.target = '';
		} 
		
		// 모바일이 아닐 경우
		else {
    	KMCIS_window = window.open('', 'KMCISWindow', 'width=425, height=550, resizable=0, scrollbars=no, status=0, titlebar=0, toolbar=0, left=435, top=250' );

     	if(KMCIS_window == null){
    	  alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
      }
     	
     	document.reqKMCISForm.target = 'KMCISWindow';
		}
		  
		document.reqKMCISForm.action = 'https://www.kmcert.com/kmcis/web/kmcisReq.jsp';
		document.reqKMCISForm.submit();
  }

//-->
</script>

</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>

<center>
<br><br><br><br><br><br>
<span class="style1">KMC 본인확인서비스 요청화면 Sample입니다.</span><br>
<br><br>
<table cellpadding=1 cellspacing=1>
    <tr>
        <td align=center>고객사ID</td>
        <td align=left><?php echo $cpId ?></td>
    </tr>
    <tr>
        <td align=center>URL코드</td>
        <td align=left><?php echo $urlCode ?></td>
    </tr>
    <tr>
        <td align=center>요청번호</td>
        <td align=left><?php echo $certNum ?></td>
    </tr>
    <tr>
        <td align=center>요청일시</td>
        <td align=left><?php echo $date ?></td>
    </tr>
    <tr>
        <td align=center>본인확인방법</td>
        <td align=left><?php echo $certMet ?></td>
        </td>
    </tr>
    <tr>
        <td align=center>추가DATA정보</td>
        <td align=left><?php echo $plusInfo ?></td>
        </td>
    </tr>
    <tr>
        <td align=center>&nbsp</td>
        <td align=left>&nbsp</td>
    </tr>
    <tr width=100>
        <td align=center>요청정보(암호화)</td>
        <td align=left>
			<?php echo substr($enc_tr_cert,0,50) ?>...
        </td>
    </tr>
    <tr>
        <td align=center>결과수신URL</td>
        <td align=left><?php echo $tr_url ?></td>
    </tr>
    <tr>
        <td align=center>IFrame사용여부</td>
        <td align=left><?php echo $tr_add ?></td>
    </tr>	
</table>

<!-- KMC 본인확인서비스 요청 form --------------------------->
<form name="reqKMCISForm" method="post" action="#">
    <input type="hidden" name="tr_cert"     value = "<?php echo $enc_tr_cert ?>">
    <input type="hidden" name="tr_url"      value = "<?php echo $tr_url ?>">
	<input type="hidden" name="tr_add"      value = "<?php echo $tr_add ?>">
    <input type="submit" value="KMC 본인확인서비스 요청"  onclick= "javascript:openKMCISWindow();">
</form>
<BR>
<BR>
<!--End KMC 본인확인서비스 요청 form ----------------------->

<br>
<br>
  이 Sample화면은 KMC 본인확인서비스 요청화면 개발시 참고가 되도록 제공하고 있는 화면입니다.<br>
<br>
</center>
</BODY>
</HTML>