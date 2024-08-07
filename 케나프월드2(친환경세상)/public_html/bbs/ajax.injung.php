<?php
include_once('./_common.php');
$injung=rand(100000,999999);
echo $injung;
goSms($mb_hp,"바로펫 회원 인증번호 [".$injung."] 입니다]", "01044604494");
?>