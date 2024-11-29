<?
	require_once("include/bbs.lib.inc.php");
	
	if(!$auth[bbs_comment]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'��������� �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
		
	switch($type) {
		case 'delete' :
			$dbqry="
				SELECT *
				FROM `$commant_table`
				WHERE cmt_num = '$cmt_num'
			";
			$rs=query($dbqry,$dbcon);
			$cmt=mysql_fetch_array($rs);
			
			// �α����� �Ǿ� ���� �ʰų� �ڽ��� ���� �ƴϰ� �����ڰ� �ƴ϶��
			if((!$mb || ($cmt[cmt_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
				if($bbs_cfg[$C_AUTH_COMMENT] == 'A') {
					if($old_password) {  // ��ȣ �Է��� �ִٸ� 
						if($cmt[cmt_password] != get_password_str($old_password)) {
							$msg = '��ȣ�� �ٸ��ϴ�.\n��Ȯ�� �Է����ּ���.';
							rg_href('',$msg,'','back');
						}
					} else { // ��ȣ�Է��� ���ٸ�
						$title='�ڸ�Ʈ���� ��ȣ�� �Է��ϼ���.';
						require_once("_header.php");
						include($skin_board_path."mobile_password.php");
						require_once("_footer.php");		
						exit;
					}	
				} else {
					$msg = '���� �Ҽ� �����ϴ�.\n�α����� �Ǿ� ���� �ʴٸ� �α������ּ���.';
					rg_href('',$msg,'','back');
				}
			} else { // ȸ���� �ٷ� �����Ҽ� �ִٸ� Ȯ�� �۾��� ��ģ��.
				if($act != 'confirm_ok') {  // ���� Ȯ���� �ƴϸ�
					$title='�ڸ�Ʈ���� Ȯ���մϱ�?';
					require_once("_header.php");
					include($skin_board_path."mobile_confirm.php");
					require_once("_footer.php");		
					exit;
				}		
			}

			$doc_num = $cmt[cmt_doc_num];
			$dbqry="
				DELETE FROM `$commant_table`
				WHERE cmt_num='$cmt_num'
			";
			query($dbqry,$dbcon);

			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_cmt_count` = rg_cmt_count - 1
				WHERE rg_doc_num='$doc_num'
			";
			query($dbqry,$dbcon);
						
			break;
		default :

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

			if($bbs[bbs_write_time] && ($_SESSION[ss_write_date]+$bbs[bbs_write_time] > $now) && !$auth[admin]) {
				$error_msg = $bbs[bbs_write_time].'�� �Ŀ� ���� �÷��ּ���.(�������)';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
					
			$reply = rg_get_doc_info($bbs_id,$doc_num);
			while(list($key,$value)=each($HTTP_POST_VARS))
				if(is_string($value))
					$GLOBALS[$key]=trim($value);
			if(!$cmt_comment) {
				$error_msg = '�ڸ�Ʈ ������ �Է��ϼ���.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			if($tmp = rg_str_inword($bbs[bbs_deny_word],$cmt_comment)) {
				$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			$cmt_reg_date = $now;
			$cmt_reg_ip = $REMOTE_ADDR;
			$cmt_doc_num = $doc_num;
			$cmt_mb_num = ($mb)?$mb[mb_num]:'0';

			if($mb) { // �α��� �Ǿ� �ִٸ� 
				$cmt_name = $mb[mb_show_name];
				$cmt_email = $mb[mb_mail];
			} else {
				if($cmt_name=='') {
					$error_msg = '�̸��� �Է��ϼ���.';
					require_once("_header.php");
					include($skin_board_path."error.php");
					require_once("_footer.php");
					exit;
				}
/*				if(!$cmt_email){
					$error_msg = '�̸����� �Է��ϼ���.';
					include($skin_site_path.'error.htm');
					exit;
				}
*/
				if($cmt_password=='') {
					$error_msg = '��ȣ�� �Է��ϼ���.';
					require_once("_header.php");
					include($skin_board_path."error.php");
					require_once("_footer.php");
					exit;
				}
			}
			if($cmt_password) $cmt_password = get_password_str($cmt_password);

			$dbqry="
				INSERT INTO `$commant_table`
					( `cmt_num` , `cmt_doc_num` , `cmt_mb_num` ,
						`cmt_name` , `cmt_password` , `cmt_email` ,
						`cmt_comment` , `cmt_reg_date` , `cmt_reg_ip`
					) 
				VALUES
					( '', '$cmt_doc_num', '$cmt_mb_num',
						'$cmt_name', '$cmt_password', '$cmt_email',
						'$cmt_comment', '$cmt_reg_date', '$cmt_reg_ip'
					)
			";
			query($dbqry,$dbcon);
	
			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_cmt_count` = rg_cmt_count + 1
				WHERE rg_doc_num='$doc_num'
			";
			query($dbqry,$dbcon);
			rg_set_point($mb[mb_num],$bbs[bbs_point_comment],1);
	
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
					($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbsdmin_list])) &&
					 file_exists($skin_board_path."mail.php")) { 
				$mail_subject = $site[st_site_name];
				$mail_subject = ($mail_subject)?
												$mail_subject." > ".$bbs[bbs_name]:
												$bbs[bbs_name];
				$mail_subject = "[{$mail_subject}] �ڸ�Ʈ���� �ö�Խ��ϴ�.";
				$mail_title = rg_conv_text($reply[rg_title]);
				$mail_from_name = $cmt_name;
				$mail_content = rg_conv_text($cmt_comment);
				$mail_view_url = rg_get_current_url().'mobile_view.php?&bbs_id='.$bbs_id.'&doc_num='.$doc_num;
	
				$mail_subject = stripslashes($mail_subject);
				$mail_title = stripslashes($mail_title);
				$mail_from_name = stripslashes($mail_from_name);
				$mail_content = stripslashes($mail_content);
		
				// �Խ��ǰ����� �̸��� �����ϱ� 
				$email_list=array();
				if($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbsdmin_list]) {
					$tmp=explode (',', $bbs['bbsdmin_list']);
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
				$rg_name = $cmt_name;
				$rg_email = $cmt_email;
				include("{$site_path}include/mail.inc.php");	
			}

			$ss_write_date = $now;
//			session_register("ss_write_date");
			$_SESSION['ss_write_date']=$ss_write_date;
			break;
	}
	rg_href("mobile_view.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$doc_num");
?>