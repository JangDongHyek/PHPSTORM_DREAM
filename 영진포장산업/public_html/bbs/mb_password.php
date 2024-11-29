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

		ob_start();

		include($skin_site_path."mail_mb_password.php");
		
		$message = ob_get_contents(); 
		ob_end_clean();
		
		rg_mail("$site[st_email]","$mb_email","","","$subject","$message");

		if(!$url)$url=$site[st_join_ok_url];
		rg_href($url,"$msg_mb_password_send_ok");
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_password.php");
	include($skin_site_path."foot.php");
?>