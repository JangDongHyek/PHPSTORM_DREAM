<?
	require_once("include/mobile.bbs.lib.inc.php");
	$html_title = ($html_title)?$html_title." > �ۻ���":'';
	
	if(!$auth[bbs_delete]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_mobile_header.php");
		include($skin_board_path."mobile_error.php");
		require_once("_mobile_footer.php");
		exit;
	}

	$data = rg_get_doc_info($bbs_id,$doc_num);
	// ���ñ��� �ִٸ� ���� �ɼ��� ��� ó�� 
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
			if(($bbs_cfg[$C_REPLY_DELETE]==1) || ($bbs_cfg[$C_REPLY_DELETE]==3)) { // ���� �Ұ����
				$error_msg = '������� ������ �����ϽǼ� �����ϴ�.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_error.php");
				require_once("_mobile_footer.php");
				exit;
			}
			if($bbs_cfg[$C_REPLY_DELETE]==4) { // ����ǥ�ø�
				$deleted_check = true;
			}
		}
	}

	$u_action = $HTTP_SERVER_VARS['REQUEST_URI'];
	
	if($data) {
		// �α����� �Ǿ� ���� �ʰų� �ڽ��� ���� �ƴϰ� �����ڰ� �ƴ϶��
		if((!$mb || ($data[rg_mb_num] != $mb[mb_num])) && !$auth[admin]) { 
			if($old_password) {  // ��ȣ �Է��� �ִٸ� 
				if($data[rg_password] != get_password_str($old_password)) {
					$msg = '��ȣ�� �ٸ��ϴ�.\n��Ȯ�� �Է����ּ���.';
					rg_href('',$msg,'','back');
				}
			} else { // ��ȣ�Է��� ���ٸ� 
				$title='�ۻ��� ��ȣ�� �Է��ϼ���.';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_password.php");
				require_once("_mobile_footer.php");		
				exit;
			}		
		} else { // ȸ���� �ٷ� �����Ҽ� �ִٸ� Ȯ�� �۾��� ��ģ��.
			if($act != 'confirm_ok') {  // ���� Ȯ���� �ƴϸ�
				$title='�ۻ��� Ȯ���մϱ�?';
				require_once("_mobile_header.php");
				include($skin_board_path."mobile_confirm.php");
				require_once("_mobile_footer.php");		
				exit;
			}		
		}

		if($deleted_check) {
			// ���� �����Ѵ�.
			$dbqry="
				UPDATE `$bbs_table` SET
					`rg_deleted` = '1'
				WHERE rg_doc_num = '$doc_num'
			";
			query($dbqry,$dbcon);
		} else {
			//�������������� gm���ϵ鵵 �����ϱ�
			$dbqry2 = "
				SELECT *
				FROM `$bbs_table`
				WHERE `rg_doc_num` = '$data[rg_doc_num]'
			";
			$rs2 = query($dbqry2,$dbcon);
			$tmp2 = mysql_fetch_array($rs2);

			
			preg_match_all("/src=\"([^>]*)\"/is", $tmp2[rg_content], $output); 
			for($i=0;$i<100;$i++){


				$output_1 = str_replace('"',"",$output[0][$i]);
				$output_2 = explode("/",$output_1);
				$output_22 = $output_2[7];
				$oupput_3 = "../bbs/editor/tmp/".$output_22;
				
				if(!$output_22){
					$oupput_3 = "../bbs/editor/tmp/".$output_2[6];
					$output_22 = $output_2[6];
				}
			
				if($output_22){
					if(file_exists($oupput_3)){
						unlink($oupput_3);
					}
				}
				
			}
			//��
		    // �ۻ��� �Լ��� �̿��ؼ� �����Ѵ�.
			rg_bbs_doc_del($bbs_id,$doc_num);
		}
	}
	rg_href("mobile_list.php?$p_str&page=$page&bbs_id=$bbs_id");
?>
