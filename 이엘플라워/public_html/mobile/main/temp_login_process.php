<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../";
} 

//========================== URL 처리 ==========================================
$url = str_replace( "|", "?", $url );
$url = str_replace( "!", "&", $url );



if( !$order_name ){
	echo ("
		<script>
		window.alert('이름을 입력하지 않았습니다.')
		history.go(-1)
		</script>
	");
	exit;
}
if( !$order_pass ){
	echo ("
		<script>
		window.alert('비밀번호를 입력하지 않았습니다.')
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