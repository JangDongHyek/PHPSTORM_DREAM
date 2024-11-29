<?
	require_once("include/lib.inc.php");
	
	// 로그인 되어 있지 않다면 
	if(empty($_SESSION[ss_mb_id])) {
		if($url==NULL) $url = $HTTP_SERVER_VARS['REQUEST_URI'];
		rg_href('mb_login.php?url='.$url);
	}
	
	if($act=='ok') {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		$mb_email=strtolower($mb_email);

		$mb_homepage=rg_homepage_chk($mb_homepage);
		
		$mb_modi_date = $now;
		if($mb_password) {
			$mb_password = get_password_str($mb_password);
			$sql_password = "`mb_password` = '$mb_password',";
		}

		$mb_photo = $mb[mb_photo];
		$mb_icon = $mb[mb_icon];
		$mb_num = $mb[mb_num];
		include($site_path."include/mb_upload_chk.inc.php");		
		include($site_path."include/mb_upload.inc.php");
		
		if($site[st_join_form_cfg][1] != 0) { // 닉네임
			if($mb_nick=='') { // 2003-10-15 닉네임입력이 없다면
				$msg = str_replace ("닉네임을 입력해주세요.");
				rg_href('',$msg,'','back');
			}
			$dbqry = "
				SELECT mb_num
				FROM $db_table_member
				WHERE mb_nick = '$mb_nick'
					AND mb_num <> '$mb_num'
			";
			$rs=query($dbqry,$dbcon);
			if(mysql_num_rows($rs)) { // 사용하고 있는 닉네임
				$msg = str_replace ("%mb_nick%", $mb_nick, "$msg_exist_mb_nick");
				rg_href('',$msg,'','back');
			}
		}
		// 이름은 변경을 하지 않는다.		
		// `mb_name` = '$mb_name',
		$mb_tel = implode("-", $mb_tel);
		$mb_mobile = implode("-", $mb_mobile);

		$dbqry="
			UPDATE `$db_table_member` SET
				 $sql_password
				`mb_nick` = '$mb_nick',
				`mb_email` = '$mb_email',
				`mb_msn` = '$mb_msn',
				`mb_homepage` = '$mb_homepage', 
				`mb_tel` = '$mb_tel',
				`mb_mobile` = '$mb_mobile',
				`mb_birth` = '$mb_birth',
				`mb_post` = '$mb_post',
				`mb_address1` = '$mb_address1',
				`mb_address2` = '$mb_address2',
				`mb_job` = '$mb_job',
				`mb_sex` = '$mb_sex',
				`mb_hobby` = '$mb_hobby',
				`mb_photo` = '$mb_photo',
				`mb_mailing` = '$mb_mailing',
				`mb_open_info` = '$mb_open_info',
				`mb_icon` = '$mb_icon',
				`mb_signature` = '$mb_signature',
				`mb_greet` = '$mb_greet',
				`mb_modi_date` = '$mb_modi_date',
				`mb_ext1` = '$mb_ext1',
				`mb_ext2` = '$mb_ext2',
				`mb_ext3` = '$mb_ext3',
				`mb_ext4` = '$mb_ext4',
				`mb_ext5` = '$mb_ext5',
				`mb_ext6` = '$mb_ext6',
				`mb_ext7` = '$mb_ext7',
				`mb_ext8` = '$mb_ext8',
				`mb_ext9` = '$mb_ext9',
				`mb_ext10` = '$mb_ext10'
			WHERE `mb_num` = '$mb[mb_num]'
		";
		query($dbqry,$dbcon);

/*		
		$mb_num = mysql_insert_id();
		
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
		$mb=rg_get_member_info($_SESSION[ss_mb_id]);
	}
	extract($mb);

	$show_join_begin = '<!--';
	$show_join_end = '-->';

	$show_edit_begin = '';
	$show_edit_end = '';
	
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

	if($mb[mb_photo]) {
		$mb_photo_view = "<img src=$member_photo_url$mb[mb_photo]>";
	} else {
		if(!$show_photo_begin) {
			$show_del_photo_begin = '<!--';
			$show_del_photo_end = '-->';
		}
	}
	if($mb[mb_icon]) {
		$mb_icon_view = "<img src=$member_icon_url$mb[mb_icon]>";
	} else {
		if(!$show_icon_begin) {
			$show_del_icon_begin = '<!--';
			$show_del_icon_end = '-->';
		}
	}

	$mb_tel = explode("-", $mb_tel);
	$mb_mobile = explode("-", $mb_mobile);

	$need_password = false;

	$show_jumin_begin = '<!--';
	$show_jumin_end = '-->';

	$show_sex_begin = '<!--';
	$show_sex_end = '-->';
	
	$show_join = '<!--';
	$show_join = '-->';

	$required_password = '';
	
	for($i=1;$i<11;$i++) {
		eval("\$show_ext{$i}_begin = (\$site[st_mb_ext_types][{$i}]==0)?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$site[st_mb_ext_types][{$i}]==0)?'-->':'';");
		eval("\$show_ext{$i}_title = \$site[st_mb_ext_name{$i}];");
		eval("\$show_ext{$i}_input = rg_makeform('mb_ext{$i}',\$site[st_mb_ext_types][{$i}],\$site[st_mb_ext_value{$i}],\$mb_ext$i);");
	}
	$checked_mb_open_info = ($mb_open_info)?'checked':'';
	$checked_mb_mailing = ($mb_mailing)?'checked':'';
	
	// 수정완료라면
	if($act=='ok') {
		if(!$url)$url=$site[st_join_ok_url];
		
		// 가입완료 파일이 없다면 바로 다음으로 넘기고 
		if (!file_exists($skin_site_path."mb_join_ok.php")) 
			rg_href($url);
		
		// 가입완료 파일이 있다면 보여준다. 
		include($skin_site_path."head.php");
		include($skin_site_path."mb_join_ok.php");
		include($skin_site_path."foot.php");
		exit;
	}
	
	include($skin_site_path."head.php");
	include($skin_site_path."mb_join.php");
	include($skin_site_path."foot.php");
?>