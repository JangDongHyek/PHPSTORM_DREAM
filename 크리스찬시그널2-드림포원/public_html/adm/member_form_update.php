<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

@mkdir(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH . '/file/' . 'member', G5_DIR_PERMISSION);

//print_r($_POST);exit;
//print_r($_FILES);exit;

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$mb_id = trim($_POST['mb_id']);

// 휴대폰번호 체크
$mb_hp = hyphen_hp_number($_POST['mb_hp']);
//if($mb_hp) {
//    $result = exist_mb_hp($mb_hp, $mb_id);
//    if ($result)
//        alert($result);
//}
if($_POST['mb_introduce'] == "직접입력"){
    $_POST['mb_introduce']  = $_POST['mb_introduce_memo'];
}
// 기본정보
$sql_common = " mb_name = '{$_POST['mb_name']}',
                mb_birth = '{$_POST['mb_birth']}',
                mb_nick = '{$_POST['mb_nick']}',
                mb_old = '{$_POST['mb_old']}',
                mb_hp = '{$mb_hp}',
                mb_live_si = '{$_POST['mb_live_si']}',
                mb_live_gu = '{$_POST['mb_live_gu']}',
                mb_church = '{$_POST['mb_church']}',
                mb_pastor = '{$_POST['mb_pastor']}',
                mb_church_si = '{$_POST['si_church']}', 
                mb_church_gu = '{$_POST['gu_church']}', 
                mb_church_dong = '{$_POST['dong_church']}',
                mb_social_role = '{$_POST['mb_social_role']}',
                mb_character_type = '{$_POST['mb_character_type']}',
                mb_blood_type = '{$_POST['mb_blood_type']}',
                mb_confession = '{$_POST['mb_confession']}',
                mb_sex = '{$_POST['mb_sex']}',
                mb_level = '{$_POST['mb_level']}',
                mb_agree1 = 'Y',
                mb_agree2 = 'Y',
                mb_join_date = '".G5_TIME_YMDHIS."',
                mb_height = '{$_POST['mb_height']}',
                mb_weight = '{$_POST['mb_weight']}',
                mb_introduce = '{$_POST['mb_introduce']}',
                mb_join_type = '{$_POST['mb_join_type']}',
                mb_join_type_de = '{$_POST['mb_join_type_de']}',
                mb_church_show = '{$mb_church_show}',
                mb_job = '{$mb_job}',
                mb_mycar = '{$mb_mycar}',
                mb_mycar_name = '{$mb_mycar_name}',
                mb_mycar_name_memo = '{$mb_mycar_name_memo}',
                mb_myhome = '{$mb_myhome}',
                mb_family = '{$mb_family}',
                mb_family_txt = '{$mb_family_txt}',
                mb_live = '{$mb_live}',
                mb_live_txt = '{$mb_live_txt}',
                mb_salary = '{$mb_salary}',
                mb_mbti = '{$mb_mbti}',
                mb_school = '{$mb_school}',
                mb_department = '{$mb_department}',
                mb_children = '{$mb_children}'
                ";

                 /*mb_email = '{$_POST['mb_email']}',
                 mb_homepage = '{$_POST['mb_homepage']}',
                 mb_tel = '{$_POST['mb_tel']}',
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
                 mb_3 = '{$_POST['mb_3']}',
                 mb_4 = '{$_POST['mb_4']}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}'*/

// 인터뷰
$sql_common2 = " interview1_text1 = '{$_POST['interview1_text1']}', 
                 interview2_text1 = '{$_POST['interview2_text1']}', 
                 interview2_text2 = '{$_POST['interview2_text2']}', 
                 interview3_text1 = '{$_POST['interview3_text1']}', 
                 interview3_text2 = '{$_POST['interview3_text2']}', 
                 interview4_text1 = '{$_POST['interview4_text1']}', 
                 interview4_text2 = '{$_POST['interview4_text2']}', 
                 interview5_text1 = '{$_POST['interview5_text1']}', 
                 interview5_text2 = '{$_POST['interview5_text2']}', 
                 interview6_text1 = '{$_POST['interview6_text1']}', 
                 interview7_text1 = '{$_POST['interview7_text1']}', 
                 interview8_text1 = '{$_POST['interview8_text1']}', 
                 interview9_text1 = '{$_POST['interview9_text1']}', 
                 interview10_text1 = '{$_POST['interview10_text1']}', 
                 interview11_text1 = '{$_POST['interview11_text1']}', 
                 interview11_text2 = '{$_POST['interview11_text2']}', 
                 interview12_text1 = '{$_POST['interview12_text1']}',
                 interview12_text2 = '{$_POST['interview12_text2']}', 
                 interview13_text1 = '{$_POST['interview13_text1']}',
                 interview14_text1 = '{$_POST['interview14_text1']}'
                 ";

