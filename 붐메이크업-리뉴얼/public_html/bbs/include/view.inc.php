<?
	if($auth[admin]) $mb_open_info = 1;
	$rg_email_enc=($rg_email)?urlencode($rg_email):'';
	$cat_name = $category_list[$rg_cat_num][cat_name]; 
	$rg_reg_date = rg_date($rg_reg_date,$bbs[bbs_view_date_disp]);
/*
	// �Խ��� ������ ȸ�������������ϴٸ�
	if($bbs_cfg[$C_AUTH_EDIT]!='A' && $data[rg_mb_num]!=$mb[mb_num] && $mb) {
		$u_edit = "";
		$a_edit = "<RG--";
	}
	// �Խ��� ������ ȸ�������������ϴٸ�
	if($bbs_cfg[$C_AUTH_DELETE]!='A' && $data[rg_mb_num]!=$mb[mb_num] && $mb) {
		$u_delete = "";
		$a_delete = "<RG--";
	}
*/
	if($auth[bbs_edit] || $mb && ($mb[mb_num] == $rg_mb_num)) {
		$u_edit = "{$site_url}edit.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_edit = "<a href=\"$u_edit$doc_num\" $class[link_bbs]>";
	} else {
		$u_edit = "";
		$a_edit = "<RG--";
	}
	
	if($auth[bbs_delete] || $mb && ($mb[mb_num] == $rg_mb_num)) {
		$u_delete = "{$site_url}delete.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_delete = "<a href=\"$u_delete$doc_num\" $class[link_bbs]>";
	} else {
		$u_delete = "";
		$a_delete = "<RG--";
	}

	// ���������̶�� ������� ����Ҽ� �����ϴ�. 2003-10-15
	if($auth[bbs_reply] && $data['rg_notice']=='0') {
		$u_reply = "{$site_url}reply.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_reply = "<a href=\"$u_reply$doc_num\" $class[link_bbs]>"; 
		$show_reply_begin='';
		$show_reply_end='';
	} else {
		$u_reply = "";
		$a_reply = "<RG--";
		$show_reply_begin='<!--';
		$show_reply_end='-->';
	}

	// ���ñ��� �ִٸ� �������� �ɼ��� ��� ó�� 
	if(($bbs_cfg[$C_REPLY_DELETE]>0) && ($bbs_cfg[$C_REPLY_DELETE]<4) && !$auth[admin]) {
		$dbqry = "
			SELECT count(*)
			FROM `$bbs_table`
			WHERE `rg_parent_num` = '$rg_doc_num'
		";
		$rs = query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]) { // ������� �ִٸ� 
			 switch($bbs_cfg[$C_REPLY_DELETE]) {
			 	case 1 :
					$u_edit = "";
					$a_edit = "<RG--";
					$u_delete = "";
					$a_delete = "<RG--";
					break;
				case 2 :
					$u_edit = "";
					$a_edit = "<RG--";
					break;
				case 3 :
					$u_delete = "";
					$a_delete = "<RG--";
					break;
			 }
		}
	}

	if($rg_home_url!='') {
		$show_home_begin = '';
		$show_home_end = '';
	} else {
		$show_home_begin = '<!--';
		$show_home_end = '-->';
	}

	$show_link1_begin = "";
	$show_link1_end = "";
	$show_link2_begin = "";
	$show_link2_end = "";
	if(!$rg_link1_url || $bbs_cfg[$C_AUTH_LINK]=='N') {
		$show_link1_begin = "<!--";
		$show_link1_end = "-->";
	}
	if(!$rg_link2_url || $bbs_cfg[$C_AUTH_LINK]=='N') {
		$show_link2_begin = "<!--";
		$show_link2_end = "-->";
	}

	$dbqry = "SHOW COLUMNS FROM `$bbs_table` LIKE 'rg_file%_name'";
	$rs_files = mysql_query($dbqry, $dbcon);

	$fi = 1;
	while($col_files = mysql_fetch_array($rs_files))
	{
		${'show_file'.$fi.'_begin'} = "";
		${'show_file'.$fi.'_end'} = "";	
		if(!$data[$col_files["Field"]] || !$auth[bbs_download]) {
			${'show_file'.$fi.'_begin'} = "<!--";
			${'show_file'.$fi.'_end'} = "-->";
		}

		${'show_file'.$fi.'_view_begin'} = '<!--';
		${'show_file'.$fi.'_view_end'} = '-->';

		if($bbs_cfg[$C_VIEW_IMAGE]) {
			if($data[$col_files["Field"]] && eregi('(\.gif|\.jpg|\.png)$', $data[$col_files["Field"]])) {
				${'rg_file'.$fi.'_info'} = "{$bbs_data_url}"."{$rg_doc_num}\$$fi\$th2\$".$data[$col_files["Field"]];
				

				//��������� �����ְ� ���� ���̹��� �����ֱ�(�������������� ����� ����)
				if(file_exists("{$bbs_data_url}"."{$rg_doc_num}\$$fi\$th2\$".$data[$col_files["Field"]])) {
					
						${'rg_file'.$fi.'_url'} = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$$fi\$th2\$".$data[$col_files["Field"]]);
				}else{		
					
						${'rg_file'.$fi.'_url'} = "{$bbs_data_url}".urlencode("{$rg_doc_num}\$$fi\$".$data[$col_files["Field"]]);
				}







				${'rg_file'.$fi.'_view'} = rg_img_view_tag(${'rg_file'.$fi.'_url'});
				${'show_file'.$fi.'_view_begin'} = '';
				${'show_file'.$fi.'_view_end'} = '';
			} else {
				${'rg_file'.$fi.'_url'} = '';
				${'rg_file'.$fi.'_view'} = '';
			}
		}
		${'rg_file'.$fi.'_size'} = rg_human_fsize_lib(${'rg_file'.$fi.'_size'});

		$fi++;
	}
	
	$show_link1_view_begin = '<!--';
	$show_link1_view_end = '-->';
	$show_link2_view_begin = '<!--';
	$show_link2_view_end = '-->';

	if($bbs_cfg[$C_VIEW_IMAGE]) {
		if($rg_link1_url) {
			$rg_link1_view = rg_img_view_tag($rg_link1_url);
			$show_link1_view_begin = '';
			$show_link1_view_end = '';
		} else {
			$rg_link1_view = '';
		}
		
		if($rg_link2_url) {
			$rg_link2_view = rg_img_view_tag($rg_link2_url);
			$show_link2_view_begin = '';
			$show_link2_view_end = '';
		} else {
			$rg_link2_view = '';
		}

	}

	$show_signature_begin = "";
	$show_signature_end = "";
	if(!$bbs_cfg[$C_USE_SIGNATURE] || !$data[rg_mb_num] || !$data[mb_signature]) {
		$show_signature_begin = "<!--";
		$show_signature_end = "-->";
	}
	$mb_signature = nl2br($data[mb_signature]);
	
	for($i=1;$i<51;$i++) {
		${"show_ext{$i}_begin"} = ($bbs[bbs_ext_types][$i]==0 || !${"rg_ext$i"})?'<!--':'';
		${"show_ext{$i}_end"} = ($bbs[bbs_ext_types][$i]==0 || !${"rg_ext$i"})?'-->':'';
		${"show_ext{$i}_title"} = $bbs["bbs_ext_name$i"];
/*
		eval("\$show_ext{$i}_begin = (\$bbs[bbs_ext_types][{$i}]==0 || !\$ext{$i})?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$bbs[bbs_ext_types][{$i}]==0 || !\$ext{$i})?'-->':'';");
		eval("\$show_ext{$i}_title = \$bbs[bbs_ext_name{$i}];");
*/
	}
	
	// ȸ�������� ó��
	if($bbs_cfg[$C_USE_MB_ICON] && $data[mb_icon]) { // ȸ��
		$rg_mb_icon = "<img src=$member_icon_url$data[mb_icon] align=absbottom>";
	} else {
		$rg_mb_icon = '';
	}
	// html �� �����Ұ�� ���Ұ� html üũ
//	if(!$auth[admin] && ($rg_html_use == 1 || $rg_html_use == 2)) {
	if($rg_html_use == 1 || $rg_html_use == 2) {
		$rg_content = rg_script_conv($bbs[bbs_html_text],$rg_content);

	}
	// ȸ�������� 10���ϸ� html �� ����Ҽ� ����.
	if($data[mb_level]<10) {
		$rg_title = rg_conv_text($rg_title);
		$rg_name = rg_conv_text($rg_name);
		$rg_email = rg_conv_text($rg_email);
	}
	$rg_content = rg_conv_text($rg_content,$rg_html_use);
	$rg_home_url = rg_get_text(rg_homepage_chk($rg_home_url));
	$rg_link1_url = rg_get_text($rg_link1_url);
	$rg_link2_url = rg_get_text($rg_link2_url);

	if(!$auth[admin]) $rg_reg_ip = rg_hidden_ip($rg_reg_ip);
	if(!$auth[admin]) $rg_modi_ip = rg_hidden_ip($rg_modi_ip);
?>	