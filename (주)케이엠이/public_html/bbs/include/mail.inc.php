<?
/*
���� ���� �߼� ��ƾ
$email_list : ���ϸ��(�迭)
$mail_subject : ���� ����
$mail_title : ���� Ÿ��Ʋ
$mail_from_name : ������ ���
$mail_content : ���� ����
*/
	// �ߺ��� �̸��� ���� 
	$email_list = array_unique($email_list);
	
	if(count($email_list)>0) {

		// ���� ��Ų ����
		ob_start();
			include($skin_board_path."mail.php");
		$mail_body = ob_get_contents(); 
		ob_end_clean();
		
		// ���� �߼�
		foreach ($email_list as $email) {
			rg_mail("$rg_name<{$rg_email}>","$email","","",$mail_subject,$mail_body);
		}
	}
?>