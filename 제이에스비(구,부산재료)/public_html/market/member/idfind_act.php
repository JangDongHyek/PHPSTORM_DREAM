<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";

$name = iconv("utf-8","euc-kr",$name);

$sql = "select * from mart_member_new where name='$name' and email='$email' and tel1='$tel1'";
$qry = mysql_query($sql,$dbconn);
$num = mysql_num_rows($qry);
if($num > 0){
	$row = mysql_fetch_array($qry);
	echo "success/$row[username]";
	exit;
}else{
	echo "fail/none_id";
	exit;
}
?>