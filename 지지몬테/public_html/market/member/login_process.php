<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../../.";
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

if( $member_type == "1" ){
	$query = "select * from $Mart_Member_NewTable where username ='$username'";
	$result = mysql_query( $query, $dbconn );
	$total = mysql_num_rows( $result );
	$row = mysql_fetch_array( $result );
	/*if(!$row[is_member]){
		echo "<script language='javascript'>";
		echo "alert('관리자 승인 후 이용이 가능하십니다.');";
		echo "history.back();";
		echo "</script>";
		exit;
	}*/
	if(!$total)
	{
		$query = "select * from $MemberTable where username ='$username'";
		$result = mysql_query( $query, $dbconn );
		$total = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );
		$_SESSION["Mall_Admin_ID"] = $row[username];		// 관리자 아이디
	}

	$username = $row[username];
	$db_passwd = $row[password];
	$perms = $row[perms];
	$name = $row[name];
	$email = $row[email];
	
}else if( $member_type == "2" || $member_type == "3" ){
	$query = "select * from $MemberTable where username ='$username'";
	$result = mysql_query( $query, $dbconn );
	$total = mysql_num_rows( $result );
	$row = mysql_fetch_array( $result );

	$username = $row[username];
	$db_passwd = $row[password];
	$perms = $row[perms];
	$name = $row[name];
	$email = $row[email];
}
if( !$username ){
	echo("
		<script>
		alert('존재하지 않는 아이디입니다.');
		history.go(-1);
		</script>
	");
	exit;
}

$login_date = date("Y-m-d H:i:s");//마지막 접속시간

//================ 두 비밀번호를 비교하여 일치하면 세션을 생성함 =========================
if( strcmp( $db_passwd, get_password_str($password) ) ){ // 두 변수를 비교하여 같으면 else{}, 다르면 if()를 실행함
	echo("
		<script>
		alert('잘못된 회원정보입니다. 다시 입력해주세요!');
		history.go(-1);
		</script>
	");
	exit;
}else{
	if( headers_sent() ){
		error("HTTP_HEADERS_SENT");
		exit;
	}else{
		if( $member_type == "1" ){
			$UnameSess   = $username;
			$MemberLevel  = $perms;
			$MemberName  = $name;
			$MemberEmail  = $email;

	        //session_register("UnameSess");
	        //session_register("MemberLevel");
		    //session_register("MemberName");
			//session_register("MemberEmail");
			$_SESSION["UnameSess"] = $username;
			$_SESSION["MemberLevel"] = $perms;
			$_SESSION["MemberName"] = $name;
			$_SESSION["MemberEmail"] = $email;


			//==================== 회원 정보를 쿠키에 저장함 =============================
			setcookie("na3_member",$username,time()+30*24*3600,"/");
			//setcookie("member_id",$username,time()+30*24*3600,"/");

			//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
			$sql = "update $Mart_Member_NewTable set login_date='$login_date', login_count=login_count+1 where username='$username'";
		}else if( $member_type == "2" || $member_type == "3" ){
			$Mall_Admin_ID   = $username;
			$MemberLevel  = $perms;
			$MemberName  = $name;
			$MemberEmail  = $email;

			$_SESSION["Mall_Admin_ID"] = $username;
			$_SESSION["UnameSess"] = $username;
			$_SESSION["MemberLevel"] = $perms;
			$_SESSION["MemberName"] = $name;
			$_SESSION["MemberEmail"] = $email;
			//==================== 회원 정보가 맞다면 접속시간을 저장함 ======================
			$sql = "update $MemberTable set lastlogin='$login_date', loginno=loginno+1 where username='$username'";
		}
		
		$res = mysql_query( $sql, $dbconn );

		$url = str_replace( "|", "?", $url );
		$url = str_replace( "!", "&", $url );

		?>
		
		<?
		
		echo ("
			<!-- <script>
			window.alert('{$url}님 안녕하세요!');
			window.alert('{$MemberName}님 안녕하세요!');
			</script> -->
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>
