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
<?
	include "../admin_head.php";
?>
</head>
<body>
�������(����)�� �Ϸ�Ǿ����ϴ�.
</body>
</html>