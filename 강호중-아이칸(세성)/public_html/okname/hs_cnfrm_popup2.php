<?php
	header('Content-Type: text/html; charset=euc-kr');
	if (!function_exists('json_decode')) {
    function json_decode($json,$bool) {
      $comment = false;
      $out    = '$x=';
      for ($i=0; $i<strlen($json); $i++) {
        if (!$comment) {
          if (($json[$i] == '{') || ($json[$i] == '[')) {
            $out .= 'array(';
          }
          elseif (($json[$i] == '}') || ($json[$i] == ']')) {
            $out .= ')';
          }
          elseif ($json[$i] == ':') {
            $out .= '=>';
          }
          elseif ($json[$i] == ',') {
            $out .= ',';
          }
          elseif ($json[$i] == '"') {
            $out .= '"';
          }
          /*elseif (!preg_match('/\s/', $json[$i])) {
            return null;
          }*/
        }
        else $out .= $json[$i] == '$' ? '\$' : $json[$i];
        if ($json[$i] == '"' && $json[($i-1)] != '\\') $comment = !$comment;
      }
      eval($out. ';');
      return $x;
    }
  }
  include "../connect.php";
    $tel_no = $tel_no1.$tel_no2.$tel_no3;
	$SQL = "select mobile from item where mobile='$tel_no' and item_name = '$name'"; 
	$dbresult = mysql_query($SQL, $dbconn);
	$tot1 = mysql_num_rows($dbresult);

	if($tot1 > 0){
		echo ("<script>alert('�̹̰��Ե� �޴��� ��ȣ�Դϴ�.'); self.close();</script>");
		exit;
	}
    //**************************************************************************
	// ���ϸ� : phone_popup2.php
	// - �˾�������
	// �޴��� ����Ȯ�� ���� ���������� ȣ�� ȭ��
    //
    // ������
    // 	���� ��ÿ��� ȭ�鿡 �������� �����͸� �����Ͽ� �ֽñ� �ٶ��ϴ�.
    // 	�湮�ڿ��� ����Ʈ�����Ͱ� ����� �� �ֽ��ϴ�.
    //**************************************************************************
	
	/**************************************************************************
	 * okcert3 �޴��� ����Ȯ�� ���� �Ķ����
	 **************************************************************************/
	 
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' ȸ���� ����Ʈ��, URL
    //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	$SITE_NAME	=	"wickhan.com";
	$SITE_URL 	=   "www.wickhan.com";
	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' KCB�κ��� �ο����� ȸ�����ڵ�(���̵�) ���� (12�ڸ�)
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	$CP_CD = "V37550000000";
	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    //' ���� URL ����
    //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' opener(phone_popup1.php)�� �����ϰ� ��ġ�ϵ��� �����ؾ� ��. 
	//' (http://www.test.co.kr�� http://test.co.kr�� �ٸ� ���������� �ν��ϸ�, http �� https�� ��ġ�ؾ� ��)
	$RETURN_URL = "http://".$_SERVER['HTTP_HOST']."/okname/hs_cnfrm_popup3.php";// ���� �Ϸ� �� ���ϵ� URL (������ ���� full path)
	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' ������û�����ڵ� (���̵� ���� ����)
    //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	$RQST_CAUS_CD ="00";
	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' ä�� �ڵ� (���鰡��. �ʿ��� ȸ���翡���� �Է�)
    //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//$CHNL_CD	=	$_REQUEST["CHNL_CD"];	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//' ���ϸ޽��� (���鰡��. returnUrl���� ���� ���޹ް��� �ϴ� ���� �ִٸ� ����.)
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	//$RETURN_MSG = "";
	
	// ########################################################################
	// # Ÿ�� �� �����˾�URL : �/�׽�Ʈ ��ȯ�� ���� �ʿ�
	// ########################################################################
	$target = "PROD";	// �׽�Ʈ="TEST", �="PROD"
	//$popupUrl = "";	// �׽�Ʈ URL
	$popupUrl = "https://safe.ok-name.co.kr/CommonSvl";	// � URL
	
	//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    //' ���̼��� ����
    //'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
	$license = "/home/khj/public_html/okname/".$CP_CD."_IDS_01_".$target."_AES_license.dat";
	
	/**************************************************************************
	okcert3 request param JSON String
	**************************************************************************/
	$params  = '{ "CP_CD":"'.$CP_CD.'",';
	$params .= '"RETURN_URL":"'.$RETURN_URL.'",';
	$params .= '"SITE_NAME":"'.$SITE_NAME.'",';
	$params .= '"SITE_URL":"'.$SITE_URL.'",';
	
	//$params .= '"CHNL_CD":"'.$CHNL_CD.'",';
	//$params .= '"RETURN_MSG":"'.$RETURN_MSG.'",';

	//' �ŷ��Ϸù�ȣ�� �⺻������ ��� ������ �ڵ� ä���ǰ� ä���� ���� ��������.
	//'	ȸ���簡 ���� ä���ϱ� ���ϴ� ��쿡�� �Ʒ� �ڵ带 �ּ� ���� �� ���.
	//' �� �ŷ����� �ߺ� ���� $�� �����Ͽ� �Է�. �ִ����:20����Ʈ
	//$params .= '"TX_SEQ_NO":"'."123456789012345".'",'; 
	
	$params .= '"RQST_CAUS_CD":"'.$RQST_CAUS_CD.'" }';
	
	
	$svcName = "IDS_HS_POPUP_START";
	$out = NULL;
	
	// okcert3 ����
	//$ret = okcert3_u($target, $CP_CD, $svcName, $params, $license, $out);	// UTF-8
	$ret = okcert3($target, $CP_CD, $svcName, $params, $license, $out);		// EUC-KR
	
	/**************************************************************************
	okcert3 ���� ����
	**************************************************************************/
	$RSLT_CD = "";						// ����ڵ�
	$RSLT_MSG = "";						// ����޽���
	$MDL_TKN = "";						// �����ū
	$TX_SEQ_NO = "";					// �ŷ��Ϸù�ȣ
	
	if ($ret == 0) {// �Լ� ���� ������ ��� ������ ������� ����
		$out = iconv("euckr","utf-8",$out);		// ���ڵ� icnov ó��. okcert3 ȣ��(EUC-KR)�� ��쿡�� ��� (json_decode�� UTF-8�� ����)
		$output = json_decode($out,true);		// $output = UTF-8
		
		$RSLT_CD = $output['RSLT_CD'];
		$RSLT_MSG  = iconv("utf-8","euckr", $output["RSLT_MSG"]);	// �ٽ� EUC-KR �� ��ȯ
		
		if(isset($output["TX_SEQ_NO"])) $TX_SEQ_NO = $output["TX_SEQ_NO"]; // �ʿ� �� �ŷ� �Ϸ� ��ȣ �� ���Ͽ� DB���� ���� ó��
		
		if( $RSLT_CD == "B000" ) { // B000 : �����
			$MDL_TKN = $output['MDL_TKN']; 
		}
	}
	else {
		echo ("<script>alert('Fuction Fail / ret: ".$ret."'); self.close();</script>");
	}
?>
<title>KCB �޴��� ����Ȯ�� ���� ���� 2</title>
<script>
	function request(){
		document.form1.action = "<?=$popupUrl?>";
		document.form1.method = "post";

		document.form1.submit();
	}
</script>
</head>

<body>
	<form name="form1">
	<!-- ���� ��û ���� -->
	<!--// �ʼ� �׸� -->
	<input type="hidden" name="tc" value="kcb.oknm.online.safehscert.popup.cmd.P931_CertChoiceCmd"/>		<!-- ����Ұ�-->
	<input type="hidden" name="cp_cd" value="<?=$CP_CD?>">	<!-- ȸ�����ڵ� -->
	<input type="hidden" name="mdl_tkn" value="<?=$MDL_TKN?>">	<!-- �����ū --> 
	<input type="hidden" name="target_id" value="">	
	<!-- �ʼ� �׸� //-->	
	</form>
<?php
 	if ($RSLT_CD == "B000") {
		//������û
		echo ("<script>request();</script>");
	} else {
		//��û ���� �������� ����
		echo ("<script>alert('".$RSLT_CD." : ".$RSLT_MSG."'); self.close();</script>");
	}
?>
</body>
</html>
