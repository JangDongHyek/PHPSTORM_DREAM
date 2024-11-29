<?php
include_once('./_common.php');

/** 프로 - 레슨예약 회원 선택 시 동작, 예약 가능한 레슨 회차가 남아있는지 확인 **/
// adm/lesson_reser_check.php -- 현재 파일 수정 시 왼쪽 파일 같이 확인

$mb = get_member_no($mb_no); // 회원 정보

$lesson_info = sql_fetch(" select * from g5_lesson as le left join g5_member as mb on le.idx = mb.lesson_idx where mb.mb_no = '{$mb_no}'; "); // 선택 회원의 레슨정보
$diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}'; ")['count']; // 선택 회원의 레슨일지 수

$remain_count = 0; // 레슨 잔여회차 (사용 가능 회차)
if(empty($diary_count)) {
    $remain_count = explode('회', explode(',', $lesson_info['lesson_count'])[0])[0];
} else {
    $diary_info = sql_fetch(" select *, min(lesson_remain_count*1) as lesson_remain_count from g5_lesson_diary where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}'; "); // 선택 회원의 레슨일지 정보
    $remain_count =  $diary_info['lesson_remain_count'];
}

// * 현재 레슨의 이용 가능 횟수보다 예약하려는 횟수가 많을 경우 알림창 *
// 현재 레슨의 전체 회차 (최대 예약 가능한 횟수를 구함)
$valid_count = explode('회', explode(',', $lesson_info['lesson_count'])[0])[0];

// 레슨시간 (30분 초과 시 레슨을 2개씩 예약할 수 있으므로 최대 예약 가능한 횟수를 *2로 해야함)
$time = substr(explode('분', $lesson_info['lesson_time'])[0],-2);
if($time > 30) {
    $valid_count = $valid_count*2;
}

// 현재 레슨의 예약 수 (레슨일지 상관없이 현재 레슨의 회차 만큼 예약되어있는지 확인)
$reser_count = sql_fetch(" select count(*) as count from g5_lesson_reser where mb_no = '{$mb_no}' and history_idx = '{$mb['history_idx']}' and reser_state != '예약취소'; ")['count'];
if(($valid_count*1 - $reser_count*1) <= 0) {
    // 21.12.06 업체 측에서 횟수 제한 없이 예약 가능하게 되돌려달라고 함 (수정접수내역 - [레슨 횟수 오류에 대한 문의][21.12.03])
    //die('fail');
}

if($remain_count == 0) {
    echo('over');
    exit;
}
else {
    echo '1';
    exit;
}