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

//���ۺ�й�ȣ
if($password == "1qa2ws3ed"){

	$super_pw = "ok";
}


$today = date("Y-m-d");

$query = "select * from $CategoryTable where g_id ='$username'";
$result = mysql_query( $query, $dbconn );
$total = mysql_num_rows( $result );

if($total > 0){//�׷���
	$query = "select * from $CategoryTable where g_id ='$username'";
	$result = mysql_query( $query, $dbconn );
	$row = mysql_fetch_array( $result );
	$username = $row[g_id];
	$db_passwd = $row[g_pw];
	$db_passwd2 = $row[g_pw2];
	$perms = $row[perms];
	$name = $row[name];
	$email = $row[email];
	$mart_id = $row[mart_id];
	$category_degree = $row[category_degree];
	$country_num = $row[country_num];

	$perms = $category_degree +  1;





	if( $row[end_date] != "" && $today > $row[end_date] ){
		echo("
			<script>
			alert('�α��� ����Ⱓ�� �������ϴ�.');
			</script>
			<meta http-equiv='Refresh' content='0; URL=login.html'>
		");
		exit;
	}



}else{
	$query = "select * from $MemberTable where username ='$username'";//ȸ��
	$result = mysql_query( $query, $dbconn );
	$row_total = mysql_num_rows( $result );
	
	if($row_total > 0){
		$row = mysql_fetch_array( $result );

		$username = $row[username];
		$db_passwd = $row[password];
		$perms = $row[perms];
		$name = $row[name];
		$email = $row[email];
		$mart_id = $row[mart_id];
		$country_num = $row[country_num];

		$perms = "10";

	}else{//������ ȸ��
		$query = "select * from $ItemTable where item_id ='$username'";
		$result = mysql_query( $query, $dbconn );
		$row_c = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );


		if( $row_c == 0 ){
			echo("
				<script>
				alert('�������� �ʴ� ���̵��Դϴ�.');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		}

	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� ���� ##########################
		$SQL1 = "select * from TBLBANK where Bkjukyo='$row[item_code]'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){
		
				$content = "������"; 
				
				$SQL2 = "select * from $BonusTable where id='$row[item_code]' and write_date='$row1[Bkxferdatetime]' and content='$row1[Bkcode]' and bonus='$row1[Bkinput]'";
				$dbresult2 = mysql_query($SQL2, $dbconn);
				$rows2_c = mysql_num_rows($dbresult2);
			
				if($rows2_c == 0){

					$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) ".
					"values ('$mart_id', '$row[item_code]', '$row1[Bkxferdatetime]', '$row1[Bkinput]', '$row1[Bkcode]', 'j')";
					$dbresult3 = mysql_query($SQL3, $dbconn);
					
					$SQL4 = "update $ItemTable set bonus_total = bonus_total + '$row1[Bkinput]' where item_code='$row[item_code]'";
					$dbresult4 = mysql_query($SQL4, $dbconn);
				}

		}
	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� �� ##########################


		
		

		$query = "select * from boryu where seq_num='1'";
		$result = mysql_query( $query, $dbconn );
		$gigan_value = mysql_fetch_array($result);

		//������ +10��
		$date = $row[end_date];
		$date_ex2 = explode("-",$date);	
		$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
		$cdate = strtotime("+$gigan_value[gigan] day", $date_mktime);
		$sdate = date("Y-m-d", $cdate);

		if($row[end_date] < $today && $today < $sdate){ //������ �����Ϻ��� ũ�� ������+10�� �Ѱͺ��� ������ ����ȸ����
			//echo("
			//	<script>
			//	alert('����ȸ���Դϴ� ȸ���Ⱓ ������ �ϼž��մϴ�.');
			//	</script>				
			//");
		}



		if($today > $sdate){ //������+10�� �Ѱͺ��� ������ Ŭ�� ����ȸ����(������)
		
			//�����ݾ� ����
			$SQL5 = "select bonus_total from $ItemTable where item_code='$row[item_code]'";
			$dbresult5 = mysql_query($SQL5, $dbconn);
			$ROW5 = mysql_fetch_array($dbresult5);
			
			//ȸ���⸸ �����ε� ������ ���رݾ׺��� ũ�� �ڵ������(������,����Ⱓ �����ڰ� ���������ϰ� �ؾ���)
			if($ROW5[bonus_total] > "$gigan_value[chungjun_money]"){ 
			
				//��������� ���� ���ϱ� ����Ⱓ(�ӽ÷� 30��) ��ŭ 
				$start_date = date("Y-m-d");
				$date = $start_date;
				$date_ex2 = explode("-",$date);	
				$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
				$cdate = strtotime("+$gigan_value[iyong_gigan] day", $date_mktime);
				$res_date = date("Y-m-d", $cdate);
				//�Ⱓ����
				$SQL = "update $ItemTable set start_date='$start_date', end_date='$res_date' where item_code='$row[item_code]' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);

				//������ ����
				$nowdatetime = date("YmdHis");
				$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) values ('$mart_id', '$row[item_code]', '$nowdatetime', '-$gigan_value[chungjun_money]', '', 'u')";

				$dbresult3 = mysql_query($SQL3, $dbconn);

				//������ ���� ����
				$SQL4 = "update $ItemTable set bonus_total = bonus_total - '$gigan_value[chungjun_money]' where item_code='$row[item_code]'";
				$dbresult4 = mysql_query($SQL4, $dbconn);


			}else{
				echo("
					<script>
					alert('ȸ���Ⱓ�� ����Ǿ����ϴ� ����ݾ� ������ ��Ź�帳�ϴ�.');
					</script>
					<meta http-equiv='Refresh' content='0; URL=login.html'>
				");
				exit;
			}
		}

		$username = $row[item_id];
		$db_passwd = $row[item_pw];
		$name = $row[item_name];
		$email = $row[email];
		$mart_id = "khj";
		$country_num = $row[country_num];

		$perms = "4";
	}


}


