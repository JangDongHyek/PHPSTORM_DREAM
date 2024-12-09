<?php
include_once ("../common.php");

$stx = trim($_GET['stx']);
$page = (int)$_GET['page'];

// 공통쿼리
$sql_common = "FROM g5_bbs_basic WHERE del_yn = 'N' AND tbl_name = 'column'";
if ($stx != "") $sql_common .= " AND (subject LIKE '%{$stx}%' OR content LIKE '%{$stx}%')";

// 페이징
$sql = " SELECT COUNT(*) AS cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 20;                         				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);	// 전체페이지
// if ($page > $total_page) $page = $total_page;

$last_page = ($page == $total_page)? "Y" : "N"; // 마지막페이지?
if ($page > $total_page) die();

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

// 롱런칼럼 목록
$sql = "SELECT * {$sql_common} ORDER BY idx DESC {$sql_limit}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

if ($result_cnt == 0) {
?>
<ul data-last-page="Y">
    <li><a href="javascript:void(0)"><p class="title">등록된 칼럼이 없습니다.</p></a></li>
</ul>
<? } else { ?>
    <ul data-last-page="<?=$last_page?>">
        <? while($row = sql_fetch_array($result)) { ?>
            <li>
                <!--<a href="./column_view.php?idx=<?/*=$row['idx']*/?>">-->
                <a href="#column<?=$row['idx']?>">
                    <p class="title"><strong><?=$row['category']?></strong><?=$row['subject']?></p>
                    <p class="date"><?=date("Y-m-d", strtotime($row['regdate']))?></p>
                </a>
            </li>
        <? } ?>
    </ul>
<? } ?>