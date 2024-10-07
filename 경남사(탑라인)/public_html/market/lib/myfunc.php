<?
//----------------------------------------------------------
//	���� �̸� : myfunc
//	���� : �⺻�� �Ǵ� �Լ� ���� ����
//	��Ʈ : 
//	�����丮 : ����						- ������ : 2006. 1. 11
//	Copyright �� 2006 Color. All rights reserved
//----------------------------------------------------------
// W3C P3P �Ծ༳��
    @header ("P3P: CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");

	/*******************************************************************************
 	 * ���� ������ ������ register_globals_on�϶� ���� �� ����
 	 ******************************************************************************/
 	@error_reporting(E_ALL ^ E_NOTICE);
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SERVER); 
	@extract($_ENV);

	// ���â��
	function alert($msg)
	{
		echo "<script language=javascript>
					alert('$msg');
				</script>";
		exit;
	}

	// ���â�� ��
	function alertBack($msg)
	{
		echo "<script language=javascript>
					alert('$msg');
					history.go(-1);
				</script>";
		exit;
	}

	// ���â �� ���� URL�� �̵�
	function alertRedirect($msg, $url)
	{
		if(!empty($msg))
		{
			echo "
				<script language=javascript>
					alert(\"$msg\");
				</script>
				";
		}
		echo "<meta http-equiv='refresh' content=\"0;URL=$url\">";
		exit;
	}

	// ���â�� â�ݱ�
	function alertClose($msg)
	{
		echo "<script language=javascript>
					alert('$msg');
					self.close();
				</script>";
		exit;
	}
	
	function redirect($url)
	{
		echo "<meta http-equiv='refresh' content=\"0;URL=$url\">";
		exit;
	}

	function historyGo($go)
	{
		echo "<script language=javascript>
					history.go($go);
				</script>";
		exit;
	}

	// �ð� üũ���ϴ� �Լ�
	function getMicrotime() 
	{ 
		$time = explode( " ", microtime()); 
		$usec = (double)$time[0]; 
		$sec = (double)$time[1]; 

		return $sec + $usec; 
	}

	// calculate time
	function mtime_diff($ts, $te) 
	{ 
		return sprintf("%2.2f" ,$te - $ts);
	}

	// �ѱ۷� �� ����� �ڸ���.
	function hanCut($str, $len) {
		if ($len >= strlen($str)) return $str;
		$klen = $len - 1;
		while(ord($str[$klen]) & 0x80) $klen--;
		return substr($str, 0, $len - (($len + $klen + 1) % 2)) ."..";
	}

	function sendMail($type, $to, $to_name, $from, $from_name, $subject, $comment, $cc="", $bcc="")
	{
		$recipient = "$to_name <$to>";
//		$recipient = "$to";

//		if($type==1) $comment = nl2br($comment);
		$headers = "From: $from_name <$from>\n";
		$headers .= "X-Sender: <$from>\n";
		$headers .= "X-Mailer: PHP ".phpversion()."\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "Return-Path: <$from>\n";

		if(!$type) $headers .= "Content-Type: text/plain; ";
		else $headers .= "Content-Type: text/html; ";
		$headers .= "charset=euc-kr\n";

		if($cc)  $headers .= "cc: $cc\n";
		if($bcc)  $headers .= "bcc: $bcc";

		$comment = stripslashes($comment);
		$comment = str_replace("\n\r","\n", $comment);

		return mail($recipient , $subject, $comment, $headers);
//		return mail($recipient, "�׽�Ʈ", "�׽�Ʈ", $headers);
	}

	// ����� �̿��� �۾��� ����
	function wrest()
	{
		if(!eregi($_SERVER[HTTP_HOST],$_SERVER[HTTP_REFERER])) AlertBack("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");
		if(getenv("REQUEST_METHOD") == 'GET' ) AlertBack("���������� ���� ���ñ� �ٶ��ϴ�","");		
	}

	function multiFileUpload($file_form_name, $save_file_path="files/", $new_file_name="")
	{
		$arr_files = array(array());
		$files = $_FILES[$file_form_name];
		$files_count = count($files['name']);
		$files_keys = array_keys($files);

		if(!is_dir($save_file_path))
		{
			@mkdir($save_file_path, 0707);
			@chmod($save_file_path, 0707);
		}

		$max_size=ini_get("upload_max_filesize");

		if(!is_numeric($unit=substr($max_size, -1)))
		{
			$max_size = substr($max_size, 0, strlen($max_size)-1);
			if(strtoupper($unit)=="M")
				$max_size *= 1024*1024;
			elseif(strtoupper($unit)=="K")
				$max_size = substr($max_size, 0, strlen($max_size)-1)*1024;
		}

		for ($i=0; $i<$files_count; $i++) {
			foreach ($files_keys as $key) {
				$arr_files[$i][$key] = $files[$key][$i];
			}

			switch ($arr_files[$i]['error']) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_INI_SIZE:
					$msg = "������ ���ε� ���� �뷮������ �ʰ� �߽��ϴ�. (".ini_get("upload_max_filesize").") in php.ini.\\n\\n���������ڿ��� ���� �ϼ���.";
					rg_href('',$msg,'','back');
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$msg = ("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.");
					rg_href('',$msg,'','back');
					break;
				case UPLOAD_ERR_PARTIAL:
					$msg = ("The uploaded file was only partially uploaded.");
					rg_href('',$msg,'','back');
					break;
				case UPLOAD_ERR_NO_FILE:
					//$msg = ("No file was uploaded.");
					//rg_href('',$msg,'','back');
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$msg = ("Missing a temporary folder.");
					rg_href('',$msg,'','back');
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$msg = ("Failed to write file to disk");
					rg_href('',$msg,'','back');
					break;
				default:
					$msg = ("Unknown File Error");
					rg_href('',$msg,'','back');
			}

			$arr_files[$i]['name'] = $new_file_name."_".$i."_".str_replace(" ","_",$arr_files[$i]['name']);

			if(!@move_uploaded_file($arr_files[$i]['tmp_name'], $save_file_path.$arr_files[$i]['name']))
			{
				$arr_files[$i]['name'] = false;
				$arr_files[$i]['size'] = 0;
			}
		}
		return $arr_files;
	}

?>
