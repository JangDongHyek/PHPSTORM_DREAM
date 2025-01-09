<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect_login.php";

if( !$url ){
	$url = "./.";
} 

if( !$username ){
	echo ("
		<script>
		window.alert('아이디를 입력하지 않았습니다.')
		history.go(-1)
		</script>
	");
	exit;
}

if( !$password ){
	echo ("
		<script>
		window.alert('비밀번호를 입력하지 않았습니다.')
		history.go(-1)
		</script>
	");
	exit;
}

$query = "select * from $MemberTable where username ='$username'";
$result = mysql_query( $query, $dbconn );
$total = mysql_num_rows( $result );

$row = mysql_fetch_array( $result );
$username = $row[username];
$db_passwd = $row[password];
$perms = $row[perms];
$name = $row[name];
$email = $row[email];
$mart_id = $row[mart_id];

if( !$username ){
	echo("
		<script>
		alert('존재하지 않는 아이디입니다.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

//================ 회원등급을 비교하여 관리자가 아니면 돌려보냄 ==========================
if( $perms > 2 ){
	echo("
		<script>
		alert('관리자만 들어올 수 있습니다.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

//================ 두 비밀번호를 비교하여 일치하면 세션을 생성함 =========================
if( $db_passwd != get_password_str($password) ){ // 두 변수를 비교하여 같으면 else{}, 다르면 if()를 실행함
	echo("
		<script>
		alert('잘못된 비밀번호입니다. 다시 입력해주세요!');
		history.go(-1);
		</script>
	");
	exit;
}else{
	if( headers_sent() ){
		error("HTTP_HEADERS_SENT");
		exit;
	}else{
        $Mall_Admin_ID  = $username;
        $MemberLevel  = $perms;
        $MemberName  = $name;
		$MemberEmail  = $email;
		$mart_id  = $mart_id;

        $_SESSION["Mall_Admin_ID"] = $username;
        $_SESSION["MemberLevel"] = $perms;
        $_SESSION["MemberName"] = $name;
		$_SESSION["MemberEmail"] = $email;
		$_SESSION["mart_id"] = $mart_id;

		//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
		$lastlogin = date("Y-m-d H:i:s");//마지막 접속시간
		$sql = "update $MemberTable set lastlogin='$lastlogin', loginno=loginno+1 where username='$username'";
		$res = mysql_query( $sql, $dbconn );

		$url = str_replace( "|", "?", $url );
		$url = str_replace( "!", "&", $url );

		echo ("
			<script>
			//window.alert('{$name}님 안녕하세요!');
			</script>
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>