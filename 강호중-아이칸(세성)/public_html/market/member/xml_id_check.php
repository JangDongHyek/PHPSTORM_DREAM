<?
//============================= XML ����� ���� header �κ�==============================
header("Content-type:text/xml;charset=euc-kr");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
$sql = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username ='$user_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
echo $tot;
?>