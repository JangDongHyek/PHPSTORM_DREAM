<?
	require_once("include/lib.inc.php");
//	session_unregister("ss_mb_id");
//	session_unregister("ss_mb_num");
//	session_unregister("ss_login_ok");
	unset($_SESSION['ss_mb_id']);
	unset($_SESSION['ss_mb_num']);
	unset($_SESSION['ss_mb_level']);
	unset($_SESSION['ss_login_ok']);	
	if(!$url)$url=$site[st_logout_ok_url];
	rg_href($url);
?>