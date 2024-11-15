
<?

$HostName = "localhost";
$DbName = "elfower";
$Admin = "elfower";
$AdminPass = "&nvyu*p6";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);


      $sql = "show tables";
      $res = mysql_query($sql, $dbconn);
      for($i=0;$row = mysql_fetch_array( $res );$i++){
		
				$query = "update $row[0] set mart_id='elfower'";
				$res2 = mysql_query($query, $dbconn);
	
	}
		
?>