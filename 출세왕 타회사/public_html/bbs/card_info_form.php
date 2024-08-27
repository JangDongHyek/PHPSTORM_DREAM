<?php
include_once('./_common.php');

$g5['title'] = '카드등록';
include_once('./_head.php');

if (!$is_member){
    alert("정상적인 방법으로 접근하여주세요.",G5_URL);
}

$sql = "SELECT * FROM g5_autoPay WHERE userid = '{$member['mb_id']}' order by idx desc limit 1";
$my_card = sql_fetch($sql);

include_once($member_skin_path.'/card_info_form.php');

include_once('./_tail.php');
?>

