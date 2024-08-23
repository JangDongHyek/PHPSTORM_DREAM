<?
if (!defined('BBS_LIB_INC_INCLUDED')) {  
    define('BBS_LIB_INC_INCLUDED', 1);
// *-- BBS_LIB_INC_INCLUDED START --*

	if (!get_magic_quotes_gpc()) {
		$bbs_id = addslashes($bbs_id); // �Է°� Ư������ ���͸�
		$page = addslashes($page);
		$type = addslashes($type);
		$doc_num = addslashes($type);
	}

	$bbs_id = htmlentities($bbs_id);
	$page = htmlentities($page);
	$type = htmlentities($type);
	$doc_num = htmlentities($doc_num);

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"�ҹ� ���� ����\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';

	require_once "{$site_path}include/lib.inc.php";

	// �Խ��� ���� �ε�
	if($bbs_id) {
		$bbs = rg_get_bbs_cfg($bbs_id);
	} else {
		include($skin_site_path."head.php");
		$error_msg = '�Խ��� ���̵� �����Ͻʽÿ�.';
		include($skin_site_path.'error.php');	
		include($skin_site_path."foot.php");
		exit;
	}
	if(!$bbs) {
		include($skin_site_path."head.php");
		$error_msg = '�������� ���� �Խ����Դϴ�.';
		include($skin_site_path.'error.php');	
		include($skin_site_path."foot.php");
		exit;
	}
	$bbs_cfg = explode(',', $bbs[bbs_cfg]);
	if($bbs[bbs_bg_image])
		$bbs[bbs_bg_image_tag] = "background=\"$bbs[bbs_bg_image]\"";
	if($bbs[bbs_bg_color])
		$bbs[bbs_bg_color_tag] = "bgcolor=\"$bbs[bbs_bg_color]\"";

	// �Խ��� ���� ���� ������ üũ
	if(rg_chk_deny_ip($bbs[bbs_deny_read_ip],$REMOTE_ADDR)) {
		$error_msg = $REMOTE_ADDR.'���ٱ����� �����ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	// �Խ����� ������ ���� �˻縦�Ѵ�
  //   (���� �Խ��ǿ� ���Ͽ� �ְ� ���������� �����Ѵ�)
  $tmp=explode (",", $bbs['bbs_admin_list']);
  if(in_array($mb[mb_id],$tmp) && !empty($_SESSION[ss_mb_id])) {
		$auth[bbs_admin] = true; 
		$auth[admin] = true; 
	} else {
		$auth[bbs_admin] = false; 
	}

	$group = rg_get_group_cfg($bbs[bbs_gr_num],1);  // �׷�����
	if(!$group) {
		$error_msg = '�������� ���� �׷��Դϴ�.<br>�׷������� �ùٸ��� �ʽ��ϴ�.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");	
		exit;
	}

	// �׷���¸� �ľ��Ѵ�.
	switch($group[gr_state]) {
		case 1 : // ���δ����
			$error_msg = '���δ������ �׷��Դϴ�.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");	
			exit;
		case 2 : // ���� �׷�
			$error_msg = '���� �׷��Դϴ�.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");	
			exit;
	}
	
	// �̸�ǥ������ 
	if($mb) { // �α��� �Ǿ� �ִٸ� 
		switch($group[gr_name_disp]){
			case 0:
				$mb[mb_show_name] = $mb[mb_id];
				break;
			case 1:
				$mb[mb_show_name] = $mb[mb_name];
				break;
			case 2:
				$mb[mb_show_name] = $mb[mb_nick];
				break;
		}
		if($mb[mb_show_name]=='') $mb[mb_show_name] = $mb[mb_id];		
	}

	// �׷�ȸ������
	$group_member = rg_get_group_member_info($bbs[bbs_gr_num],$mb[mb_num],2); 

	if($group_member) {
		// ���Ѽ���
		// �׷�ȸ�������� 10�̸� �׷������
		$auth[group_admin] = ($group_member[gm_level]>9)?true:false; 
		$auth[admin] = ($auth[group_admin])?true:$auth[admin]; 
	} else {
		$auth[group_admin] = false; 
	}

	// �׷��������
	if($group[gr_open] && !$group_member) {
			$error_msg = '����� �׷��Դϴ�.';
			require_once("_header.php");
			include($skin_board_path."error.php");
			require_once("_footer.php");	
			exit;
	}
	// ��Ų���� ���� ����
	$skin_board_path = $skin_path.$skin_board_dir.$bbs[bbs_skin].'/';
	$skin_board_url = $skin_url.$skin_board_dir.$bbs[bbs_skin].'/';
	
	// ��Ų �¾�
	if (file_exists($skin_board_path."setup.php")) 
    include($skin_board_path."setup.php");

	$tmp = array(1=>"read",2=>"write",3=>"reply",4=>"comment",5=>"upload",
	             6=>"download",7=>"vote_yes",8=>"vote_no",9=>"html",10=>"list",
							11=>"link",12=>"notice",13=>"edit",14=>"secret",15=>"cart",
							16=>"delete");
	if($group[gr_level_type]) {
		$tmp_level = $group_member[gm_level];
	} else {
		$tmp_level = $mb[mb_level];
	}

	foreach($tmp as $key => $val) {
		switch($bbs_cfg[$key]) {
			case 'A' : $auth["bbs_{$val}"] = true;break;// ��ü 
			case 'M' : $auth["bbs_{$val}"] = ($mb)?true:false;break;// ȸ�� 
			case 'G' : $auth["bbs_{$val}"] = ($group_member)?true:false;break;// �׷�ȸ�� 
			case 'D' :
			case 10 : $auth["bbs_{$val}"] = ($auth[admin])?true:false;break;// ��� 
			case 'N' : $auth["bbs_{$val}"] = false;break;// ������
			case 0 :
			case 1 : 
			case 2 :
			case 3 : 
			case 4 :
			case 5 : 
			case 6 :
			case 7 : 
			case 8 : 
			case 9 : 
			default : // ������ ����
					$auth["bbs_{$val}"] = ($tmp_level>=$bbs_cfg[$key])?true:false;
					break;
//					$error_msg = '�߸��� �����Դϴ�.';
//					include($skin_site_path.'error.htm');
//					exit;
//					break;
		}
		$GLOBALS["show_{$val}_begin"] = ($auth["bbs_{$val}"])?'':'<!--';
		$GLOBALS["show_{$val}_end"] = ($auth["bbs_{$val}"])?'':'-->';
	}	
	unset($tmp_level);
	unset($tmp);
	
	// �Խ��� ���̺� ���� ����
	$bbs_table = $db_table_prefix.$bbs[bbs_id].$db_table_suffix_body;
	$commant_table = $db_table_prefix.$bbs[bbs_id].$db_table_suffix_comment;
	$category_table = $db_table_prefix.$bbs[bbs_id].$db_table_suffix_category;
	
	// ī�װ� ��뿩��
	if($bbs_cfg[$C_USE_CATEGORY]==1) {
		$dbqry="
			SELECT *
			FROM `$category_table`
			ORDER BY cat_order
		";
		
		$rs=query($dbqry,$dbcon);
		while ($R=mysql_fetch_array($rs)) {
			$category_list[$R[cat_num]] = $R;
		}
		mysql_free_result($rs);
		unset($R);
		$show_category_begin = '';
		$show_category_end = '';
	} else {
		$show_category_begin = '<!--';
		$show_category_end = '-->';
	}
	
	// �Ķ��Ÿ ó��
	$p_str="";
	
	if(count($ss)==0) $ss=array();
//	$ss_key=array_keys($ss);

	reset($ss);
	while (list ($ss_key, $ss_val) = each ($ss)) {
//	for($i=0;$i < count($ss_key);$i++) {
		$p_str.="&ss[$ss_key]=".$ss_val;
	}
	unset($ss_key);
	unset($ss_val);
	

	// =================================================================
	// ����Ÿ �������� 
	$bbs_data_path = $data_path.$bbs_id.'/';
	$bbs_data_url = $data_url.$bbs_id.'/';
	

	// ��ũ��������
	$u_category = "{$site_url}list.php?bbs_id=$bbs_id&ss[fc]=";
	$u_navigation = "{$site_url}list.php?$p_str&bbs_id=$bbs_id&page=";
	$u_search = "{$site_url}list.php?bbs_id=$bbs_id";
	$u_view = "{$site_url}view.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
	$u_images_view = "{$site_url}images_view.php?$p_str&bbs_id=$bbs_id&doc_num=";

	$u_comment_write = "{$site_url}comment.php?$p_str&bbs_id=$bbs_id&page=$page&type=write&doc_num=$doc_num";
	$u_comment_delete = "{$site_url}comment.php?$p_str&bbs_id=$bbs_id&page=$page&type=delete&cmt_num=";

	$u_all_list = "{$site_url}list.php?bbs_id=$bbs_id";
	$a_all_list = "<a href=\"$u_list\" $class[link_bbs]>";
	$u_list = "{$site_url}list.php?$p_str&bbs_id=$bbs_id&page=$page";
	$a_list = "<a href=\"$u_list\" $class[link_bbs]>";
		
	if($auth[bbs_edit]) {
		$u_edit = "{$site_url}edit.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_edit = "<a href=\"$u_edit$doc_num\" $class[link_bbs]>"; 
	} else {
		$u_edit = "";
		$a_edit = "<RG--";
	}
	
	//echo $auth[bbs_write];
	if($auth[bbs_write]) {
		$u_write = "{$site_url}write.php?bbs_id=$bbs_id";
		$a_write = "<a href=\"$u_write\" $class[link_bbs]>";
	} else {
		$u_write = "";
		$a_write = "<RG--";
	}

	if($auth[bbs_delete]) {
		$u_delete = "{$site_url}delete.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_delete = "<a href=\"$u_delete$doc_num\" $class[link_bbs]>";
	} else {
		$u_delete = "";
		$a_delete = "<RG--";
	}

	if($auth[bbs_reply]) {
		$u_reply = "{$site_url}reply.php?$p_str&bbs_id=$bbs_id&page=$page&doc_num=";
		$a_reply = "<a href=\"$u_reply$doc_num\" $class[link_bbs]>"; 
	} else {
		$u_reply = "";
		$a_reply = "<RG--";
	}

	if($auth[bbs_vote_yes]) {
		$u_vote_yes = "{$site_url}vote.php?$p_str&bbs_id=$bbs_id&page=$page&type=yes&doc_num=";
		$a_vote_yes = "<a href=\"$u_vote_yes$doc_num\" $class[link_bbs]>";
	} else {
		$u_vote_yes = "";
		$a_vote_yes = "<RG--";
	}

	if($auth[bbs_vote_no]) {
		$u_vote_no = "{$site_url}vote.php?$p_str&bbs_id=$bbs_id&page=$page&type=no&doc_num=";
		$a_vote_no = "<a href=\"$u_vote_no$doc_num\" $class[link_bbs]>";
	} else {
		$u_vote_no = "";
		$a_vote_no = "<RG--";
	}
	
	// �ٿ�ε� ����
	if($auth[bbs_download]) {
		$u_file1 = "{$site_url}download.php?$p_str&bbs_id=$bbs_id&page=$page&type=1&doc_num=";
		$a_file1 = "<a href=\"$u_file1$doc_num\" $class[link_bbs]>";
		$u_file2 = "{$site_url}download.php?$p_str&bbs_id=$bbs_id&page=$page&type=2&doc_num=";
		$a_file2 = "<a href=\"$u_file2$doc_num\" $class[link_bbs]>";
	} else {
		$u_file1 = "";
		$a_file1 = "<RG--";
		$u_file2 = "";
		$a_file2 = "<RG--";
	}
	
	// ��ũ��뿩��
	if($bbs_cfg[$C_AUTH_LINK]!='N') {
		$u_link1 = "{$site_url}link.php?$p_str&bbs_id=$bbs_id&page=$page&type=1&doc_num=";
		$a_link1 = "<a href=\"$u_link1$doc_num\" target=_blank $class[link_bbs]>";
		$u_link2 = "{$site_url}link.php?$p_str&bbs_id=$bbs_id&page=$page&type=2&doc_num=";
		$a_link2 = "<a href=\"$u_link2$doc_num\" target=_blank $class[link_bbs]>";
	} else {
		$u_link1 = "";
		$a_link1 = "<RG--";
		$u_link2 = "";
		$a_link2 = "<RG--";
	}
	$u_home = "{$site_url}link.php?$p_str&bbs_id=$bbs_id&page=$page&type=home&doc_num=";
	$a_home = "<a href=\"$u_home$doc_num\" target=_blank $class[link_bbs]>";
	
	// =================================================================
	
	$show_chk_begin = ($auth[bbs_cart])?'':'<!--';
	$show_chk_end = ($auth[bbs_cart])?'':'-->';

	if($auth[admin]) {
		$a_setup="<a href={$site_url}admin/board_edit.php?mode=edit&bbs_num=$bbs[bbs_num] $class[link_header] target=\"_blank\">";
		$u_board_manager = "{$site_url}admin/board_manager.php";
		$a_board_manager = "<a href=\"javascript:board_manager('$u_board_manager')\" $class[link_bbs]>";
		$show_admin_begin = '';
		$show_admin_end = '';
	} else {
		$a_setup="<RG----";
		$u_board_manager = '';
		$a_board_manager = '<RG--';
		$show_admin_begin = '<!--';
		$show_admin_end = '-->';
	}

	$show_reply_mail_begin = ($bbs_cfg[$C_USE_REPLAY_MAIL])?'':'<!--';
	$show_reply_mail_end = ($bbs_cfg[$C_USE_REPLAY_MAIL])?'':'-->';

	if(!isset($ss[sn]) && !isset($ss[st]) && !isset($ss[sc]) && !isset($ss[kw])) {
		$ss[sn]='';
		$ss[st]='1';
		$ss[sc]='1';
	}

	$checked_sn = ($ss[sn] == '1')?'checked':'';
	$checked_st = ($ss[st] == '1')?'checked':'';
	$checked_sc = ($ss[sc] == '1')?'checked':'';
	
	//
	$width=$bbs[bbs_width];
	$align=$bbs[bbs_align];

	if(!$is_addon)
		$html_title = ($bbs[bbs_title])? $bbs[bbs_title] : $html_title." > ".$bbs[bbs_name];
		
	$group[gr_header_file] = 
	    str_replace('{$site_path}',"$site_path",$group[gr_header_file]);
	$group[gr_footer_file] = 
	    str_replace('{$site_path}',"$site_path",$group[gr_footer_file]);

	$bbs[bbs_header_file] = 
	    str_replace('{$site_path}',"$site_path",$bbs[bbs_header_file]);
	$bbs[bbs_footer_file] = 
	    str_replace('{$site_path}',"$site_path",$bbs[bbs_footer_file]);

} // *-- BBS_LIB_INC_INCLUDED END --*
?>
