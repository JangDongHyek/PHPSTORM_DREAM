<?
	require_once("include/bbs.lib.inc.php");
	$bbs_category_table="rg_".$bbs_id."_category";
	require_once("_mobile_header.php");
	include($skin_board_path."mobile_time_list.php");
	require_once("_mobile_footer.php");

	// 로봇등록을 방지 하기 위해서	
	if(!$bbs_cfg[$C_USE_REMOTE_WRITE]) {
		$_SESSION['write_key']=$bbs[bbs_num].'.'.$bbs[bbs_id];
	}
?>