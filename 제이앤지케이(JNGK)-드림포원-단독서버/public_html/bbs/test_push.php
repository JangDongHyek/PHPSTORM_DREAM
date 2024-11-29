<?php
include_once('./_common.php');

$sql="select * from g5_fcm where mb_id='test01'";
$fRow=sql_fetch($sql);

$tokens=array($fRow[token]);

$message=array(
    "message"=>"테스트",
    "subject"=>"테스트",
    "goUrl"=>G5_URL,
);

$fcm=sendFcm($tokens,$message);