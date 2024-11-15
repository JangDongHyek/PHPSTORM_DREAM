<?
/*
공용 메일 발송 루틴
$email_list : 메일목록(배열)
$mail_subject : 메일 제목
$mail_title : 메일 타이틀
$mail_from_name : 보내는 사람
$mail_content : 메일 내용
*/
	// 중복된 이메일 제거 
	$email_list = array_unique($email_list);
	
	if(count($email_list)>0) {

		// 메일 스킨 적용
		ob_start();
			include($skin_board_path."mail.php");
		$mail_body = ob_get_contents(); 
		ob_end_clean();
		
		// 메일 발송
		foreach ($email_list as $email) {
			rg_mail("$rg_name<{$rg_email}>","$email","","",$mail_subject,$mail_body);
		}
	}
?>