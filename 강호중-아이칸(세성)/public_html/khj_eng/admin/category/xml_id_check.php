<?
//============================= XML 만들기 위한 header 부분==============================
header("Content-type:text/xml;charset=euc-kr");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$SQL = "select g_id from $CategoryTable where mart_id='$mart_id' and g_id='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot1 = mysql_num_rows($dbresult);

$SQL = "select item_id from $ItemTable where mart_id='$mart_id' and item_id='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot2 = mysql_num_rows($dbresult);

$SQL = "select username from $MemberTable where mart_id='$mart_id' and username='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot3 = mysql_num_rows($dbresult);


$tot = $tot1 + $tot2 + $tot3;

echo $tot;
?>