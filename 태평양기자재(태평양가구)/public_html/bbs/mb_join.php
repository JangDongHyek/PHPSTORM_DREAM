<?
	require_once("include/lib.inc.php");
	
	// 로그인 되어 있다면 
	if($_SESSION[ss_mb_id]!='') {
//		if($url==NULL) $url = $HTTP_SERVER_VARS['REQUEST_URI'];
		rg_href($site_url);
	}

	$show_join_begin = '';
	$show_join_end = '';

	$show_edit_begin = '<!--';
	$show_edit_end = '-->';

	$show = array(1=>"nick",2=>"name",3=>"email",4=>"msn",5=>"homepage",
	              6=>"tel",7=>"mobile",8=>"jumin",9=>"birth",10=>"address",
								11=>"sex",12=>"job",13=>"hobby",14=>"photo",15=>"icon",
								16=>"signature", 17=>"greet");
	foreach($show as $key => $val) {
		if($site[st_join_form_cfg][$key] == 0) { 
			$GLOBALS["show_{$val}_begin"]= '<!--';
			$GLOBALS["show_{$val}_end"]= '-->';
		} else {
			$GLOBALS["show_{$val}_begin"]= '';
			$GLOBALS["show_{$val}_end"]= '';
		}
		if($site[st_join_form_cfg][$key] == 2) { 
			$GLOBALS["need_{$val}"]= true;
		} else {
			$GLOBALS["need_{$val}"]= false;
		}
	}

	if(!$show_photo_begin) {
		$show_del_photo_begin = '<!--';
		$show_del_photo_end = '-->';
	}

	if(!$show_icon_begin) {
		$show_del_icon_begin = '<!--';
		$show_del_icon_end = '-->';
	}

	$need_password = true;
	$need_id = true;
	
	for($i=1;$i<11;$i++) {
		if(strrpos($site["st_mb_ext_value{$i}"], "required"))
			$site["st_mb_ext_name{$i}"] = "*".$site["st_mb_ext_name{$i}"];

		eval("\$show_ext{$i}_begin = (\$site[st_mb_ext_types][{$i}]==0)?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$site[st_mb_ext_types][{$i}]==0)?'-->':'';");
		eval("\$show_ext{$i}_title = \$site[st_mb_ext_name{$i}];");
		eval("\$show_ext{$i}_input = rg_makeform('mb_ext{$i}',\$site[st_mb_ext_types][{$i}],\$site[st_mb_ext_value{$i}],\$mb_ext$i);");
	}

	if($act=='ok') {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		
		$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);

		$mb_homepage=rg_homepage_chk($mb_homepage);

		$mb_reg_date=$now;
		$mb_login_ip=$REMOTE_ADDR;
	
		if(isset($mb_tel))
			$mb_tel = implode("-", $mb_tel);
		if(isset($mb_mobile))
			$mb_mobile = implode("-", $mb_mobile);
		
		if(rg_get_member_info($mb_id)) { // 사용하고 있는 아이디
			$msg = str_replace ("%mb_id%", $mb_id, "$msg_exist_mb_id");
			rg_href('',$msg,'','back');
		}
		
		if($site[st_join_form_cfg][8] != 0) { // 주민등록번호 체크
			$jumin = $mb_jumin1.$mb_jumin2;
			// 주민등록번호 형식 체크
			if(!rg_check_jumun($jumin)) {
				rg_href('',$msg_check_mb_jumin,'','back');
			}
			
			$mb_jumin = get_password_str($jumin);
			if(rg_get_member_info($mb_jumin,3)) {	// 사용하고 있는 주민등록번호
				rg_href('',$msg_exist_mb_jumin,'','back');
			}
		}

		if($site[st_join_form_cfg][1] != 0) { // 닉네임
			if(rg_get_member_info($mb_nick)) { // 사용하고 있는 닉네임
				$msg = str_replace ("%mb_nick%", $mb_nick, "$msg_exist_mb_nick");
				rg_href('',$msg,'','back');
			}
		}

		$mb_point = $site[st_default_point];
		$mb_level = $site[st_default_level];
		$mb_state = $site[st_default_state];

		$mb_password = get_password_str($mb_password);
		
		$mb_photo = '';
		$mb_icon = '';
		
		include($site_path."include/mb_upload_chk.inc.php");
		$dbqry="
			INSERT INTO `$db_table_member`
				( `mb_num` , `mb_id` , `mb_password` , 
					`mb_nick` , `mb_name` , `mb_email` , 
					`mb_msn` , `mb_homepage` , `mb_tel` , 
					`mb_mobile` , `mb_jumin` , `mb_birth` , 
					`mb_post` , `mb_address1` , `mb_address2` , 
					`mb_sex` , `mb_job` , `mb_hobby` , 
					`mb_photo` , `mb_mailing` , `mb_open_info` , 
					`mb_icon` , `mb_signature` , `mb_greet` , 
					`mb_point` , `mb_level` , `mb_state` , 
					`mb_reg_date` , `mb_modi_date` , `mb_login_ip` , 
					`mb_log_count` , `mb_ext1` , `mb_ext2` , 
					`mb_ext3` , `mb_ext4` , `mb_ext5`,
					`mb_ext6` , `mb_ext7` , `mb_ext8`,
					`mb_ext9` , `mb_ext10`
				) 
			VALUES 
				( '', '$mb_id', '$mb_password', 
					'$mb_nick', '$mb_name', '$mb_email',
					'$mb_msn', '$mb_homepage', '$mb_tel', 
					'$mb_mobile', '$mb_jumin', '$mb_birth', 
					'$mb_post', '$mb_address1', '$mb_address2', 
					'$mb_sex', '$mb_job', '$mb_hobby', 
					'$mb_photo', '$mb_mailing', '$mb_open_info', 
					'$mb_icon', '$mb_signature', '$mb_greet', 
					'$mb_point', '$mb_level', '$mb_state', 
					'$mb_reg_date', '$mb_modi_date', '$mb_login_ip', 
					'$mb_log_count', '$mb_ext1', '$mb_ext2', 
					'$mb_ext3', '$mb_ext4', '$mb_ext5',
					'$mb_ext6', '$mb_ext7', '$mb_ext8',
					'$mb_ext9', '$mb_ext10'
				)
		";
		query($dbqry,$dbcon);

		$mb_num = mysql_insert_id();

		include($site_path."include/mb_upload.inc.php");

		$dbqry="
			UPDATE `$db_table_member` SET
				`mb_photo` = '$mb_photo',
				`mb_icon` = '$mb_icon'
			WHERE `mb_num` = '$mb_num'		
		";
		query($dbqry,$dbcon);
