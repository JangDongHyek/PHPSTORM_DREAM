<?
include "../lib/Mall_Admin_Session.php";


$sql = "select * from mart_member_new where mem_grade='2'";
$res = mysql_query($sql,$dbconn);
for($i=0;$rows = mysql_fetch_array($res);$i++){
	


		$sql4 = "update bonus set bonus = bonus / 2  where id='$rows[username]'";
		
		$res4 = mysql_query($sql4,$dbconn);
	

}

?>