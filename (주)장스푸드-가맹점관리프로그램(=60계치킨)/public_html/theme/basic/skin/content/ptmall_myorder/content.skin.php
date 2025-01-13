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
	include(G5_THEME_PATH.'/skin/content/ptmall_myorder/content_view.skin.php');

}else if($od_idx != '' && $mode == 'design'){
	//include(G5_THEME_PATH.'/skin/content/ptmall_myorder/content_design.skin.php');

}else{
	// 공통 조건문
	$whereStrJoin = " and g5_ptmall_order.od_status = '신청' and g5_ptmall_order.od_date >= '{$sDate}' and g5_ptmall_order.od_date < '{$eDateAfter}' ";

	if($member['mb_level'] < 3) {
		$whereStr = " od_status='신청' and od_date >= date_add(now(), interval -1 year) and mb_id='{$member['mb_id']}' ";	//점주 최근 1년만
	} else {
		$whereStr = " od_status='신청' and od_date >= '{$sDate}' and od_date < '{$eDateAfter}' ";
	}

	// 페이징
	$sql = " select count(*) as cnt from g5_ptmall_order where {$whereStr} ";

	if($sch_mb_2 != '' && $sch_wr_id != ''){
		$sql = " select count(*) as cnt from g5_member, g5_ptmall_cart, g5_ptmall_order where g5_ptmall_order.mb_id = g5_member.mb_id and g5_ptmall_order.od_idx = g5_ptmall_cart.od_idx and g5_member.mb_id = g5_ptmall_cart.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' and g5_ptmall_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} ";

	}else if($sch_mb_2 != ''){
		$sql = " select count(*) as cnt from g5_member, g5_ptmall_order where g5_ptmall_order.mb_id = g5_member.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' {$whereStrJoin} ";

	}else if($sch_wr_id != ''){
		$sql = " select count(*) as cnt from g5_ptmall_cart, g5_ptmall_order where g5_ptmall_order.od_idx = g5_ptmall_cart.od_idx and g5_ptmall_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} ";
	}
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = 20;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) $page = 1;	// 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	// 목록
	$list_orderBy = " g5_ptmall_order.od_date desc limit {$from_record}, {$rows}";
	$list_sql = " select * from g5_ptmall_order where {$whereStr} order by od_date desc limit {$from_record}, {$rows} ";

	if($sch_mb_2 != '' && $sch_wr_id != ''){
		$list_sql = " select g5_ptmall_order.* from g5_member, g5_ptmall_cart, g5_ptmall_order where g5_ptmall_order.mb_id = g5_member.mb_id and g5_ptmall_order.od_idx = g5_ptmall_cart.od_idx and g5_member.mb_id = g5_ptmall_cart.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' and g5_ptmall_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";

	}else if($sch_mb_2 != ''){
		$list_sql = " select g5_ptmall_order.* from g5_member, g5_ptmall_order where g5_ptmall_order.mb_id = g5_member.mb_id and g5_member.mb_2 like '%{$sch_mb_2}%' {$whereStrJoin} order by {$list_orderBy} ";

	}else if($sch_wr_id != ''){
		$list_sql = " select g5_ptmall_order.* from g5_ptmall_cart, g5_ptmall_order where g5_ptmall_order.od_idx = g5_ptmall_cart.od_idx and g5_ptmall_cart.it_id = '{$sch_wr_id}' {$whereStrJoin} order by {$list_orderBy} ";
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
        <button type="button" class="btn btn-primary btn-sm" id="btnExcDown2">세금계산서 발행</button>&nbsp;
		<? } ?>
		<div id="sch_box">
			<?php if($member['mb_level'] >= 3){ ?>
			<form method="get" name="order_sch_frm" action="">
				<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
				<input type="text" class="sch_txt" name="sDate" value="<?=$sDate?>" readonly> ~ <input type="text" class="sch_txt" name="eDate" value="<?=$eDate?>" readonly>
				<?php
				$si_sql = " select * from g5_write_ptmall_item where wr_2='NS' order by wr_id desc ";
				$si_qry = sql_query($si_sql);
				$si_num = sql_num_rows($si_qry);
				if($si_num > 0){
					echo '<select name="sch_wr_id" id="sch_wr_id" style="padding:3px 0px;">';
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

	<form method="post" name="ca_frm" style="clear:both;">
	<input type="hidden" name="mode" id="mode" value="">
		<table class="list_tbl">
		<thead>
		<tr>
			<th class="list_th">번호</th>
			<th class="list_th">주문일</th>
			<th class="list_th">매장명 /<br>사업자등록번호</th>
			<th class="list_th">점주명</th>
			<th class="list_th">주문상품</th>
			<th class="list_th">일반<br>결제금액</th>
            <th class="list_th">마일리지<br>결제금액</th>
            <!--
			<th class="list_th">결제방법</th>
			-->
			<th class="list_th">결제상태</th>
            <!--
			<th class="list_th">진행상황</th>
			-->
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

                if($list_row['od_hap'] > 0 && $list_row['od_hap2'] > 0){
                    $od_method = '포인트&일반 주문';
                }else if($list_row['od_hap'] > 0){
                    $od_method = '일반 주문';
                }else if($list_row['od_hap2'] > 0){
                    $od_method = '포인트';
                }else{
                    $od_method = '일반 주문';
                }



				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';
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
			$ct_sql = " select * from g5_ptmall_cart where od_idx='{$list_row['od_idx']}' order by ct_idx asc ";
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
            <td class="list_td talgin_r <?php echo $td_bg ?>"><?php echo number_format($list_row['od_hap2']).'P' ?></td>
            <!--
			<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $od_method ?></td>
			-->
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<?php
				$statusStyle = "";
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

            <!--
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<?php
				if($list_row['trade_check'] == '') {
					if($list_row['pay_status'] == '결제취소') { echo '-'; }
					else { echo '발주대기'; }
				} else if($list_row['trade_check'] == '발주완료') {
					echo '<a class="design_btn3" style="color:#fff;">발주완료</a>';
				}
				?>
			</td>
			-->
		</tr>
		<?php
			}
		} else {
		?>
		<tr>
			<td colspan="9" class="list_td talgin_c">주문 내역이 없습니다.</td>
		</tr>
		<?
		}
		?>
		</tbody>
		</table>
	</form>

	<?php echo get_paging(10, $page, $total_page, '?co_id='.$co_id.'&sch_mb_2='.$sch_mb_2); ?>

</div>


<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
var day_arr = ['일', '월', '화', '수', '목', '금', '토'];

$(function(){
	$("#btnExcDown").on("click", function(){
		var curUrl =  window.location.href;
		curUrl = curUrl.replace("content.php", "ptmall_order.excel.php");
		window.open(curUrl, "_blank");
	});
    $("#btnExcDown2").on("click", function(){
        var curUrl =  window.location.href;
        curUrl = curUrl.replace("content.php", "ptmall_order.excel_tax.php");
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


