<?
	require_once("include/lib.inc.php");
	
	// 로그인 되어 있다면 
	if($_SESSION[ss_mb_id]!='') {
//		if($url==NULL) $url = $HTTP_SERVER_VARS['REQUEST_URI'];
		rg_href($site_url);
	}

	if(!$site[st_joining_check])
	{
		$show_joining_check_begin = "<!--";
		$show_joining_check_end = "-->";
	}

	if(!$site[st_join_agreement])
	{
		$show_agreement_begin = "<!--";
		$show_agreement_end = "-->";
		$show_pravacy_policy_begin = "<!--";
		$show_pravacy_policy_end = "-->";
	}		

	// 약관과 가입여부에 체크되었다면 체크페이지를 보여준다. 
	include($skin_site_path."head.php");
	include($skin_site_path."mb_join_check.php");
	include($skin_site_path."foot.php");
	exit;
?>