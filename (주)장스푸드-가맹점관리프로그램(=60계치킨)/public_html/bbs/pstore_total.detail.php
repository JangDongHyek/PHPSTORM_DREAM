<?php
include_once('./_common.php');
include_once('./_head.php');

$e_date = date("Y-m-d", strtotime("+1 days", strtotime($s_date)));
$sql_common = "po_rel_table <> '@login' and po_datetime >= '{$s_date}' and po_datetime < '{$e_date}' and po_type in ('발급', '차감')";

// 페이징
$sql ="select count(*) as cnt from g5_point where {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt']; 
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 리스트
$list_sql="select * from g5_point where {$sql_common} order by po_datetime desc limit {$from_record}, {$rows} ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);

?>
<link rel="stylesheet" href="<?=G5_THEME_URL?>/skin/content/myorder/style.css?ver=<?=strtotime(date('Y-m-d H:i:s'))?>">

<!-- 본문 시작 -->
<div id="category_container">
	<h2 id="category_title">포인트 상세이력</h2>
	<div class="info">
		<ul id="list_date">
			<li>조회일 :</li>
			</li><?=$s_date?></li>
		</ul>
	</div>
	<form method="post" name="ca_frm" style="clear:both;">
		<table class="list_tbl">
			<colgroup>
				<col width="20%">
				<col width="20%">
				<col width="30%">
				<col width="30%">
			</colgroup>
			<thead>
			<tr>
				<th class="list_th">날짜</th>
				<th class="list_th">매장명</th>
				<th class="list_th">발급</th>
				<th class="list_th">차감</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if($list_num > 0){
				for($l=0; $l<$list_num; $l++){
					$list_row = sql_fetch_array($list_qry);
					$td_bg = '';
					if($l%2 == 0) $td_bg = 'td_bg';

					$mb = get_member($list_row[mb_id]);
					$mb_point = intval($list_row[po_point]);
			?>
			<tr>
				<td class="list_td talgin_c <?php echo $td_bg ?>"><?=$s_date?></td>
				<td class="list_td talgin_c <?php echo $td_bg ?>"><?=$mb[mb_2]?></td>
				<td class="list_td talgin_r <?php echo $td_bg ?>"><? if($mb_point > 0) echo number_format($mb_point)."점";?></td>
				<td class="list_td talgin_r <?php echo $td_bg ?>"><? if($mb_point < 0) echo number_format(abs($mb_point))."점";?></td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr><td colspan="4" class="list_td talgin_c">포인트 내역이 없습니다.</td></tr>
			<?
			}
			?>
			</tbody>
		</table>
	</form>

	<div id="list_paging">
		<?php echo get_paging(10, $page, $total_page, '?s_date='.$s_date); ?>
		<? if($member['mb_level'] > 2) { ?>
		<button type="button" class="btn btn-primary btn-sm" id="btn_down">엑셀다운</button>
		<? } ?>
	</div>
</div>
<!-- 본문 끝 -->
<!-- 자바스크립트 시작 -->
<script>
$(function(){
	$("#btn_down").on("click", function(){
		var params = "s_date=<?=$s_date?>"; 
		var curUrl = window.location.pathname;
		curUrl = curUrl.replace("detail.php", "detail.excel.php");
		window.open(curUrl + "?" + params, "_blank");
	});
});

</script>
<!-- 자바스크립트 끝 -->

<?
include_once('./_tail.php');
?>
