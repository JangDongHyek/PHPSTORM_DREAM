<?php

include_once('./_common.php');

$mb_hp = $_REQUEST['mb_hp'];
$mb_name = $_REQUEST['mb_name'];
$mb_id = $_REQUEST['mb_id'];
$register_url = G5_BBS_URL . '/register_form.php';

//공란일 경우 팅겨냄
if ($mb_hp == "") {
    die(json_encode(array('msg' => "핸드폰 번호가 비워져있습니다.")));
}

//문자보내기

    $random = rand("100000", "999999");

    $sql = "select count(mb_no) cnt from g5_member where mb_id='$mb_id' and (mb_hp='" . hyphen_hp_number($mb_hp) . "' or mb_hp = '".$mb_hp."' )";
    $msg = "[출세왕] 임시비밀번호는 [{$random}] 입니다. 로그인 후 보안을 위해 변경해주세요.";
    $console_msg = "임시비밀번호가 발송되었습니다. 로그인 후 보안을 위해 변경해주세요.";

    $member_result = sql_fetch($sql);

    if ($member_result['cnt'] == 0) {
        die(json_encode(array('msg' => "해당 정보로 가입한 회원이 없습니다.")));
    }

    $mb_hp = str_replace("-", "", $mb_hp);
    //$send_phone = '01064253103';
    $send_phone = '0518910088';



    $result = goSms($mb_hp, $send_phone, $msg);

    $sql = "select count(ch_no) cnt from new_certify_history where ch_id = '{$mb_hp}' and ch_method_op = '{$type}' ";
    $ch_result = sql_fetch($sql);
    //인증시간 없으면 insert, 있으면 시간 update
    if ($ch_result['cnt'] == 0) {
        $sql = "insert into new_certify_history set
                ch_method = 'phone', ch_method_op = '{$type}', ch_id = '{$mb_hp}'
                ,ch_count = 1, ch_check = 'Y', ch_date = '" . G5_TIME_YMDHIS . "', ch_sms_number = '{$random}' ";

        sql_query($sql);

    } else {
        //인증 있을 경우 새로 업뎃
        $sql = "update new_certify_history set
                    ch_method = 'phone', ch_id = '{$mb_hp}'
                     ,ch_count = ch_count + 1, ch_check = 'Y',
                    ch_date = '" . G5_TIME_YMDHIS . "', ch_sms_number = '{$random}'
                    where ch_id = '{$mb_hp}' and ch_method_op = '{$type}' ";

        sql_query($sql);

    }

    //비번찾기 일 경우 member임시비밀번호로 변경해주기

    $sql = "update g5_member set mb_password = '".get_encrypt_string($random)."' where mb_id = '{$mb_id}' ";
    sql_query($sql);
    $url =  G5_BBS_URL.'/login.php';

    die(json_encode(array( 'swal_msg' => $console_msg ,'msg' => 'sms_ok', "url" => $url )));



//인증 테이블에 데이터 넣기
