<?php
include_once('./_common.php');
$file=date("YmdHis");
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename={$file}.xls");
header( "Content-Description: PHP4 Generated Data" );
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");

$sql = " select * from {$write_table} where wr_is_comment = 0";
$result = sql_query($sql);

$k = 0;
$i = 0;
while ($row = sql_fetch_array($result))
{
	// 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
	if ($sca || $stx)
		$row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

	$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
	if (strstr($sfl, 'subject')) {
		$list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
	}
	$list[$i]['is_notice'] = false;
	$list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
	$list[$i]['num'] = $list_num - $k;

	$i++;
	$k++;
}
include_once($board_skin_path.'/excel.list.skin.php');
?>