<?
	require_once("include/lib.inc.php");
	/*
	ȸ���� ��ȣ�� �������� �ٲ㼭 �̸��Ϸ� �����Ѵ�.
	����Ʈ ������ ���� �Է� �޴� �׸��� �ٸ���.
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

	
		if(mysql_num_rows($rs)==0) {// �ش�ȸ���� ����
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
			########���Ϻ�����
			$to = $mb_email;
			$toname = $mb_name;
			$subject = "���̵�� ��й�ȣ �����Դϴ�.";

			$from = "postmaster@lets080.com";
			$fromName = "������";

			$comment = "�ȳ��ϼ���! <br>$mb_name ���� ȸ�� ���̵�� ���Ӱ� ����� ��й�ȣ�Դϴ�. <br>
			Ȯ���� �� �α��� �ϼż� ��й�ȣ�� �����Ͽ� �ֽñ� �ٶ��ϴ�.<br>
			<br>
			ID : $mb_id <br>
			Password : $new_password <br>
			<br>
			 * ���� ��й�ȣ�� Ÿ�����ϱ� ���鶧 ���콺�� ����Ŭ������ Ctrl-C �� ������ �������� <br>
			 ��й�ȣ �Է�ĭ���� Ctrl-V�� ������ �����ϼ���.<br>
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
			########���Ϻ�����	
		

		rg_href($url,"$msg_mb_password_send_ok");
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_password.php");
	include($skin_site_path."foot.php");
?>
