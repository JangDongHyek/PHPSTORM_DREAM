<?php
include_once('./_common.php');

if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

$g5['title'] = '전자지갑';
include_once('./_head.php');


include_once($mypage_skin_path.'/mymovie_point.skin.php');

include_once('./_tail.php');
?>
