<?php
$sub_id = "my_inquiry";
include_once('./_common.php');

$g5['title'] = '재능 문의 글';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}

if ($member['mb_division'] == 1) {
    $division = 'co';
}else{
    $division = 'ta';
}
$sql = "select count(comment_idx) cnt from new_comment co left join new_talent ta on co.wr_cp_idx = ta.ta_idx where {$division}.mb_id = '{$member['mb_id']}' and wr_parent = 0 and wr_table = 'talent' ";
$cnt = sql_fetch($sql)['cnt'];
$total_count = $cnt;

$rows = 6;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select *,co.wr_datetime co_wr_datetime, co.mb_id co_mb_id  from new_comment co left join new_talent ta on ta.ta_idx = co.wr_cp_idx where {$division}.mb_id = '{$member['mb_id']}' and wr_parent = '0' and wr_table = 'talent' limit {$from_record}, {$rows} ";
$result = sql_query($sql);

include_once($member_skin_path.'/my_inquiry.skin.php');

include_once('./_tail.php');
?>