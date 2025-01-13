<?php
include_once('./_common.php');
include_once('./_head.php');

if($is_admin || $member['mb_level'] > 2){
} else {
	alert('', G5_BBS_URL.'/login.php');
}

$curYear = (int)date('Y');
$curMonth = (int)date('m');
$s_date = $s_date? $s_date : date("Y-m-d", mktime(0, 0, 0, $curMonth , 1, $curYear));
$e_date = $e_date? $e_date : date("Y-m-d", mktime(0, 0, 0, $curMonth+1 , 0, $curYear));

$next_e_date = date("Y-m-d", strtotime("+1 days", strtotime($e_date)));
$sql_common = "po_rel_table <> '@login' and po_datetime >= '{$s_date}' and po_datetime < '{$next_e_date}' and po_type in ('발급', '차감') group by left(po_datetime, 10)";

// 페이징
$sql ="select count(*) as cnt from g5_point where {$sql_common}";
$p_result = sql_query($sql);
$total_count = 0;
while($p_row=sql_fetch_array($p_result)){
	$total_count++;
}
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
	<h2 id="category_title">마일리지 상세이력</h2>
	<div class="info">
		<ul id="list_date">
			<li>조회일 :</li>
			<li><input type="text" value="<?=$s_date?>" id="s_date" readonly></li>
			<li>~</li>
			<li><input type="text" value="<?=$e_date?>" id="e_date" readonly></li>
			<li><button type="button" class="btn btn-primary btn-sm" id="btn_srch">조회</button></li>
		</ul>
	</div>
	<form method="post" name="ca_frm" style="clear:both;">
		<table class="list_tbl">
			<colgroup>
				<col width="20%">
				<col width="30%">
				<col width="30%">
				<col width="20%">
			</colgroup>
			<thead>
			<tr>
				<th class="list_th">날짜</th>
				<th class="list_th">총 발급</th>
				<th class="list_th">총 차감</th>
				<th class="list_th">상세 매장</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if($list_num > 0){
				for($l=0; $l<$list_num; $l++){
					$list_row = sql_fetch_array($list_qry);
					$td_bg = '';
					if($l%2 == 0) $td_bg = 'td_bg';

					$list_date = substr($list_row[po_datetime], 0, 10);
					
					$next_list_date = date("Y-m-d", strtotime("+1 days", strtotime($list_date)));
					$sql = "select * from g5_point where po_rel_table <> '@login' and po_datetime >= '{$list_date}' and po_datetime < '{$next_list_date}' and po_type IN ('발급', '차감')";
					$result2 = sql_query($sql);
					$total_issue = 0;	//발급
					$total_deduct = 0;	//차감
					while($row2 = sql_fetch_array($result2)){
						if(strpos($row2[po_point], "-") !== false)
							$total_deduct += $row2[po_point];
						else 
							$total_issue += $row2[po_point];
					}

			?>
			<tr>
				<td class="list_td talgin_c <?php echo $td_bg ?>"><?=$list_date?></td>
				<td class="list_td talgin_r <?php echo $td_bg ?>"><?=number_format($total_issue)?>점</td>
				<td class="list_td talgin_r <?php echo $td_bg ?>"><?=number_format(abs($total_deduct))?>점</td>
				<td class="list_td talgin_c <?php echo $td_bg ?>"><a href="./pstore_total.detail.php?s_date=<?=$list_date?>">상세 보기</a></td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr><td colspan="4" class="list_td talgin_c">마일리지 내역이 없습니다.</td></tr>
			<?
			}
			?>
			</tbody>
		</table>
	</form>

	<div id="list_paging">
		<?php echo get_paging(10, $page, $total_page, '?s_date='.$s_date.'&amp;e_date='.$e_date); ?>
		<? if($member['mb_level'] > 2) { ?>
		<button type="button" class="btn btn-primary btn-sm" id="btn_down">엑셀다운</button>
		<? } ?>
	</div>
</div>
<!-- 본문 끝 -->
<!-- 자바스크립트 시작 -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
var day_arr = ['일', '월', '화', '수', '목', '금', '토'];

$(function(){
	$("#s_date, #e_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr }); 

	$("#btn_srch").on("click", function(){
		var params = "s_date=" + $("#s_date").val() + "&e_date=" + $("#e_date").val();
		location.href = "?" + params;
	});

	$("#btn_down").on("click", function(){
		var params = "s_date=" + $("#s_date").val() + "&e_date=" + $("#e_date").val();
		var curUrl = window.location.pathname;
		curUrl = curUrl.replace("list.php", "list.excel.php");
		window.open(curUrl + "?" + params, "_blank");
	});
});

</script>
<!-- 자바스크립트 끝 -->

<?
include_once('./_tail.php');
?>
