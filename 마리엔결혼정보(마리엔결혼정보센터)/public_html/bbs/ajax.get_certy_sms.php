<?php
    include_once('./_common.php');
    include_once(G5_SMS5_PATH.'/sms5.lib.php');
    $phone  = $_POST['phone'];
    $phone_db  = get_hp($phone, 0);
    $company  = $_POST['company'];

    $rand_num_first = sprintf('%06d',rand(000000,999999));
    $rand_num = sprintf('%04d',rand(0000,9999));
    $rand_num_last = sprintf('%06d',rand(000000,999999));

    if($company){
        $msg  = "[".$company."] 인증번호[".$rand_num."]를 입력해주세요.";
    }else{
        $msg  = "[본인인증] 인증번호[".$rand_num."]를 입력해주세요.";
    }

    $result   = goSms($phone_db,'01071790034', $msg);
    echo $rand_num_first.$rand_num.$rand_num_last;