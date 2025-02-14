<?php
include_once('./_common.php');

$mb = get_member($reg_mb_id);
$now_point = $mb['cw_point']; // 현재회원포인트
if(empty($now_point)) { $now_point = 0; }

$point = str_replace(',','',$input_point); // 지급 or 차감할 포인트
$sql_update = '';
if($input_category == '지급') {
    $acc_point = $now_point + $point;
    $sql_update .= ', acc_cw_point = acc_cw_point + ' . $point;
}
else if($input_category == '차감') {
    if($now_point < $point) { // 현재 포인트가 차감할 포인트보다 작으면
        die('fail');
    }
    $acc_point = $now_point - $point;
}

// 포인트 관리 INSERT
$sql = " insert into g5_member_point set 
         mb_id = '{$reg_mb_id}', 
         point_category = '{$input_category}', 
         point = {$point}, 
         acc_point = {$acc_point}, 
         point_content = '{$input_content}',
         rel_mb_id = 'admin',
         wr_datetime = '".G5_TIME_YMDHIS."' ";
sql_query($sql);

// 회원 포인트 UPDATE
$sql = " update g5_member set cw_point = {$acc_point} {$sql_update} where mb_id = '{$reg_mb_id}' ";
$result = sql_query($sql);

if($result) {
    die('success');
}
?>