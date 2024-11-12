<?php
$sub_id = "register_place_form";
include_once('./_common.php');

$g5['title'] = '장소 등록';
include_once('./_head.php');

$mb_id = $_SESSION['ss_mb_id'];
$te_no = $_GET['te_no']; // 20.07.31 수정 화면 접근 방식에 따라 추후 변경 가능성 있음

$register_action_url = G5_BBS_URL.'/register_place_form.php';
include_once($member_skin_path.'/register_place_form.skin.php');

include_once('./_tail.sub.php');
?>
