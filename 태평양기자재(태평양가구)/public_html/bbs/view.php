<?
	require_once("include/bbs.lib.inc.php");

	if(!$auth[bbs_read]) {
		echo"<script>location.href='../bbs/mb_login.php?url=../bbs/list.php?bbs_id=$bbs_id';</script>";
		exit;

		$error_msg = '������ �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		//$url = $HTTP_SERVER_VARS['REQUEST_URI'];
		//include("mb_login.php");
		require_once("_footer.php");
		exit;
	}

	$dbqry="
		SELECT `$bbs_table`.*,
						mb_icon,mb_id,mb_name,mb_nick,mb_level,
						mb_open_info,mb_signature
		FROM `$bbs_table` LEFT JOIN `$db_table_member`
			ON rg_mb_num = mb_num
		WHERE rg_doc_num = '$doc_num'";
	$rs = mysql_query($dbqry,$dbcon);
	if(mysql_num_rows($rs)) {
		$data=mysql_fetch_array($rs);
	} else {
		rg_href("list.php?$p_str&page=$page&bbs_id=$bbs_id");
	}
//	$data=rg_get_doc_info($bbs_id,$doc_num);

	$html_title = ($html_title)?$html_title." > ".$data[rg_title]:$data[rg_title];
	
	if($data[rg_deleted] && !$auth[admin]) { //�����ȱ� 
		$error_msg = '������ ���Դϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	// ��б� üũ
	if($data[rg_secret]) {
		if($data['rg_parent_num'] == 0) {
			$parent_data=false;
		} else {
			$parent_data=rg_get_doc_info($bbs_id,$data['rg_parent_num']);
		}
	 	// �ڽ��� ��
		$view_check1=($mb[mb_num] == $data[rg_mb_num]);
	 	// �θ���� �ڽ��� ��
		$view_check2=(($mb[mb_num] == $parent_data[rg_mb_num]) && $parent_data);
		
		if(!($mb && ($view_check1 || $view_check2)) && !$auth[admin]) {	
			if($bbs_cfg[$C_AUTH_SECRET] == 'A') {
				if($old_password) {  // ��ȣ �Է��� �ִٸ� 
					// �۾�ȣüũ 
					$view_check3=(get_password_str($old_password) == $data[rg_password]);
					// �θ�۾�ȣüũ 
					$view_check4=((get_password_str($old_password) == $parent_data[rg_password])
					                && $parent_data);
					
					if(!($view_check3 || $view_check4)) {
						$msg = '��ȣ�� �ٸ��ϴ�.\n��Ȯ�� �Է����ּ���.';
						rg_href('',$msg,'','back');
					}
				} else { // ��ȣ�Է��� ���ٸ�
					$title='��б� ��ȣ�� �Է��ϼ���.';
					require_once("_header.php");
					include($skin_board_path."password.php");
					require_once("_footer.php");		
					exit;
				}	
			} else {
				$msg = '��б��� ������ �����ϴ�.\n�α����� �Ǿ� ���� �ʴٸ� �α������ּ���.';
				rg_href('',$msg,'','back');
			}
		}
		
		// �׳� ������ �ִ�����
		// 1 �α��εǾ� �ְ�, �ڽ��� ��
		// 2 ������
		
		// ��ȣ üũ�Ұ�� ��б۾��Ⱑ A�� �Ǿ� �ִ°ܿ�  
		
		// �ƿ� ���д°�� 
		// ��б۾��Ⱑ A�� �ƴѰ��
		
	}
	extract($data);
	
	// ī�װ��� option �±� �� �����Ѵ�.
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	
	// �ۺ����� ����� ������ �� ���� ǥ���Ѵ�.
	$u_list = "{$site_url}list.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=$doc_num";
	$a_list = "<a href=\"$u_list\" $class[link_bbs]>";

	// �� ��ȸ�� �ø��� 
	if($data[rg_mb_num] == '0' || $mb[mb_num] != $data[rg_mb_num]) {
		$tmp=explode(',',$_SESSION["ss_doc_hit"]);
		if(!in_array("$bbs[bbs_num]:$doc_num",$tmp)){
			$dbqry = "
				UPDATE $bbs_table SET
					`rg_doc_hit` = `rg_doc_hit` + 1
				WHERE rg_doc_num = '$doc_num'
			";
			$rs = query($dbqry,$dbcon);
			array_push($tmp, $bbs[bbs_num].':'.$doc_num);
			$ss_doc_hit = implode(',',$tmp);
//			session_register("ss_doc_hit");
			$_SESSION['ss_doc_hit']=$ss_doc_hit;
		}
		unset($tmp);
	}
	
	// �ۺ��� �ؼ�
	include("{$site_path}include/view.inc.php");

/************************************/	
// ������ // ������ ó��
/************************************/
	include("{$site_path}include/list_where.inc.php");

	// ������
	$dbqry = "
		SELECT *
		FROM `$bbs_table`
		WHERE (rg_next_num > '$data[rg_next_num]') $where_str
		ORDER BY rg_next_num
		LIMIT 0,1
	";
	$rs = query($dbqry,$dbcon);
	$prev_data = mysql_fetch_array($rs);

	if($prev_data) {
		$a_prev = "<a href=\"$u_view$prev_data[rg_doc_num]\">";
	}	else {
    $show_prev_begin = '<!--';
    $show_prev_end = '-->';
		$a_prev = '<RG--';
	}
	
	// ������
	$dbqry = "
		SELECT *
		FROM `$bbs_table`
		WHERE (rg_next_num < '$data[rg_next_num]') $where_str
		ORDER BY rg_next_num DESC
		LIMIT 0,1
	";
	$rs = query($dbqry,$dbcon);
	$next_data = mysql_fetch_array($rs);
	if($next_data) {
		$a_next = "<a href=\"$u_view$next_data[rg_doc_num]\">";
	} else {
    $show_next_begin = '<!--';
    $show_next_end = '-->';
		$a_next='<RG--';
	}
	
	require_once("_header.php");

	include($skin_board_path."view_main.php");
	
/****************************************************************************/
// �ڸ�Ʈ�κ�
/****************************************************************************/
	// ���̵�, �̸���, ��ȣ �Է� ���� 
	// �α��� ���� �ʾҴٸ� ������ �Է�
	
	if($mb) {
		$cmt_name = $mb[mb_show_name];
		$cmt_email = $mb[mb_email];
	} else {
		$cmt_name = '';
		$cmt_email = '';
	}
	if($auth[bbs_comment]) {
		$show_comment_form_begin = '';
		$show_comment_form_end = '';
	} else {
		$show_comment_form_begin = '<!--';
		$show_comment_form_end = '-->';
		$show_mb_login_begin = '';
		$show_mb_login_end = '';
		$show_mb_logout_begin = '';
		$show_mb_logout_end = '';
	}

	include($skin_board_path."view_cmt_head.php");

	$dbqry="
		SELECT `$commant_table`.*,mb_icon,mb_id,mb_open_info,mb_homepage
		FROM `$commant_table` LEFT JOIN `$db_table_member`
			ON cmt_mb_num = mb_num
		WHERE cmt_doc_num = '$doc_num'
		ORDER BY cmt_num
	";
	$rs=query($dbqry,$dbcon);
	while ($cdata=mysql_fetch_array($rs)) {
		$mb_icon='';
		$mb_id='';
		$mb_open_info='';
		$mb_homepage='';
		extract($cdata);
		$cmt_reg_date = rg_date($cdata[cmt_reg_date],$bbs[bbs_view_date_disp]);
		$a_comment_delete = "<a href=\"$u_comment_delete$cmt_num\">";
		if($bbs_cfg[$C_USE_MB_ICON] && $mb_icon) { // �������� �ִٸ�
			$cmt_mb_icon = "<img src=$member_icon_url$mb_icon align=absbottom>";
		} else {
			$cmt_mb_icon = '';
		}
		// ���� ǥ������
		// 1 : ��ü ��밡���ϴٸ� ������ ǥ��
		// 2 : ��ü�� �ƴ϶�� �۾����
		// ������ �α��� �ΰ�� ������ ������ ���� 
		if($bbs_cfg[$C_AUTH_COMMENT] == 'A' || $auth[admin] || ($cmt_mb_num == $mb[mb_num])) {
			$show_comment_delete_begin = '';
			$show_comment_delete_end = '';
		} else {
			$show_comment_delete_begin = '<!--';
			$show_comment_delete_end = '-->';
		}
		$cmt_comment = rg_conv_text($cmt_comment);
		if(!$auth[admin]) $cmt_reg_ip = rg_hidden_ip($cmt_reg_ip);

		include($skin_board_path."view_cmt_main.php");
	}
	if($mb) {
		$cmt_name = $mb[mb_show_name];
		$cmt_email = $mb[mb_email];
	} else {
		$cmt_name = '';
		$cmt_email = '';
	}

	include($skin_board_path."view_cmt_foot.php");
	include($skin_board_path."view_foot.php");

/****************************************************************************/
// ��Ϻκ�
/****************************************************************************/
	switch($bbs_cfg[$C_VIEW_LIST]) {
		case 1 : 
//			include("{$site_path}include/list_where.inc.php");
			include("{$site_path}include/list.inc.php");
			break;
		case 2 :
		  $where_str=" AND (rg_top_num = '{$data[rg_top_num]}') ";
			include("{$site_path}include/list.inc.php");
			break;
		default : break;
	}
	require_once("_footer.php");

	// �κ������ ���� �ϱ� ���ؼ�	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>
