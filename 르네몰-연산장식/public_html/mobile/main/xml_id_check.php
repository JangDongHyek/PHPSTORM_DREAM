<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
$sql = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username ='$user_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
echo $tot;
?>