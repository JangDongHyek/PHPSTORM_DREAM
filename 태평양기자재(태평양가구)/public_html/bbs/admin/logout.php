<?
	$site_path = '../';
	require_once($site_path."include/lib.inc.php");
 	$url=($url)?$url:'admin/';
	rg_href("../mb_logout.php?url=$url");
?>