<?
	require_once("include/bbs.lib.inc.php");
	$mode_write=true;
	$mode = 'write';
	
	if($act=='del') {
		
	// 글을 삭제한다.
	$dbqry="delete from `$bbs_table` where rg_doc_num = '$doc_num'";
	query($dbqry,$dbcon);

	rg_href("waiting.php?bbs_id=$bbs_id&page=$page");

	}
		

	//require_once("_header.php");
	include($skin_board_path."waiting.html");
	//require_once("_footer.php");

?>