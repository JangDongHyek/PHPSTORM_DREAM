<?php
include_once('./_common.php');

if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요", G5_BBS_URL."/login.php");
}

if(!$bo_table){
	alert("올바른 경로가 아닙니다.", G5_URL);
}

$is_mypage = "mypage";
$g5['title'] = '내 정보관리';

include_once('./_head.php');

$sql_search = " and mb_id = '{$member['mb_id']}' ";

$result = sql_query("select ca_code, ca_name, ca_file, ca_filename from g5_category where char_length(ca_code) = '2' order by ca_order asc");
while($row = sql_fetch_array($result)){
	$ca[] = $row;
}

$sql = " select count(*) as cnt from {$write_table} where wr_is_comment = '0' {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_num = $total_count - ($page - 1) * $rows;

$sql = "select * from {$write_table} where wr_is_comment = '0' {$sql_search} order by wr_datetime desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();

for($i=0; $i<$row=sql_fetch_array($result); $i++){
	$list[$i] = $row;
}

$write_pages = get_paging($rows, $page, $total_page, G5_BBS_URL.'/mybusiness.php?bo_table='.$bo_table."&".$qstr.'&amp;page=');

include_once($mypage_skin_path.'/mybusiness.skin.php');

include_once('./_tail.php');
?>
