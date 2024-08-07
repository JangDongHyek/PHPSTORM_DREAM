<?php
include_once('./_common.php');

if ($is_guest)
    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

$g5['title'] = '환전';
include_once('./_head.php');

$wal_action_url = G5_BBS_URL."/mychange_update.php";

$sql_search = " and mb_id = '{$member['mb_id']}' ";

$sql = "select * from g5_change where ch_status = '신청' {$sql_search} order by po_datetime";
$result = sql_query($sql);
$list = array();

for($i=0; $i<$row=sql_fetch_array($result); $i++){
	$list[$i] = $row;
}

//$sql_search .= " and po_content like '%환전%'";

$sql = " select count(*) as cnt from g5_change where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = " select * from g5_change where (1=1) {$sql_search} order by po_datetime desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$write_pages = get_paging($rows, $page, $total_page, G5_BBS_URL.'/mychange.php?'.$qstr.'&amp;page=');

include_once($mypage_skin_path.'/mychange.skin.php');

include_once('./_tail.php');
?>
