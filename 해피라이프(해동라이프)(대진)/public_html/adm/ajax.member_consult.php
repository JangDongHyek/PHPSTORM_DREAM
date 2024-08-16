<?
/*******************************************
회원상세 - 상담내역 호출
*******************************************/
include_once('./_common.php');

$sql_common = " FROM g5_consult WHERE mb_id = '{$mb_id}' ";

// 페이징
$sql = " SELECT COUNT(*) AS cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 10;	//$config['cf_page_rows'];				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)

$list = array();

if ($total_count > 0) {
	// 리스트
	$result = sql_query(" SELECT * {$sql_common} ORDER BY cs_date DESC {$sql_limit} ");
	$result_cnt = sql_num_rows($result);

	for ($i = 0; $i < $result_cnt; $i++) {
		$list[$i] = sql_fetch_array($result);
	}
}

?>
<table>
<colgroup>
	<col width="5%">
	<col width="15%">
	<col width="*">
	<col width="15%">
	<col width="12%">
</colgroup>
<tbody>
<tr>
	<th scope="row">No.</th>
	<th scope="row">상담일자</th>
	<th scope="row">상담내용</th>
	<th scope="row">작성자</th>
	<th scope="row">관리</th>
</tr>
<? if (count($list) == 0) { ?>
<tr>
	<td colspan="5">상담내역이 없습니다.</td>
</tr>
<? } else { 
	foreach ($list as $key=>$val) {
?>
<tr>
	<td><?=$list_no?></td>
	<td><?=$val['cs_date']?></td>
	<td><div style="line-height: 1.5"><?=nl2br($val['cs_memo'])?></div></td>
	<td><?=$val['cs_name']?></td>
	<td style="padding: 0;">
		<button type="button" class="btn btn_02" onclick="getFrmLoad('<?=$val['idx']?>')">수정</button>
		<button type="button" class="btn btn_02" onclick="frmDelete('<?=$val['idx']?>')">삭제</button>
	</td>
</tr>
<? 
	$list_no--;

	} // end foreach
}
?>
</tbody>
</table>

<? if ($total_page > 1) { ?>
<nav class="pg_wrap">
	<span class="pg">
		<?
		// list_rows : 한페이지 개수
		// list_page_rows : 한블럭 페이지 개수
		$page_num = ceil($total_count / $list_rows);	// 총페이지
		$block_num = ceil($page_num / $list_page_rows);	// 총블럭
		$now_block = ceil($page / $list_page_rows);

		$s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
		if ($s_page <= 1) $s_page = 1;
		$e_page = ($now_block * $list_page_rows);
		if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록
		?>
		<? if ($now_block > 1) { ?>
		<a href="javascript:void(0)" onclick="getInnerList(1, <?=$s_page-1?>)" class="pg_page">이전</a>
		<? } ?>
		
		<? for ($p=$s_page; $p<=$e_page; $p++) { ?>
		<a href="javascript:void(0)" <?if ($page != $p) {?>onclick="getInnerList(1, <?=$p?>)"<?}?> class="<? echo ($page == $p)? "pg_current" : "pg_page"; ?>"><?=$p?></a>
		<? } ?>

		<? if ($block_num > 1 && $block_num != $now_block) { ?>
		<a href="javascript:void(0)" onclick="getInnerList(1, <?=$e_page+1?>)" class="pg_page">다음</a>
		<? } ?>
	</span>
</nav>
<? } ?>