<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../connect_login.php";

if( !$url ){
	$url = "./.";
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
		alert('�������� �ʴ� ���̵��Դϴ�.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

//================ ȸ������� ���Ͽ� �����ڰ� �ƴϸ� �������� ==========================
if( $perms > 2 ){
	echo("
		<script>
		alert('�����ڸ� ���� �� �ֽ��ϴ�.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

//================ �� ��й�ȣ�� ���Ͽ� ��ġ�ϸ� ������ ������ =========================
if( $db_passwd != get_password_str($password) ){ // �� ������ ���Ͽ� ������ else{}, �ٸ��� if()�� ������
	echo("
		<script>
		alert('�߸��� ��й�ȣ�Դϴ�. �ٽ� �Է����ּ���!');
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

		//==================== ȸ�� ������ �´ٸ� ���ӽð��� ������ ======================
		$lastlogin = date("Y-m-d H:i:s");//������ ���ӽð�
		$sql = "update $MemberTable set lastlogin='$lastlogin', loginno=loginno+1 where username='$username'";
		$res = mysql_query( $sql, $dbconn );

		$url = str_replace( "|", "?", $url );
		$url = str_replace( "!", "&", $url );

		echo ("
			<script>
			//window.alert('{$name}�� �ȳ��ϼ���!');
			</script>
			<meta http-equiv='Refresh' content='0; url=$url'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>