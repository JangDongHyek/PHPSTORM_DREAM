<?
	require_once("include/bbs.lib.inc.php");

	if(($type != 'yes') && ($type != 'no')) {
	}

	$tmp=explode(',',$_SESSION["ss_doc_vote"]);
	if(!in_array("$bbs[bbs_num]:$doc_num",$tmp)){
		$dbqry="
				UPDATE `$bbs_table` SET
					`rg_vote_{$type}` = rg_vote_{$type}+1
				WHERE rg_doc_num='$doc_num'
		";
		$rs=query($dbqry,$dbcon);
		array_push($tmp, $bbs[bbs_num].':'.$doc_num);
		$ss_doc_vote = implode(',',$tmp);
//		session_register("ss_doc_vote");
		$_SESSION['ss_doc_vote']=$ss_doc_vote;
	}
	unset($tmp);

	rg_href("view.php?$p_str&page=$page&bbs_id=$bbs_id&doc_num=$doc_num");
?>