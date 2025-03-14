<? include_once("../../common.php"); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?php
header('Content-Type: text/html; charset=euc-kr');
//**************************************************************************
// 파일명 : phone_popup3.php
// - 팝업페이지
// 휴대폰 본인확인 서비스 인증 결과 화면(return url).
// 암호화된 인증결과정보를 복호화한다.
//**************************************************************************

/**************************************************************************
 * okcert3 본인확인 서비스 파라미터
 **************************************************************************/
/* 팝업창 리턴 항목 */
$MDL_TKN	=	$_REQUEST["mdl_tkn"];			// 모듈토큰

// ########################################################################
// # KCB로부터 부여받은 회원사코드(아이디) 설정 (12자리)
// ########################################################################
$CP_CD = KCB_CP_ID;				// 회원사코드(아이디)

//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//' 타겟 : 운영/테스트 전환시 변경 필요
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
$target = "PROD"; // 테스트="TEST", 운영="PROD"

//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
//' 라이센스 파일
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
$license = G5_PATH."/kcb/".$CP_CD."_IDS_01_".$target."_AES_license.dat";


/**************************************************************************
okcert3 request param JSON String
**************************************************************************/
$params = '{ "MDL_TKN":"'.$MDL_TKN.'" }';


$svcName = "IDS_HS_POPUP_RESULT";
$out = NULL;

// okcert3 실행
//$ret = okcert3_u($target, $CP_CD, $svcName, $params, $license, $out);  // UTF-8
$ret = okcert3($target, $CP_CD, $svcName, $params, $license, $out);  // EUC-KR

/**************************************************************************
okcert3 응답 정보
**************************************************************************/
$RSLT_CD = "";						// 결과코드
$RSLT_MSG = "";						// 결과메시지
$TX_SEQ_NO = "";					// 거래일련번호

$RSLT_NAME		= "";
$RSLT_BIRTHDAY 	= "";
$RSLT_SEX_CD	= "";
$RSLT_NTV_FRNR_CD="";

$DI				= "";
$CI				= "";
$CI_UPDATE		= "";
$TEL_COM_CD		= "";
$TEL_NO			= "";

$RETURN_MSG 	= "";				// 리턴메시지

if($ret == 0) {		// 함수 실행 성공일 경우 변수를 결과에서 얻음
	$out = iconv("euckr","utf-8",$out);		// 인코딩 icnov 처리. okcert3 호출(EUC-KR)일 경우에만 사용 (json_decode가 UTF-8만 가능)
	$output = json_decode($out,true);		// $output = UTF-8
	
	$RSLT_CD	= $output['RSLT_CD'];
	$RSLT_MSG  = iconv("utf-8","euckr", $output["RSLT_MSG"]);	// 다시 EUC-KR 로 변환
	
	if(isset($output["TX_SEQ_NO"])) $TX_SEQ_NO = $output["TX_SEQ_NO"]; // 필요 시 거래 일련 번호 에 대하여 DB저장 등의 처리
	if(isset($output["RETURN_MSG"]))  $RETURN_MSG  = $output['RETURN_MSG'];
	
	if( $RSLT_CD == "B000" ) { // B000 : 정상건
		$RSLT_NAME  = iconv("utf-8","euckr",$output['RSLT_NAME']); // 다시 EUC-KR 로 변환
		$RSLT_BIRTHDAY	= $output['RSLT_BIRTHDAY'];
		$RSLT_SEX_CD	= $output['RSLT_SEX_CD'];
		$RSLT_NTV_FRNR_CD=$output['RSLT_NTV_FRNR_CD'];
		
		$DI				= $output['DI'];
		$CI 			= $output['CI'];
		$CI_UPDATE		= $output['CI_UPDATE'];
		$TEL_COM_CD		= $output['TEL_COM_CD'];
		$TEL_NO			= $output['TEL_NO'];

        $kcb_birth_format = substr($RSLT_BIRTHDAY, 0, 4)."-".substr($RSLT_BIRTHDAY, 4, 2)."-".substr($RSLT_BIRTHDAY, 6, 2);


		set_session("TEL_NO",$TEL_NO);
        set_session("RSLT_BIRTHDAY",$kcb_birth_format);
	}
}

