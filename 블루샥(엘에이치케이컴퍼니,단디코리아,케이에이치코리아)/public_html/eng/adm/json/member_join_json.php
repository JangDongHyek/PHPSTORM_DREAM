<?
	$sql="select * from g5_member where mb_id='$mb_id'";
	$result=sql_query($sql);
	$row=sql_fetch_array($result);
	$jsonArray=array();
	if($row[mb_id]){
		$jsonArray["success"]="false";
		$jsonArray["message"]="아이디가 중복되었습니다.";
		$output=json_encode($jsonArray);
		echo to_han($output);
		exit;
	}
	
	$sql="select * from g5_member where mb_nick='$mb_nick'";
	$result=sql_query($sql);
	$row=sql_fetch_array($result);
	if($row[mb_id]){
		$jsonArray["success"]="false";
		$jsonArray["message"]="닉네임이 중복되었습니다.";
		$output=json_encode($jsonArray);
		echo to_han($output);
		exit;
	}
	$sql="insert into g5_member
                set mb_id = '{$mb_id}',
                     mb_password = '".get_encrypt_string($mb_password)."',
                     mb_name = '{$mb_name}',
                     mb_nick = '{$mb_nick}',
                     mb_nick_date = '".G5_TIME_YMD."',
                     mb_email = '{$mb_email}',
                     mb_homepage = '{$mb_homepage}',
                     mb_tel = '{$mb_tel}',
                     mb_zip1 = '{$mb_zip1}',
                     mb_zip2 = '{$mb_zip2}',
                     mb_addr1 = '{$mb_addr1}',
                     mb_addr2 = '{$mb_addr2}',
                     mb_addr3 = '{$mb_addr3}',
                     mb_addr_jibeon = '{$mb_addr_jibeon}',
                     mb_signature = '{$mb_signature}',
                     mb_profile = '{$mb_profile}',
                     mb_today_login = '".G5_TIME_YMDHIS."',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$config['cf_register_level']}',
                     mb_recommend = '{$mb_recommend}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_mailling = '{$mb_mailling}',
                     mb_sms = '{$mb_sms}',
                     mb_open = '{$mb_open}',
                     mb_open_date = '".G5_TIME_YMD."',
                     mb_1 = '{$mb_1}',
                     mb_2 = '{$mb_2}',
                     mb_3 = '{$mb_3}',
                     mb_4 = '{$mb_4}',
                     mb_5 = '{$mb_5}',
                     mb_6 = '{$mb_6}',
                     mb_7 = '{$mb_7}',
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}'";
	$result=sql_query($sql);
	if($result==1){
		$jsonArray["success"]="true";
		$jsonArray["message"]="축하드립니다. 회원가입이 되었습니다.";
		$output=json_encode($jsonArray);
		echo to_han($output);
		exit;
	}else{
		echo sql_error();
	}
?>