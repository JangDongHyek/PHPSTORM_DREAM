<?
//============================= XML ����� ���� header �κ�==============================
/*
header("Content-type:text/xml;charset=euc-kr");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
*/
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
$SQL = "select g_id from $CategoryTable where g_id='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot1 = mysql_num_rows($dbresult);

$SQL = "select item_id from $ItemTable where item_id='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot2 = mysql_num_rows($dbresult);

$SQL = "select username from $MemberTable where username='$user_id'";
$dbresult = mysql_query($SQL, $dbconn);
$tot3 = mysql_num_rows($dbresult);


$tot = $tot1 + $tot2 + $tot3;

echo $tot;
?>