<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../";
} 

//========================== URL ó�� ==========================================
$url = str_replace( "|", "?", $url );
$url = str_replace( "!", "&", $url );



if( !$order_name ){
	echo ("
		<script>
		window.alert('�̸��� �Է����� �ʾҽ��ϴ�.')
		history.go(-1)
		</script>
	");
	exit;
}
if( !$order_pass ){
	echo ("
		<script>
		window.alert('��й�ȣ�� �Է����� �ʾҽ��ϴ�.')
		history.go(-1)
		</script>
	");
	exit;
}

if( headers_sent() ){
	error("HTTP_HEADERS_SENT");
	exit;
}else{
	$_SESSION["NonMemberName"] = $order_name;
	$_SESSION["NonMemberPass"] = $order_pass;
	echo "
			<meta http-equiv='Refresh' content='0; url=$url'>
			";
	exit;
}

mysql_close($dbconn);
?>