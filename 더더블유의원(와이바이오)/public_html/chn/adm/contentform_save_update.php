<?php
include_once("./_common.php");

for ($i=0; $i<count($_POST['chk']); $i++) {

	// 실제 번호를 넘김
	$k = $_POST['chk'][$i];
	$sql = " delete from {$g5['content_save_table']} where co_no = '{$co_no[$k]}' ";
	sql_query($sql);
}

if($co_id)
	$qstr .= "&co_id=".$co_id;

goto_url(G5_ADMIN_URL."/contentform_save.php?".$qstr);
?>