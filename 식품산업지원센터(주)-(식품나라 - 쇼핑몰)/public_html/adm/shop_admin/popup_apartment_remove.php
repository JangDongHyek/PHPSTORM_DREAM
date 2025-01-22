<?php
	include_once("./_common.php");
	$sql="update apartment set is_view='$is_view' where idx='$idx'";
	sql_query($sql);
?>
<script>
	alert(opener.document.location.href);
	location.href="./popup_apartment.php";
</script>
<?
	exit;
	//goto_url("./popup_apartment.php");
?>