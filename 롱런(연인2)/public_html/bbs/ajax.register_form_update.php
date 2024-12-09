<?php
include_once("./_common.php");
include_once("../lib/register.lib.php");

// 24-07-22 완열 토큰 검사 추가
$ss_token = get_session("ss_token");
$reg_token = $_POST['reg_token'];
if(!empty($ss_token) && !empty($reg_token) && $ss_token != $reg_token){
    $json['err_msg'] = "올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.";
    die(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$json = array();
$json['result'] = false;
$json['err_msg'] = "";
$json['post'] = $_POST;
$json['file'] = $_FILES;

$w = $_POST['w'];

// step3
$mb_join_path = implode(",", $_POST['mb_join_path']);
$mb_certify = "Y";

// step4
$mb_si = $_POST['mb_si']; // 거주지역 시/도
$mb_gu = $_POST['mb_gu']; // 거주지역 구/군
$mb_height = $_POST['mb_height'];   // 키
$mb_smoking = $_POST['mb_smoking']; // 흡연여부
$mb_job = ($_POST['mb_job'] == "직접입력")? $_POST['mb_job_str'] : $_POST['mb_job']; // 성격
$mb_char = implode(",", $_POST['mb_char']); // 성격
$mb_char_str = in_array("직접입력", $_POST['mb_char'])? $_POST['mb_char_str'] : ""; // 성격-직접입력
$mb_body_type = ($_POST['mb_body_type_str'] != "")? $_POST['mb_body_type_str'] : $_POST['mb_body_type']; // 체형
$mb_hobby = ($_POST['mb_hobby_str'] != "")? $_POST['mb_hobby_str'] : $_POST['mb_hobby']; // 취미
$mb_car_yn = $_POST['mb_car_yn']; // 자차
$mb_drinking = $_POST['mb_drinking']; // 음주
$mb_profile = trim($_POST['mb_profile']); // 내소개

// step5
$mb_ideal_type = implode(",", $_POST['mb_ideal_type']); // 이상형등록
$mb_ideal_type_str = in_array("직접입력", $_POST['mb_ideal_type'])? $_POST['mb_ideal_type_str'] : ""; // 이상형등록-직접입력

// 공통쿼리
$sql_common = "
    , mb_join_path = '{$mb_join_path}'
    , mb_si = '{$mb_si}'
    , mb_gu = '{$mb_gu}'
    , mb_height = '{$mb_height}'
    , mb_smoking = '{$mb_smoking}'
    , mb_job = '{$mb_job}'
    , mb_char = '{$mb_char}'
    , mb_char_str = '{$mb_char_str}'
    , mb_body_type = '{$mb_body_type}'
    , mb_hobby = '{$mb_hobby}'
    , mb_car_yn = '{$mb_car_yn}'
    , mb_drinking = '{$mb_drinking}'
    , mb_profile = '{$mb_profile}'
    , mb_ideal_type = '{$mb_ideal_type}'
    , mb_ideal_type_str = '{$mb_ideal_type_str}'
	, mb_5 = '{$mb_5}'
";

if ($w == "") { // 회원가입
    // step3 add
    $mb_id = trim($_POST['mb_id']);
    $mb_password = trim($_POST['mb_password']); // get_encrypt_string($mb_password)
    $mb_password_re = trim($_POST['mb_password_re']);
    $mb_name = $_POST['mb_name'];
    $mb_sex = $_POST['mb_sex'];
    $mb_birth = $_POST['mb_birth'];
    $mb_hp = $_POST['mb_hp'];

    if ($msg = exist_mb_id($mb_id)) {
        $json['err_msg'] = $msg;
        die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }

    if ($mb_password != $mb_password_re) {
        $json['err_msg'] = "비밀번호와 비밀번호확인이 일치하지 않습니다.";
        die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }

    $enc_password = get_encrypt_string($mb_password);

    $sql = "INSERT INTO g5_member SET
            mb_id = '{$mb_id}',
            mb_password = '{$enc_password}',
            mb_name = '{$mb_name}',
            mb_level = '2',
            mb_sex = '{$mb_sex}',
            mb_birth = '{$mb_birth}',
            mb_hp = '{$mb_hp}',
            mb_certify = '{$mb_certify}',
            mb_datetime = '".G5_TIME_YMDHIS."',
            mb_ip = '{$_SERVER['REMOTE_ADDR']}'
            {$sql_common}
            ";
    // $json['test'] = $sql;
    $json['result'] = sql_query($sql);

    if ($json['result']) {
        // 로그인 새션 생성
        set_session('ss_mb_id', $mb_id);
        set_session('ss_mb_key', md5(G5_TIME_YMDHIS . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

        $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $enc_password);
        set_cookie('ck_mb_id', $mb_id, 86400 * 365);
        set_cookie('ck_auto', $key, 86400 * 365);
    }

} else { // 회원수정

    // 24-07-22 완열 기존 아이디 검사 추가
    $edit_mb_id = get_session("edit_mb_id");
    if(trim($edit_mb_id) != trim($mb_id)){
        $json['err_msg'] = "올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.";
        die(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    // 24-07-22 완열 기존 아이디 검사 추가
    if($member['mb_id'] != trim($mb_id)){
        $json['err_msg'] = "올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.";
        die(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $mb_password = trim($_POST['mb_password']);
    $mb_password_re = trim($_POST['mb_password_re']);

    if ($mb_password != "") { // 비밀번호 변경시 쿼리 추가
        if ($mb_password != $mb_password_re) {
            $json['err_msg'] = "비밀번호와 비밀번호확인이 일치하지 않습니다.";
            die(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        $enc_password = get_encrypt_string($mb_password);
        $sql_common .= ", mb_password = '{$enc_password}'";
    }

    $sql = "UPDATE g5_member SET
            mb_certify = '{$mb_certify}'";
    $sql .= $sql_common;
    $sql .= "WHERE mb_id = '{$mb_id}'";

    // $json['query'] = $sql;
    $json['result'] = sql_query($sql);

}


// 사진 등록/삭제
if ($json['result']) {
    // 1. 등록
    $img_count = count($_FILES['img_file']['tmp_name']);
    $upload_dir = MB_IMG_PATH.'/';

    for ($i = 0; $i < $img_count; $i++) {
        $ext = "";
        $file_name = "";

        // 이미지 업로드
        $upload_file = $_FILES['img_file']['tmp_name'][$i];

        if ($upload_file == "") continue;

        $ext = array_pop(explode('.', $_FILES['img_file']['name'][$i]));
        $file_name = "{$mb_id}_{$i}_".strtotime(G5_TIME_YMDHIS).".{$ext}";
        $upload_path = $upload_dir.$file_name;

        if (move_uploaded_file($upload_file, $upload_path)) {
            $sql = "INSERT INTO g5_member_img SET 
                    mb_id = '{$mb_id}',
                    mi_img = '{$file_name}',
                    mi_regdate = '".G5_TIME_YMDHIS."'
                    ";
            sql_query($sql);
        }
    }

    // 2. 삭제
    if ($_POST['deleteOldImgIdx'] != "") {
        $rst = sql_query("SELECT mi_img FROM g5_member_img WHERE idx IN ({$_POST['deleteOldImgIdx']})");
        for ($i = 0; $row = sql_fetch_array($rst); $i++) {
            // 파일삭제
            @unlink($upload_dir.$row['mi_img']);
        }
        // DB삭제
        sql_query("DELETE FROM g5_member_img WHERE idx IN ({$_POST['deleteOldImgIdx']})");
    }
}


die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));