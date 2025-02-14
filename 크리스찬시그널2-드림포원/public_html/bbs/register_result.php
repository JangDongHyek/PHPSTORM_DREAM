<?php
include_once('./_common.php');

if($_SESSION['ss_mb_id'] == 'admin' || $_SESSION['ss_mb_id'] == 'lets080') {
    goto_url(G5_ADMIN_URL);
}

if (isset($_SESSION['ss_mb_reg']))
    $mb = get_member($_SESSION['ss_mb_reg']);

if (isset($_SESSION['ss_mb_id']))
    $mb = get_member($_SESSION['ss_mb_id']);

// 회원정보가 없다면 초기 페이지로 이동
//if (!$mb['mb_id'])
//    goto_url(G5_URL);

$g5['title'] = '회원가입이 완료되었습니다.';
include_once('./_head.php');
include_once($member_skin_path.'/register_result.skin.php');
include_once('./_tail.php');
?>