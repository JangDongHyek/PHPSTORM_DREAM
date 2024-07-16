<?php
include_once("./_common.php");

/** 벙커 선물하기 (ajax) **/

$mb = get_member($member['mb_id']);
$you = get_member($you_id);
$bunker = str_replace(',', '', $bunker);

$msg = bunkerHistory($mb['mb_id'], '차감', $bunker, 'bunker gift', $you['mb_id'], '', '', 'gift');
if(!$msg) {
    echo 'no_bunker';
    exit;
} else {
    $result = bunkerHistory($you['mb_id'], '적립', $bunker, 'bunker gift', $mb['mb_id'], '', '', 'gift');
}

if($result) {
    echo 'success';
    exit;
}