/*for ($i = 1; $i <= 12; $i++) {
    if(!empty($_POST['interview'.$i.'_text1'])) {
        $sql_common2 .= " interview".$i."_text1 = '{$_POST['interview'.$i.'_text1']}' ";
    }
    if(!empty($_POST['interview'.$i.'_text2'])) {
        $sql_common2 .= " interview".$i."_text2 = '{$_POST['interview'.$i.'_text2']}' ";
    }
    if(!empty($_POST['interview'.$i.'_text3'])) {
        $sql_common2 .= " interview".$i."_text3 = '{$_POST['interview'.$i.'_text3']}' ";
    }
}*/

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

    // 닉네임중복체크
//    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' ";
//    $row = sql_fetch($sql);
//    if ($row['mb_id'])
//        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    /*// 이메일중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);*/

    // 기본정보
    $sql = " insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', {$sql_common} ";
    sql_query($sql);

    $sql = " select mb_no from {$g5['member_table']} where mb_id = '{$mb_id}' ";
    $mb_no = sql_fetch($sql)['mb_no'];

    // 인터뷰
    $sql = " insert into g5_member_interview set mb_no = '{$mb_no}', {$sql_common2} ";
    sql_query($sql);

    // 취미/관심사
    if(!empty($_POST['hobby_code'])) {
        $code = explode(',', $_POST['hobby_code']);

        for($i=0; $i<count($code); $i++) {
            $hobby_code = explode('_', $code[$i]);
            if($hobby_code[0] == 'hobby') $code_name = "취미";
            if($hobby_code[0] == 'exercise') $code_name = "운동";
            if($hobby_code[0] == 'movie') $code_name = "영화";
            if($hobby_code[0] == 'music') $code_name = "음악";
            if($hobby_code[0] == 'tv') $code_name = "TV";

            sql_query(" insert into g5_member_hobby set mb_no = '{$mb_no}', co_code = '{$hobby_code[1]}', co_code_name = '{$code_name}' ");
        }
    }



}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    $mb_no = $mb['mb_no'];

    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    // 닉네임중복체크
//    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' and mb_id <> '$mb_id' ";
//    $row = sql_fetch($sql);
//    if ($row['mb_id'])
//        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    /*// 이메일중복체크
    $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' and mb_id <> '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);*/

    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    // 기본정보
    $sql = " update {$g5['member_table']} set {$sql_common} {$sql_password} {$sql_certify} where mb_id = '{$mb_id}' ";
    sql_query($sql);

    // 인터뷰
    $sql = " select count(*) as count from g5_member_interview where mb_no = '{$mb['mb_no']}' ";
    $count = sql_fetch($sql)['count'];

    if($count > 0) {
        $sql = " update g5_member_interview set {$sql_common2} where mb_no = '{$mb['mb_no']}' ";
        sql_query($sql);
    } else {
        $sql = " insert into g5_member_interview set mb_no = '{$mb_no}', {$sql_common2} ";
        sql_query($sql);
    }

    // 취미/관심사
    if(!empty($_POST['hobby_code'])) {
        sql_query( " delete from g5_member_hobby where mb_no = '{$mb['mb_no']}' ");
        $code = explode(',', $_POST['hobby_code']);

        for($i=0; $i<count($code); $i++) {
            $hobby_code = explode('_', $code[$i]);
            if($hobby_code[0] == 'hobby') $code_name = "취미";
            if($hobby_code[0] == 'exercise') $code_name = "운동";
            if($hobby_code[0] == 'movie') $code_name = "영화";
            if($hobby_code[0] == 'music') $code_name = "음악";
            if($hobby_code[0] == 'tv') $code_name = "TV";

            sql_query(" insert into g5_member_hobby set mb_no = '{$mb['mb_no']}', co_code = '{$hobby_code[1]}', co_code_name = '{$code_name}' ");
        }
    }


}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');



//희망배우자
$mh_sql_common = "";
foreach ($_REQUEST as $key => $value) {
    if (strpos($key, 'mh_') === 0) {

        if ($key != "mh_style_memo" && $key != "mh_job_memo") {
            $comma_text = "";
            for ($i = 0; $i < count($value); $i++) {
                $comma_text .= "," . $value[$i];
            }
            $comma_text = substr($comma_text, 1);

        }else{
            $comma_text = $value;

        }

        $mh_sql_common .= $key . "='" . $comma_text . "',";
    }
}

