<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = trim($_POST['mb_id']);

// 휴대폰번호 체크
// $mb_hp = $_POST['mb_hp'];
// $chk_mb_hp = hyphen_hp_number($mb_hp);
// if($chk_mb_hp) {
//     $result = exist_mb_hp($chk_mb_hp, $mb_id);
//     if ($result)
//         alert($result);
// }

/*
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
*/

// 닉네임
$mb_nick = $_POST['mb_name'];

// 블랙/탈퇴회원 (접근차단일 지정) mb_leave_date는 자동으로 삭제될까봐 사용안했음.
$mb_intercept_date = "";
if ($_POST['mb_status'] == "블랙" || $_POST['mb_status'] == "탈퇴") {
    $mb_intercept_date = ($_POST['mb_intercept_date'] != "")? $_POST['mb_intercept_date'] : date("Ymd");
}

// 직접입력처리 (직업, 체형, 취미)
if ($_POST['mb_job'] == "직접입력") {
    $_POST['mb_job'] = $_POST['mb_job_str'];
}
if ($_POST['mb_body_type'] == "직접입력") {
    $_POST['mb_body_type'] = $_POST['mb_body_type_str'];
}
if ($_POST['mb_hobby'] == "직접입력") {
    $_POST['mb_hobby'] = $_POST['mb_hobby_str'];
}


// 성격
$mb_char_list = "";
$mb_char_str = "";
$mb_char = $_POST['mb_char'];
if(count($mb_char) > 0){
    for($i = 0; $i < count($mb_char); $i++){
        if ($mb_char_list != "") $mb_char_list .= ",";
        $mb_char_list .= $mb_char[$i];

        if ($mb_char[$i] == "직접입력") $mb_char_str = $_POST['mb_char_str'];
    }
}

// 이상형설정
$mb_ideal_type_list = "";
$mb_ideal_type_str = "";
$mb_ideal_type = $_POST['mb_ideal_type'];
if(count($mb_ideal_type) > 0){
    for($i = 0; $i < count($mb_ideal_type); $i++){
        if ($mb_ideal_type_list != "") $mb_ideal_type_list .= ",";
        $mb_ideal_type_list .= $mb_ideal_type[$i];

        if ($mb_ideal_type[$i] == "직접입력") $mb_ideal_type_str = $_POST['mb_ideal_type_str'];
    }
}


/*
                 mb_nick = '{$mb_nick}',
                 mb_tel = '{$_POST['mb_tel']}',
                 mb_leave_date = '{$_POST['mb_leave_date']}',
 */

$sql_common = "  mb_name = '{$_POST['mb_name']}',
                 mb_hp = '{$mb_hp}',
                 mb_intercept_date='{$mb_intercept_date}',
                 mb_memo = '{$_POST['mb_memo']}',
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
				 , mb_status = '{$_POST['mb_status']}'
				 , mb_sex = '{$_POST['mb_sex']}'
				 , mb_birth = '{$_POST['mb_birth']}'
				 , mb_si = '{$_POST['mb_si']}'
				 , mb_gu = '{$_POST['mb_gu']}'
				 , mb_height = '{$_POST['mb_height']}'
				 , mb_smoking = '{$_POST['mb_smoking']}'
				 , mb_job = '{$_POST['mb_job']}'
				 , mb_char = '{$mb_char_list}'
				 , mb_char_str = '{$mb_char_str}'
				 , mb_body_type = '{$_POST['mb_body_type']}'
				 , mb_hobby = '{$_POST['mb_hobby']}'
				 , mb_car_yn = '{$_POST['mb_car_yn']}'
				 , mb_drinking = '{$_POST['mb_drinking']}'
				 , mb_ideal_type = '{$mb_ideal_type_list}'
				 , mb_ideal_type_str = '{$mb_ideal_type_str}'
				 , mb_adm_profile = '{$mb_adm_profile}'
				 ";

if ($w == '') {
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nID : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name']);

    /*
    // 닉네임중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);


    // 이메일중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);
    */

    $sql = " insert into {$g5['member_table']} set 
			mb_id = '{$mb_id}', 
			mb_password = '".get_encrypt_string($mb_password)."', 
			mb_datetime = '".G5_TIME_YMDHIS."', 
			mb_ip = '{$_SERVER['REMOTE_ADDR']}', 
			mb_email_certify = '".G5_TIME_YMDHIS."', 
			{$sql_common} ";
    sql_query($sql);

} else if ($w == 'u') {

    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    /*
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
    */

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
    exit;
}

//===============================================================
// 연인추가 - 사진업로드
//---------------------------------------------------------------
$img_count = count($_FILES['bf_file']['tmp_name']);

for ($i = 0; $i < $img_count; $i++) {
    $upload_dir = MB_IMG_PATH.'/';
    $ext = "";
    $file_name = "";
    $table_name = "g5_member_img";

    if ($bf_idx[$i] == "") {				//====> 신규등록

        // 이미지 업로드
        $upload_file = $_FILES['bf_file']['tmp_name'][$i];

        if ($upload_file != "") {
            $ext = array_pop(explode('.', $_FILES['bf_file']['name'][$i]));
            $file_name = "{$mb_id}_{$i}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
            $upload_path = $upload_dir.$file_name;

            move_uploaded_file($upload_file, $upload_path);
        }

        $sql = "INSERT INTO {$table_name} SET 
				mb_id = '{$mb_id}',
				mi_img = '{$file_name}',
				mi_regdate = '".G5_TIME_YMDHIS."'
				";

    } else {							//====> 수정

        // 이미지 업로드
        $upload_file = $_FILES['bf_file']['tmp_name'][$i];
        $old_file_del = ($bf_file_del[$i] == "1")? true : false;

        if ($upload_file != "") {
            $ext = array_pop(explode('.', $_FILES['bf_file']['name'][$i]));
            $file_name = "{$mb_id}_{$i}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
            $upload_path = $upload_dir.$file_name;

            move_uploaded_file($upload_file, $upload_path);
            $old_file_del = true;

        } else {
            $file_name = $bf_old_img[$i];
        }

        // 이전이미지 삭제
        if ($old_file_del) {
            @unlink($upload_dir.$bf_old_img[$i]);
            if ($file_name == $bf_old_img[$i]) $file_name = "";
        }

        $sql = "UPDATE {$table_name} SET 
				mi_img = '{$file_name}',
				mi_regdate = '".G5_TIME_YMDHIS."'
				WHERE mb_id = '{$mb_id}' AND idx = '{$bf_idx[$i]}'
				";
    }

    sql_query($sql);
}

goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>