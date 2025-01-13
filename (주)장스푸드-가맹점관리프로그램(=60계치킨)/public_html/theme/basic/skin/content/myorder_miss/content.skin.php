<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css?v='.date("YmdHis").'">', 0);

if($od_idx != ''){
	include(G5_THEME_PATH.'/skin/content/myorder_miss/content_view.skin.php');

} else {

	// 누락조회
	$sql = "SELECT A.od_idx, A.mb_id, A.mb_name, A.card_num, B.ct_idx, B.it_id, B.it_name, B.it_tot_price, B.ct_time
			FROM g5_order A INNER JOIN g5_cart B 
			ON A.od_idx = B.od_idx
			WHERE A.pay_status = '' AND B.it_bo_table = 'item' AND (A.acct_bankcode != '' || A.card_num != '')
			ORDER BY B.ct_time DESC";
	$result = sql_query($sql);
	$listCount = sql_num_rows($result);


?>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<div style="margin-top:30px; padding-bottom:10px;">
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
			</tr>
			</thead>
			<tbody>
			<? if ($listCount == 0) { ?>
			<tr>
				<td colspan="10">주문 누락건이 없습니다.</td>
			<tr>
			<? } else { 
				for ($i = 0; $row = sql_fetch_array($result); $i++) {

					$ii = $listCount - $i;

					$td_bg = '';
					if($l%2 == 0) $td_bg = 'td_bg';

					// 매장조회
					$mbRow = sql_fetch("SELECT mb_2, mb_3 FROM g5_member WHERE mb_id = '{$row['mb_id']}'");
					$mb_store = $mbRow["mb_2"];
					$mb_storeNum = $mbRow["mb_3"];

					if ($row['acct_bankcode'] != "") {
						$paymentStr = "온라인계좌이체";
					} else {
						$paymentStr = "신용카드";
					}
			?>
			<tr class="<?=$td_bg?>">
				<td class="list_td talgin_c"><?=$ii?></td>
				<td class="list_td talgin_c"><?=substr($row['ct_time'], 0, 10)?></td>
				<td class="list_td talgin_c">
					<?=$mb_store?><? echo ($mb_storeNum != "")? "<div style='font-size: 13px; margin-top: 3px;'>{$mb_storeNum}</div>" : ""; ?>
				</td>
				<td class="list_td talgin_c"><?=$row['mb_name']?></td>
				<td class="list_td talgin_l"><!--<a href="?co_id=<?=$co_id?>&od_idx=<?=$row['od_idx']?>"><?=$row['it_name']?></a>--><?=$row['it_name']?></td>
				<td class="list_td talgin_r"><?=number_format($row['it_tot_price'])?>원</td>
				<td class="list_td talgin_c"><?=$paymentStr?></td>
			</tr>
			<?	}	// end for
			   } // end if
			?>
			</tbody>
			</table>
		</form>
	</div>

</div>
<?
} // end if 
?>