<?
// 전체검색어 
if ($_GET['s_query'] != "") {
	$sql_search .= " AND (wr_subject LIKE '%{$s_query}%' OR wr_content LIKE '%{$s_query}%') ";
}
?>