<?
//================== SMS DB 설정 파일을 불러옴 ===========================================
include "../../connect_sms.php";

$tr_senddate = date("YmdHis");
$tran_phone = $receiver;//받는 사람 번호
$tran_callback = $sender;//보내는 사람 번호
$tran_msg = $message;

$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
$sms_res = mysql_query( $sms_sql, $connect );

if( $sms_res ){
	echo "
	<script>
	window.alert('전송 선공');
	</script>
	<meta http-equiv='refresh' content='0; URL=phone.html'>
	";
	exit;
}else{
	echo "
	<script>
	window.alert('문자 전송 실패');
	</script>
	<meta http-equiv='refresh' content='0; URL=phone.html'>
	";
	exit;
}

mysql_close($connect);
?>