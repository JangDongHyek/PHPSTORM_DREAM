<?
//================== SMS DB ���� ������ �ҷ��� ===========================================
$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
mysql_select_db("emma");
$j=0;
for($i=0;$i<count($hp);$i++){
	$user_id = "whwindow"; //������

	$rand		= rand(1000, 9999);
	$wr_message = $content;
	$send_content = $content;
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//������ ��� ��ȣ
	$send_back = "1588-1943";//������ ��� ��ȣ
	$send_phone = $hp[$i];//�޴� ��� ��ȣ 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//��ü��ϳ����
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
	window.alert('���ڰ� ���۵Ǿ����ϴ�.');
	self.close();
	</script>
	";
	exit;
}else{
	$fail=$hp-$j;
	echo "
	<script>
	window.alert('".$fail."�� ���� ������ �����Ͽ����ϴ�');
	self.close();
	</script>
	";
	exit;
}

?>