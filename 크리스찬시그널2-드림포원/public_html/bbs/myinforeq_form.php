<?php
$sub_id = "myinforeq_form";
include_once('./_common.php');

$is_mypage = "myinforeq_form";
$g5['title'] = '내정보 열람 신청함';
include_once('./_head.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

$sql = "select * from new_info_question where want_mb_no = '{$member["mb_no"]}' order by iq_idx desc ";
$result = sql_query($sql);


include_once($member_skin_path.'/myinforeq_form.skin.php');

include_once('./_tail.php');
?>
