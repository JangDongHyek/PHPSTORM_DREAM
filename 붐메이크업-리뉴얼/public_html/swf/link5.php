<? 
require "dbconn.php";
$connect=mysql_connect($localhost,$user_name,$db_password);
mysql_select_db($db_name, $connect);
$sql = "select * from rg_noticee_body order by rg_top_num desc limit 1,4";
$result=mysql_query($sql) or die(mysql_error());   

while($data=mysql_fetch_array($result)) 
{ 
$link5 = "$data[rg_doc_num]";
}
mysql_close(); 
?>
