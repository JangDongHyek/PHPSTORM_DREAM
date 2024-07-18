<?
include_once('../../common.php');
$print = array();

if(!$is_member){
    $print['code'] = "-1";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if($member['mb_level'] < 10){
    $print['code'] = "-2";
    $print['m'] = $member;
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

$idx = sql_real_escape_string(get_text(trim($_POST['idx'])));
$state = sql_real_escape_string(get_text(trim($_POST['state'])));

$sql = "select * from `g5_order_list` where `idx` = '$idx'";
$row = sql_fetch($sql);

if(empty($row)){
    $print['code'] = "-3";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

$sql = "update `g5_order_list` set `state` = '$state' where `idx` = '$idx'";
sql_query($sql);

$print['code'] = "200";
$print['msg'] = "정상적으로 처리 되었습니다.";
die(json_encode($print));

?>