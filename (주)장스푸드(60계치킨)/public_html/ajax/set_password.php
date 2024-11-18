<?php
include_once('./_common.php');

$mb_id = get_session("pw_mb_id");
$ci = get_session("pw_ci");
unset($_SESSION['pw_mb_id']);
unset($_SESSION['pw_ci']);

if(empty($mb_id)){
    $print['code'] = "-1";
    $print['msg'] = "다시 시도해주세요";
    die(json_encode($print));
}

if(empty($ci)){
    $print['code'] = "-1";
    $print['msg'] = "다시 시도해주세요";
    die(json_encode($print));
}

$pass = sql_real_escape_string(trim($_POST['pass']));

if(empty($pass)){
    $print['code'] = "-1";
    $print['msg'] = "다시 시도해주세요";
    die(json_encode($print));
}

$mb_password = get_encrypt_string($pass);

$sql = "update `g5_member` set `mb_password` = '$mb_password' where `mb_id` = '$mb_id' and `mb_9` = '$ci'";
sql_query($sql);

$print['code'] = "200";
$print['msg'] = "변경되었습니다.";
die(json_encode($print));