<?
//================== SMS DB 설정 파일을 불러옴 ===========================================
$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
mysql_select_db("emma");
$j=0;
for($i=0;$i<count($hp);$i++){
	$user_id = "whwindow"; //계정명

	$rand		= rand(1000, 9999);
	$wr_message = $content;
	$send_content = $content;
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//보내는 사람 번호
	$send_back = "1588-1943";//보내는 사람 번호
	$send_phone = $hp[$i];//받는 사람 번호 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//전체기록남기기
	$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";
	mysql_query($sql, $conn_db);
	if($res){
		$j++;
	}
	sleep(5);
}


if( $j==count($hp)){
	echo "
	<script>
	window.alert('문자가 전송되었습니다.');
	self.close();
	</script>
	";
	exit;
}else{
	$fail=$hp-$j;
	echo "
	<script>
	window.alert('".$fail."건 문자 전송이 실패하였습니다');
	self.close();
	</script>
	";
	exit;
}

?>