<?php
include_once('./_common.php');
include_once('./_head.php');
if($ss[sc]){
	$where = " and mb_2 like '%$ss[sc]%'";
}
$mb=get_member($mb_id);

$curYear = (int)date('Y');
$curMonth = (int)date('m');
$s_date = $s_date? $s_date : date("Y-m", mktime(0, 0, 0, $curMonth+1 , 0, $curYear));
$e_date = $s_date? $s_date : date("Y-m-d", mktime(0, 0, 0, $curMonth+1 , 0, $curYear));
$start_s_date = date("Y-m-d", strtotime("+0 days", strtotime($s_date)));
$next_e_date = date("Y-m-d", strtotime("+1 month", strtotime($e_date)));
$e_date = $next_e_date;
$sql_common = "and po_datetime >= DATE('{$start_s_date}') and po_datetime < DATE('{$next_e_date}')";

// 페이징
$sql ="select count(*) as cnt from g5_point where mb_id='$mb_id' and po_rel_table <> '@login'  {$sql_common}";
$row = sql_fetch($sql);

$total_count = $row['cnt'];
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 리스트
$list_sql="select * from g5_point where mb_id='$mb_id' and po_rel_table <> '@login' {$sql_common} order by po_id desc limit {$from_record}, {$rows} ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);

// 2개월뒤의 꺼면서 만료안된거 얼마인지 체크
$point_e_date = date("Y-m-d", mktime(0, 0, 0, $curMonth-2 , 0, $curYear));
$sql ="select sum(po_point) as point_sum from g5_point where mb_id='$mb_id' and po_datetime <= DATE('{$point_e_date}') and po_expired = 0 ";
$result = sql_fetch($sql);
$point_expired_yet = $result['point_sum'];

?>
<link rel="stylesheet" href="<?=G5_THEME_URL?>/skin/content/myorder/style.css?ver=<?=strtotime(date('Y-m-d H:i:s'))?>">
<style>
    .ui-datepicker table{
        display: none;
    }
    /*
    table.ui-datepicker-calendar { display:none; }
     */
