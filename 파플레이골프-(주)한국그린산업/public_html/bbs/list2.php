<?
	require_once("include/bbs.lib.inc.php");

	if(!$auth[bbs_list]) {
		$error_msg = '������ �����ϴ�.';
		require_once("_header.php");
		if( $mb && ($HTTP_SESSION_VARS[ss_login_ok]=='ok') && !empty($HTTP_SESSION_VARS[ss_mb_id]))
		{
		
			include($skin_board_path."error.php");
		}else{
			$login_url = "mb_login.php";
			$url = "list.php?bbs_id=$bbs_id";
			include($skin_site_path."mb_login.php");
		}
		require_once("_footer.php");
		exit;
	}

	require_once("_header.php");
	// ī�װ��� option �±� �� �����Ѵ�.	
	$category_list_option=rg_html_option($category_list,'cat_num','cat_name',$ss[fc]);
	include("{$site_path}include/list_where.inc.php");
	include("{$site_path}include/list.inc2.php");
	require_once("_footer.php");

	// �κ������ ���� �ϱ� ���ؼ�	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>