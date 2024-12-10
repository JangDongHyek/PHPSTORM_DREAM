<? 
	header("Content-type:text/xml;charset=euc-kr");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
   $site_path = "/home/unitedinfo3/public_html/bbs/"; 
   $site_url = "../bbs/"; 
   require_once($site_path."include/lib.inc.php"); 
   include($site_path."counter/counter.lib.php");
   $sql="select * from `rg_member` where mb_id='$mb_id'";
   $result=mysql_query($sql);
   $cnt=mysql_num_rows($result);
	$xml="<?xml version=\"1.0\" encoding=\"euc-kr\" ?>";
	$xml.="<member>$cnt</member>";
	echo $xml;
	mysql_close();
?>