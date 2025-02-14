<?php
$sub_id = "date_alarm";
include_once('./_common.php');

$g5['title'] = '데이트설정';
include_once('./_head.php');

$mb = get_member($_SESSION['ss_mb_id']);

include_once($member_skin_path.'/date_alarm.skin.php');

include_once('./_tail.php');
?>
