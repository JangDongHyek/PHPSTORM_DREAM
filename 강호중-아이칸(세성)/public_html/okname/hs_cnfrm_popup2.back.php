<?php
	header('Content-Type: text/html; charset=euc-kr');
	/**************************************************************************
	 * ���ϸ� : hs_cnfrm_popup2.php
	 *
	 * ����Ȯ�μ��� ���� ���� �Է� ȭ��
	 *    (�� �������� KCB�˾�â���� �Է¿�)
	 *
	 * ������
	 * 	���� ��ÿ��� 
	 * 	response.write�� ����Ͽ� ȭ�鿡 �������� �����͸� 
	 * 	�����Ͽ� �ֽñ� �ٶ��ϴ�. �湮�ڿ��� ����Ʈ�����Ͱ� ����� �� �ֽ��ϴ�.
	 **************************************************************************/



	$tel_no = $_POST["tel_no1"]."-".$_POST["tel_no2"]."-".$_POST["tel_no3"];
	$tel_no2 = $_POST["tel_no1"].$_POST["tel_no2"].$_POST["tel_no3"];


	include "../connect.php";
	$SQL = "select mobile from item where mobile='$tel_no' or mobile='$tel_no2'";

	$dbresult = mysql_query($SQL, $dbconn);
	$tot1 = mysql_num_rows($dbresult);

	if($tot1 > 0){
		echo ("<script>alert('�̹̰��Ե� �޴��� ��ȣ�Դϴ�.'); self.close();</script>");
		exit;
	}



	// ���񽺰ŷ���ȣ�� �����Ѵ�.
	function generateSvcTxSeqno() {   
		$numbers  = "0123456789";   
		$svcTxSeqno = date("YmdHis");   
		$nmr_loops = 6;   
		while ($nmr_loops--) {   
			$svcTxSeqno .= $numbers[mt_rand(0, strlen($numbers)-1)];   
		}   
		return $svcTxSeqno;   
	}   

	/**************************************************************************
	 * okname ����Ȯ�μ��� �Ķ����
	 **************************************************************************/
	$name = "x";							// ����
	$birthday = "x";						// ������� 
	$sex = "x";								// ����
	$nation="x";							// ���ܱ��α��� 
	$telComCd="x";							// �̵���Ż��ڵ� 
	$telNo="x";								// �޴�����ȣ 

	/**************************************************************************
	 * �Ķ���Ϳ� ���� ��ȿ�����θ� �����Ѵ�.
	 **************************************************************************/
	$inTpBit = $_POST["in_tp_bit"];	// �Է±����ڵ�(0:����, 1:�⺻����, 2:���ܱ���, 4:�޴�������)
	if (preg_match('~[^0-9]~', $inTpBit, $match)) {
		echo ("<script>alert('�Է±����ڵ忡 ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
		exit;
	}
	$inTpBitVal = intval($inTpBit, 0);

	if (($inTpBitVal & 1) == 1) {
		$name = $_POST["name"];				// ����
		if (preg_match('~[^\xA1-\xFEa-zA-Z ]~', $name, $match)) {	// EUC-KR�� ���
			echo ("<script>alert('���� ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
	}
	
	if (($inTpBitVal & 2) == 2) {
		$birthday = $_POST["birthday"];		// �������
		if (preg_match('~[^0-9]~', $birthday, $match)) {
			echo ("<script>alert('������Ͽ� ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
	}
	
	if (($inTpBitVal & 4) == 4) {
		$sex = $_POST["sex"];				// ����
		$nation = $_POST["nation"];			// ���ܱ��α���
		if (preg_match('~[^01]~', $sex, $match)) {
			echo ("<script>alert('������ ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
		if (preg_match('~[^12]~', $nation, $match)) {
			echo ("<script>alert('���ܱ��� ���п� ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
	}
	
	if (($inTpBitVal & 8) == 8) {
		$telComCd = $_POST["tel_com_cd"];	// ��Ż��ڵ�
		$telNo = $tel_no;			// �޴�����ȣ
		if (preg_match('~[^0-9]~', $telComCd, $match)) {
			echo ("<script>alert('��Ż��ڵ忡 ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
		if (preg_match('~[^0-9]~', $telNo, $match)) {
			echo ("<script>alert('�޴�����ȣ�� ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
			exit;
		}
	}

	$rqstCausCd = $_POST["rqst_caus_cd"];			// ������û�����ڵ� 2byte  (00:ȸ������, 01:��������, 02:ȸ����������, 03:��й�ȣã��, 04:��ǰ����, 99:��Ÿ)
	if (preg_match('~[^0-9]~', $rqstCausCd, $match)) {
		echo ("<script>alert('������û�����ڵ忡 ��ȿ���� ���� ���ڿ��� �ֽ��ϴ�.'); self.close();</script>");
		exit;
	}

	$svcTxSeqno = generateSvcTxSeqno();	// �ŷ���ȣ. ���Ϲ��ڿ��� �ι� ����� �� ����. (�ִ� 30�ڸ��� ���ڿ�. 0-9,A-Z,a-z ���)
	
	// ########################################################################
	// # KCB�κ��� �ο����� ȸ�����ڵ�(���̵�) ���� (12�ڸ�)
	// ########################################################################
	$memId = "V37550000000";										// ȸ�����ڵ�(���̵�)

	// ########################################################################
	// # ȸ���� ��⼳ġ���� IP �� ȸ���� ������ ����
	// ########################################################################
	$serverIp = "x";					// ����� ��ġ�� ����IP (����IP������ �����Ϸ��� 'x'�� ����)
	$siteDomain = "wickhan.com";		// ȸ���� ������. (�޴���������ȣ �߼۽� ���޻�� ����)
	
	$rsv1 = "0";						// ���� �׸�
	$rsv2 = "0";						// ���� �׸�
	$rsv3 = "0";						// ���� �׸�
	
	$hsCertMsrCd = "10";				// ���������ڵ� 2byte  (10:�ڵ���)
	
	$returnMsg = "x";					// ���ϸ޽��� (������ 'x') 
	
	// ########################################################################
	// # ���� URL ����
	// ########################################################################
	// opener(hs_cnfrm_popup1.php)�� �����ϰ� ��ġ�ϵ��� �����ؾ� ��. 
	// (http://www.test.co.kr�� http://test.co.kr�� �ٸ� ���������� �ν��ϸ�, http �� https�� ��ġ�ؾ� ��)
	$returnUrl = "http://".$_SERVER['HTTP_HOST']."/okname/hs_cnfrm_popup3.php";// �������� �Ϸ��� ���ϵ� URL (������ ���� full path)
	
	// ########################################################################
	// # ���ȯ�� ���� �ʿ�
	// ########################################################################
	//$endPointURL = "http://tsafe.ok-name.co.kr:29080/KcbWebService/OkNameService";	// �׽�Ʈ ����
	$endPointURL = "http://safe.ok-name.co.kr/KcbWebService/OkNameService"; // � ���� 

	// ########################################################################
	// # �α� ��� ���� �� ���� �ο� (������)
	// ########################################################################
	$logPath = "/okname/log";

	// ########################################################################
	// # �ɼǰ��� 'D','L'�� �߰��ϴ� ��� �α�(logPath������ ������)�� ������.
	// # �ý���(ȯ�溯�� LANG����)�� UTF-8�� ��� 'U'�ɼ� �߰� ex)$option='QLU'
	// ########################################################################
	$options = "Q";		// Q:������û������ ��ȣȭ

	$cmd = array($svcTxSeqno, $name, $birthday, $sex, $nation, $telComCd,
				$telNo, $rsv1, $rsv2, $rsv3, $returnMsg, $returnUrl, $inTpBit,
				$hsCertMsrCd, $rqstCausCd, $memId, $serverIp, $siteDomain,
				$endPointURL, $logPath, $options);
	
//	echo $cmd."<br/>";
	
	/**************************************************************************
	okname ����
	**************************************************************************/
	$output = NULL;
	//cmd ����
	$ret = okname($cmd, $output);
//	echo "ret=".$ret."<br/>";
	
	/**************************************************************************
	okname ���� ����
	**************************************************************************/
	$retcode = "";						// ����ڵ�
	$retmsg = "";						// ����޽���
	$e_rqstData = "";					// ��ȣȭ�ȿ�û������
	
	if ($ret == 0) {//������ ��� ������ ������� ����
		$result = explode("\n", $output);
		$retcode = $result[0];
		$retmsg  = $result[1];
		$e_rqstData = $result[2];
	}
	else {
		if($ret <=200)
			$retcode=sprintf("B%03d", $ret);
		else
			$retcode=sprintf("S%03d", $ret);
	}
	
	/**************************************************************************
	 * hs_cnfrm_popup3.php ���� ����
	 **************************************************************************/
	$targetId = "";		// Ÿ��ID (����� ������ �˾��� ���� ���� ��� �ش� �˾���(window.name ������)�� ����. �Ϲ������� ""���� ����)

	// ########################################################################
	// # ���ȯ�� ���� �ʿ�
	// ########################################################################
	//$commonSvlUrl = "https://tsafe.ok-name.co.kr:2443/CommonSvl";	// �׽�Ʈ URL
	$commonSvlUrl = "https://safe.ok-name.co.kr/CommonSvl";	// � URL
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>KCB ����Ȯ�μ��� ����</title>
<script>
	function request(){
		window.name = "<?=$targetId?>";

		document.form1.action = "<?=$commonSvlUrl?>";
		document.form1.method = "post";

		document.form1.submit();
	}
</script>
</head>

<body>
	<form name="form1">
	<!-- ���� ��û ���� -->
	<!--// �ʼ� �׸� -->
	<input type="hidden" name="tc" value="kcb.oknm.online.safehscert.popup.cmd.P901_CertChoiceCmd">				<!-- ����Ұ�-->
	<input type="hidden" name="rqst_data"				value="<?=$e_rqstData?>">		<!-- ��û������ -->
	<input type="hidden" name="target_id"				value="<?=$targetId?>">				<!-- Ÿ��ID --> 
	<!-- �ʼ� �׸� //-->	
	</form>
<?php
 	if ($retcode == "B000") {
		//������û
		echo ("<script>request();</script>");
	} else {
		//��û ���� �������� ����
		echo ("<script>alert(\"$retcode\"); self.close();</script>");
	}
?>
</body>
</html>
