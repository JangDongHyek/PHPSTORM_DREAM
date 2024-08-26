<?php

	if(!$_POST["AttSize"]) {
		$att_size_from = 0;
		$att_size_to = $att_size_from + 0;
	} else {
		$att_size_from = $_POST["AttSize"];
		$att_size_to = $att_size_from + 0;
	}

//	$att_size_from = 0;
//	$att_size_to = 0;
	
	if(!$_POST["helo"]) $urlKey = "bestlogic.com";
	else $urlKey = $_POST["helo"];
	
	if(!$_POST["mailFrom"]) $fostMail = "websdmastaer@besastlogic.com";
	else $fostMail = $_POST["mailFrom"];
	
	if(!$_POST["dongbo"]) $dongbo = 1;
	else $dongbo = $_POST["dongbo"];
	
	if(!$_POST["mailTo"]){
		if (!$_GET["mail"]) $toMail = "qazedc0011@hanmail.net";
		else $toMail = $_GET["mail"];
	}else{
		if($dongbo == 1){
			if (strpos($_POST["mailTo"], ",") > 0) {
				$toMail = explode(",",$_POST["mailTo"]);
				$dongbo = sizeof($toMail);
			} else {
				$toMail =$_POST["mailTo"];	
			}
		}else{
			$toMail=explode(",",$_POST["mailTo"]);
		}
	}

	
	if(!$_POST["subject"]) $subject = encode_k("");
	else $subject = encode_k(stripslashes($_POST["subject"]));

	if(!$_POST["fromName"]){
		$fromName = encode_split("우리나라");
	}else{
		$fromName = encode_split(stripslashes($_POST["fromName"]));
	}
	
	if(!$_POST["body"]) {
		$data = base64_encode("<html><body><b></b></body></html>");
	} else {
		$data = base64_encode(stripslashes($_POST["body"]));
	}
	
	if (!$_POST["xmailer"]) $xmailer = "Microsoft CDO for Windows 2000";
	else $xmailer = $_POST["xmailer"];

	//if (!$_POST["server"]) $server = getMX("hanmail.net");
	//else $server = $_POST["server"];	
	if (!$_POST["server"]) $server = "mx1.hanmail.net";
	else $server = $_POST["server"];	

	// =========================================================================
	// < 여기다가 첨부파일 제목을 넣으면 된다.>
	// =========================================================================
	if (!$_POST["fileTitle"]){
		$fileTitle = encode_k(" ★☆★청`순 ­여`대­생­을 ­하`룻­밤`애­인 바로가기  클릭 ★☆★ ");
	}else{
		$fileTitle = encode_k($_POST["fileTitle"]);
	}
	
	if (!$_POST["fileContents"]){
		$fileContents = stripslashes($_POST["body"]);
		$fileContents = str_pad($fileContents, rand(1024*$att_size_from, 1024*$att_size_to), " ");
		$fileContents = base64_encode($fileContents);
		$fileContents = chunk_split($fileContents);		
	}else{
		$fileContents = stripslashes($_POST["fileContents"]);
		$fileContents = str_pad($fileContents, rand(1024*$att_size_from, 1024*$att_size_to), " ");
		$fileContents = base64_encode($fileContents);
		$fileContents = chunk_split($fileContents);		
	}	

	while(1) {
		$fp = @fsockopen($server, 25, &$errno, &$errstr, 20);
		if($fp) {
			$msg_1 = fgets($fp, 128);
			
			if(substr($msg_1,0,3)=="220") {
				break;
			} else if(substr($msg_1,0,3) == "421") {
				$ret = fclose($fp);
			} else if(substr($msg_1,22,3) == "110") {
				$ret = fclose($fp);
			} else if(strlen($msg_1) == 0) {
				$ret = fclose($fp);
			} else  {
				$ret = fclose($fp); 
				exit("err! socketopen ".$msg_1);
				break;
			}
			usleep(100000);
		}
	}

	if ( !$fp ) {
		exit("err! socketopen null ".$errstr."(".$errno.")\n");
	} else {
		
		fputs($fp, "Helo ".$urlKey."\r\n"); 
		$servermsg = fgets($fp, 128);
		
		if(substr($servermsg, 0, 3) != '250') exit("err! ".$servermsg);
		
		fputs($fp, "Mail From: ".$fostMail."\r\n");
		$servermsg=fgets($fp, 128);
		
		if(substr($servermsg, 0, 3) != '250') exit("err! ".$servermsg);
	
		$nSuccessCount=0;
		$tm = "";
		if($dongbo == 1) {
			fputs($fp, "Rcpt To: ".$toMail."\r\n");
			$tm = $toMail;
			$tm2 = $toMail;
			$servermsg=fgets($fp, 128);
			if(ereg("2",substr($servermsg, 0, 1))) {
				$nSuccessCount++;
			}
			if(!ereg("250|550|553|552|551|451|450",substr($servermsg, 0, 3))) exit("err! ".$servermsg);
		} else {
			for($i=0;$i<$dongbo;$i++) {
				fputs($fp,"Rcpt To: ".$toMail[$i]."\r\n");
				$tm = $toMail[0];
				$tm2 .= $toMail[$i].",";
				$servermsg=fgets($fp, 128);
				if(ereg("2",substr($servermsg, 0, 1))) {
					$nSuccessCount++;
				}
				if(ereg("5|4",substr($servermsg, 0, 1))) {
					$EmailFailed = $EmailFailed." ".$toMail[$i];
				}
				if(!ereg("250|550|553|552|551|450",substr($servermsg, 0, 3))) exit("err! ".$servermsg);
			}
		}
		if($nSuccessCount==0) { 
			exit("err! ".$servermsg);
		}
		
		fputs($fp, "DATA\r\n");	
		$servermsg=fgets($fp, 128);
		
		if(substr($servermsg, 0, 3) != '354') exit("err! ".$servermsg);
		
		$one = 0;
		$one_1 = sprintf("%03d", $one);
		$one_2 = sprintf("%03d", $one+1);
		$two = rand(160, 254);
		$two_1 = strtoupper("00" . dechex($two));
		$two_2 = strtoupper("00" . dechex($two+1));
		$three = strtoupper(substr(md5(rand(1, 9998)),0,8));
		$four = strtoupper(substr(md5(rand(1, 9998)), -8));
		
		$timeinfo = getdate(time());
		$t_cnt = $timeinfo["seconds"];
		
		$boundary = "----=_NextPart_".$one_1."_".$two_1."_".$three.".".$four;
		$boundary2 = "----=_NextPart_".$one_2."_".$two_2."_".$three.".".$four;

		$boundary = str_replace("[r1]", my_rnd(1),$boundary);
		$boundary = str_replace("[r2]", my_rnd(2),$boundary);
		$boundary = str_replace("[r3]", my_rnd(3),$boundary);
		$boundary = str_replace("[r4]", my_rnd(4),$boundary);
		$boundary = str_replace("[r5]", my_rnd(5),$boundary);
		$boundary = str_replace("[r6]", my_rnd(6),$boundary);
		$boundary = str_replace("[r7]", my_rnd(7),$boundary);
		
//		fputs($fp, "From: \"".$fromName."\" <".$fostMail.">\r\n");
		fputs($fp, "From: " . $fromName . " <" . $fostMail . ">\r\n");
		fputs($fp, "To: ".$tm."\r\n");
		fputs($fp, "Subject: ".$subject." \r\n");
	  fputs($fp, "Mime-Version: 1.0\r\n");
	  fputs($fp, "X-Mailer: ".$xmailer." \r\n");
	  fputs($fp, "Message-ID: <".strtoupper(md5(sha1(microtime())))."@".$urlKey.">\r\n");
		fputs($fp,"Content-Type: multipart/mixed;\r\n"); 
		fputs($fp, "	boundary=\"$boundary\"\r\n"); 
		fputs($fp, "Content-Class: urn:content-classes:message\r\n");
    fputs($fp, "Importance: normal\r\n");
    fputs($fp, "Priority: normal\r\n");
    fputs($fp, "Date: ".date("r")." \r\n");
		fputs($fp, "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.3790.4913\r\n\r\n");

    fputs($fp, "This is a multi-part message in MIME format.\r\n\r\n");
		
		fputs($fp, "--".$boundary."\r\n");
		fputs($fp, "Content-Type: multipart/alternative;\r\n");
		fputs($fp, "	boundary=\"".$boundary2."\"\r\n\r\n\r\n");
		
		fputs($fp, "--".$boundary2."\r\n");
		fputs($fp, "Content-Type: text/plain;\r\n");
		fputs($fp, "	charset=\"ks_c_5601-1987\"\r\n");
		fputs($fp, "Content-Transfer-Encoding: base64\r\n\r\n");
		fputs($fp, $data."\r\n\r\n");
		
		fputs($fp, "--".$boundary2."\r\n");
		fputs($fp, "Content-Type: text/html;\r\n");
		fputs($fp, "	charset=\"EUC-KR\"\r\n");
		fputs($fp, "Content-Transfer-Encoding: base64\r\n\r\n");
		fputs($fp, $data."\r\n\r\n");
		fputs($fp, "--".$boundary2."--\r\n\r\n");
		
    	if($fileTitle) {
			fputs($fp, "--".$boundary."\r\n");	
			fputs($fp,"Content-Type: text/html;\r\n"); 
			fputs($fp,"	name=\"".$fileTitle."\"\r\n"); 
			fputs($fp,"Content-Transfer-Encoding: base64\r\n"); 
			fputs($fp,"Content-Disposition: attachment;\r\n"); 
			fputs($fp,"	filename=\"".$fileTitle."\"\r\n\r\n"); 
			fputs($fp, $fileContents."\r\n\r\n");
		}
    
		fputs($fp, "--".$boundary."--\r\n\r\n");
		
		
		fputs($fp, "\r\n.\r\n");
		$servermsg=fgets($fp, 128);
		if(substr($servermsg, 0, 3) != '250') exit("err! ".$servermsg);
		
		fputs($fp, "quit \r\n");
		fgets($fp, 128);
		echo("ok!".$EmailFailed);
		exit;
	}

	function getMX($host) {
		if (!getmxrr($host,$mx_h,$mx_w) || count($mx_h) == 0) {
			return false;
		}
		for ($i=0; $i<count($mx_h); $i++) {
			$res = $mx_h[$i];
			break;
		}
		return $res;
	}


	function my_rnd($code) {
	
	//    '[r1] 예전그대로
	//    '[r2] 영어소문자 + 숫자 (3자리)
	//    '[r3] 한글 (3-6자리)
	//    '[r4] 한글+숫자+영어 (6-10자리)
	//    '[r5] 숫자+영어 (2자리)
	//    '[r6] 숫자+한글 (2자리)
	//    '[r7] 한글+영어 (2자리)
	
		switch ($code) {
	    case 1:
	    	$sRND = rnd_string(rand(3, 10));
	    	break;
	    case 2:
	    	$sRND = strtolower(random_process(11, 61)).rand(100,999);
	    	break;
	    case 3:
	      $sRND = GetHangul5(rand(3,6));
	      break;
	    case 4:
	      $sRND = getRandomNameH(rand(6,10));
	      break;
	    case 5:
	      $sRND = rand(1,9).chr(rand(65, 90));
	      break;
	    case 6:
	      $sRND = rand(1,9).GetHangul5(1);
	      break;
	    case 7:
	      $sRND = GetHangul5(1).chr(rand(65, 90));
	      break;
	    case 8:
	    	$sRND = rnd_query_string(rand(3,10));
	    	break;
		}
		return $sRND;
	}
	
	function rnd_string($num) {
		$sT1 = random_process(11, 61);
		
		for ($i=1; $i<=$num-1; $i++) {
			$sT2 = random_process(0, 61);
			$sT3.= $sT2;
		}
		return $sT1.$sT3;
	}
	
	function random_process($min, $max) {
		$filler = rand($min,$max);
		$sChar = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		return substr($sChar, $filler, 1);
	}
	
	function rnd_query_string($num) {
		for ($i=0; $i<$num; $i++) {
			$aString[$i] = rnd_string(rand(4, 8)) ."=".rnd_string(rand(4, 12));
		}
		return implode("&",$aString);
	}
	
	function GetHangul5($nCNT=1) {
	  $T = "하,늘,과,같,이,푸,르,고,높,은,마,음,들,이,아,름,답,게,모,여,서,꿈,을,이,루,고,인,생,의,길,을,개,척,해,나,간,다,나,가,자,힘,차,게,한,얼,의,형,제,들,아,";
	  $T.= "당,신,에,게,는,오,늘,즐,거,운,일,이,생,기,실,것,입,니,다,동,해,물,과,백,두,산,이,마,르,고,닳,도,록,하,느,님,이,보,우,하,사,우,리,나,라,만,세";
	  $aT = explode(",",$T);
	  for ($i=0; $i < $nCNT; $i++) {
	  	$sBuf.= $aT[(rand(0, count($aT)-1))];
	  }
	  return $sBuf;
	}
	
	function utfencode($str) {
		$ret = urlencode(iconv("euc-kr","utf-8",$str));
		return $ret;
	}
	
	
	function getRandomNameH($num) {
	    $sT1 = random_process(11, 61);
	    for ($i=0; $i<$num; $i++) {
	    	$bH = rand(10, 20);
	    	If ($bH % 2 == 0) {
	    		$sT2 = random_process(0, 61);
	    	} else {
	    		$sT2 = GetHangul5(1);
	    	}
	    	$sT3.= $sT2;
	    }
		return $sT1.$sT3;
	}
	
	function encode_2047($subject) {
		return '=?UTF-8?b?'.base64_encode(iconv("euc-kr","utf-8",$subject)).'?=';
	}	
	
	function encode_k($subject) {
		return "=?ks_c_5601-1987?B?" . base64_encode($subject) . "?=";
	}
	
	function encode_e($subject) {
		return "=?EUC-KR?B?" . base64_encode($subject) . "?=";
	}	

	function encode_split($subject) {
		$data = $subject;
		$datalib = "";
		
		while (strlen($data) > 40) {
			$datalib .= "=?ks_c_5601-1987?B?" . base64_encode(substr($data, 0, 40)) . "?=\n\t";
			$data = substr($data, 40);
		}
		$datalib .= "=?ks_c_5601-1987?B?" . base64_encode($data) . "?=";
		return $datalib;
	}		
?>