<?php
include_once("./_common.php");

/** 레슨 예약 삭제 (회원/프로 같은 ajax 사용) **/

$mb_no = $member['mb_no'];
$reser = sql_fetch(" select * from g5_lesson_reser where idx = {$_POST['idx']}; "); // 예약정보

// 21.12.07 프로가 이미 예약을 승인했을 경우 삭제 불가, 프로는 삭제 가능
if($member['mb_level'] == 2) {
    if($reser['reser_state'] == '예약완료') {
        die('fail');
    }
}

$sql = " delete from g5_lesson_reser where idx = {$_POST['idx']} ";
sql_query($sql);

// 21.02.05 푸시
$mb = get_member_no($mb_no);
$pro_mb_id = sql_fetch(" select mb_id from g5_member where mb_no = {$mb['pro_mb_no']} ")['mb_id'];

$sql="select * from g5_fcm where mb_id = '{$pro_mb_id}'"; // 예약 삭제 시 담당 프로에게 알림 (프로 id 필요)
$fRow=sql_fetch($sql);
$tokens=array($fRow[token]);
$message=array(
    "subject"=>"예약취소",
    "message"=>"{$mb['mb_name']} 회원님의 {$reser['reser_date']}/{$reser['reser_time']} 예약이 취소되었습니다.",
    "goUrl"=>"",
);
$fcm=sendFcm($tokens, $message);

die('success');
?>