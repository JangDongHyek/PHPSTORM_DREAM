<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../../.";
} 

//========================== URL ó�� ==========================================
$url = str_replace( "|", "?", $url );
$url = str_replace( "!", "&", $url );
if($if_nomem_use_pass == 1){
	if( !$passport1 && !$passport2 ){
		echo ("
			<script>
			window.alert('�ֹε�Ϲ�ȣ�� �Է����� �ʾҽ��ϴ�.')
			history.go(-1)
			</script>
		");
		exit;
	}
}
if( !$order_name ){
	echo ("
		<script>
		window.alert('�̸��� �Է����� �ʾҽ��ϴ�.')
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
	if($if_nomem_use_pass == 1){
		$_SESSION["NonMemberPassport1"] = $passport1;
		$_SESSION["NonMemberPassport2"] = $passport2;
	}
	echo "
			<meta http-equiv='Refresh' content='0; url=$url'>
			";
	exit;
}

mysql_close($dbconn);
?>