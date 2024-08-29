<?
if($pagetype=="ce"){
	$_SESSION["PageType"] = "ce";

	if($login=='y'){
?>
		<meta http-equiv="refresh" content="0; url=../member/login.html?url=/market/main/index.html">
<?
	}
	if($join=='y'){
?>
		<meta http-equiv="refresh" content="0; url=../member/join.html">
<?
	}else{
?>
		<meta http-equiv="refresh" content="0; url=../main/index.html">
<?
	}
}else{
	$_SESSION["PageType"] = "je";
?>
	<meta http-equiv="refresh" content="0; url=../main/index2.html">
<?
}
?>