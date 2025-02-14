<?php
$sub_id = "alarm";
include_once('./_common.php');

$g5['title'] = '알림설정';
include_once('./_head.php');

$mb = get_member($_SESSION['ss_mb_id']);

include_once($member_skin_path.'/alarm.skin.php');

include_once('./_tail.php');
?>
