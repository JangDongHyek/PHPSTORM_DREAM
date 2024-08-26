<?
	header("Cache-control: private");
	require_once("include/bbs.lib.inc.php");
	
	if(!$auth[bbs_download]) {
		$error_msg = '권한이 없습니다.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	if(($type != '1') && ($type != '2')) {
		$error_msg = '잘못된 접근입니다.';
		require_once("_header.php");
		include($skin_board_path."error.php");
		require_once("_footer.php");
		exit;
	}
	
	$data=rg_get_doc_info($bbs_id,$doc_num);
	$file_name = $data["rg_file{$type}_name"];
	$server_name = "{$bbs_data_path}{$doc_num}\$$type\$$file_name";
	download_file($server_name,$file_name);

	$dbqry="
			UPDATE `$bbs_table` SET
				`rg_file{$type}_hit` = rg_file{$type}_hit+1
			WHERE rg_doc_num='$doc_num'
	";
	$rs=query($dbqry,$dbcon);	
?>