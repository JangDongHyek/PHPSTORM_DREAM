<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

$sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
$qry = mysql_query($sql,$dbconn);
$num = mysql_num_rows($qry);
if($num > 0){
	$row = mysql_fetch_array($qry);
	if($row[card_paid] == "t" && ($row[status] == 1 || $row[status] == 2)){
		$sql2 = "update order_buy set pay_cancel='y' where mart_id='$mart_id' and order_num='$order_num'";
		if(mysql_query($sql2,$dbconn)){
			echo "<script>
			alert('������� ��û�� �Ϸ�Ǿ����ϴ�!\\nȮ�� �� �����帮�ڽ��ϴ�.');
			history.go(-1);
			</script>";
			exit;
		}else{
			echo "<script>
			alert('������� ��û�� �����Ͽ����ϴ�!');
			history.go(-1);
			</script>";
			exit;
		}
	}else{
		echo "<script>
		alert('������� ��û�� �����Ͽ����ϴ�!');
		history.go(-1);
		</script>";
		exit;
	}
}else{
	echo "<script>
	alert('������� ��û�� �����Ͽ����ϴ�!');
	history.go(-1);
	</script>";
	exit;
}
?>