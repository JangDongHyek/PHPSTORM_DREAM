<?php
include_once("./_common.php");

/** 마이페이지 - 벙커관리 - 벙커 트레이드로 등록 시 자격 확인 (3등 항해사 & 2만 벙커 보유) **/

$mb_grade = $member['mb_grade'];
if($mb_grade == '실습항해사') {
    echo 'fail1';exit;
}
if($member['mb_bunker'] < 20000) {
    echo 'fail2';exit;
}
if($mb_grade != '실습항해사' && $member['mb_bunker'] >= 20000) {
    echo 'success';exit;
}