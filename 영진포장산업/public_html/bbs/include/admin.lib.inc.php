<?
if (!defined('ADMIN_LIB_INC_INCLUDED')) {  
    define('ADMIN_LIB_INC_INCLUDED', 1);
// *-- ADMIN_LIB_INC_INCLUDED START --*

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"불법 접근 금지\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';

	require_once "{$site_path}include/lib.inc.php";

	// 파라메타 처리
	if(empty($sort) || $sort == "DESC")
	{
		$sort = "DESC";
		$next_sort  = "ASC";
	}
	else
	{
		$sort = "ASC";
		$next_sort  = "DESC";
	}

	$p_str="";
	
	if(!isset($ss)) $ss=array();
	$ss_key=array_keys($ss);

	for($i=0;$i < count($ss_key);$i++) {
		$p_str.="&ss[$ss_key[$i]]=".$ss[$ss_key[$i]];
	}
	
	if(!empty($kw)) {
		$p_str.="&kw=".$kw;
	}
	if(!empty($from) && !empty($to)) {
		$p_str.="&from=".$from. "&to=". $to;
	}
	if(!$mb) {
		rg_href("login.php");
	}
	if(!$auth[site_admin]) {
		rg_href("login.php");
	}
	
} // *-- ADMIN_LIB_INC_INCLUDED END --*
?>