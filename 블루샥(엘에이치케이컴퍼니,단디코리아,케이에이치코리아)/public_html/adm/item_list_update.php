<?php
$sub_menu = "300100";
include_once('./_common.php');

for ($i=0; $i<count($_POST['chk']); $i++)
{
	$k = $_POST['chk'][$i];
	$idx = $_POST['idx'][$k];
	$orderby = $_POST['orderby'][$k];
	if($_POST[act_button]=="선택삭제"){
		$sql="delete from g5_item where idx='$idx'";
	}else{
		$sql="update g5_item set orderby = '$orderby' where idx='$idx'";
	}
	
	sql_query($sql);
}

goto_url("./item_list.php");
?>