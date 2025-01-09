<?
	require_once("include/bbs.lib.inc.php");

	if(!$type) {
	}
	$data=rg_get_doc_info($bbs_id,$doc_num);
	
	if($type == 'home') {
		$dbqry="
				UPDATE `$bbs_table` SET
					`rg_home_hit` = rg_home_hit+1
				WHERE rg_doc_num='$doc_num'
		";
		$rs=query($dbqry,$dbcon);	
		$url = $data["rg_home_url"];
		$rg_home_url=rg_homepage_chk($rg_home_url);
	} else {
		$dbqry="
				UPDATE `$bbs_table` SET
					`rg_link{$type}_hit` = rg_link{$type}_hit+1
				WHERE rg_doc_num='$doc_num'
		";
		$rs=query($dbqry,$dbcon);	
		$url = $data["rg_link{$type}_url"];
	}
	rg_href($url);
?>