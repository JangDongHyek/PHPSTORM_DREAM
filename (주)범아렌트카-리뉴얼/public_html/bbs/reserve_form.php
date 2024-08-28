<?php
include_once('./_common.php');

//if ($is_guest)
//    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

$title['sm_name'] = '렌터카 예약하기';
$g5['title'] = '렌터카 예약하기';
include_once('./_head.php');

$url = clean_xss_tags($_GET['url']);

// url 체크
check_url_host($url);

$url = get_text($url);

include_once($member_skin_path.'/reserve_form.skin.php');

include_once('./_tail.php');
?>
