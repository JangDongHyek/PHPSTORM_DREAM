<?
 $site_path = "/home/yensan/public_html/bbs/"; 
  $site_url = "http://www.renemall.co.kr/bbs/"; 
	require_once($site_path."include/lib.inc.php");
	require_once($site_path."include/schema.inc.php");

		$dbqry = "
				SELECT *
				FROM `tblpopup` where idx = '$idx'
					";

		$rs = query($dbqry, $dbcon);
		$R=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		$idx = $R[idx];
		$rg_file1_name = $R[file1];
	

	if($mode=="delete") {
		
		$dbqry = "
				DELETE FROM
				`tblpopup` where idx = '$idx'
				";
			query($dbqry, $dbcon);

		$bbs_data_path = "../editor/upload/";

		// 파일처리
		if($rg_file1_name)
			@unlink($bbs_data_path.$rg_file1_name);
	
		rg_href("popup_list.php?$p_str");
	}
?>	
