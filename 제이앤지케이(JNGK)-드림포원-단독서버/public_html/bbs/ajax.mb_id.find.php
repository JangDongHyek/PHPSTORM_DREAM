<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

$mode = $_POST['mode'];
$mb_hp=hyphen_hp_number($mb_hp);

if($mode == 'password') {
    //$sql="select * from g5_member where mb_id='$mb_id' and mb_hp='$mb_hp'";
    $sql="select * from g5_member where mb_id='$mb_id' and mb_name='$mb_name' and use_yn = 'Y'";
    $row=sql_fetch($sql);
    if($row[mb_id]){
        // 임시 비밀번호 메일 발송

        $reg_mb_email = trim($mb_email);

        // 임시비밀번호 발급
        $temp_password = rand(100000, 999999);

        /*// 임시 비밀번호 생성
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        $random_string = '';
        $length = 10; // 임시 비밀번호 길이
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $characters_length - 1)]; // "0~9", "a~z", "A~Z" 중 임의의 문자열 조합
        }
        $temp_password = $random_string;*/

        // 메일 제목
        $subject = "[JNGK] JNGK 임시 비밀번호 발급 안내";

        // 메일 내용
        $content = "";
        $content .= "<div style='width:600px;border:10px solid #f7f7f7;text-align: center;'>";
        $content .= "<span><img src='".G5_IMG_URL."/logo.png' style='width: 100px;padding-top: 10px;'></span><h1 style='color:#555;font-size:1.4em'> JNGK 임시 비밀번호 발급 안내</h1>";
        $content .= "<p style='font-size:20px;margin-bottom:0;padding-top: 20px;padding-bottom: 18px;font-family:Nanum Gothic;background:#f7f7f7;'>임시 비밀번호를 다음과 같이 알려드립니다.<br>로그인 후 비밀번호를 변경하세요.</p>";
        $content .= "<p style='font-size:20px;font-family:Nanum Gothic;background:#f7f7f7;'><div>".$temp_password."<div></p>";
        $content .= "</div>";

        // 메일 발송
        itforoneMailer( 'shu@jngk.co.kr','JNGK', $reg_mb_email, $reg_mb_email, $subject, $content);

        // 임시 비밀번호 → 사용자 비밀번호 update
        $mb_password = get_encrypt_string($temp_password);
        $sql = " update {$g5['member_table']} set mb_password = '{$mb_password}' where mb_id = '{$mb_id}' and use_yn = 'Y' ";
        sql_query($sql);

        // 메일 발송 로그
        sql_query(" insert into g5_mail_log set mb_id = '{$mb_id}', mb_name = '{$mb_name}', mail = '{$reg_mb_email}', data1 = '{$temp_password}', data2 = '{$mb_password}', pre_data = '{$row['mb_password']}', wr_datetime = '".G5_TIME_YMDHIS."' ");

        echo "임시 비밀번호를 메일로 발송하였습니다.";
    }else{
        echo "해당정보가 없거나 또는 잘못 정보를 입력하셨습니다.";
    }
}
else {
    $sql="select * from g5_member where mb_name='$mb_name' and mb_hp='$mb_hp' and use_yn = 'Y'";
    $row=sql_fetch($sql);
    if($row[mb_id]){
        $length=strlen($row[mb_id])-3;
        $firstId=substr($row[mb_id],0,3);
        $starTxt="";
        for($i=0;$i<$length;$i++){
            $starTxt.="*";
        }
        $mb_id=$firstId.$starTxt;
        echo "회원님의 아이디는 <font color='blue' style='font-size:15px;font-weight:bold'>".$mb_id."</font> 입니다.";
    }else{
        echo "해당정보가 없거나 또는 잘못 정보를 입력하셨습니다.";
    }
}


?>