$sql = "select count(*) cnt from g5_member_hope where mb_id = '{$mb_id}'";
$cnt = sql_fetch($sql)["cnt"];
if ($cnt == 0) {
    $sql = "insert into g5_member_hope set " . $mh_sql_common . " mb_id = '{$mb_id}' ,wr_datetime = '" . G5_TIME_YMDHIS . "'";
}else{
    // where idx로 되어있는거 mb_id로 바꿔줌 wc
    $sql = "update g5_member_hope set ".$mh_sql_common." mb_id = '{$mb_id}' where mb_id = '{$mb_id}' ";
}

sql_query($sql);



$sql = "insert into new_member_interview set ";
$mi_sql_common = "";

foreach ($_REQUEST as $key => $value) {
    if (strpos($key, 'mi_') === 0) {

        $mi_sql_common .= $key . "='" . $value . "',";
    }
}


$sql = "select count(*) cnt from new_member_interview where mb_id = '{$mb_id}'";
$cnt = sql_fetch($sql)["cnt"];
if ($cnt == 0) {
    $sql = "insert into new_member_interview set " . $mi_sql_common . " mb_id = '{$mb_id}' ,wr_datetime = '" . G5_TIME_YMDHIS . "'";
}else{
    $sql = "update new_member_interview set ".$mi_sql_common." mb_id = '{$mb_id}' where mb_id = '{$mb_id}' ";
}

sql_query($sql);

// 파일 삭제 (프로필 이미지)
$del_mb_img = explode(',', $_POST['del_mb_img']);
for($i = 0; $i < count($del_mb_img); $i++) {
    $sql = " select * from g5_member_img where idx = {$del_mb_img[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/member/' . $row['img_file']);

    $sql = " delete from g5_member_img where idx = {$del_mb_img[$i]} ";
    sql_query($sql);
}

// 파일 삭제 (추가 서류)
$del_mb_file = explode(',', $_POST['del_mb_file']);
for($i = 0; $i < count($del_mb_file); $i++) {
    $sql = " select * from g5_member_img_add where idx = {$del_mb_file[$i]} ";
    $row = sql_fetch($sql);

    unlink(G5_DATA_PATH . '/file/member_add/' . $row['img_file']);

    $sql = " delete from g5_member_img_add where idx = {$del_mb_file[$i]} ";
    sql_query($sql);
}

// 파일 등록


for ($i = 0; $i < count($_FILES['mb_img']['name']); $i++) {
    $upload[$i]['file'] = '';
    $upload[$i]['source'] = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image'] = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    $tmp_file = $_FILES['mb_img']['tmp_name'][$i];
    $filesize = $_FILES['mb_img']['size'][$i];
    $filename = $_FILES['mb_img']['name'][$i];
    $filename = get_safe_filename($filename);

    if (is_uploaded_file($tmp_file)) {
        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);
        $dest_file = G5_DATA_PATH . '/file/member/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_img']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_member_img set mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}', 
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}', 
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
}


// 파일 등록 추가서류
for ($i = 0; $i < count($_FILES['mb_add']['name']); $i++) {
    $upload[$i]['file'] = '';
    $upload[$i]['source'] = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image'] = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    $tmp_file = $_FILES['mb_add']['tmp_name'][$i];
    $filesize = $_FILES['mb_add']['size'][$i];
    $filename = $_FILES['mb_add']['name'][$i];
    $filename = get_safe_filename($filename);

    if (is_uploaded_file($tmp_file)) {
        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
            preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);
        $dest_file = G5_DATA_PATH . '/file/member_add/' . $upload[$i]['file'];

        //이미지 크기조정
        //size_image($_FILES['file'], 200, 200, $dest_file, 'multi', $i);

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['mb_add']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $sql = " insert into g5_member_img_add set mb_no = '{$mb_no}', img_source = '{$upload[$i]['source']}', img_file = '{$upload[$i]['file']}', 
                                               img_filesize = '{$upload[$i]['filesize']}', img_width = '{$upload[$i]['image']['0']}', img_height = '{$upload[$i]['image']['1']}', 
                                               img_type = '{$upload[$i]['image']['2']}', img_datetime = '" . G5_TIME_YMDHIS . "' ";
        sql_query($sql);
    }
}


//die($mb_id);
goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>