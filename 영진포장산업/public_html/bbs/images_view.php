<?
	require_once("include/bbs.lib.inc.php");

	if(!$auth[bbs_read]) {
		rg_href("","������ �����ϴ�.","","close");
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
		rg_href("","","","close");
	}
//	$data=rg_get_doc_info($bbs_id,$doc_num);

	$html_title = ($html_title)?$html_title." > ".$data[rg_title]:$data[rg_title];	
	
	if($data[rg_deleted] && !$auth[admin]) { //�����ȱ� 
		rg_href("","������ ���Դϴ�.","","close");
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
				rg_href('',$msg,'','close');
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
		$a_prev = "<a href=\"$u_images_view$prev_data[rg_doc_num]\">";
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
		$a_next = "<a href=\"$u_images_view$next_data[rg_doc_num]\">";
	} else {
    $show_next_begin = '<!--';
    $show_next_end = '-->';
		$a_next='<RG--';
	}
	
	include($skin_board_path."images_view.php");	
?>