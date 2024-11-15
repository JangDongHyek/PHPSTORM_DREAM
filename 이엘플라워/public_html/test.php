<?

	$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	$sql = "";

	/*
	$tran_phone1 = "010-8081-8077";//받는 사람 번호 관리자
	$tran_callback1 = "010-8081-8077";//보내는 사람 번호
	$send_date = date("YmdHis");
	$mart_id = "elfower";
	$tran_msg1 = "[이엘플라워]".$name." ".$tel2." 주문이 들어왔습니다.";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
	mysql_query($sms_query,$conn_db);

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
	mysql_query($all_query,$conn_db);


	$wr_message = "[이엘플라워]".$name."님 주문접수되었습니다.";//$content;
	$send_content = "[이엘플라워]".$name."님 주문접수되었습니다.";
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//보내는 사람 번호
	$send_back = "010-8081-8077";//보내는 사람 번호
	$send_phone = "010-8945-5430";//받는 사람 번호 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//전체기록남기기
	$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";
	mysql_query($sql, $conn_db);
*/
	?>