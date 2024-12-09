<?php
include_once('../../common.php');
$token = md5(uniqid(rand(), true));
set_session("auth_token", $token);

header('Content-Type: text/html; charset=utf-8');
//**************************************************************************
// 파일명 : phone_popup1.php
// - 바닥페이지
// 휴대폰 본인확인 서비스 요청 정보 입력 화면
//**************************************************************************

// 요청페이지 초기화
// $_SESSION['req_page'] = "";
// if ($_REQUEST["req_page"] == "find") {
// 	$_SESSION['req_page'] = "find";
// }

?>
<html>
<head>
<title>KCB 휴대폰 본인확인 서비스<</title>
<script>
<!--
	function jsSubmit(){
		//window.open("", "auth_popup", "width=430,height=640,scrollbar=yes");
		//var form1 = document.form1;
		//form1.target = "auth_popup";
		form1.submit();
	}
//-->

document.addEventListener("DOMContentLoaded", function(){
	jsSubmit();
});

</script>
</head>
<body>
	<div>
		<form name="form1" action="phone_popup2.php" method="post">
			<input type="hidden" name="CP_CD" maxlength="12" size="16" value="<?=KCB_CP_ID?>">
			<input type="hidden" name="SITE_NAME" maxlength="20" size="24" value="<?=KCB_SITE_NAME?>">
			<input type="hidden" name="req_page" value="<?=$_REQUEST['req_page']?>">
        </form>
    </div>
	
	<!-- 휴대폰 본인확인 팝업 처리결과 정보 = phone_popup3 에서 값 입력 -->
	<!--
	<form name="kcbResultForm" method="post" >
		<input type="hidden" name="CP_CD" />
		<input type="hidden" name="TX_SEQ_NO" />
		<input type="hidden" name="RSLT_CD" />
		<input type="hidden" name="RSLT_MSG" />
		
		<input type="hidden" name="RSLT_NAME" />
		<input type="hidden" name="RSLT_BIRTHDAY" />
		<input type="hidden" name="RSLT_SEX_CD" />
		<input type="hidden" name="RSLT_NTV_FRNR_CD" />
		
		<input type="hidden" name="DI" />
		<input type="hidden" name="CI" />
		<input type="hidden" name="CI2" />
		<input type="hidden" name="CI_UPDATE" />
		<input type="hidden" name="TEL_COM_CD" />
		<input type="hidden" name="TEL_NO" />
		
		<input type="hidden" name="RETURN_MSG" />
	</form>
	-->
</body>
</html>
