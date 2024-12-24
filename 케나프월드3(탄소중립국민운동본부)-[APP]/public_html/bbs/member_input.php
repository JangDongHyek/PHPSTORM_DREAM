<?php
include_once('./_common.php');

$g5['title'] = '로그인';
include_once('./_head.sub.php');


$login_url        = login_url($url);
$login_action_url = G5_HTTPS_BBS_URL."/member_input.skin.php";

// 로그인 스킨이 없는 경우 관리자 페이지 접속이 안되는 것을 막기 위하여 기본 스킨으로 대체
$login_file = $member_skin_path.'/member_input.skin.php';
if (!file_exists($login_file))
    $member_skin_path   = G5_SKIN_PATH.'/member/basic';

include_once($member_skin_path.'/member_input.skin.php');

include_once('./_tail.sub.php');
?>
