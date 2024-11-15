<?
	require_once("include/bbs.lib.inc.php");
	$mode_reply=true;
	$mode = 'reply';
	$html_title = ($html_title)?$html_title." > ����۾���":'';

	// ����� ����üũ
	if(!$auth[bbs_reply]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	// �۾��� ���� ������ üũ
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'��������� �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	$u_action = $u_reply.$doc_num;
	$reply = rg_get_doc_info($bbs_id,$doc_num);

	// ���������̶�� ������� ����Ҽ� �����ϴ�. 2003-10-15
	if($reply['rg_notice']!='0') {
		$error_msg = '�������׿� �������� ���� �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}

	if($act=='ok') {
		/*
		// ���ݱ۾��� ����
		if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
			if(trim($HTTP_SERVER_VARS['HTTP_REFERER'])=='') {
				$error_msg = '���ݱ۾��� ����';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			if($_SESSION['write_key']!=$bbs[bbs_num].'.'.$bbs[bbs_id]) {
				$error_msg = '�κ������� �۾��� ����';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
		}
		unset($_SESSION['write_key']);
			
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		*/

		if($bbs_cfg[$C_USE_REMOTE_WRITE] == 1 && !$ss_mb_id){
				if($_SESSION['scode']==$_POST['user_scode'] && !empty($_SESSION['scode'])){
						unset($_SESSION['scode']);
				}else{
						echo"<script>alert('���Թ��� ��ȣ�� ��ġ���� �ʽ��ϴ�.');history.go(-1);</script>";
						exit;
				}
		}

		if($rg_title=='') {
			$error_msg = '������ �Է����ּ���.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");
			exit;
		}

		if($rg_content=='') {
			$error_msg = '������ �Է����ּ���.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");
			exit;
		}
		
		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_title)) {
			$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");
			exit;
		}

		if($tmp = rg_str_inword($bbs[bbs_deny_word],$rg_content)) {
			$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");
			exit;
		}
		
		if($bbs[bbs_write_time] && ($_SESSION[ss_write_date]+$bbs[bbs_write_time] > $now) && !$auth[admin]) {
			$error_msg = $bbs[bbs_write_time].'�� �Ŀ� ���� �÷��ּ���.(�������)';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");
			exit;
		}

		// ����ۿ��� ���������� ����Ҽ� ����
		$rg_notice = '0';
		$rg_html_use = ($auth[bbs_html])?$rg_html_use:'0';

		// �Խ��� ������ ��ü�� �ƴϰ� , �α��� �Ǿ� �ִٸ�
		if($bbs_cfg[$C_AUTH_REPLY]!='A' && $mb) {
			$rg_name = $mb[mb_show_name];
			$rg_email = $mb[mb_mail];
//			$rg_home_url = $mb[mb_homepage]; // 2003-10-15 �׻�Ȩ�������Է°���
		} else {
			if($rg_name=='') {
				$error_msg = '�̸��� �Է����ּ���.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			if(($rg_password=='') && !$mb) {  // �α��εǾ� ���� �ʰ� ��ȣ�� ���ٸ�
				$error_msg = '��ȣ�� �Է����ּ���.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
		}
		
		$rg_doc_num = '';
		$rg_top_num = '';
		$rg_parent_num = '';
		$rg_sequence = 1;
		$rg_depth = 0;
		$rg_next_num = '';
//		$rg_cat_num
		$rg_mb_num = $mb[mb_num];
//		$rg_name 
		if($rg_password) $rg_password = get_password_str($rg_password);
//		$rg_email
//		$rg_home_url 
		$rg_home_url=rg_homepage_chk($rg_home_url);

		$rg_home_hit = 0;
//		$rg_link1_url
//		$rg_link2_url 
		$rg_link1_hit = 0;
		$rg_link2_hit = 0;
		$rg_file1_name = '';
		$rg_file2_name = '';
		$rg_file1_size = 0;
		$rg_file2_size = 0;
		$rg_file1_hit = 0;
		$rg_file2_hit = 0;
		$rg_vote_yes = 0;
		$rg_vote_no = 0;
		$rg_doc_hit = 0;
		$rg_cmt_count = 0;
//		$rg_title
//		$rg_content
//		$rg_html_use 
		$rg_reg_date = $now;
//		$rg_modi_date
		$rg_reg_ip = $REMOTE_ADDR;
//		$rg_modi_ip
//		$rg_deleted
//		$rg_secret 
		$rg_vote_ip = $REMOTE_ADDR;
//		$rg_head_num
//		$rg_reply_mail 
		$rg_agree = 0;
		
		// next_num�� ������� next_num
		$rg_next_num = $reply[rg_next_num];
		
		// ���ε�üũ
		include("{$site_path}include/upload_chk.inc.php");
		
		// next_num�� �ϳ��� �ø���.
		$dbqry="
			UPDATE `$bbs_table` SET
				`rg_next_num` = `rg_next_num` + 1
			WHERE rg_next_num >= '$reply[rg_next_num]'
		";
		query($dbqry,$dbcon);
		
		$dbqry="
			INSERT INTO `$bbs_table`
				( `rg_doc_num` , `rg_top_num` , `rg_parent_num` ,
				 	`rg_sequence` , `rg_depth` , `rg_next_num` ,
					`rg_cat_num` , `rg_mb_num` , `rg_name` ,
					`rg_password` , `rg_email` , `rg_home_url` ,
					`rg_home_hit` , `rg_link1_url` , `rg_link2_url` ,
					`rg_link1_hit` , `rg_link2_hit` , `rg_file1_name` ,
					`rg_file2_name` , `rg_file1_size` , `rg_file2_size` ,
					`rg_file1_hit` , `rg_file2_hit` , `rg_vote_yes` ,
					`rg_vote_no` , `rg_doc_hit` , `rg_cmt_count` ,
					`rg_title` , `rg_content` , `rg_html_use` ,
					`rg_reg_date` , `rg_modi_date` , `rg_reg_ip` ,
					`rg_modi_ip` , `rg_deleted` , `rg_secret` ,
					`rg_vote_ip` , `rg_notice` , `rg_reply_mail` ,
					`rg_agree` , `rg_ext1` , `rg_ext2` ,
					`rg_ext3` , `rg_ext4` , `rg_ext5` 
				)
			VALUES 
				( '$rg_doc_num', '$rg_top_num', '$rg_parent_num',
					'$rg_sequence', '$rg_depth', '$rg_next_num', 
					'$rg_cat_num', '$rg_mb_num', '$rg_name', 
					'$rg_password', '$rg_email', '$rg_home_url', 
					'$rg_home_hit', '$rg_link1_url', '$rg_link2_url', 
					'$rg_link1_hit', '$rg_link2_hit', '$rg_file1_name', 
					'$rg_file2_name', '$rg_file1_size', '$rg_file2_size', 
					'$rg_file1_hit', '$rg_file2_hit', '$rg_vote_yes', 
					'$rg_vote_no', '$rg_doc_hit', '$rg_cmt_count', 
					'$rg_title', '$rg_content', '$rg_html_use', 
					'$rg_reg_date', '$rg_modi_date', '$rg_reg_ip', 
					'$rg_modi_ip', '$rg_deleted', '$rg_secret', 
					'$rg_vote_ip', '$rg_notice', '$rg_reply_mail', 
					'$rg_agree', '$rg_ext1', '$rg_ext2', 
					'$rg_ext3', '$rg_ext4', '$rg_ext5'
				)
		";
		query($dbqry,$dbcon);

		$rg_doc_num = mysql_insert_id();
		
		// ���ε� ���� ��ƾ�� ����
		include("{$site_path}include/upload.inc.php");

		$rg_depth = $reply[rg_depth]+1;
		$rg_sequence = $reply[rg_sequence]+1;
		$rg_parent_num = $doc_num;
		$rg_top_num = $reply[rg_top_num];

		$dbqry = "UPDATE $bbs_table SET
										rg_sequence=rg_sequence+1 
							WHERE rg_top_num = '$rg_top_num'
								AND rg_sequence >= '$rg_sequence'";
		$rs = query($dbqry,$dbcon);

		$dbqry="
			UPDATE `$bbs_table` SET
				`rg_top_num` = '$rg_top_num',
				`rg_depth` = '$rg_depth',
				`rg_sequence` = '$rg_sequence',
				`rg_parent_num` = '$rg_parent_num',
				`rg_file1_name` = '$rg_file1_name',
				`rg_file1_size` = '$rg_file1_size',
				`rg_file2_name` = '$rg_file2_name',
				`rg_file2_size` = '$rg_file2_size'
			WHERE rg_doc_num='$rg_doc_num'
		";
		query($dbqry,$dbcon);

		rg_set_point($mb[mb_num],$bbs[bbs_point_reply],1);
		
/*
 ���� �߼۱��
 ����� ���Ϲ߼��ΰ�� �ٷ� ���� ���� �̸��Ϸθ� ������ �߼��Ѵ�.
 ��ü ���ñ��� �̸��Ϸ� �߼��� ������ ���� �����Ѵ�. 

 ���ñ� ���Ϲ߼� 
(���ñ� ���Ϲ߼۱�� Ȱ��ȭ�� �Ǿ� �ְ�,�������� �̸����� �����Ѵٸ�) 
�Ǵ�
(��ڸ��ϼ��� �Ǿ� �ְ� ��� ����� �ִٸ�)
*/
		if((($bbs_cfg[$C_USE_REPLAY_MAIL] && $reply[rg_email] && 
			                                   $reply[rg_reply_mail]) ||
		    ($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbs_admin_list])) &&
   			 file_exists($skin_board_path."mail.php")) { 
			$mail_subject = $site[st_site_name];
			$mail_subject = ($mail_subject)?
											$mail_subject." > ".$bbs[bbs_name]:
											$bbs[bbs_name];
			$mail_subject = "[{$mail_subject}] ������� �ö�Խ��ϴ�.";
			$mail_title = rg_conv_text($rg_title);
			$mail_from_name = $rg_name;
			$mail_content = rg_conv_text($rg_content,$rg_html_use);
			$mail_view_url = rg_get_current_url().'view.php?&bbs_id='.$bbs_id.'&doc_num='.$rg_doc_num;

			$mail_subject = stripslashes($mail_subject);
			$mail_title = stripslashes($mail_title);
			$mail_from_name = stripslashes($mail_from_name);
			$mail_content = stripslashes($mail_content);
	
			// �Խ��ǰ����� �̸��� �����ϱ� 
			$email_list=array();
			if($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbs_admin_list]) {
				$tmp=explode (',', $bbs['bbs_admin_list']);
				$admin_id_list='\''.implode ('\',\'', $tmp).'\'';
				$dbqry="
					SELECT mb_email
					FROM `$db_table_member`
					WHERE mb_id in ($admin_id_list) 
					  AND mb_email <> ''
				";
				$rs=query($dbqry,$dbcon);
				while($R=mysql_fetch_array($rs)) {
					$email_list[] = $R[mb_email];
				}
			}
			// �����..
			if($bbs_cfg[$C_USE_REPLAY_MAIL] && $reply[rg_email] && 
			                                   $reply[rg_reply_mail])
				$email_list[] = $reply[rg_email];
			// ���� �߼� ��ƾ�� ����
			include("{$site_path}include/mail.inc.php");	
		}
		
		// ��б��� ���ٸ� �۸������
		if($rg_secret && $bbs[bbs_act_after]=='1') $bbs[bbs_act_after]='';
				
		switch($bbs[bbs_act_after]){
			case '' : 
			case '0' : 
					rg_href("list.php?$p_str&page=$page&bbs_id=$bbs_id");
					break;
			case '1' : 
					rg_href("view.php?$p_str&bbs_id=$bbs_id&doc_num=$rg_doc_num");
					break;
			default : 
					rg_href($bbs[bbs_act_after]);
					break;
		}
	}
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	$checked_html_use0 = 'checked';
	$checked_secret=($reply['rg_secret'])?'checked':'';
	
	// ������� ������������ �Ҽ��� ����	
	$show_notice_begin = '<!--';
	$show_notice_end = '-->';
	
	// ������ �ο뿩�� 
	if($bbs_cfg[$C_USE_QUOTE]) {
		if(substr($reply[rg_title],0,strlen($bbs[bbs_title_prefix])) == $bbs[bbs_title_prefix])
			$rg_title = $reply[rg_title];
		else 
			$rg_title = $bbs[bbs_title_prefix].$reply[rg_title];
		$rg_content = $reply[rg_name].$bbs[bbs_name_suffix]."\n";
		$rg_content .= $bbs[bbs_quota_mark].str_replace("\n",$bbs[bbs_quota_mark],$reply[rg_content]);
	} else {
		$rg_content = $bbs[bbs_default_content];
	}
	
	// �Խ��� ������ ��ü�� �ƴϰ� , �α��� �Ǿ� �ִٸ�
	if($bbs_cfg[$C_AUTH_REPLY]!='A' && $mb) {
		$show_password_begin = '<!--';
		$show_password_end = '-->';
		$show_name_begin = '<!--';
		$show_name_end = '-->';
		$show_email_begin = '<!--';
		$show_email_end = '-->';
		$show_home_url_begin = ''; // 2003-10-15 Ȩ�������� �׻��Է�
		$show_home_url_end = '';
	} else {
		// 2003-10-15 (ȸ���α������� ��� ��ȣ�� �Է¾��ص� ��)
		if($mb) {
			$show_password_begin = '<!--';
			$show_password_end = '-->';
		} else {
			$show_password_begin = '';
			$show_password_end = '';
		}
		$show_name_begin = '';
		$show_name_end = '';
		$show_email_begin = '';
		$show_email_end = '';
		$show_home_url_begin = '';
		$show_home_url_end = '';
	}
	if($mb) {
		$rg_name = $mb[mb_show_name];
		$rg_email = $mb[mb_email];
		$rg_home_url = $mb[mb_homepage];
	} else {
		$rg_name = '';
		$rg_email = '';
		$rg_home_url = '';
	}

	// ���ε尡 �����ϴٸ�
	if($auth[bbs_upload]) {
		// ù��° ���ε� ���� Ȯ���� üũ
		if($bbs[bbs_file1_ext]) {
			if(substr($bbs[bbs_file1_ext],0,1) == '!') {
				$upload_file1_ext = substr($bbs[bbs_file1_ext],1,strlen($bbs[bbs_file1_ext])-1);
				$upload_file1_able = false;
			} else {
				$upload_file1_ext = $bbs[bbs_file1_ext];
				$upload_file1_able = true;
			}
		} else {
			$show_file1_ext_begin = '<!--';
			$show_file1_ext_end = '-->';
		}
		// �ι�° ���ε� ���� Ȯ���� üũ
		if($bbs[bbs_file2_ext]) {
			if(substr($bbs[bbs_file2_ext],0,1) == '!') {
				$upload_file2_ext = substr($bbs[bbs_file2_ext],1,strlen($bbs[bbs_file2_ext])-1);
				$upload_file2_able = false;
			} else {
				$upload_file2_ext = $bbs[bbs_file2_ext];
				$upload_file2_able = true;
			}
		} else {
			$show_file2_ext_begin = '<!--';
			$show_file2_ext_end = '-->';
		}
		// ���ε� �뷮�� ������ �ִٸ� 1��°
		if($bbs[bbs_file1_size]) {
			$upload_file1_size = rg_human_fsize_lib($bbs[bbs_file1_size]);
		} else {
			$show_file1_size_begin = '<!--';
			$show_file1_size_end = '-->';
		}
		
		// ���ε� �뷮�� ������ �ִٸ� 2��°
		if($bbs[bbs_file2_size]) {
			$upload_file2_size = rg_human_fsize_lib($bbs[bbs_file2_size]);
		} else {
			$show_file2_size_begin = '<!--';
			$show_file2_size_end = '-->';
		}
		
		$show_file1_delete_begin = '<!--';
		$show_file1_delete_end = '-->';
		$show_file2_delete_begin = '<!--';
		$show_file2_delete_end = '-->';
	}
	// �߰��׸��� ó���ϴ� ��ƾ�̴�.
	for($i=1;$i<6;$i++) {
		${'show_ext'.$i.'_begin'} = ($bbs[bbs_ext_types][$i]==0)?'<!--':'';
		${'show_ext'.$i.'_end'} = ($bbs[bbs_ext_types][$i]==0)?'-->':'';
		${'show_ext'.$i.'_title'} = $bbs['bbs_ext_name'.$i];
		${'show_ext'.$i.'_input'} = 
					rg_makeform('rg_ext'.$i,$bbs[bbs_ext_types][$i],$bbs['bbs_ext_value'.$i]);
	}
	
	require_once("_header.php");
	include($skin_board_path."write.php");
	require_once("_footer.php");
?>