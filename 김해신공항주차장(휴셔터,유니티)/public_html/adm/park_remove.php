<?php
	include_once("./_common.php");
	$sql="delete from park_line where idx='{$_GET[idx]}'";
	sql_query($sql);
	goto_url("./park_line.php");
?>

