<?
	$site_path='./';
	$site_url='./';
	require_once($site_path.'include/lib.inc.php');
	require_once($site_path.'counter/counter.lib.php');
		
	$LastModified = gmdate("D d M Y H:i:s", filemtime($HTTP_SERVER_VARS[SCRIPT_FILENAME])); 
	header("Last-Modified: $LastModified GMT"); 
	header("ETag: \"$LastModified\""); 
?>
<html>
<head>
<title>Let's080</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<frameset rows="*,0" frameborder="NO" border="0" framespacing="0">
  <frame src="addon.php?file=main.php" name="">
<frame src="about:blank"></frameset>
<noframes>
<body alink="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" text="#FFFFFF" onLoad="location.href='addon.php?file=main.php'" bgcolor="#FFFFFF">
<a href="addon.php?file=main.php">메인화면으로</a> 
</body>
</noframes>
</html>