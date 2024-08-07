<?php
include_once("./_common.php");

$mb_search_str = ""; 

for($i=0; $i<count($_POST['mb_search']); $i++){
	if($i != 0) $mb_search_str .= "|";
	$mb_search_str .= $_POST['mb_search'][$i];
}

sql_query("update g5_member set mb_search = '{$mb_search_str}' where mb_id = '{$member['mb_id']}'");

goto_url(G5_URL);
?>