<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo G5_URL ?>/theme/basic/skin/board/new/jquery-ui.js"></script>

<article id="ctt" class="ctt_<?php echo $co_id; ?>">
    <header>
        <h1><?php echo $g5['title']; ?></h1>
    </header>

    <div id="ctt_con" style="margin:0 auto; text-align:center;">
        <?php //echo $str; ?>

		<div style="padding-bottom:15px;">
			<form method="get" action="">
				<input type="hidden" name="co_id" value="<?php echo $co_id ?>">

				<label style="margin-right:5px; font-size:1rem;">계약일자</label>
				<input type="text" name="sch_fdate1" id="sch_fdate1" class="frm_input" value="<?php echo $sch_fdate1 ?>">&nbsp;&nbsp;~&nbsp;&nbsp;
				<input type="text" name="sch_ldate1" id="sch_ldate1" class="frm_input" value="<?php echo $sch_ldate1 ?>">
				<input class="search_btn" type="submit" value="검색">
			</form>
		</div>

		<table class="tbl1">
		<tbody>
		<tr>
			<th class="th1">관리업체수</th>
			<td class="td1">
			<?php
			$where_str1 = "";
			if($sch_fdate1 != ''){
				$where_str1 .= " and wr_1 >= '{$sch_fdate1}'";
			}
			if($sch_ldate1 != ''){
				$where_str1 .= " and wr_1 <= '{$sch_ldate1}'";
			}

			$tot_sql = " select count(*) as cnt from g5_write_new where (1) and wr_2 = '임대' {$where_str1} ";
			$tot_row = sql_fetch($tot_sql);
			echo number_format($tot_row['cnt']);
			?>
			</td>
		</tr>
		<tr>
			<th class="th1">총임대댓수</th>
			<td class="td1">
			<?php
			if($sch_fdate1 != ''){
				$where_str2 .= " and n.wr_1 >= '{$sch_fdate1}'";
			}
			if($sch_ldate1 != ''){
				$where_str2 .= " and n.wr_1 <= '{$sch_ldate1}'";
			}

			// 총임대댓수
			$tot1_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id {$where_str2} ";
			$tot1_row = sql_fetch($tot1_sql);
			echo number_format($tot1_row['cnt']);
			?>
			</td>
		</tr>
		<tr>
			<th class="th1">복사기임대수</th>
			<td class="td1">
			<?php
			// 복사기임대대수
			$tot2_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='흑백복사기' or nt.nt_list='컬러복사기') {$where_str2} ";
			$tot2_row = sql_fetch($tot2_sql);
			echo number_format($tot2_row['cnt']);
			?>
			</td>
		</tr>
		<tr>
			<th class="th1">잉크젯임대수</th>
			<td class="td1">
			<?php
			// 잉크젯임대수
			$tot3_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='잉크젯복합기' or nt.nt_list='잉크젯프린터') {$where_str2} ";
			$tot3_row = sql_fetch($tot3_sql);
			echo number_format($tot3_row['cnt']);
			?>
			</td>
		</tr>
		<tr>
			<th class="th1">레이져임대수</th>
			<td class="td1">
			<?php
			// 레이져임대수
			$tot4_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='레이져복합기' or nt.nt_list='레이져프린터' or nt.nt_list='흑백레이져프린터' or nt.nt_list='컬러레이져프린터' or nt.nt_list='컬러레이져복합기' or nt.nt_list='흑백레이져복합기') {$where_str2} ";
			$tot4_row = sql_fetch($tot4_sql);
			echo number_format($tot4_row['cnt']);
			?>
			</td>
		</tr>
		<tr>
			<th class="th1">총임대금액</th>
			<td class="td1">
			<?php
			$tot5_sql = " select sum(wr_13) as cnt from g5_write_new as n where n.wr_2='임대' {$where_str2} ";
			$tot5_row = sql_fetch($tot5_sql);
			echo number_format($tot5_row['cnt']).'원';
			?>
			</td>
		</tr>
		</tbody>
		</table>
    </div>

</article>

<script>
function datepicker_act(){
	$("#sch_fdate1,#sch_ldate1").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
		buttonText: "Select date",
		dateFormat: "yy-mm-dd",	// Form에 입력될 Date Type
		prevText: '이전 달',	// ◀ 에 마우스 오버하면 나타나는 타이틀
		nextText: '다음 달',	// ▶ 에 마우스 오버하면 나타나는 타이틀
		changeMonth: true,	// 월 SelectBox 형식으로 선택변경 유무
		changeYear: true,	// 년 SelectBox 형식으로 선택변경 유무
		showMonthAfterYear: true,	// 년도 다음에 월이 나타나게 할지 여부 ( true : 년 월 , false : 월 년 )
		showButtonPanel: true,	// UI 하단에 버튼 사용 유무
		monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],	// 요일에 마우스 오버하면 나타나는 타이틀
		dayNamesMin: ['일','월','화','수','목','금','토'],	// 요일 텍스트 값
		duration: 'fast', // 달력 나타나는 속도 ( Slow , Normal , Fast )
		showAnim: 'slideDown'
	});
}

$(function(){
	datepicker_act();
});
</script>