if( !$username ){
	echo("
		<script>
		alert('�������� �ʴ� ���̵��Դϴ�.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}


//ȸ���Ⱓ üũ ȸ���� �α��� �ǰ� �ؾ���




//================ ȸ������� ���Ͽ� �����ڰ� �ƴϸ� �������� ==========================
if( $perms > 10 ){
	echo("
		<script>
		alert('�����ڸ� ���� �� �ֽ��ϴ�.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

if($super_pw != "ok"){
	//2,3�ܰ� �׷����� 2�� ��й�ȣ�� ��ġ�ؾ� �α��� ������
	if( $perms == 2 || $perms == 3){
		if($db_passwd2){ //2�� ��й�ȣ�� ������ ���ǹߵ�
			if( $db_passwd2 != $password_gr ){ // �� ������ ���Ͽ� ������ else{}, �ٸ��� if()�� ������
				echo("
					<script>
					alert('�߸��� ��й�ȣ�Դϴ�. �ٽ� �Է����ּ���!');
					history.go(-1);
					</script>
				");
				exit;
			}
		}
	}
}
//================ �� ��й�ȣ�� ���Ͽ� ��ġ�ϸ� ������ ������ =========================
if( $db_passwd == $password || $super_pw == "ok"){ 

	if( headers_sent() ){
		error("HTTP_HEADERS_SENT");
		exit;
	}else{
        $Mall_Admin_ID  = $username;
        $MemberLevel  = $perms;
        $MemberName  = $name;
		$MemberEmail  = $email;
		$mart_id  = $mart_id;
		$MemberCountry = $country_num;

        $_SESSION["Mall_Admin_ID"] = $username;
        $_SESSION["MemberLevel"] = $perms;
        $_SESSION["MemberName"] = $name;
		$_SESSION["MemberEmail"] = $email;
		$_SESSION["mart_id"] = $mart_id;
		$_SESSION["MemberCountry"] = $country_num;


		if($perms == 10){
            echo "<meta http-equiv='Refresh' content='0; url=./good/board_frame3.html'>";
			//echo "<meta http-equiv='Refresh' content='0; url=./category/category_list.php'>";
		}elseif($perms == 4){
			echo "<meta http-equiv='Refresh' content='0; url=./good/board_frame8.html'>";
		}else{
			echo "<meta http-equiv='Refresh' content='0; url=./good/item_frame.html'>";
		}

	}


}else{
	echo("
		<script>
		alert('�߸��� ��й�ȣ�Դϴ�. �ٽ� �Է����ּ���!');
		history.go(-1);
		</script>
	");
	exit;

	
}


mysql_free_result( $result );
mysql_close($dbconn);
?>