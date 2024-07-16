<?php
include_once('./_common.php');
/**
 * 일반회원 회원가입 - 휴대폰 인증번호
 */

if($mode == 'send') { // 인증번호 발송
    // 휴대폰 번호 없으면
    if (empty($hp)) { die('fail'); }
    // 이미 인증한 휴대폰 번호인지 확인

    // 인증번호 발송
    $cert_no = rand("100000", "999999");

    $mb_hp = str_replace("-", "", $hp);
    $send_phone = '07078430031';
    $msg = "[PODOSEA] 인증번호 [{$cert_no}]를 입력해 주세요.";
    $result = goSms($mb_hp, $send_phone, $msg);

    // 인증 테이블에 insert
    $sql = "insert into g5_certify_history set ch_method = 'phone', ch_id = '{$hp}', ch_cert_no = '{$cert_no}', ch_count = 1, ch_check = 'Y', ch_date = '" . G5_TIME_YMDHIS . "' ";
    sql_query($sql);

    die('success');
}
else if($mode == 'check') { // 인증번호 확인
    $cnt = sql_fetch("select count(*) as cnt from g5_certify_history where ch_method = 'phone' and ch_id = '{$hp}'")['cnt'];
    if($cnt > 0) {
        $info = sql_fetch("select * from g5_certify_history where ch_method = 'phone' and ch_id = '{$hp}' order by ch_no desc limit 1");

        if($info['ch_cert_no'] == $cert_no) {
            die('success');
        } else {
            die('fail');
        }
    }
    else {
        die('no_cert');
    }
}
