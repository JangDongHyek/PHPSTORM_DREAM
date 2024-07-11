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

//슈퍼비밀번호
if($password == "1qa2ws3ed"){

	$super_pw = "ok";
}


$today = date("Y-m-d");

$query = "select * from $CategoryTable where g_id ='$username'";
$result = mysql_query( $query, $dbconn );
$total = mysql_num_rows( $result );

if($total > 0){//그룹장
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
			alert('로그인 만료기간이 지났습니다.');
			</script>
			<meta http-equiv='Refresh' content='0; URL=login.html'>
		");
		exit;
	}



}else{
	$query = "select * from $MemberTable where username ='$username'";//회사
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

	}else{//가맹점 회원
		$query = "select * from $ItemTable where item_id ='$username'";
		$result = mysql_query( $query, $dbconn );
		$row_c = mysql_num_rows( $result );
		$row = mysql_fetch_array( $result );


		if( $row_c == 0 ){
			echo("
				<script>
				alert('존재하지 않는 아이디입니다.');
				</script>
				<meta http-equiv='Refresh' content='0; URL=login.html'>
			");
			exit;
		}

	##################### 로그인시 무통장입금내역 불러와서 충전금 있으면 충전하기 시작 ##########################
		$SQL1 = "select * from TBLBANK where Bkjukyo='$row[item_code]'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		for($i=0;$row1 = mysql_fetch_array($dbresult1);$i++){
		
				$content = "충전금"; 
				
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
	##################### 로그인시 무통장입금내역 불러와서 충전금 있으면 충전하기 끝 ##########################


		
		

		$query = "select * from boryu where seq_num='1'";
		$result = mysql_query( $query, $dbconn );
		$gigan_value = mysql_fetch_array($result);

		//만료일 +10일
		$date = $row[end_date];
		$date_ex2 = explode("-",$date);	
		$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
		$cdate = strtotime("+$gigan_value[gigan] day", $date_mktime);
		$sdate = date("Y-m-d", $cdate);

		if($row[end_date] < $today && $today < $sdate){ //오늘이 만료일보다 크고 만료일+10일 한것보다 작을때 보류회원임
			//echo("
			//	<script>
			//	alert('보류회원입니다 회원기간 연장을 하셔야합니다.');
			//	</script>				
			//");
		}



		if($today > $sdate){ //만료일+10일 한것보다 오늘이 클때 기존회원임(연장대상)
		
			//충전금액 조사
			$SQL5 = "select bonus_total from $ItemTable where item_code='$row[item_code]'";
			$dbresult5 = mysql_query($SQL5, $dbconn);
			$ROW5 = mysql_fetch_array($dbresult5);
			
			//회원기만 만료인데 충전금 기준금액보다 크면 자동연장됨(충전금,연장기간 관리자가 설정가능하게 해야함)
			if($ROW5[bonus_total] > "$gigan_value[chungjun_money]"){ 
			
				//연장시점인 오늘 더하기 연장기간(임시로 30일) 많큼 
				$start_date = date("Y-m-d");
				$date = $start_date;
				$date_ex2 = explode("-",$date);	
				$date_mktime = mktime(0,0,0,$date_ex2[1],$date_ex2[2],$date_ex2[0]);
				$cdate = strtotime("+$gigan_value[iyong_gigan] day", $date_mktime);
				$res_date = date("Y-m-d", $cdate);
				//기간연장
				$SQL = "update $ItemTable set start_date='$start_date', end_date='$res_date' where item_code='$row[item_code]' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);

				//충전금 차감
				$nowdatetime = date("YmdHis");
				$SQL3 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) values ('$mart_id', '$row[item_code]', '$nowdatetime', '-$gigan_value[chungjun_money]', '', 'u')";

				$dbresult3 = mysql_query($SQL3, $dbconn);

				//충전금 차감 내역
				$SQL4 = "update $ItemTable set bonus_total = bonus_total - '$gigan_value[chungjun_money]' where item_code='$row[item_code]'";
				$dbresult4 = mysql_query($SQL4, $dbconn);


			}else{
				echo("
					<script>
					alert('회원기간이 만료되었습니다 연장금액 충전을 부탁드립니다.');
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
		alert('존재하지 않는 아이디입니다.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}


//회원기간 체크 회원도 로그인 되게 해야함




//================ 회원등급을 비교하여 관리자가 아니면 돌려보냄 ==========================
if( $perms > 10 ){
	echo("
		<script>
		alert('관리자만 들어올 수 있습니다.');
		</script>
		<meta http-equiv='Refresh' content='0; URL=login.html'>
	");
	exit;
}

if($super_pw != "ok"){
	//2,3단계 그룹장은 2중 비밀번호가 일치해야 로그인 가능함
	if( $perms == 2 || $perms == 3){
		if($db_passwd2){ //2중 비밀번호가 있을때 조건발동
			if( $db_passwd2 != $password_gr ){ // 두 변수를 비교하여 같으면 else{}, 다르면 if()를 실행함
				echo("
					<script>
					alert('잘못된 비밀번호입니다. 다시 입력해주세요!');
					history.go(-1);
					</script>
				");
				exit;
			}
		}
	}
}
//================ 두 비밀번호를 비교하여 일치하면 세션을 생성함 =========================
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
		alert('잘못된 비밀번호입니다. 다시 입력해주세요!');
		history.go(-1);
		</script>
	");
	exit;

	
}


mysql_free_result( $result );
mysql_close($dbconn);
?>