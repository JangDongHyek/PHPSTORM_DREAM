<?php
include_once('./_common.php');

/** 관리자페이지-벙커관리-벙커 적립/차감 이벤트 (ajax) **/

$mb = get_member($reg_mb_id); // 회원 정보
$input_bunker = str_replace(',', '', $input_bunker); // 콤마 제거

$mb_bunker = '';
$etc = '';
if($input_gubun == '보너스') {
    $mb_bunker = $mb['mb_bunker_bonus'];
    $etc = 'bonus';
} else { // 일반
    $mb_bunker = $mb['mb_bunker'];
}

if($input_mode == '차감') {
    if($mb_bunker < $input_bunker) { // 회원이 보유한 벙커보다 차감할 벙커가 더 많으면
        die('fail');
    }
}

$result = bunkerHistory($mb['mb_id'], $input_mode, $input_bunker, $input_content, '', '', '', $etc, '');

if($result) {
    die('success');
}
?>