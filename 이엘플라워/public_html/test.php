<?

	$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	$sql = "";

	/*
	$tran_phone1 = "010-8081-8077";//�޴� ��� ��ȣ ������
	$tran_callback1 = "010-8081-8077";//������ ��� ��ȣ
	$send_date = date("YmdHis");
	$mart_id = "elfower";
	$tran_msg1 = "[�̿��ö��]".$name." ".$tel2." �ֹ��� ���Խ��ϴ�.";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
	mysql_query($sms_query,$conn_db);

	//��ü��ϳ����
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
	mysql_query($all_query,$conn_db);


	$wr_message = "[�̿��ö��]".$name."�� �ֹ������Ǿ����ϴ�.";//$content;
	$send_content = "[�̿��ö��]".$name."�� �ֹ������Ǿ����ϴ�.";
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//������ ��� ��ȣ
	$send_back = "010-8081-8077";//������ ��� ��ȣ
	$send_phone = "010-8945-5430";//�޴� ��� ��ȣ 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//��ü��ϳ����
	$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";
	mysql_query($sql, $conn_db);
*/
	?>