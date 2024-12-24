<?php
include_once('./_common.php');

if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

$g5['title'] = '보너스';
include_once('./_head.php');

$wal_action_url = G5_BBS_URL."/mypayment_update.php";

$sql_search = " and mb_id = '{$member['mb_id']}' and po_rel_table = '@bonus' and po_content like '%추천인 보너스%'";

$sql = " select count(*) as cnt from g5_point where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$cnt_record = $page * $rows;

$list_num = $total_count - ($page - 1) * $rows;

$row = sql_fetch(" select sum(po_point) as sum from g5_point where (1=1) {$sql_search} order by po_datetime desc");
$row2 = sql_fetch(" select sum(po_point) as sum from g5_point where (1=1) {$sql_search} order by po_datetime desc limit {$cnt_record}, 99999 ");

$sum1 = $row['sum'];
$sum2 = $row2['sum'];

$sum = $sum1 - $sum2;

$sql = " select * from g5_point where (1=1) {$sql_search} order by po_datetime desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$write_pages = get_paging($rows, $page, $total_page, G5_BBS_URL.'/mybonus.php?'.$qstr.'&amp;page=');

// 2step
$sql_search = " and mb_id = '{$member['mb_id']}' and po_rel_table = '@bonus' and po_content like '%님에게 위캐시 결제%'";

$sql = " select count(*) as cnt from g5_point where (1=1) {$sql_search}";
$row2 = sql_fetch($sql);
$total_count2 = $row2['cnt'];

$total_page2  = ceil($total_count2 / $rows);  // 전체 페이지 계산
if ($page2 < 1) { $page2 = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record2 = ($page2 - 1) * $rows; // 시작 열을 구함
$cnt_record2 = $page2 * $rows;

$list_num2 = $total_count2 - ($page2 - 1) * $rows;

$row = sql_fetch(" select sum(po_point) as sum from g5_point where (1=1) {$sql_search} order by po_datetime desc");
$row2 = sql_fetch(" select sum(po_point) as sum from g5_point where (1=1) {$sql_search} order by po_datetime desc limit {$cnt_record}, 99999 ");

$sum21 = $row['sum'];
$sum22 = $row2['sum'];

$sum2 = $sum21 - $sum22;

$sql2 = " select * from g5_point where (1=1) {$sql_search} order by po_datetime desc limit {$from_record}, {$rows} ";
$result2 = sql_query($sql2);

$write_pages2 = get_paging($rows, $page2, $total_page2, G5_BBS_URL.'/mybonus.php?'.$qstr.'&amp;page=');


include_once($mypage_skin_path.'/mybonus.skin.php');

include_once('./_tail.php');
?>
