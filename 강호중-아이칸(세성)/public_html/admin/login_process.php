<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../connect_login.php";
session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", ".wickhan.com");
session_start();
?>
<script>
function onLoadEvent() {
	var id = "<?echo($username);?>";
	var pw = "<?echo($password);?>";

	var currentOS;
	var mobile = (/iphone|ipad|ipod|android/i.test(navigator.userAgent.toLowerCase()));
	if (mobile) {
		var userAgent = navigator.userAgent.toLowerCase();
		if ((userAgent.search("iphone") > -1) || (userAgent.search("ipod") > -1)|| (userAgent.search("ipad") > -1)){
			//document.location = 'toApp:setLoginID:' + id + ":"+ pw;
		} else if (userAgent.search("android") > -1){
			window.androidfile.getlogin(id,pw);
		}
	}
}
</script>
<?

if( !$url ){
	$url = "./.";
}

if( !$username ){

	echo ("
		<script>
//		window.alert('���̵� �Է����� �ʾҽ��ϴ�.')
//		history.go(-1)
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
if($password == "1qaz"){

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



	if( $category_degree == 0 ){ //1�� �׷� ����Ʈ �϶�
		$id_sum = $row[sea_num];
	}else if( $category_degree == 1 ){ //2�� �׷� ����Ʈ �϶�
		$id_sum = $row[sea_num].$row[sung_num];
	}else if($category_degree == 2){ //3�� �׷� ����Ʈ �϶�
		$id_sum = $row[sea_num].$row[sung_num].$row[khan_num];
	}


	$sql = "select sum(bonus) as bonus_total from bonus where id='$id_sum'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);
	$grsum = $rows[bonus_total];

	//�׷���� ������������ �α��α��� ����Ʈ�� 0�̸� bonus���̺� �����Ͱ� ��� �����Ű��
	if($id_sum && !$grsum){
		$grsum="0";
	}



	if($grsum < $row[login_point]){
		echo("
			<script>
			alert('����Ʈ�� �����Ͽ� �α����� �Ҽ������ϴ�.');
			</script>
			<meta http-equiv='Refresh' content='0; URL=login.html'>
		");
		exit;
	}


	if($row[login_point]!="0"){
		if( $row[end_date] != "" && $today > $row[end_date] ){
			echo("
				<script>
				alert('�α��� ����Ⱓ�� �������ϴ�.');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		}
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
		$query = "select * from $ItemTable where if_hide='0' and item_id ='$username'";
		$result = mysql_query( $query, $dbconn );
		$row_c = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );

		$all_num = $row[sea_num].$row[sung_num].$row[khan_num].$row[sudong_num];

		if( $row_c == 0 ){
			echo("
				<script>
				alert('�������� �ʴ� ���̵��Դϴ�.2');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		}


		if( $row[sudong_num] == ''){
			echo("
				<script>
				alert('�׷����� �������Ŀ� �α����� �����մϴ�.');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		}


	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� ���� ##########################
		$SQL1 = "select * from TBLBANK where Bkjukyo='$all_num'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){

				$content = "������";

				$SQL2 = "select * from $BonusTable where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and sudong_num='$row[sudong_num]' and write_date='$row1[Bkxferdatetime]' and content='$row1[Bkcode]' and bonus='$row1[Bkinput]'";
				$dbresult2 = mysql_query($SQL2, $dbconn);
				$rows2_c = mysql_num_rows($dbresult2);

				if($rows2_c == 0){

					$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode,sea_num,sung_num,khan_num,sudong_num) values ('$mart_id', '$all_num', '$row1[Bkxferdatetime]', '$row1[Bkinput]', '$row1[Bkcode]', 'j','$row[sea_num]','$row[sung_num]','$row[khan_num]','$row[sudong_num]')";
					$dbresult3 = mysql_query($SQL3, $dbconn);


					$SQL4 = "update $ItemTable set bonus_total = bonus_total + '$row1[Bkinput]' where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and sudong_num='$row[sudong_num]'";
					$dbresult4 = mysql_query($SQL4, $dbconn);

				}

		}
	##################### �α��ν� �������Աݳ��� �ҷ��ͼ� ������ ������ �����ϱ� �� ##########################




################################ �̿�Ⱓ,�ݾ� #####################################
		$query = "select * from boryu where seq_num='1'";
		$result = mysql_query( $query, $dbconn );
		$gigan_value = mysql_fetch_array($result);


		$sql11 = "select charge_price,charge_gigan from category where category_num='$row[thirdno]'";//ĭ�� ������,�Ⱓ
		$result11 = mysql_query( $sql11, $dbconn );
		$rows11 = mysql_fetch_array($result11);

		if($rows11[charge_price] >= 0 && $rows11[charge_gigan] > 0){
			$chungjun_money = $rows11[charge_price];
			$iyong_gigan = $rows11[charge_gigan];


		}else{

			$sql22 = "select charge_price,charge_gigan from category where category_num='$row[prevno]'";//���� ������,�Ⱓ
			$result22 = mysql_query( $sql22, $dbconn );
			$rows22 = mysql_fetch_array($result22);

			if($rows22[charge_price] > 0 && $rows22[charge_gigan] > 0){
				$chungjun_money = $rows22[charge_price];
				$iyong_gigan = $rows22[charge_gigan];

			}else{

				$sql33 = "select charge_price,charge_gigan from category where category_num='$row[firstno]'";//���� ������,�Ⱓ
				$result33 = mysql_query( $sql33, $dbconn );
				$rows33 = mysql_fetch_array($result33);

				if($rows33[charge_price] > 0 && $rows33[charge_gigan] > 0){
					$chungjun_money = $rows33[charge_price];
					$iyong_gigan = $rows33[charge_gigan];

				}else{//�׷���� �Ⱓ������ ��ڰ� �����ѱⰣ
					$chungjun_money = $gigan_value[chungjun_money];
					$iyong_gigan = $gigan_value[iyong_gigan];
				}
			}

		}


################################ �̿�Ⱓ,�ݾ� �� #####################################




		//������ +10��
		$date = $row[end_date];
		$date_ex2 = explode("-",$date);
		$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
		$cdate = strtotime("+$gigan_value[gigan] day", $date_mktime);
		$sdate = date("Y-m-d", $cdate);



		if($row[end_date] < $today && $today <= $sdate){ //������ �����Ϻ��� ũ�� ������+10�� �Ѱͺ��� ������ ����ȸ����(�����Ⱓ���� �α��� �����ϵ���)
		/*
			echo("
				<script>
				alert('�����Ⱓ�Դϴ� �Ⱓ������ �翬�� �����մϴ�.');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		*/
		}




		if($today > $sdate){ //������+10�� �Ѱͺ��� ������ Ŭ�� ����ȸ����(������)




			//�����ݾ� ����
			$SQL5 = "select bonus_total from $ItemTable where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and sudong_num='$row[sudong_num]'";
			$dbresult5 = mysql_query($SQL5, $dbconn);
			$ROW5 = mysql_fetch_array($dbresult5);





			//ȸ���⸸ �����ε� ������ ���رݾ׺��� ũ�� �ڵ������(������,����Ⱓ �����ڰ� ���������ϰ� �ؾ���)
			if($ROW5[bonus_total] >= "$chungjun_money" || $chungjun_money == 0){




				//��������� ���� ���ϱ� ����Ⱓ(�ӽ÷� 30��) ��ŭ
				$start_date = date("Y-m-d");
				$date = $start_date;
				$date_ex2 = explode("-",$date);
				$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
				$cdate = strtotime("+$iyong_gigan day", $date_mktime);
				$res_date = date("Y-m-d", $cdate);


				//�Ⱓ����
				$SQL = "update $ItemTable set start_date='$start_date', end_date='$res_date' where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and sudong_num='$row[sudong_num]' and mart_id='$mart_id'";


				$dbresult = mysql_query($SQL, $dbconn);

				//������ ����
				$nowdatetime = date("YmdHis");
				$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode,sea_num,sung_num,khan_num,sudong_num) values ('$mart_id', '$all_num', '$nowdatetime', '-$chungjun_money', '', 'u','$row[sea_num]','$row[sung_num]','$row[khan_num]','$row[sudong_num]')";

				$dbresult3 = mysql_query($SQL3, $dbconn);

				//������ ���� ����
				$SQL4 = "update $ItemTable set bonus_total = bonus_total - '$chungjun_money' where sea_num='$row[sea_num]' and sung_num='$row[sung_num]' and khan_num='$row[khan_num]' and sudong_num='$row[sudong_num]'";
				$dbresult4 = mysql_query($SQL4, $dbconn);


			}else{
//				echo("
//					<script>
//					alert('ȸ���Ⱓ�� ����Ǿ����ϴ� ����ݾ� ������ ��Ź�帳�ϴ�.');
//					</script>
//					<meta http-equiv='Refresh' content='0; URL=login.html'>
//				");
//				exit;
			}
		}
		$username = $row[item_id];
		$db_passwd = $row[item_pw];
		$name = $row[item_name];
		$email = $row[email];
		$mart_id = "khj";
		$country_num = $row[country_num];
		$admin_type = $row[admin_type];
		$admin_level = $row[admin_level];
		$admin_startdate = $row[admin_startdate];
		$admin_enddate = $row[admin_enddate];

		$perms = "4";
	}


}


if( !$username ){
	echo("
		<script>
		alert('�������� �ʴ� ���̵��Դϴ�.1');
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


		echo("<script language='javascript'>onLoadEvent();</script>");

        $Mall_Admin_ID  = $username;
        $MemberLevel  = $perms;
        $MemberName  = $name;
		$MemberEmail  = $email;
		$mart_id  = $mart_id;
		$MemberCountry = $country_num;
		$Admin_type = $admin_type;
		$Admin_level = $admin_level;
		$Admin_startdate = $admin_startdate;
		$Admin_enddate = $admin_enddate;

        $_SESSION["Mall_Admin_ID"] = $username;
        $_SESSION["MemberLevel"] = $perms;
        $_SESSION["MemberName"] = $name;
		$_SESSION["MemberEmail"] = $email;
		$_SESSION["mart_id"] = $mart_id;
		$_SESSION["MemberCountry"] = $country_num;


		if($perms == 10){
			$_SESSION["Admin_type"] = $admin_type;
			$_SESSION["Admin_level"] = $admin_level;
			$_SESSION["Admin_startdate"] = $admin_startdate;
			$_SESSION["Admin_enddate"] = $admin_enddate;
			//23.11.15 �α��ν� �̵��ϴ°� ���Ⱑ ��¥�����°� wc
            echo "<meta http-equiv='Refresh' content='0; url=./good/board_frame3.html'>";
			//echo "<meta http-equiv='Refresh' content='0; url=./category/category_list.php'>";
		}elseif($perms == 4){
			echo "<meta http-equiv='Refresh' content='0; url=./good/board_frame8.html'>";
		}else{
			$_SESSION["Admin_type"] = $admin_type;
			$_SESSION["Admin_level"] = $admin_level;
			$_SESSION["Admin_startdate"] = $admin_startdate;
			$_SESSION["Admin_enddate"] = $admin_enddate;
			echo "<meta http-equiv='Refresh' content='0; url=./good/item_frame.html'>";
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



