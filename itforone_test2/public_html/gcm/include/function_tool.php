<?php
if(!defined('__HHGYU__')) exit();

class Function_Tool{

	function &getInstance() {
		static $theInstance = null;
		if(!$theInstance) $theInstance = new Function_Tool();

		return $theInstance;
	}

	function dataToNewRequest($data){
		$string = "";
		$start_ad = explode(" ",$data['start_point_address']);
		$start_ad = $start_ad[0] . " " . $start_ad[1];
		$end_ad = explode(" ",$data['end_point_address']);
		$end_ad = $end_ad[0] . " " . $end_ad[1];
		
		$string = $start_ad . " → " . $end_ad . "\r\n";
		$string .= $data['car_sort'] . " " . $data['weight'] . " " . $data['price'] . " 만원\r\n";
		$string .= $data['km'] . "km\r\n" . $this->strcut_utf8($data['etc'],100) . "\r\n";
		return $string;
	}

	function dataToNewComment($data,$member_data){
		$string = "\r\n";
		$string = $member_data['name'] . "님의 댓글\r\n";
		$string .= $this->strcut_utf8($data['etc']) . "\r\n";
		return $string;
	}

	function dataToONEandONE($data,$member_data){
		$string = "";
		$string = $member_data['name'] . "님의 문의글\r\n";
		$string .= "제목 : " . $data['title'] . "\r\n";
		$string .= "답변 완료 : " .($data['is_success'] == 'Y'? "답변 완료":"답변 준비중") . "\r\n";
		$string .= "내용\r\n" . $this->strcut_utf8($data['content']) . "\r\n";
		return $string;
	}

	function dataToONEandONE_Comment($data,$member_data,$prefix = "답변"){
		$string = "\r\n";
		$string = $member_data['name'] . "님의 {$prefix}\r\n";
		$string .= "내용\r\n" . $this->strcut_utf8($data['content']) . "\r\n";
		return $string;
	}

	function dataToNotice($data,$member_data){
		$string = "";
		$string .= "제목 : " . $data['title'] . "\r\n";
		$string .= "내용\r\n" . $this->strcut_utf8($data['content']) . "\r\n";
		return $string;
	}

	function strcut_utf8($str, $len=200, $checkmb=false, $tail='...') {
		preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

		$m    = $match[0];
		$slen = strlen($str);  // length of source string
		$tlen = strlen($tail); // length of tail string
		$mlen = count($m); // length of matched characters
		
		if ($slen <= $len) return $str;
		if (!$checkmb && $mlen <= $len) return $str;
		
		$ret   = array();
		$count = 0;
		
		for ($i=0; $i < $len; $i++) {
			$count += ($checkmb && strlen($m[$i]) > 1)?2:1;
		
			if ($count + $tlen > $len) break;
			$ret[] = $m[$i];
		}
		
		return join('', $ret).$tail;
	}

	function sendMail_ToMember_Find_Pw($member_idx, $member_data){
		$return_obj = array();
		$return_obj['change_password'] = $this->rand_string("8","13");
		$return_obj['Error'] = 0;
		$DB = &DB::getInstance();
		$config2 =  &Config::getInstance();
		$mysql_query = $DB->db;
		
		$cols = array();
		$values = array();
		$cols[] = "`password`";
		$values[] =  "md5(PASSWORD('" . $mysql_query->real_escape_string($return_obj['change_password']) . "'))";
		$query = $mysql_query->update($config2->db_info->member,$cols,$values,"`idx` = '{$member_idx}'");
		if($query != null){
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "mail.hhgyu.wo.tc";
			$mail->SMTPDebug  = 0;   
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = "hhgyu@hhgyu.wo.tc";
			$mail->Sender = "noreply@cargo.us7.kr";
			$mail->Password = "kid5-2";
			$mail->CharSet = "UTF-8";
			
			$address = $member_data['emailaddress'];
			$mail->AddAddress($address, $address);
			$mail->SetFrom('noreply@cargo.us7.kr',$config2->default_title);

			$mail->Subject = "요청하신 회원아이디/패스워드 정보입니다. ";
			
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML("<div style='line-height:180%;'><p>요청하신 계정정보는 다음과 같습니다.</p><hr><ul><li>회원아이디 : {$member_data['id']}</li><li>변경 패스워드 : <span style='color:#ff3300; font:13px Verdana;'><strong>{$return_obj['change_password']} </strong></span></li><li>이름 : {$member_data['name']}</li></ul></div>");
			
			if(!$mail->Send()) {
				//var_dump($mail);
				//$return_obj['error'] = $mail->getMessage();
				$return_obj['Error'] = 2;
			}
		}
		else{
			$return_obj['Error'] = 1;
		}
		return $return_obj;
	}

	function rand_string($min = "8", $max = "30") 
	{
		$code = NULL;
		$pass = "Q";
		for($i=1;$i<$min;$i++) 
		{
			$char = chr(rand(48,122));
			while(!ereg("[a-zA-Z0-9]", $char))
			{
				if($char == $lchar) { continue; }
				$char = chr(rand(48,90));
			}
		  $pass .= $char;
		  $lchar = $char;
		}
		return $pass;
	}
}