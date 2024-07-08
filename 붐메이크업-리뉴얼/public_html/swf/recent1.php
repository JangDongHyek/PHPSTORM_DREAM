<? 
require "dbconn.php";
$connect=mysql_connect($localhost,$user_name,$db_password);
mysql_select_db($db_name, $connect);
$result=mysql_query("select * from rg_noticee_body order by rg_top_num desc limit 1") or die(mysql_error());   

while($data=mysql_fetch_array($result)) 
{
$data[subject] = stripslashes($data[rg_title]); 
$max = 50; //제목을 가져올 때 숫자보다 길면 ..으로 표시하라는 명령입니다. 
$count = strlen($data[subject]); 
if($count >= $max) { 
for ($pos=$max;$pos>0 && ord($new[subject][$pos-1])>=127;$pos--); 
if (($max-$pos)%2 == 0) 
$data[subject] = substr($data[subject], 0, $max) . ".."; 
else 
$data[subject] = substr($data[subject], 0, $max+1) . ".."; 
} 
else { 
$data[subject] = "$data[subject]"; 
} 
$recent = "[".stripslashes($data[rg_name])."]+".stripslashes($data[subject])."+[".date("Y/n/j",$data[rg_reg_date])."]";
echo("&recent1=".stripslashes($recent)."");
}
mysql_close(); 
?>
