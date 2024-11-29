<?php
include_once('./_common.php');

$name = str_replace(' ', '', $_POST['member']);

$sql_add = '';
if(!empty($_POST['option'])) {
    $sql_add = ' and (lesson_idx is not null and lesson_idx != 0) ';
}

if(empty($_POST['mode'])) { // 레슨예약 시 검색
    $sql_search = " and mb_state not in ('one_point_lesson','no_register','no_long_register') ";
}
else { // 재등록 시 검색 (mode = 're')
    $sql_search = " and mb_state not in ('one_point_lesson') ";
}

// 프로에게 배정된 담당 회원만 조회 - 수정 시 팀장, 프로 둘 다 확인 필요함 -- 원포인트 회원은 재등록 불가 처리 (아이디가 없기 때문)
if($member['mb_category'] == '프로') {
    $sql = " select * from {$g5['member_table']} 
             where mb_name like '%{$name}%' and pro_mb_no = {$member['mb_no']} and center_code = '{$member['center_code']}' and use_yn = 'Y'
             {$sql_search} {$sql_add} order by mb_reg_date desc ";
    $result = sql_query($sql);
}
else {
    $sql = " select * from {$g5['member_table']} 
             where mb_name like '%{$name}%' and center_code = '{$member['center_code']}' and mb_category = '회원' and use_yn = 'Y'
             {$sql_search} {$sql_add} order by mb_reg_date desc ";
    $result = sql_query($sql);
}

$array = array();
for($i=0; $row = sql_fetch_array($result); $i++) {
    array_push($array, $row);
}

die(json_encode($array));
?>