<?php
$sub_id = "get_out";
include_once('./_common.php');

$g5['title'] = '탈퇴하기';
include_once('./_head.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php?url='.G5_BBS_URL.'/get_out.php');
}

include_once($member_skin_path.'/get_out.skin.php');

include_once('./_tail.php');
?>
