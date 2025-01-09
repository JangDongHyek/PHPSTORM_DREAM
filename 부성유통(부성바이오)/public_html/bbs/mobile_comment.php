<?
	require_once("include/bbs.lib.inc.php");
	
	if(!$auth[bbs_comment]) {
		$error_msg = '권한이 없습니다.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	if(rg_chk_deny_ip($bbs[bbs_deny_write_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'쓰기권한이 없습니다.';
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
			
			// 로그인이 되어 있지 않거나 자신의 글이 아니고 관리자가 아니라면
			if((!$mb || ($cmt[cmt_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
				if($bbs_cfg[$C_AUTH_COMMENT] == 'A') {
					if($old_password) {  // 암호 입력이 있다면 
						if($cmt[cmt_password] != get_password_str($old_password)) {
							$msg = '암호가 다릅니다.\n정확히 입력해주세요.';
							rg_href('',$msg,'','back');
						}
					} else { // 암호입력이 없다면
						$title='코멘트삭제 암호를 입력하세요.';
						require_once("_header.php");
						include($skin_board_path."mobile_password.php");
						require_once("_footer.php");		
						exit;
					}	
				} else {
					$msg = '삭제 할수 없습니다.\n로그인이 되어 있지 않다면 로그인해주세요.';
					rg_href('',$msg,'','back');
				}
			} else { // 회원등 바로 삭제할수 있다면 확인 작업을 거친다.
				if($act != 'confirm_ok') {  // 삭제 확인이 아니면
					$title='코멘트삭제 확실합니까?';
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
					$error_msg = '원격글쓰기 제한';
					require_once("_header.php");
					include($skin_board_path."error.php");
					require_once("_footer.php");
					exit;
				}
				if($_SESSION['write_key']!=$bbs[bbs_num].'.'.$bbs[bbs_id]) {
					$error_msg = '로봇에의한 글쓰기 제한';
					require_once("_header.php");
					include($skin_board_path."error.php");
					require_once("_footer.php");
					exit;
				}
			}
			unset($_SESSION['write_key']);

			if($bbs[bbs_write_time] && ($_SESSION[ss_write_date]+$bbs[bbs_write_time] > $now) && !$auth[admin]) {
				$error_msg = $bbs[bbs_write_time].'초 후에 글을 올려주세요.(도배방지)';
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
				$error_msg = '코멘트 내용을 입력하세요.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			if($tmp = rg_str_inword($bbs[bbs_deny_word],$cmt_comment)) {
				$error_msg = $tmp.'(은)는 사용할수 없는 단어입니다.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			$cmt_reg_date = $now;
			$cmt_reg_ip = $REMOTE_ADDR;
			$cmt_doc_num = $doc_num;
			$cmt_mb_num = ($mb)?$mb[mb_num]:'0';

			if($mb) { // 로그인 되어 있다면 
				$cmt_name = $mb[mb_show_name];
				$cmt_email = $mb[mb_mail];
			} else {
				if($cmt_name=='') {
					$error_msg = '이름을 입력하세요.';
					require_once("_header.php");
					include($skin_board_path."error.php");
					require_once("_footer.php");
					exit;
				}
/*				if(!$cmt_email){
					$error_msg = '이메일을 입력하세요.';
					include($skin_site_path.'error.htm');
					exit;
				}
*/
				if($cmt_password=='') {
					$error_msg = '암호를 입력하세요.';
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
 메일 발송기능
 응답글 메일발송인경우 바로 상위 글의 이메일로만 메일을 발송한다.
 전체 관련글의 이메일로 발송을 할지는 차후 결정한다. 

 관련글 메일발송 
(관련글 메일발송기능 활성화가 되어 있고,상위글의 이메일이 존재한다면) 
또는
(운영자메일수신 되어 있고 운영자 목록이 있다면)
*/
			if((($bbs_cfg[$C_USE_REPLAY_MAIL] && $reply[rg_email] && 
			                                   $reply[rg_reply_mail]) ||
					($bbs_cfg[$C_USE_ADMIN_MAIL]  && $bbs[bbsdmin_list])) &&
					 file_exists($skin_board_path."mail.php")) { 
				$mail_subject = $site[st_site_name];
				$mail_subject = ($mail_subject)?
												$mail_subject." > ".$bbs[bbs_name]:
												$bbs[bbs_name];
				$mail_subject = "[{$mail_subject}] 코멘트글이 올라왔습니다.";
				$mail_title = rg_conv_text($reply[rg_title]);
				$mail_from_name = $cmt_name;
				$mail_content = rg_conv_text($cmt_comment);
				$mail_view_url = rg_get_current_url().'mobile_view.php?&bbs_id='.$bbs_id.'&doc_num='.$doc_num;
	
				$mail_subject = stripslashes($mail_subject);
				$mail_title = stripslashes($mail_title);
				$mail_from_name = stripslashes($mail_from_name);
				$mail_content = stripslashes($mail_content);
		
				// 게시판관리자 이메일 추출하기 
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
				// 응답글..
				if($bbs_cfg[$C_USE_REPLAY_MAIL] && $reply[rg_email] && 
			                                   $reply[rg_reply_mail])
					$email_list[] = $reply[rg_email];
				// 메일 발송 루틴은 공용
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