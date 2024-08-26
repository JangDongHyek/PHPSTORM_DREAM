<?
include "../lib/Mall_Admin_Session.php";


$sql = "select username from mart_member_new";
$res = mysql_query($sql,$dbconn);
for($i=0;$rows = mysql_fetch_array($res);$i++){



	$sql2 = "select * from order_buy where id='$rows[username]' and status='3'";
	//echo "aaa ".$sql2."<br>";
	$res2 = mysql_query($sql2,$dbconn);
	$cnt2 = mysql_num_rows($res2);

	
	if($cnt2 >= 3){


		$sql4 = "update mart_member_new set mem_grade = '2'  where username='$rows[username]'";	
		
		$res4 = mysql_query($sql4,$dbconn);
	}

}

?>