<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?	
$sql = "select * from item where country_num='$ext1' and sea_num='$ext2' and sung_num='$ext3' and khan_num='$ext4' and sudong_num='$ext5'";
$qry = mysql_query($sql,$dbconn);
$num = mysql_num_rows($qry);




echo $num;
exit;


?>