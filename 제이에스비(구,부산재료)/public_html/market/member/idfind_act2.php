<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";

$sql = "update mart_member_new set password=old_password('$password') where username='$username'";
if(mysql_query($sql,$dbconn)){
	echo "<script>
	alert('��й�ȣ�� ����Ǿ����ϴ�!');
	location.href='./idfind.html';
	</script>";
	exit;
}else{
	echo "<script>
	alert('��й�ȣ ���濡 �����Ͽ����ϴ�!');
	location.href='./idfind.html';
	</script>";
	exit;
}
?>