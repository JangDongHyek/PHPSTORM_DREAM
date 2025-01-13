<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css?v='.date("YmdHis").'">', 0);

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

//$sDate = ($_GET["sDate"])? $_GET["sDate"] : "2018-03-01";
//$eDate = ($_GET["eDate"])? $_GET["eDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m')+1 , 0, (int)date('Y')));
//23.11.17 디폴트 기간 1달설정 wc
$sDate = ($_GET["sDate"])? $_GET["sDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m') , 1, (int)date('Y')));
$eDate = ($_GET["eDate"])? $_GET["eDate"] : date("Y-m-d", mktime(0, 0, 0, (int)date('m')+1 , 0, (int)date('Y')));

$eDateAfter = date("Y-m-d", strtotime("+1 days", strtotime($eDate)));

if($od_idx != '' && $mode == ''){
	include(G5_THEME_PATH.'/skin/content/myorder/content_view.skin.php');

}else if($od_idx != '' && $mode == 'design'){
	include(G5_THEME_PATH.'/skin/content/myorder/content_design.skin.php');

}else{
	// 공통 조건문 (주문누락 조건 추가)
	// (join)
	//$whereStrJoin = " and g5_order.od_status = '신청' and g5_order.od_date >= '{$sDate}' and g5_order.od_date < '{$eDateAfter}' ";
	$whereStrJoin = " and g5_order.od_date >= '{$sDate}' and g5_order.od_date < '{$eDateAfter}' and (g5_order.od_status = '신청' OR (g5_order.od_status != '신청' AND (g5_order.acct_bankcode != '' OR g5_order.card_num != '')))";

	// (기본)
	if($member['mb_level'] < 3) {	//점주 최근 1년만
		//$whereStr = " od_status='신청' and od_date >= date_add(now(), interval -1 year) and mb_id='{$member['mb_id']}' ";
		$whereStr = " (od_status='신청' OR (od_status != '신청' AND (acct_bankcode != '' OR card_num != ''))) and od_date >= date_add(now(), interval -1 year) and mb_id='{$member['mb_id']}' ";
	} else {
		//$whereStr = " od_status='신청' and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";
		$whereStr = " (od_status='신청' OR (od_status != '신청' AND (acct_bankcode != '' OR card_num != ''))) and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";
	}


	// 페이징
	$sql = " select count(*) as cnt from g5_order where {$whereStr} ";

	if($sch_mb_2 != '' && $sch_wr_id != ''){
		$sql = " select count(*) as cnt from g5_member, g5_cart, g5_order where g5_order.mb_id = g5_member.mb_id and g5_order.od_idx = g5_cart.od_idx and g5_member.mb_id = g5_cart.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' and g5_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} ";

	}else if($sch_mb_2 != ''){
		$sql = " select count(*) as cnt from g5_member, g5_order where g5_order.mb_id = g5_member.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' {$whereStrJoin} ";

	}else if($sch_wr_id != ''){
		$sql = " select count(*) as cnt from g5_cart, g5_order where g5_order.od_idx = g5_cart.od_idx and g5_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} ";
	}
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = 20;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) $page = 1;	// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	// 목록
	$list_orderBy = " g5_order.od_date desc limit {$from_record}, {$rows}";
	$list_sql = " select * from g5_order where {$whereStr} order by od_date desc limit {$from_record}, {$rows} ";

	if($sch_mb_2 != '' && $sch_wr_id != ''){
		$list_sql = " select g5_order.* from g5_member, g5_cart, g5_order where g5_order.mb_id = g5_member.mb_id and g5_order.od_idx = g5_cart.od_idx and g5_member.mb_id = g5_cart.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' and g5_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";

	}else if($sch_mb_2 != ''){
		$list_sql = " select g5_order.* from g5_member, g5_order where g5_order.mb_id = g5_member.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' {$whereStrJoin} order by {$list_orderBy} ";

	}else if($sch_wr_id != ''){
		$list_sql = " select g5_order.* from g5_cart, g5_order where g5_order.od_idx = g5_cart.od_idx and g5_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";
	}
	$list_qry = sql_query($list_sql);
	$list_num = sql_num_rows($list_qry);

	//url 파라미터
	$qstr = "";
	if($sch_wr_id != "") $qstr .= "&amp;sch_wr_id=".$sch_wr_id;
	if($sch_mb_2 != "") $qstr .= "&amp;sch_mb_2=".$sch_mb_2;
	if($_GET["sDate"]) $qstr .= "&amp;sDate=".$_GET["sDate"];
	if($_GET["eDate"]) $qstr .= "&amp;eDate=".$_GET["eDate"];
?>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<div style="margin-top:30px; padding-bottom:10px;">
		<? if($member["mb_level"] < 3) { ?>
		※ 최근 1년이내 주문내역만 조회 됩니다.
		<? } else { ?>
		<button type="button" class="btn btn-primary btn-sm" id="btnExcDown">엑셀다운</button>&nbsp;
		<? } ?>
		<div id="sch_box">
			<?php if($member['mb_level'] >= 3){ ?>
			<form method="get" name="order_sch_frm" action="">
				<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
				<input type="text" class="sch_txt" name="sDate" value="<?=$sDate?>" readonly> ~ <input type="text" class="sch_txt" name="eDate" value="<?=$eDate?>" readonly>
				<?php
				$si_sql = " select * from g5_write_item where wr_2='NS' order by wr_id desc ";
				$si_qry = sql_query($si_sql);
				$si_num = sql_num_rows($si_qry);
				if($si_num > 0){
					echo '<select name="sch_wr_id" id="sch_wr_id">';
					echo '<option value="">----------------상품선택----------------</option>';
					for($si=0; $si<$si_num; $si++){
						$si_row = sql_fetch_array($si_qry);
				?>
					<option value="<?php echo $si_row['wr_id'] ?>" <?php if($sch_wr_id == $si_row['wr_id']) echo 'selected'; ?>><?php echo $si_row['wr_subject'] ?></option>
				<?php
					}
					echo '</select>';
				}
				?>
				<input type="text" name="sch_mb_2" id="sch_mb_2" value="<?php echo $sch_mb_2 ?>" placeholder="매장명">
				<input type="submit" value="검색" id="sch_submit">
			</form>
			<?php } ?>
		</div>
	</div>

	<form method="post" name="ca_frm" action="<?php echo G5_BBS_URL ?>/category_list_update.php" style="clear:both;">
	<input type="hidden" name="mode" id="mode" value="">
		<table class="list_tbl">
		<thead>
		<tr>
			<th class="list_th">번호</th>
			<th class="list_th">주문일</th>
			<th class="list_th">매장명 /<br>사업자등록번호</th>
			<th class="list_th">점주명</th>
			<th class="list_th" style="width: 250px;">주문상품</th>
			<th class="list_th">결제금액</th>
			<th class="list_th">결제방법</th>
			<th class="list_th">결제상태</th>
			<th class="list_th">디자인 검토</th>
			<th class="list_th">배송업체 /<br>송장번호</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if($list_num > 0){
			$list_num2 = $total_count - ($page - 1) * $rows;
			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);
				
				$ll = $list_num2 - $l;

				$od_date = explode(' ',$list_row['od_date']);
				
				$od_method = '';
				switch($list_row['od_method']){
					case "card" : $od_method = '신용카드'; break;
					case "online" : $od_method = '온라인계좌이체'; break;
					case "free" : $od_method = '무료'; break;
					case "VBank" : $od_method = '가상계좌'; break;
				}
				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';

				// 주문누락 확인
				if ($list_row['od_status'] != "신청") {
					// 주문상태(od_status)는 대기인데 결제가 완료된 가상계좌건
					if ($list_row['od_method'] == "VBank" && $list_row['pay_status'] == "결제완료") {
						sql_query("UPDATE g5_order SET od_status = '신청' WHERE od_idx='{$list_row['od_idx']}'");

					} else {
						$list_row['pay_status'] = "결제누락";
						if ($list_row['card_num'] != "") { $od_method = "신용카드"; }
						if ($list_row['acct_bankcode'] != "") { 
							$od_method = "온라인계좌이체"; 
							if ($list_row['vact_num'] != "")	$od_method = "가상계좌"; 
						}
					}
				}
		?>
		<tr>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $ll ?></td>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $od_date[0] ?></td>
			<td class="list_td <?php echo $td_bg ?>">
				<?php
				$get_member = get_member($list_row['mb_id']);
				echo $get_member['mb_2'];
				echo ($get_member['mb_3'] != "")? "<div style='font-size: 13px; margin-top: 3px;'>".$get_member['mb_3']."</div>" : "";
				?>
			</td>
			<td class="list_td <?php echo $td_bg ?>"><?=$get_member['mb_name']?></td>
			<td class="list_td <?php echo $td_bg ?>">
			<?php
			$ct_sql = " select * from g5_cart where od_idx='{$list_row['od_idx']}' order by ct_idx asc ";
			$ct_qry = sql_query($ct_sql);
			$ct_num = sql_num_rows($ct_qry);
			if($ct_num > 0){
				for($k=0; $k<$ct_num; $k++){
					$ct_row = sql_fetch_array($ct_qry);
					echo '<div><a href="'.G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$list_row['od_idx'].'&page='.$page.$qstr.'">'.$ct_row['it_name'].'</a></div>';
				}
			}

			if($list_row['moid'] != ''){
				$moid_arr = explode('60chicken4_',$list_row['moid']);
				echo $moid_arr[1];
			}
			?>
			</td>
			<td class="list_td talgin_r <?php echo $td_bg ?>"><?php echo number_format($list_row['od_hap']).'원' ?></td>
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $od_method ?></td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<?php
				$statusStyle = "color : #000000";
				if($list_row['pay_status'] == '결제완료'){
					$statusStyle = "color : #0000ff";
				} else if($list_row['pay_status'] == '결제취소' || $list_row['pay_status'] == '결제실패') {
					$statusStyle = "color : #ff0000";
				} else if($list_row['pay_status'] == "입금대기") {
					$statusStyle = "color : #000000";
				}
				?>
				<span style="<?=$statusStyle?>"><?=$list_row['pay_status']?></span>
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<?php
				/*
				if($list_row['design_check'] == '') echo '-';
				else if($list_row['edit_check'] == '수정요청') echo '<a class="design_btn0" style="color:#fff;" href="'.G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$list_row['od_idx'].'&mode=design">수정요청</a>';
				else if($list_row['design_check'] == '검토요청') echo '<a class="design_btn1" style="color:#fff;" href="'.G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$list_row['od_idx'].'&mode=design">검토요청</a>';
				else if($list_row['design_check'] == '검토완료' && $list_row['trade_check'] == '') echo '<a class="design_btn2" style="color:#a26f28;">검토완료</a>';
				else if($list_row['trade_check'] == '발주완료') echo '<a class="design_btn3" style="color:#fff;">발주완료</a>';
				*/
				?>
				<?
				if($list_row['design_check'] == '') { 
					echo '-';
				} else {
					$btnStyle = "color:#fff;";
					if ($list_row['edit_check'] == '수정요청') {
						$btnName = "수정요청";
						$btnClass = "design_btn0";
					} else if ($list_row['design_check'] == '검토요청') {
						$btnName = "검토요청";
						$btnClass = "design_btn1";
					} else if ($list_row['design_check'] == '검토완료' && $list_row['trade_check'] == '') {
						$btnName = "검토완료";
						$btnClass = "design_btn2";
						$btnStyle = "color:#a26f28;";
					} else if ($list_row['trade_check'] == '발주완료') {
						$btnName = "발주완료";
						$btnClass = "design_btn3";
					}
				?>
				<a href="./content.php?co_id=<?=$co_id?>&od_idx=<?=$list_row['od_idx']?>&mode=design" class="<?=$btnClass?>" style="<?=$btnStyle?>"><?=$btnName?></a>
				<? } ?>
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
			<?php if($list_row['od_delivery_url'] != ''){ ?><a href="<?php echo $list_row['od_delivery_url'] ?>" target="_blank"><?php } ?>
			<?php echo $list_row['od_delivery_name'] ?>
			<?php if($list_row['od_delivery_url'] != ''){ ?></a><?php } ?>
			<?php if($list_row['od_send_number'] != ''){echo '<div>'.$list_row['od_send_number'].'</div>';} ?>
			</td>
		</tr>
		<?php
			}
		}
		?>
		</tbody>
		</table>
	</form>

	<?php echo get_paging(10, $page, $total_page, '?co_id='.$co_id.$qstr); ?>

</div>


<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
var day_arr = ['일', '월', '화', '수', '목', '금', '토'];

$(function(){
	$("#btnExcDown").on("click", function(){
		var curUrl =  window.location.href;
		curUrl = curUrl.replace("content.php", "order.excel.php");
		window.open(curUrl, "_blank");
	});

	$(".sch_txt").datepicker({
		changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr
	}); 
});


</script>
<?php
}
?>