/*		
		$dbqry="
			UPDATE `$bbs_table` SET
				`rg_top_num` = '$rg_top_num',
				`rg_next_num` = '$rg_next_num',
				`rg_file1_name` = '$rg_file1_name',
				`rg_file1_size` = '$rg_file1_size',
				`rg_file2_name` = '$rg_file2_name',
				`rg_file2_size` = '$rg_file2_size'
			WHERE rg_doc_num='$rg_doc_num'
		";
		query($dbqry,$dbcon);
*/
		if($site[st_join_auto_login]) {
			$ss_mb_id = $mb_id;
			$ss_mb_num = $mb_num;
			$ss_login_ok = 'ok';
//			session_register("ss_mb_id");
//			session_register("ss_mb_num");
//			session_register("ss_login_ok");
			$_SESSION['ss_mb_id']=$ss_mb_id;
			$_SESSION['ss_mb_num']=$ss_mb_num;
			$_SESSION['ss_login_ok']=$ss_login_ok;
		}
		
		if(!$url)$url=$site[st_join_ok_url];
		
		// 가입완료 파일이 없다면 바로 다음으로 넘기고 
		if (!file_exists($skin_site_path."mb_join_ok.php")) 
			rg_href($url);
		
		// 가입완료 파일이 있다면 보여준다. 
		//include($skin_site_path."head.php");
		//include($skin_site_path."mb_join_ok.php");
		//include($skin_site_path."foot.php");
		echo"<script>alert('회원가입이 완료되었습니다');</script>";
		echo"<script>location.href='../';</script>";
		exit;
	}

	include($skin_site_path."head.php");
	include($skin_site_path."mb_join.php");
	include($skin_site_path."foot.php");
?>