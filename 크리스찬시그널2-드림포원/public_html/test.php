<?
	include_once("./_common.php");


	$sql = "select * from `g5_fcm` where `mb_id` = 'cocomong'";

	$re = sql_query($sql);

	while($row = sql_fetch_array($re)){
		$token[] = $row['token'];
	}

	//var_dump($token);

	

	$message['subject'] = "123";
	$message['message'] = "bbs";
	$message['goUrl'] = "";

	$re = sendFcmIOS($token,$message);
	var_dump($re);

	$re = sendFcm($token,$message);
	var_dump($re);