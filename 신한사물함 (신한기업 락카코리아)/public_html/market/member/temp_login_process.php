<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../../.";
} 

//========================== URL 처리 ==========================================
$url = str_replace( "|", "?", $url );
$url = str_replace( "!", "&", $url );
if($if_nomem_use_pass == 1){
	if( !$passport1 && !$passport2 ){
		echo ("
			<script>
			window.alert('주민등록번호를 입력하지 않았습니다.')
			history.go(-1)
			</script>
		");
		exit;
	}
}
if( !$order_name ){
	echo ("
		<script>
		window.alert('이름을 입력하지 않았습니다.')
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