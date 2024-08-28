<?php
	include_once("./_common.php");
	$sql="delete from g5_model where idx='$idx'";
	sql_query($sql);
	goto_url("./car_model.php?ca_name=$ca_name");
?>
<script type="text/javascript">
	opener.document.location.reload();
	location.href="./car_model.php?ca_name=<?=$ca_name?>";
</script>
<?php exit;?>