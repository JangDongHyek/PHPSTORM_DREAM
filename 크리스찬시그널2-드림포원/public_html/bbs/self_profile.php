<?php
$sub_id = "self_profile";
include_once('./_common.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

if ($member['mb_approval_request'] == 'Y' && $member['mb_approval'] == 'N') { // 프로필 승인 여부 확인
    alert("프로필 심사 중입니다.\\n심사 완료 시 모든 컨텐츠 이용이 가능합니다.");
}
else if($member['mb_approval_request'] == 'N') { // 프로필 미작성 시 회원가입완료 페이지로 이동
    alert("프로필을 작성해주세요.\\n작성 후 심사 완료 시 모든 컨텐츠 이용이 가능합니다.");
}

$is_mypage = "self_profile";
$g5['title'] = '';
include_once('./_head.php');

include_once($member_skin_path.'/self_profile.skin.php');

include_once('./_tail.php');
?>
