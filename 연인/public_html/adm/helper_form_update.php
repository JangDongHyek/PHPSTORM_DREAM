<?php
$sub_menu = "400100";
include_once("./_common.php");

/*
if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();
*/

$mb_id = trim($_POST['mb_id']);

// 닉네임
$mb_nick = $_POST['mb_name'];


$sql_common = "  mb_name = '{$_POST['mb_name']}',
                 mb_nick = '{$mb_nick}',
                 mb_email = '',
                 mb_homepage = '',
                 mb_tel = '',
                 mb_hp = '',
				 mb_profile = '{$_POST['mb_profile']}',
				 mb_level = '{$_POST['mb_level']}',
                 mb_1 = '{$_POST['mb_1']}',
                 mb_2 = '{$_POST['mb_2']}',
                 mb_3 = '{$_POST['mb_3']}',
                 mb_4 = '{$_POST['mb_4']}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}'
				 , mb_status = '{$_POST['mb_status']}'";

$mb = get_member($mb_id);

if ($w == '') {

    if ($mb['mb_id'])
        alert('이미 존재하는 아이디입니다.\\nＩＤ : '.$mb['mb_id']);

	$sql = " insert into {$g5['member_table']} set 
			mb_id = '{$mb_id}', 
			mb_password = '".get_encrypt_string($mb_password)."', 
			mb_datetime = '".G5_TIME_YMDHIS."', 
			mb_ip = '{$_SERVER['REMOTE_ADDR']}', 
			mb_email_certify = '".G5_TIME_YMDHIS."', 
			{$sql_common} ";
    sql_query($sql);

} else if ($w == 'u') {

    if (!$mb['mb_id'])
        alert('존재하지 않는 헬퍼입니다.');

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    $sql = " update {$g5['member_table']}
                set {$sql_common}
                     {$sql_password}
                where mb_id = '{$mb_id}' ";
    sql_query($sql);

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

@include_once(G5_PATH."/customs/member_img_upload.php");

goto_url('./helper_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>