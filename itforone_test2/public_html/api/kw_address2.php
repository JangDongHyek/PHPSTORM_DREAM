<?php
include_once('./_common.php');

$list = array();

$kw = $_GET['kw'];

$page = $_GET['page'];

if(substr($kw, -3) == "역"){
	$kw = str_replace("역", "", $kw);
}

$list['kw'] = $kw;

if(!$page) $page = 1;

/*
if($page==1){
	$sql_search = "";
	$sql = "select count(distinct name) as cnt from subway where name like '{$kw}%'";
	$row = sql_fetch($sql);
	$sub_cnt = $row['cnt'];

	$sql = "SELECT * FROM subway where name like '{$kw}%' group by name order by `id`";
	$result = sql_query($sql);

	while($row = sql_fetch_array($result)){
		$row['is_subway'] = true;
		$list['data'][] = $row;
	}
}
*/

$sql_search = " dong != '' ";
//if($kw) $sql_search .= " and ( `full_gu` like '%{$kw}%' or `full_new` like '%{$kw}%') ";
if($kw) $sql_search .= " and ( `full_gu` like '%{$kw}%') ";
$sql = " SELECT * FROM `new_map_code` WHERE {$sql_search} group by `full_gu` ";
$result=sql_query($sql);
$cnt=sql_num_rows($result);

$total_count = $cnt;

$page_rows = 10;
$list_page_rows = 5;

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$list['list_page_rows']	= $list_page_rows;
$list['total_page']		= $total_page;
$list['page']			=	$page;

/*
페이징 작업 안되있어서 뺌
$sql = "SELECT * FROM `new_map_code` Group by `full_gu` Having $sql_search order by `dong` limit $from_record, $page_rows ";
$result = sql_query($sql);

while($rows = sql_fetch_array($result)){
	$rows['is_gu'] = true;
	$list['data'][] = $rows;
}
*/

$sql = "SELECT * FROM `new_map_code` where $sql_search  group by `full_gu` order by `dong` limit $from_record, $page_rows ";
$result = sql_query($sql);

while($rows = sql_fetch_array($result)){
	$rows['is_new'] = true;
	$list['data'][] = $rows;
}



echo json_encode($list);

?>