<?php
$sub_id = "my_profile06";
include_once('./_common.php');

if(!empty($_SESSION['ss_mb_id'])) {
    $mb_id = $_SESSION['ss_mb_id'];
} else {
    $mb_id = $_GET['mb_id'];
}

$mb = get_member($mb_id);



$is_mypage = "my_profile06";
$g5['title'] = '기본정보';
include_once('./_head.php');

include_once($member_skin_path.'/my_profile06.skin.php');

include_once('./_tail.php');
?>
