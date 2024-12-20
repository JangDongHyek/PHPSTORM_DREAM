<?php
$sub_menu = "400000";
include_once('./_common.php');
for($i=0;$i<count($_POST['line_name']);$i++){
	if($_POST['idx'][$i]){
		$sql="update park_line set 
				line_name='".$_POST[line_name][$i]."',
				line_order='".$_POST[line_order][$i]."'
				where idx='".$_POST[idx][$i]."'";
	}else{
		$sql="insert park_line set 
				line_name='".$_POST[line_name][$i]."',
				line_order='".$_POST[line_order][$i]."'";
	}
	sql_query($sql);
}
goto_url("./park_line.php");
?>