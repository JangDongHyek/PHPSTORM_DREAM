<?php
include_once('./_common.php');

if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}

$is_asset = "asset";
$g5['title'] = '에셋';


$sql_search = " and mb_id = '{$member['mb_id']}' ";

$result = sql_query($sql);
$list = array();

$sql = "select b.* from g5_write_asset where a.wr_is_comment = '1' and mb_id = '{$member['mb_id']}' order by wr_datetime desc";
//$sql = "select b.* from g5_write_asset as a left join g5_write_asset as b on a.wr_id = b.wr_parent where a.wr_is_comment = '' and a.mb_id = '{$member['mb_id']}' and b.wr_1 = '' order by b.wr_datetime desc";
$sql = " select * from g5_write_asset where (wr_is_comment = '1' and mb_id = '{$member['mb_id']}' and wr_1 = '') or wr_id in (select a.wr_id from g5_write_asset as a left join g5_write_asset as b on a.wr_parent = b.wr_id where a.wr_is_comment = '1' and b.mb_id = '{$member['mb_id']}' and a.wr_1 = '') order by wr_datetime desc ";

$result = sql_query($sql);

for($i=0; $i<$row=sql_fetch_array($result); $i++){
	$list[$i] = $row;
}

$sql = " select count(*) as cnt from g5_asset where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = " select * from g5_asset where (1=1) {$sql_search} order by po_datetime desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$write_pages = get_paging($rows, $page, $total_page, G5_BBS_URL.'/myasset.php?'.$qstr.'&amp;page=');

include_once('./_head.php');

include_once($mypage_skin_path.'/myasset.skin.php');

include_once('./_tail.php');
?>
