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

				




			
			///////////////////////////////�����////////////////////////////////////////
			if($username != "admin"){
				$sql = "select count(*) from order_buy where status='3' and id='$username'"; //�ѱ���Ƚ��
				$res = mysql_query( $sql, $dbconn );
				$tot_count = mysql_result($res,0,0);

				$sql2 = "select sum(mon_tot) from order_buy where status='3' and id='$username'"; //�ѱ��űݾ�
				$res2 = mysql_query( $sql2, $dbconn );
				$tot_price = mysql_result($res2,0,0);
				
				if($tot_count >= 100 || $tot_price >= 2000000){ //VIPȸ��
					$now_year = date("Y");
					$now_month = date("m");
					$sql = "select * from mart_member_new where username='$username'";
					$res = mysql_query( $sql, $dbconn );
					$rows = mysql_fetch_array($res);

					if(!$rows[now_year] && !$rows[now_month]){ //ó���̸� �߰�
						$sql = "update mart_member_new set now_year='$now_year', now_month='$now_month', now_free='2' where username='$username'";
						$res = mysql_query( $sql, $dbconn );
					}else{ //ó���ƴϰ� ����� �ٸ��� �߰�
						if($rows[now_year] != $now_year && $rows[now_month] != $now_month){
							$sql = "update mart_member_new set now_year='$now_year', now_month='$now_month', now_free='2' where username='$username'";
							$res = mysql_query( $sql, $dbconn );
						}						
					}


					$mem_grade = "4";
					echo"<script>alert('�ȳ��ϼ���! {$MemberName}���� VIPȸ�� ȸ���Դϴ�^^');</script>";
				}elseif($tot_count >= 60 || $tot_price >= 1000000){ //�ܰ�ȸ��
					$now_year = date("Y");
					$now_month = date("m");
					$sql = "select * from mart_member_new where username='$username'";
					$res = mysql_query( $sql, $dbconn );
					$rows = mysql_fetch_array($res);

					if(!$rows[now_year] && !$rows[now_month]){ //ó���̸� �߰�
						$sql = "update mart_member_new set now_year='$now_year', now_month='$now_month', now_free='1' where username='$username'";
						$res = mysql_query( $sql, $dbconn );
					}else{ //ó���ƴϰ� ����� �ٸ��� �߰�
						if($rows[now_year] != $now_year && $rows[now_month] != $now_month){
							$sql = "update mart_member_new set now_year='$now_year', now_month='$now_month', now_free='1' where username='$username'";
							$res = mysql_query( $sql, $dbconn );
						}						
					}
					$mem_grade = "3";
					echo"<script>alert('�ȳ��ϼ���! {$MemberName}���� �ܰ�ȸ�� ȸ���Դϴ�^^');</script>";
				}elseif($tot_count >= 20 || $tot_price >= 500000){ //�Ϲ�ȸ��
					$mem_grade = "2";
					echo"<script>alert('�ȳ��ϼ���! {$MemberName}���� �Ϲ�ȸ�� ȸ���Դϴ�^^');</script>";
				}else{ //������ȸ��
					$mem_grade = "1";
					echo"<script>alert('�ȳ��ϼ���! {$MemberName}���� ������ ȸ���Դϴ�^^');</script>";
				}
				$sql3 = "update $Mart_Member_NewTable set mem_grade='$mem_grade' where username='$username'";
				$res3 = mysql_query( $sql3, $dbconn );
			}
			/////////////////////////////////////////////////////////////////////////////
			






		echo ("
			<!-- <script>
			window.alert('{$url}�� �ȳ��ϼ���!');
			window.alert('{$MemberName}�� �ȳ��ϼ���!');
			</script> -->
			<meta http-equiv='Refresh' content='0; url=$url&item_no=$item_no'>
			 
		");
	}
}


mysql_free_result( $result );
mysql_close($dbconn);
?>