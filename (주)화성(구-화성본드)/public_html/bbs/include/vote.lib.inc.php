<?
if (!defined('VOTE_INC_INCLUDED')) {  
    define('VOTE_INC_INCLUDED', 1);
// *-- VOTE_INC_INCLUDED START --*

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"불법 접근 금지\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';

	if (!defined('LIB_INC_INCLUDED')) {  
		require_once("{$site_path}include/lib.inc.php");
	}
	// 기본그룹
	$group = rg_get_group_cfg("$site[st_default_group]");
	$group[gr_header_file] = 
		str_replace('{$site_path}',"$site_path",$group[gr_header_file]);
	$group[gr_footer_file] = 
		str_replace('{$site_path}',"$site_path",$group[gr_footer_file]);
		
	// 이름표시형태 
	if($mb) { // 로그인 되어 있다면 
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
	}

} // *-- VOTE_INC_INCLUDED END --*
?>