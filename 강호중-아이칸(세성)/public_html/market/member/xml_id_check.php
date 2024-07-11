<?
//============================= XML 만들기 위한 header 부분==============================
header("Content-type:text/xml;charset=euc-kr");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$sql = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username ='$user_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
echo $tot;
?>