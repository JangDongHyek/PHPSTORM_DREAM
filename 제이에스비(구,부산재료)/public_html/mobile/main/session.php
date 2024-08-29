<?
if($pagetype=="ce"){
	$_SESSION["PageType"] = "ce";
?>
	<meta http-equiv="refresh" content="0; url=../main/index.html">
<?
}else{
	$_SESSION["PageType"] = "je";
?>
	<meta http-equiv="refresh" content="0; url=../main/index2.html">
<?
}
?>