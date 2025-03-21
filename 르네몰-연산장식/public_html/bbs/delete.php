<?
	require_once("include/bbs.lib.inc.php");
	$html_title = ($html_title)?$html_title." > 글삭제":'';
	
	if(!$auth[bbs_delete]) {
		$error_msg = '권한이 없습니다.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}

	$data = rg_get_doc_info($bbs_id,$doc_num);
	// 관련글이 있다면 삭제 옵션일 경우 처리 
	$deleted_check = false;
	if(($bbs_cfg[$C_REPLY_DELETE]==1) || ($bbs_cfg[$C_REPLY_DELETE]==3) || ($bbs_cfg[$C_REPLY_DELETE]==4)) {
		$dbqry = "
			SELECT count(*)
			FROM `$bbs_table`
			WHERE `rg_parent_num` = '$data[rg_doc_num]'
		";
		$rs = query($dbqry,$dbcon);
		$tmp = mysql_fetch_array($rs);
		if($tmp[0]) {
			if(($bbs_cfg[$C_REPLY_DELETE]==1) || ($bbs_cfg[$C_REPLY_DELETE]==3)) { // 삭제 불가라면
				$error_msg = '응답글이 있으면 삭제하실수 없습니다.';
				require_once("_header.php");
				include($skin_board_path."error.php");
				require_once("_footer.php");
				exit;
			}
			if($bbs_cfg[$C_REPLY_DELETE]==4) { // 삭제표시만
				$deleted_check = true;
			}
		}
	}

	$u_action = $HTTP_SERVER_VARS['REQUEST_URI'];
	
	if($data) {
		// 로그인이 되어 있지 않거나 자신의 글이 아니고 관리자가 아니라면
		if((!$mb || ($data[rg_mb_num] != $mb[mb_num])) && !$auth[admin] && $MemberLevel!=1) { 
			if($old_password) {  // 암호 입력이 있다면 
				if($data[rg_password] != get_password_str($old_password)) {
					$msg = '암호가 다릅니다.\n정확히 입력해주세요.';
					rg_href('',$msg,'','back');
				}
			} else { // 암호입력이 없다면 
				$title='글삭제 암호를 입력하세요.';
				require_once("_header.php");
				include($skin_board_path."password.php");
				require_once("_footer.php");		
				exit;
			}		
		} else { // 회원등 바로 삭제할수 있다면 확인 작업을 거친다.
			if($act != 'confirm_ok') {  // 삭제 확인이 아니면
				$title='글삭제 확실합니까?';
				require_once("_header.php");
				include($skin_board_path."confirm.php");
				require_once("_footer.php");		
				exit;
			}		
		}

		if($deleted_check) {
			// 글을 삭제한다.
			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_deleted` = '1'
				WHERE rg_doc_num = '$doc_num'
			";
			query($dbqry,$dbcon);
		} else {
		  // 글삭제 함수를 이용해서 삭제한다.
			rg_bbs_doc_del($bbs_id,$doc_num);
		}
	}
	rg_href("list.php?$p_str&page=$page&bbs_id=$bbs_id");
?>