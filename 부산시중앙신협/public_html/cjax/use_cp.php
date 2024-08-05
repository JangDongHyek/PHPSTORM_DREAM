<?
include_once("./_common.php");

if(!$is_member){
    $print['code'] = "-1";
    $print['msg'] = "로그인 후 이용해주세요";
    die(json_encode($print));
}

if(empty($member['mb_id'])){
    $print['code'] = "-1";
    $print['msg'] = "로그인 후 이용해주세요";
    die(json_encode($print));
}

$sql = "insert into `v5_coupon_log` set `cp_id` = '$cp_id', `mb_id` = '$member[mb_id]', `staff_code` = '$staff_code'";
sql_query($sql);

$print['code'] = "200";
$print['msg'] = "쿠폰을 사용하였습니다.";
die(json_encode($print));

?>