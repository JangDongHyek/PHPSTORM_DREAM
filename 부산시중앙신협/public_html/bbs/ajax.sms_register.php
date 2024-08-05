<?php

include_once('./_common.php');

$mode = $_REQUEST['mode'];
$mb_hp = hyphen_hp_number($_REQUEST['mb_hp']);
$mb_name = $_REQUEST['mb_name'];
$mb_1 = $_REQUEST['mb_1'];
$level = $_REQUEST['level'];
$mb_id = $_REQUEST['mb_id'];
$register_url = G5_BBS_URL . '/register_form.php';

//공란일 경우 팅겨냄
if ($mb_hp == "") {
    die(json_encode(array('msg' => "핸드폰 번호가 비워져있습니다.")));
}

//문자보내기
if ($mode == "sms_send") {
    $type = $_REQUEST['type'];
    $method = "";
    $random = rand("100000", "999999");

    //회원가입 시 본인인증
    if ($type == 'id') {
        $sql = "select count(mb_no) cnt from g5_member where mb_hp='" . $mb_hp . "'";
        $msg = "[".$config["cf_title"]."] 본인확인 인증번호는 [{$random}] 입니다.";
        $console_msg = "인증번호가 발송되었습니다.";

        $member_result = sql_fetch($sql);

        if ($member_result['cnt'] != 0 && $level == 2) {
            die(json_encode(array('swal_msg' => "이미 해당 휴대폰 번호로 가입한 내역이 있습니다. 비밀번호 찾기를 이용해주세요.")));
        }

        $method = "register";

    }else{

        $sql = "select count(mb_no) cnt from g5_member where mb_id = '$mb_id' and mb_hp='" . $mb_hp . "' ";

        $msg = "[".$config["cf_title"]."] 임시비밀번호는 {$random}입니다. 로그인 후 보안을 위해 변경해주세요.";
        $console_msg = "임시비밀번호가 발송되었습니다. 로그인 후 보안을 위해 변경해주세요.";

        $member_result = sql_fetch($sql);

        if ($member_result['cnt'] == 0) {
            die(json_encode(array('swal_msg' => "해당 정보로 가입한 회원이 없습니다.")));
        }

        $method = "sms";

    }

    $send_phone = '0516111255';


    $result = goSms($mb_hp, $send_phone, $msg);

    $sql = "select count(ch_no) cnt from new_certify_history where ch_id = '".str_replace("-", "", $mb_hp)."' and ch_method = '{$method}' and ch_level = '{$level}' ";

    $ch_result = sql_fetch($sql);
    //인증시간 없으면 insert, 있으면 시간 update
    if ($ch_result['cnt'] == 0) {
        if ($level == 3 && $type == 'pw'){
            $mb_name = $mb_1;
        }
        $sql = "insert into new_certify_history set
                ch_method = '{$method}', ch_id = '".str_replace("-", "", $mb_hp)."', ch_name = '{$mb_name}',ch_level = '{$level}'
                ,ch_count = 1, ch_date = '" . G5_TIME_YMDHIS . "', ch_sms_number = '{$random}' ";

        sql_query($sql);

    } else {
        //인증 있을 경우 새로 업뎃
        $sql = "update new_certify_history set ch_count = ch_count + 1, ch_date = '" . G5_TIME_YMDHIS . "', ch_sms_number = '{$random}', ch_name = '{$mb_name}'
                    where ch_id = '".str_replace("-", "", $mb_hp)."' and ch_method = '{$method}' and ch_level = '{$level}'  ";

        sql_query($sql);

    }

    //비번찾기 일 경우 member임시비밀번호로 변경해주기
    if ($type =='pw'){

        $sql = "update g5_member set mb_password = '".get_encrypt_string($random)."' where mb_id = '$mb_id' and mb_hp='" . $mb_hp . "' ";

        sql_query($sql);
        $url =  G5_BBS_URL.'/login.php';
    }

    die(json_encode(array( 'swal_msg' => $console_msg ,'msg' => 'sms_ok', "url" => $url )));


}elseif ($mode == "sms_number_chk"){

    $sql = "select * from new_certify_history where ch_id = '".str_replace("-", "", $mb_hp)."' and ch_level = '{$level}' and ch_name = '{$mb_name}' ";
    $random = sql_fetch($sql);

    if ($random["ch_sms_number"] == $_REQUEST["number"]) {
        die(json_encode(array('swal_msg' => "인증에 성공했습니다.", 'msg' => 'ok')));
    }else{
        $sql = "update new_certify_history set ch_sms_number = '' where ch_id = '".str_replace("-", "", $mb_hp)."' and ch_level = '{$level}' and ch_name = '{$mb_name}' ";
        sql_query($sql);

        die(json_encode(array('swal_msg' => "문자로 전송한 인증번호와 일치하지 않습니다. 인증번호를 다시 받아주세요.", 'msg' => 'no' )));

    }

}
