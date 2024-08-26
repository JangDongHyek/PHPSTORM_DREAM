<?
//================== DB 설정 파일을 불러옴 ===============================================
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
			alert('결제취소 요청이 완료되었습니다!\\n확인 후 연락드리겠습니다.');
			history.go(-1);
			</script>";
			exit;
		}else{
			echo "<script>
			alert('결제취소 요청에 실패하였습니다!');
			history.go(-1);
			</script>";
			exit;
		}
	}else{
		echo "<script>
		alert('결제취소 요청에 실패하였습니다!');
		history.go(-1);
		</script>";
		exit;
	}
}else{
	echo "<script>
	alert('결제취소 요청에 실패하였습니다!');
	history.go(-1);
	</script>";
	exit;
}
?>