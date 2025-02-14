<?php
$sub_id = "user_level";
include_once('./_common.php');

$g5['title'] = '회원권 구매';
include_once('./_head.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$member['mb_no'];

include_once($member_skin_path.'/user_level.skin.php');

include_once('./_tail.php');
?>
