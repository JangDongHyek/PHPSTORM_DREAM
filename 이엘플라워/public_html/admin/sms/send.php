<?
//================== SMS DB ���� ������ �ҷ��� ===========================================
include "../../connect_sms.php";

$tr_senddate = date("YmdHis");
$tran_phone = $receiver;//�޴� ��� ��ȣ
$tran_callback = $sender;//������ ��� ��ȣ
$tran_msg = $message;

$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
$sms_res = mysql_query( $sms_sql, $connect );

if( $sms_res ){
	echo "
	<script>
	window.alert('���� ����');
	</script>
	<meta http-equiv='refresh' content='0; URL=phone.html'>
	";
	exit;
}else{
	echo "
	<script>
	window.alert('���� ���� ����');
	</script>
	<meta http-equiv='refresh' content='0; URL=phone.html'>
	";
	exit;
}

mysql_close($connect);
?>