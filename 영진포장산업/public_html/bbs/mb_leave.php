<?
	require_once("include/lib.inc.php");
	
	if($act=='ok') {
		$login = rg_get_member_info($mb[mb_id]);
		if(!$login) { // 아이디 없음
			$msg = str_replace ("%mb_id%", $mb_id, "$msg_not_find_mb_id");
			rg_href('',$msg,'','back');		
		}
		if($login[mb_password] != get_password_str($mb_password)) { // 암호가 다름
			$msg = str_replace ("%mb_id%", $mb_id, "$msg_no_match_mb_password");
			rg_href('',$msg,'','back');		
		}
	
		$dbqry="
			SELECT count(*) as gm_gr_count
			FROM `$db_table_group_member`
			WHERE `gm_mb_num` = '$mb[mb_num]'
		";
		$rs=query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]>0) {
			rg_href('','그룹회원으로 가입이 되어 있습니다.\n그룹부터 탈퇴해주세요.','','back');		
		}
		
		// 회원파일삭제
		@unlink($member_photo_path.$login[mb_photo]);
		@unlink($member_icon_path.$login[mb_icon]);
		
		if($site[st_join_out_stat]) {
			$dbqry="
				UPDATE `$db_table_member` SET
					`mb_state` = '3'
				WHERE mb_num='$login[mb_num]'
			";
			query($dbqry,$dbcon);
		} else {
			$dbqry="
				DELETE FROM `$db_table_member`
				WHERE mb_num='$login[mb_num]'
			";
			query($dbqry,$dbcon);
			// 메모삭제
			$dbqry="
				DELETE FROM `$db_table_memo`
				WHERE mo_recv_mb_num='$login[mb_num]'
				   OR mo_send_mb_num='$login[mb_num]'
			";
			query($dbqry,$dbcon);
		}
				
		$ss_mb_id = '';
		$ss_mb_num = '';
		$ss_login_ok = '';
		session_unregister("ss_mb_id");
		session_unregister("ss_mb_num");
		session_unregister("ss_login_ok");
		
		if(!$url)$url=$site[st_logout_ok_url];
		rg_href($url);
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_leave.php");
	include($skin_site_path."foot.php");
?>