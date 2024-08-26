<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH . "/thumbnail.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = $_POST['mb_email'];

// 휴대폰번호 체크
$mb_hp = hyphen_hp_number($_POST['mb_hp']);
if($mb_hp) {
    $result = exist_mb_hp($mb_hp, $mb_id);
    if ($result)
        alert($result);
}

$_POST['mb_birth'] = str_replace ( '/' , '', $_POST['mb_birth']);

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

$mb_sub_path = "";
for ($i = 0; $i < count($_POST['mb_sub_path']); $i++) {
    $mb_sub_path .= "," . $_POST['mb_sub_path'][$i];
}
$mb_sub_path = substr($mb_sub_path, 1);
$mb_sub_text = isset($_POST['mb_sub_text'])            ? trim($_POST['mb_sub_text'])          : "";


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
                 mb_birth = '{$_POST['mb_birth']}',
                 mb_1 = '{$_POST['mb_1']}',
                 mb_2 = '{$_POST['mb_2']}',
                 mb_3 = '{$_POST['mb_3']}',
                 mb_4 = '{$_POST['mb_4']}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}',
                 mb_join_division = '{$_POST['mb_division']}',
                 mb_sub_path = '{$mb_sub_path}',
                 mb_sub_text = '{$mb_sub_text}',
                 mb_buisnessman = '{$_REQUEST["mb_buisnessman"]}',
                 mb_division = '{$_POST['mb_division']}' ";

$profile_common = "";
foreach ($_REQUEST as $key => $value) {
    if (strpos( $key, 'pf_' ) === 0) {
        if ($key != 'pf_idx') {
            if ( ($key == 'pf_call_time1' || $key == 'pf_call_time2') && $value == ''){
                $profile_common .= $key . "= null,";
            }else {
                $profile_common .= $key . "='" . $value . "',";
            }
        }
    }
}

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

    // 닉네임중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'] && $row['mb_level'] == 2)
        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    // 이메일중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ");
//    $sql = "insert into {$g5['profile_table']} set {$profile_common} wr_datetime '".G5_TIME_YMDHIS."' ";
//    sql_query($sql);
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

    // 닉네임중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' and mb_id <> '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    // 이메일중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' and mb_id <> '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.jpg');

    // 아이콘 업로드
    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        $mb_dir = substr($mb_id, 0, 2);

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
        @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);


        $arr_name = explode('.', $_FILES['mb_icon']['name']);
        $file_ext = array_pop($arr_name); //확장자 추출 (array_pop : 배열의 마지막 원소를 빼내어 반환)

        $file_type = $_FILES['mb_icon']['type'];
        $check_ext = array('jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'); //확장자 체크를 위한 선언부


        if (!in_array($file_ext, $check_ext)) {
            echo "허용되지 않는 확장자입니다";
            exit;

        }
//    if ($file_width > $new_file_width) { //이미지 가로사이즈가 200보다 크면 사이즈 조절
        $dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $mb_id . '.jpg';

        size_image($_FILES['mb_icon'],$config['cf_member_icon_width'],$config['cf_member_icon_height'],$dest_path,'one');

//    }
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

    if ($_REQUEST['pf_idx'] == "") {
        $sql = "insert into {$g5['profile_table']} set {$profile_common} mb_id = '{$mb_id}',wr_datetime= '" . G5_TIME_YMDHIS . "' ";
    }else {
        $sql = "update {$g5['profile_table']} set {$profile_common} up_datetime = '" . G5_TIME_YMDHIS . "' where mb_id = '{$mb_id}' ";
    }
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

alert("완료되었습니다.",'./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>