<?php
include_once('./_common.php');

if($w==""){
	$sql = " insert g5_shop_item_option_save set is_name = '{$is_name}', it_id = '{$it_id}' ";
	sql_query($sql);
}else if($w=="u"){
	for($i=0; $i<count($is_no); $i++){
		$sql = " update g5_shop_item_option_save set is_name = '".$is_name[$i]."' where it_id = '".$it_id[$i]."' ";
		sql_query($sql);
	}
}else if($w=="d"){
	$sql = " delete from g5_shop_item_option_save where is_no = '{$is_no}' ";
	sql_query($sql);
}

goto_url(G5_ADMIN_URL."/shop_admin/itemoptionsaveform.php");

?>