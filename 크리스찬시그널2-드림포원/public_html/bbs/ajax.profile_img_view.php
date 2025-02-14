<?php
include_once('./_common.php');

$mb_no = $_POST['mb_no'];

// 23.01.19 사진보기 시 10만나 차감 --> 23.04.04 30만나 차감 -> 23.10.24 $manna_arr['photo']로 빼줌 변수 wc
$mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 프로필사진 회원정보
$mb_id = $member['mb_id'];
$manna = $manna_arr['photo'];

$acc_point = $member['cw_point'] - $manna;
if($mode == 'add_profile') { // 21.09.17 추가항목 조회 시 10만나 차감
    $point_content = $mb['mb_nick'] . ' 추가 정보 조회';
}
else {
    $point_content = $mb['mb_nick'] . ' 프로필 사진 조회';
}

// 포인트 없을 시 조회 불가
if($member['cw_point'] < $manna) {
    die('fail');
}

// 회원 포인트 이력
$sql = " insert into g5_member_point set mb_id = '{$mb_id}', point_category = '차감', point = $manna, acc_point = {$acc_point}, point_content = '{$point_content}', wr_datetime = '".G5_TIME_YMDHIS."', rel_mb_id = '{$mb['mb_id']}', profile_name='프로필사진' ";
sql_query($sql);

// 회원 포인트 업데이트
$sql = " update g5_member set cw_point = cw_point - $manna where mb_id = '{$mb_id}' ";
$result = sql_query($sql);

//장바구니 회원에 추가
$sql = " select count(*) as count from g5_member_cart where mb_no = '{$member['mb_no']}' and cart_mb_no = '{$mb["mb_no"]}' ";
$count = sql_fetch($sql)['count'];

if($count == 0) {

    $sql = "insert into g5_member_cart set mb_no = '{$member["mb_no"]}',cart_mb_no = '{$mb["mb_no"]}', wr_datetime= '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

}

if($result) { die('success'); }
?>