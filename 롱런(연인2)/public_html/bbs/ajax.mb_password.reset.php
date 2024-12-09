<?php
/**
 * 비밀번호 재설정
 */
include_once ("./_common.php");

$ss_token = get_session("find_pw_token");
set_session("find_pw_token","");

$json = array();
$json['result'] = false;

// 24-07-22 완열 토큰검사 추가
if(!empty($ss_token) && !empty($token) && $ss_token == $token){

    // 24-07-22 완열 패스워드값 검사 추가
    $mb_password = get_encrypt_string($_POST['password']);
    if(empty($mb_password)){
        die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }

    $sql = "UPDATE g5_member SET mb_password = '{$mb_password}' WHERE mb_no = '{$_POST['mb_no']}'";
    $json['result'] = sql_query($sql);

    die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}


