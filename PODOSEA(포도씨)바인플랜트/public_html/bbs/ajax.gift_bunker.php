<?php
include_once("./_common.php");

/** 벙커 선물하기 (ajax) **/

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

$mb = get_member($member['mb_id']);
$you = get_member($you_id);
$bunker = str_replace(',', '', $bunker);
// 이름 - 상대방에게 보여지는 선물한 사람 아이디or닉네임or회사명
if($mb['mb_level'] == 3) { $giver = $mb['mb_company_name']; }
else { $giver = getNickOrId($mb['mb_id']); }

$msg = bunkerHistory($mb['mb_id'], '차감', $bunker, '벙커 선물', $you['mb_id'], '', '', 'gift');
if(!$msg) {
    echo 'no_bunker';
    exit;
} else {
    $result = bunkerHistory($you['mb_id'], '적립', $bunker, '벙커 선물', $mb['mb_id'], '', '', 'gift');
}

if($result) {
    echo 'success';

    // 벙커 선물 시 선물한 회원에게 푸시
    $push_status = "bunker_gift";
    $push_data = array('url'=>G5_BBS_URL."/mypage_bunker.php", 'ref_idx'=>'', 'ref_table'=>'g5_bunker_history', 'giver'=>$giver, 'bunker'=>$bunker, 'mb_id'=>$you['mb_id']);
    @include_once(G5_BBS_PATH.'/send_push.php');

    exit;
}