// 리턴페이지 (회원가입, 비밀번호찾기)
$action_url = G5_BBS_URL."/register_form.php";
if ($_SESSION['req_page'] == "find") {
	$action_url = G5_BBS_URL."/password_lost_cert.php";
}


?>
<title>KCB 휴대폰 본인확인 서비스 샘플 3</title>
<!--
<script language="javascript" type="text/javascript" >
	function fncOpenerSubmit() {
		opener.document.kcbResultForm.CP_CD.value    	= "<?=$CP_CD?>";
		opener.document.kcbResultForm.TX_SEQ_NO.value 	= "<?=$TX_SEQ_NO?>";
		opener.document.kcbResultForm.RSLT_CD.value		= "<?=$RSLT_CD?>";
		opener.document.kcbResultForm.RSLT_MSG.value	= "<?=$RSLT_MSG?>";
		opener.document.kcbResultForm.RETURN_MSG.value	= "<?=$RETURN_MSG?>";
<?php
 	if ($ret == 0) {
?>
		opener.document.kcbResultForm.RSLT_NAME.value        = "<?=$RSLT_NAME?>";
		opener.document.kcbResultForm.RSLT_BIRTHDAY.value    = "<?=$RSLT_BIRTHDAY?>";
		opener.document.kcbResultForm.RSLT_SEX_CD.value      = "<?=$RSLT_SEX_CD?>";
		opener.document.kcbResultForm.RSLT_NTV_FRNR_CD.value = "<?=$RSLT_NTV_FRNR_CD?>";
		
		opener.document.kcbResultForm.DI.value          = "<?=$DI?>";
		opener.document.kcbResultForm.CI.value          = "<?=$CI?>";
		opener.document.kcbResultForm.CI_UPDATE.value   = "<?=$CI_UPDATE?>";
		opener.document.kcbResultForm.TEL_COM_CD.value  = "<?=$TEL_COM_CD?>";
		opener.document.kcbResultForm.TEL_NO.value      = "<?=$TEL_NO?>";
<?php
	}
?>	
		opener.document.kcbResultForm.action = "phone_popup4.php";
		opener.document.kcbResultForm.submit();
		self.close();
	}	
</script>
-->
<form name="resultFrm" action="<?=$action_url?>" method="post">
	<input type="hidden" name="kcb_step" value="2">
	<input type="hidden" name="kcb_name" value="<?=$RSLT_NAME?>"><!-- 성명 -->
	<input type="hidden" name="kcb_birth" value="<?=$RSLT_BIRTHDAY?>"><!-- 생년월일 19990101 -->
	<input type="hidden" name="kcb_sex" value="<?=$RSLT_SEX_CD?>"><!-- 성별 M,F -->
	<input type="hidden" name="kcb_hp" value="<?=$TEL_NO?>"><!-- 휴대폰번호 01012345678-->
	<input type="hidden" name="kcb_cert" value="Y">
	<input type="hidden" name="kcb_telcom" value="<?=$TEL_COM_CD?>"><!-- 통신사구분 -->
</form>
<script>
function fncOpenerSubmit() {
	document.resultFrm.submit();
}
</script>

</head>
<body>
<?php
if($ret == 0) {
	//인증결과 복호화 성공
	// 인증결과를 확인하여 페이지분기등의 처리를 수행해야한다.
	if ($RSLT_CD == "B000") {
		echo ("<script>fncOpenerSubmit();</script>");
	}
	else {
		//echo ("<script>alert('본인인증실패 : ".$RSLT_CD." : ".$RSLT_MSG."'); fncOpenerSubmit();</script>");
		echo ("<script>alert('본인확인에 실패하였습니다. 다시 시도해 주세요.'); location.href = '{$action_url}'; </script>");
	}
} else {
	//인증결과 복호화 실패
	//echo ("<script>alert('인증결과복호화 실패 : ".$ret."'); self.close(); </script>");
	echo ("<script>alert('본인확인에 실패하였습니다. 다시 시도해 주세요.'); location.href = '{$action_url}'; </script>");
}
?>
</body>
</html>
