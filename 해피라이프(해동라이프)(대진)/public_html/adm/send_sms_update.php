<?php
$sub_menu = "200200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

/*
$g5['title'] = '회원문자발송';
include_once('./admin.head.php');
*/

$sms_msg = $_POST['sms_msg'];
if ($sms_msg == "") {
	alert('문자내용을 불러오는데 실패했습니다. 다시 시도해 주세요.');
}


$mb_id_arr = array();
$mb_hp_arr = array();

$sms_type = ($sms_type == "4" || $sms_type == "6")? $sms_type : 4;			// 4:sms, 6:mms

$sms_rcv_type = ($s_type == '99')? "전체회원" : $member_group[$s_type];
$sms_send_num = SMS_SEND_NUM;

$sms_img = ($sms_type == 4)? "" : $sms_img1;
$sms_img2 = ($sms_type == 4)? "" : $sms_img2;

// 문자발송
for ($i = 0; $i < count($sms_rcv_id); $i++) {
	$k = $sms_chkbox[$i];
	$mb_id = $sms_rcv_id[$k];
	$mb_hp = $sms_rcv_hp[$k];

	if ($mb_hp != '' && $mb_id != '') {
		$mb_id_arr[] = $mb_id;
		$mb_hp_arr[] = $mb_hp;

		goMMS($mb_hp, $sms_send_num, $sms_msg, $sms_type, $sms_img, $sms_img2);	// 수신, 발신, 내용, 타입(4,6), 이미지1, 이미지2
	}
}

$sms_rcv_id = implode(",", $mb_id_arr);
$sms_rcv_hp = implode(",", $mb_hp_arr);

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
		sms_rcv_id = '{$sms_rcv_id}',
		sms_rcv_hp = '{$sms_rcv_hp}'
		";
sql_query($sql);

alert("완료되었습니다.", G5_ADMIN_URL."/send_sms.php");
?>