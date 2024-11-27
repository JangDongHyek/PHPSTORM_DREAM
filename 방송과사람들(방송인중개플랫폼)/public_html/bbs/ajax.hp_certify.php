<?php
include_once('./_common.php');

//문자보내기
if ($mode == "send") {
    $type = $_REQUEST['type'];
    $hp = $_REQUEST['hp'];
    $clean_hp = str_replace('-', '', $hp);
    $method = "";
    $random = rand("100000", "999999");

    // 회원가입
    if($type == 'register'){
        $sql = "SELECT * FROM `g5_member` WHERE REPLACE(`mb_hp`, '-', '') = '$clean_hp'";
        $mb = sql_fetch($sql);

        // 중복체크
        if($mb['mb_id'] != ''){
            echo json_encode(array('msg' => "이미 해당 휴대폰 번호로 가입한 내역이 있습니다. 비밀번호 찾기를 이용해주세요.", "code" => "-1"),JSON_UNESCAPED_UNICODE);
            exit;
        }

        // 발송
        $msg = "[".$config["cf_title"]."] 본인확인 인증번호는 [{$random}] 입니다.";

    } else if($type == ""){
        $sql = "select count(mb_no) cnt from g5_member where mb_id = '$mb_id' and REPLACE(`mb_hp`, '-', '') = '$clean_hp'";

        $msg = "[".$config["cf_title"]."] 임시비밀번호는 {$random}입니다. 로그인 후 보안을 위해 변경해주세요.";
        $console_msg = "임시비밀번호가 발송되었습니다. 로그인 후 보안을 위해 변경해주세요.";

        $member_result = sql_fetch($sql);

        if ($member_result['cnt'] == 0) {
            echo json_encode(array('swal_msg' => "해당 정보로 가입한 회원이 없습니다."),JSON_UNESCAPED_UNICODE);
            exit;
        }

        $method = "sms";
    }
    $send_phone = '0518910087';
    $result = goSms($clean_hp, $send_phone, $msg);

    set_session("hp_certify", $random);

    echo json_encode(array( 'msg' => "인증번호를 발송하였습니다." ,'code' => '1'),JSON_UNESCAPED_UNICODE);
    exit;

}else if ($mode == "check"){
    $cert_no = $_REQUEST["cert_no"];
    $hp_certify = get_session("hp_certify");

    if($cert_no != $hp_certify){
        echo json_encode(array('msg' => "문자로 전송한 인증번호와 일치하지 않습니다. 인증번호를 확인해주세요.", 'code' => '-1' ),JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        echo json_encode(array('msg' => "인증에 성공 하였습니다.", 'code' => '1' ),JSON_UNESCAPED_UNICODE);
        exit;
    }

}
