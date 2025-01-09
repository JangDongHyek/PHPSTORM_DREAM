<?
	if($auth[admin]) $mb_open_info = 1;
	$rg_email_enc=($rg_email)?urlencode($rg_email):'';
	$cat_name = $category_list[$rg_cat_num][cat_name]; 
	$rg_reg_date = rg_date($rg_reg_date,$bbs[bbs_view_date_disp]);
/*
	// 게시판 설정이 회원만수정가능하다면
	if($bbs_cfg[$C_AUTH_EDIT]!='A' && $data[rg_mb_num]!=$mb[mb_num] && $mb) {
		$u_edit = "";
		$a_edit = "<RG--";
	}
	// 게시판 설정이 회원만삭제가능하다면
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

	// 공지사항이라면 응답글을 사용할수 없습니다. 2003-10-15
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

	// 관련글이 있다면 수정삭제 옵션일 경우 처리 
	if(($bbs_cfg[$C_REPLY_DELETE]>0) && ($bbs_cfg[$C_REPLY_DELETE]<4) && !$auth[admin]) {
		$dbqry = "
			SELECT count(*)
			FROM `$bbs_table`
			WHERE `rg_parent_num` = '$rg_doc_num'
		";
		$rs = query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]) { // 응답글이 있다면 
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
				

				//썸네일있음 보여주고 없음 본이미지 보여주기(사이즈작은놈은 썸네일 없음)
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
	
	// 회원아이콘 처리
	if($bbs_cfg[$C_USE_MB_ICON] && $data[mb_icon]) { // 회원
		$rg_mb_icon = "<img src=$member_icon_url$data[mb_icon] align=absbottom>";
	} else {
		$rg_mb_icon = '';
	}
	// html 이 가능할경우 사용불가 html 체크
//	if(!$auth[admin] && ($rg_html_use == 1 || $rg_html_use == 2)) {
	if($rg_html_use == 1 || $rg_html_use == 2) {
		$rg_content = rg_script_conv($bbs[bbs_html_text],$rg_content);

	}
	// 회원레벨이 10이하면 html 을 사용할수 없다.
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