</style>
<!-- 본문 시작 -->
<div id="category_container">
	<h2 id="category_title">마일리지<?echo ($member['mb_level'] == 2)? " 이력" : " 발급/차감"; ?></h2>
	<div class="info">
		<div>
            지점명 : <strong><?=$mb[mb_2]?></strong>
            / 보유 마일리지 : <strong><?=number_format($mb['mb_point'])?></strong>점
            / <span style="color:red;">소멸 예정 포인트 : <strong><?=number_format($point_expired_yet)?></strong>점</span>
        </div>
		<!--(<span style="color:blue">로그인을 한 마일리지는 목록에서 보이지 않습니다.)</span>-->
		<ul id="list_date">
			<li>조회일 :</li>
			<li><input type="text" value="<?=$s_date?>" id="s_date" readonly ></li>

			<li style="display: none">~</li>
			<li style="display: none"><input type="text" value="<?=$e_date?>" id="e_date" readonly></li>

			<li><button type="button" class="btn btn-primary btn-sm" id="btn_srch">조회</button></li>
		</ul>
	</div>
	<form method="post" name="ca_frm" style="clear:both;">
	<input type="hidden" name="mode" id="mode" value="">
		<table class="list_tbl">
		<colgroup>
			<col width="20%">
			<col width="10%">
			<col width="30%">
			<col width="20%">
            <col width="20%">
		</colgroup>
		<thead>
		<tr>
			<th class="list_th">관리자</th>
			<th class="list_th">날짜</th>
			<th class="list_th">발급</th>
			<th class="list_th">차감</th>
            <th class="list_th">비고</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if($list_num > 0){
			//$list_num2 = $total_count - ($page - 1) * $rows;
            $total_point_plus = 0;
            $total_point_minus = 0;

			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);
				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';
				$admin_id=explode("-",$list_row[po_rel_action]);
				$sql="select mb_name from g5_member where mb_id='$admin_id[0]'";
				$result2=sql_query($sql);
				$row2=sql_fetch_array($result2);

				$mb_point = intval($list_row[po_point]);
		?>
		<tr>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $row2[mb_name] ?></td>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $list_row[po_datetime]?></td>
			<td class="list_td <?php echo $td_bg ?>">
				<? if($mb_point >= 0) {
                    $total_point_plus =+ $mb_point;
				?>
				<div><?=$list_row[po_content]?></div>
				<div style="color:blue;"><?=number_format(abs($mb_point))?>점 적립</div>
				<? } ?>
			</td>
			<td class="list_td <?php echo $td_bg ?>">
				<? if($mb_point < 0) {
                    $total_point_minus =+ $mb_point;
                ?>
				<div><?=$list_row[po_content]?></div>
				<div style="color:red;"><?=number_format(abs($mb_point))?>점 사용</div>
				<? } ?>
			</td>
            <td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $list_row[po_etc]?></td>
			<!--
			<td class="list_td <?php echo $td_bg ?>">
				<?if($list_row[po_od_idx] != 0){?>
				<a href="content.php?co_id=point_myorder&od_idx=<?=$list_row[po_od_idx]?>" class="point_link">
				<?}else{?>
				<div class="point_link">
				<?}?>
					<?php echo $list_row[po_content]?><br>
					<div style="color:<? echo $list_row[po_point]<0? "red" : "blue" ?>;"><?=number_format(abs($list_row[po_point]))?>점 <?php echo $list_row[po_point]<0?"사용":"적립";?></div>
				<?if($list_row[po_od_idx] != 0){?>
				</a>
				<?}else{?>
				</div>
				<?}?>

			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $list_row[po_point]<0?"차감":"발급";?></td>
			-->
		</tr>

		<?php
			}
		?>

            <tr>
                <td class="list_td talgin_c"></td>
                <td class="list_td talgin_c"></td>
                <td class="list_td talgin_c"><?='발급 : '.number_format(abs($total_point_plus))?></td>
                <td class="list_td talgin_c"><?='차감 : '.number_format(abs($total_point_minus))?></td>
                <td class="list_td talgin_c"></td>

            </tr>


        <?php

		} else {
		?>
		<tr><td colspan="5" class="list_td talgin_c">마일리지 내역이 없습니다.</td></tr>
		<?
		}
		?>
		</tbody>
		</table>
	</form>

	<div id="list_paging">
		<?php echo get_paging(10, $page, $total_page, '?mb_id='.$mb_id.'&amp;s_date='.$s_date.'&amp;e_date='.$e_date); ?>
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
	//$("#s_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm", showButtonPanel: true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr });

    $("#s_date").datepicker({
        monthNames: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
        monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onChangeMonthYear: function (year, month, inst) {
            $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month - 1, 1)));
        },
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        },
        beforeShow : function(input, inst) {
            if ((datestr = $(this).val()).length > 0) {
                actDate = datestr.split('-');
                year = actDate[0];
                month = actDate[1]-1;
                $(this).datepicker('option', 'defaultDate', new Date(year, month));
                $(this).datepicker('setDate', new Date(year, month));
            }
        }
    });

	$("#btn_srch").on("click", function(){
		var params = "s_date=" + $("#s_date").val() + "&e_date=" + $("#e_date").val();
		location.href = "?mb_id=<?=$mb_id?>&" + params;
	});

	$("#btn_down").on("click", function(){
		var params = "s_date=" + $("#s_date").val() + "&e_date=" + $("#e_date").val();
		var curUrl = window.location.pathname;
		curUrl = curUrl.replace("list.php", "list.excel.php");
		window.open(curUrl + "?mb_id=<?=$mb_id?>&" + params, "_blank");
	});
});
 
function addPoint(mb_id,store){
	$("#mb-id").val(mb_id);
	$("#company").html(store);
	$("#point-form").css("display","");
	$("html").scrollTop($(document).height());
	
}
</script>
<!-- 자바스크립트 끝 -->

<?
include_once('./_tail.php');
?>
