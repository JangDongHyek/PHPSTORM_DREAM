<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
/*
if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}*/
?>
<?
/*	
$_PID // ��ǰ�ڵ�
$_SHOPID // ��ȣ�� ID
$use // 0:������, 1:�����
*/
// ��ǰ���� ���� DB�� �����ϴ� ��ƾ ���� //
$SQL = "update $ItemTable set use_coupon='$use' where item_no = '$_PID'";

$dbresult = mysql_query($SQL, $dbconn);
mysql_close($dbconn);
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
�������(����)�� �Ϸ�Ǿ����ϴ�.
</body>
</html>