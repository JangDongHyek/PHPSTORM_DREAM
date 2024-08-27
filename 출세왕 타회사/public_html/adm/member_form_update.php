<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();



$mb_id = trim($_POST['mb_id']);
$mb = get_member($mb_id);

$mb_1 = $mb['mb_1']; //승인여부
$mb_2 = $mb['mb_2']; //적립금 추천아이디
$mb_3 = $mb['mb_3']; //적립금 했는지 안했는지 체크

// 휴대폰번호 체크
$mb_hp = hyphen_hp_number($_POST['mb_hp']);
if($mb_hp) {
    $result = exist_mb_hp($mb_hp, $mb_id);
    if ($result)
        alert($result);
}

// 인증정보처리
if($_POST['mb_certify_case'] && $_POST['mb_certify']) {
    $mb_certify = $_POST['mb_certify_case'];
    $mb_adult = $_POST['mb_adult'];
} else {
    $mb_certify = '';
    $mb_adult = 0;
}

$mb_zip1 = substr($_POST['mb_zip'], 0, 3);
$mb_zip2 = substr($_POST['mb_zip'], 3);

//포인트 적립
	if($_POST['mb_1'] <> $mb_1){

		$msg = "";

		if($_POST['mb_1'] == "Y"){

			$msg = "축하합니다! 출세왕 가입이 승인 되었습니다. 지금 바로 서비스를 신청해보세요.";

			if($mb_2 && $mb_3 <> '0') // 1이면 포인트 적립해야함
			{

				// 회원가입 포인트 부여 -> 회원가입 승인할 때로 변경
				insert_point($mb_id, 5000, $mb_2.' 추천가입 축하', 'member', $mb_id, '회원가입');
				// 추천인에게 포인트 부여 -> 회원가입 승인할 때로 변경
				insert_point($mb_2, 5000, $mb_id.'의 추천인', 'member', $mb_2, $mb_id.' 추천');
				$mb_3 = 0;
                $mb_4 = date("Y-m-d H:i:s");
				$result_msg_add = $mb_id."님과 ".$mb_2."님 포인트가 적립되었습니다.";
			}


		} else if($_POST['mb_1'] == "N"){
			$msg = "아쉽지만, 출세왕 서비스 조건에 부합하지 않아 거절되었습니다.";
		}

        $push_re = send_fcm($mb['mb_id'],"",$msg);

		//푸쉬
		//send_fcm($mb['mb_id'],"",$msg);
	}

//주차가능요일 중복체크
$go_day = "";
for($i = 0; $i < count($_REQUEST['go_day']); $i++ ){
    $go_day .= ','.$_REQUEST['go_day'][$i];
}
$go_day = substr($go_day, 1);

$sql_common = "  mb_name = '{$_POST['mb_name']}',
                 mb_nick = '{$_POST['mb_nick']}',
                 mb_email = '{$_POST['mb_email']}',
                 mb_homepage = '{$_POST['mb_homepage']}',
                 mb_tel = '{$_POST['mb_tel']}',
                 mb_hp = '{$mb_hp}',
                 mb_certify = '{$mb_certify}',
                 mb_adult = '{$mb_adult}',
                 mb_zip1 = '$mb_zip1',
                 mb_zip2 = '$mb_zip2',
                 mb_addr1 = '{$_POST['mb_addr1']}',
                 mb_addr2 = '{$_POST['mb_addr2']}',
                 mb_addr3 = '{$_POST['mb_addr3']}',
                 mb_addr_jibeon = '{$_POST['mb_addr_jibeon']}',
                 mb_signature = '{$_POST['mb_signature']}',
                 mb_leave_date = '{$_POST['mb_leave_date']}',
                 mb_intercept_date='{$_POST['mb_intercept_date']}',
                 mb_memo = '{$_POST['mb_memo']}',
                 mb_mailling = '{$_POST['mb_mailling']}',
                 mb_sms = '{$_POST['mb_sms']}',
                 mb_open = '{$_POST['mb_open']}',
                 mb_profile = '{$_POST['mb_profile']}',
                 mb_level = '{$_POST['mb_level']}',
                 mb_1 = '{$_POST['mb_1']}',
                 mb_2 = '{$_POST['mb_2']}',
                 mb_3 = '{$mb_3}',
                 mb_4 = '{$mb_4}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}',
                 reg_type = '{$_POST['reg_type']}',
                 go_work = '{$_POST['go_work']}',
                 go_time1 = '{$_POST['go_time1']}',
                go_time2 = '{$_POST['go_time2']}',
                go_day = '{$go_day}',
                ma_time1 = '{$_POST['ma_time1']}',
                ma_time2 = '{$_POST['ma_time2']}',
                ma_time3 = '{$_POST['ma_time3']}',
                ma_time4 = '{$_POST['ma_time4']}',
                ma_day = '{$_POST['ma_day']}',
                ma_hope_month = '{$_POST['ma_hope_month']}',
                ma_exp_yn = '{$_POST['ma_exp_yn']}',
                ma_car_no = '{$_POST['ma_car_no']}',
                ma_birth = '{$_POST['ma_birth']}',
                ma_car_type = '{$_POST['ma_car_type']}' ";

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

    sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ");
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif');

    // 아이콘 업로드
    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        if (!preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            alert($_FILES['mb_icon']['name'] . '은(는) gif 파일이 아닙니다.');
        }

        if (preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
            @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);

            $dest_path = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif';

            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);

            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config['cf_member_icon_width'] || $size[1] > $config['cf_member_icon_height']) {
                    @unlink($dest_path);
                }
            }
        }
    }

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    if ($passive_certify)
        $sql_certify = " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    else
        $sql_certify = "";

    $sql = " update {$g5['member_table']}
                set {$sql_common}
                     {$sql_password}
                     {$sql_certify}
                where mb_id = '{$mb_id}' ";

    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

alert($result_msg_add." 완료되었습니다.",'./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>