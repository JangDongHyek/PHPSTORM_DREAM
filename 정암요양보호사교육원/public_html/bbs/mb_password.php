<?
	require_once("include/lib.inc.php");
	/*
	회원의 암호를 부작위로 바꿔서 이메일로 전송한다.
	사이트 설정에 따라 입력 받는 항목이 다르다.
	*/
	if($act=='ok') {
		if(!$mb_id || !$mb_email) {
			$msg = $msg_mb_password_required;
			rg_href('',$msg,'','back');
		}
		$dbqry="
			SELECT mb_num,mb_name,mb_id
			FROM `$db_table_member`
			WHERE mb_id='$mb_id'
				AND mb_email='$mb_email'
		";

		$rs=query($dbqry,$dbcon);

	
		if(mysql_num_rows($rs)==0) {// 해당회원이 없음
			rg_href('',$msg_mb_password_not_find,'','back');		
		}
		$R = mysql_fetch_array($rs);
		$mb_id=$R[mb_id];
		$mb_name=$R[mb_name];
		$mb_password=substr(crypt($now),-8);
		$new_password=$mb_password;
		$mb_password = get_password_str($mb_password);
		
		
		$dbqry="
			UPDATE `$db_table_member` SET
				`mb_password` = '$mb_password'
			WHERE mb_num='$R[mb_num]'
		";
		query($dbqry,$dbcon);
		$subject = str_replace ("%id%", $R[mb_id], "$msg_mb_password_mail_subject");
			########메일보내기
			$to = $mb_email;
			$toname = $mb_name;
			$subject = "아이디와 비밀번호 정보입니다.";

			$from = "postmaster@lets080.com";
			$fromName = "관리자";

			$comment = "안녕하세요! <br>$mb_name 님의 회원 아이디와 새롭게 변경된 비밀번호입니다. <br>
			확인후 곧 로그인 하셔서 비밀번호를 변경하여 주시기 바랍니다.<br>
			<br>
			ID : $mb_id <br>
			Password : $new_password <br>
			<br>
			 * 위의 비밀번호를 타이핑하기 힘들때 마우스로 더블클릭한후 Ctrl-C 를 눌러서 복사한후 <br>
			 비밀번호 입력칸에서 Ctrl-V를 눌러서 복사하세요.<br>
			";

			 
			function sendMail($type, $to, $to_name, $from, $from_name, $subject, $comment, $cc="", $bcc="")
			{
				$recipient = "$to_name <$to>";
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
			}
			$return = sendMail("1", $to, $toName, $from, $fromName, $subject, $comment);
			flush();
			########메일보내기	
		

		rg_href($url,"$msg_mb_password_send_ok");
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_password.php");
	include($skin_site_path."foot.php");
?>
