<?php
include_once("./_common.php");

/** 프로 - 레슨예약 레슨예약자 명단 페이징 (ajax) ==> 달력 날짜 선택 시 레슨예약자 명단 조회 **/


$reser_date = $_POST['reser_date'];

$sql_search = " and re.reser_date = '{$reser_date}' ";

$sql = " select count(*) as cnt 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.pro_mb_no = '{$member['mb_no']}' {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 40;
//if($ip == '183.103.22.103') { $rows = 10; }
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . "&start_date=" . $reser_date . "&end_date=" . $reser_date . '&amp;page=');
?>