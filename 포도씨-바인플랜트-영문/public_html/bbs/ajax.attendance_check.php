<?php
include_once('./_common.php');
/**
 * 벙커링스테이션 - 출석체크 - 완료 시 100 벙커 지급
 */

$temp = explode('/', $_REQUEST['date']);
$attendance_date = $temp[2].'-'.sprintf('%02d', $temp[0]).'-'.sprintf('%02d', $temp[1]);

// 출석 체크 이미 했는지 체크
$cnt = sql_fetch(" select count(*) as cnt from g5_bunker_history where mb_id = '{$member['mb_id']}' and contents like 'Attendance Check%' and wr_datetime like '{$attendance_date}%' ")['cnt'];
if($cnt > 0) {
    die('fail');
}

if($mode == 'update') { // 출석체크 시
    // 12시 넘어서 날짜 바뀔 경우 다시 체크
    if ($attendance_date != date('Y-m-d')) {
        alert('please try again');
    }

    $result = bunkerHistory($member['mb_id'], '적립', 100, 'Attendance Check ('.$attendance_date.')');
}

die('success');