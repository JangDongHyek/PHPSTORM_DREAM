<?php
// 회원문자발송
include_once("../common.php");

//error_reporting(E_ALL);
//set_time_limit(0);

$json = array();
$json['result'] = false;
$json['err_msg'] = "";

$json['post'] = $_POST;

$sms_msg = $_POST['sms_msg'];
//$sms_send_num = $_POST['sms_send_num'];
$sms_type = $_POST['sms_type'];
$sms_type = ($sms_type == "4" || $sms_type == "6")? $sms_type : 4;			// 4:sms, 6:mms
$sms_img = ($sms_type == 4)? "" : $_POST['sms_img1'];
$sms_img2 = ($sms_type == 4)? "" : $_POST['sms_img2'];

if ($sms_msg == "") {
	$json['err_msg'] = '문자내용을 불러오는데 실패했습니다. 다시 시도해 주세요.';
	die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}

$sms_rcv_type = ($s_type == '99')? "전체회원" : $member_group[$s_type];
$sms_send_num = SMS_SEND_NUM;

$sms_rcv_id = $_POST['mb_id'];
$sms_rcv_hp = $_POST['mb_hp'];

// 문자발송
foreach ($sms_rcv_hp AS $key=>$val) {
	$mb_id = $sms_rcv_id[$key];
	$mb_hp = $sms_rcv_hp[$key];

    /*if (preg_match('/^(01[016789]{1})([0-9]{3,4})([0-9]{4})$/', $mb_hp, $matches)) {
        $formatted_hp = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
    } else {
        // The number does not match the pattern, so leave it as is or handle accordingly.
        $formatted_hp = $mb_hp;
    }*/

    if ($mb_hp != '' && $mb_id != '') {
		//goMMS($mb_hp, $sms_send_num, $sms_msg, $sms_type, $sms_img, $sms_img2);	// 수신, 발신, 내용, 타입(4,6), 이미지1, 이미지2
        goSms($mb_hp, $sms_msg, '');
	}
}

$sms_rcv_id_str = implode(",", $_POST['mb_id']);
$sms_rcv_hp_str = implode(",", $_POST['mb_hp']);

// 로그등록
$sql = "INSERT INTO g5_sms SET 
		sms_type = '{$sms_type}',
		sms_msg = '{$sms_msg}',
		sms_img1 = '{$sms_img1}',
		sms_img2 = '{$sms_img2}',
		sms_send_num = '{$sms_send_num}',
		sms_date = now(),
		sms_result = '',
		sms_rcv_type = '{$sms_rcv_type}',
		sms_rcv_id = '{$sms_rcv_id_str}',
		sms_rcv_hp = '{$mb_hp}'
		";

$json['result'] = sql_query($sql);

die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));