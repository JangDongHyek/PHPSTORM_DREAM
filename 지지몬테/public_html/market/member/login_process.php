<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect_login.php";

if( !$url ){
	$url = "../../.";
} 

if( !$username ){
	echo ("
		<script>
		window.alert('���̵� �Է����� �ʾҽ��ϴ�.')
		history.go(-1)
		</script>
	");
	exit;
}

if( !$password ){
	echo ("
		<script>
		window.alert('��й�ȣ�� �Է����� �ʾҽ��ϴ�.')
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
		echo "alert('������ ���� �� �̿��� �����Ͻʴϴ�.');";
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
		$_SESSION["Mall_Admin_ID"] = $row[username];		// ������ ���̵�
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
		alert('�������� �ʴ� ���̵��Դϴ�.');
		history.go(-1);
		</script>
	");
	exit;
}

$login_date = date("Y-m-d H:i:s");//������ ���ӽð�

//================ �� ��й�ȣ�� ���Ͽ� ��ġ�ϸ� ������ ������ =========================
if( strcmp( $db_passwd, get_password_str($password) ) ){ // �� ������ ���Ͽ� ������ else{}, �ٸ��� if()�� ������
	echo("
		<script>
		alert('�߸��� ȸ�������Դϴ�. �ٽ� �Է����ּ���!');
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


			//==================== ȸ�� ������ ��Ű�� ������ =============================
			setcookie("na3_member",$username,time()+30*24*3600,"/");
			//setcookie("member_id",$username,time()+30*24*3600,"/");

			//==================== ȸ�� ������ �´ٸ� ���ӽð��� ������ ======================
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
			//==================== ȸ�� ������ �´ٸ� ���ӽð��� ������ ======================
			$sql = "update $MemberTable set lastlogin='$login_date', loginno=loginno+1 where username='$username'";
		}
		
		$res = mysql_query( $sql, $dbconn );

		$url = str_replace( "|", "?", $url );
		$url = str_replace( "!", "&", $url );

		?>
		
		<?
		
		echo ("
			<!-- <script>
			window.alert('{$url}�� �ȳ��ϼ���!');
			window.alert('{$MemberName}�� �ȳ��ϼ���!');
			</script> -->
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>
