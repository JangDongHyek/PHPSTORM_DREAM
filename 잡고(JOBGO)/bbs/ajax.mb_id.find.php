<?php
include_once('./_common.php');
$sql = "select ch_sms_number number from new_certify_history where ch_id = '{$mb_hp}' ";
$number = sql_fetch($sql)['number'];

if ($number != $_REQUEST['number']){
    //인증번호 초기화
    $sql = "update new_certify_history set ch_sms_number = 'NNN' where ch_id = '{$mb_hp}' and ch_method_op = 'id' ";
    sql_query($sql);

    die(json_encode(array('msg' => "인증번호가 일치하지 않습니다. 다시 인증해주세요.")));
}


$hypen_mb_hp=hyphen_hp_number($mb_hp);
$sql="select * from g5_member where mb_name='$mb_name' and mb_hp='$hypen_mb_hp'";
$row=sql_fetch($sql);
if($row[mb_id]){

	if($row['mb_sns'] == ""){
		$length=strlen($row[mb_id])-6;
		$firstId=substr($row[mb_id],0,6);
		$starTxt="";
		for($i=0;$i<$length;$i++){
			$starTxt.="*";
		}
		$mb_id=$row[mb_id];

		//인증번호 초기화
		$sql = "update new_certify_history set ch_sms_number = 'NNN' where ch_id = '{$mb_hp}' and ch_method_op = 'id'  ";
		sql_query($sql);

		die(json_encode(array('msg' => 'success', "id" => $mb_id )));
	} else {

		if($row['mb_sns'] == "naver") { 
			$sns = "네이버";
		} else if($row['mb_sns'] == "kakao") { 
			$sns = "카카오";
		} else if($row['mb_sns'] == "google") { 
			$sns = "구글";
		} else if($row['mb_sns'] == "facebook") { 
			$sns = "페이스북";
		}

		$msg = $sns." sns로그인으로 가입하셨습니다.\n sns로그인으로 이용해주세요.";

		die(json_encode(array('msg' => $msg, "id" => $mb_id )));
	}


}else{
    die(json_encode(array('msg' => "해당 정보로 가입한 회원이 없습니다.")));
}

?>