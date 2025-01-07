<?php
$sub_menu = "300000";
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
//$sql="truncate table g5_category";
//sql_query($sql);
for($i=0;$i<count($_POST[category_name]);$i++){
	if($_POST[category_name][$i]!=""){
		$common = " g5_category set category_name='{$_POST['category_name'][$i]}'";
		if($_POST[idx][$i]){
			$sql="update $common where idx='{$_POST[idx][$i]}'";
		}else{
			$sql="insert $common";
		}
		sql_query($sql);
//		sql_query($sql);
	}
}

for($i=0;$i<count($_POST[idx]);$i++){
	if($_POST[idx][$i] && !$_POST[category_name][$i]){
		$sql="update g5_item set category_no='0' where category_no='{$_POST[idx][$i]}'";
		sql_query($sql);
		$sql="delete from g5_category where idx = '{$_POST[idx][$i]}'";
		sql_query($sql);
	}
}
?>
<script>
opener.document.location.reload();
self.close();
</script>