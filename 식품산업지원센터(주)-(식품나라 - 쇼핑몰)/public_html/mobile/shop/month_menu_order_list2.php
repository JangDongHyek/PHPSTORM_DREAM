<?php
include_once('./_common.php');
$g5['title'] = "도시락주문 결과";
if(!$month){
	$month=date("Y-m");
}
include_once(G5_MSHOP_PATH.'/_head.php');
$sql = " select count(idx) as cnt from lunch_order";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));		// 글번호(내림차순)

$sql="select * from lunch_order where mb_id='$member[mb_id]' limit $from_record, $rows";
$result=sql_query($sql);
?>

<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>

<div id="sct">
	<form name="form" method="post" action="./month_menu_update.php" onsubmit="return formCheck(this)">
	<input type="hidden" name="order_no" value="<?php echo $orderNo?>">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">주문번호</th>
			<th scope="col">메뉴</th>
			<th scope="col">주문날짜</th>
		</tr>
		</thead>
		<tbody>
		<?php
			for($i=0;$row=sql_fetch_array($result);$i++){
				$sql="select l.m_idx,m.m_date,m.main,count(m.idx) as cnt from lunch_order_menu l, month_menu m where l.m_idx=m.idx and l.order_no='$row[order_no]'";
				$row2=sql_fetch($sql);
				
		?>
		
		<tr>
			<td scope="col">
				<a href="<?php echo G5_SHOP_URL?>/month_menu_order_result.php?order_no=<?php echo $row[order_no]?>">
				<?php echo $row[order_no]?>
				</a>
			</td>
			<td scope="col">
				<a href="<?php echo G5_SHOP_URL?>/month_menu_order_result.php?order_no=<?php echo $row[order_no]?>">
				<?php echo substr($row2[m_date],-5)?>
				<?php echo $row2[main]?>
				<?php echo 1 < $row2[cnt]?"외".intval($row2[cnt]-1)."개":""?>
				</a>
				
			</td>
			<td scope="col"><?php echo substr($row[order_date],0,10)?></td>
			
		</tr>
		<?php }
			if($i==0){
		?>
		<tr>
			<td colspan="3">데이터가 없습니다.</td>
		</tr>
		<?php }?>
		
		</tbody>
	</table>

	<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

	</form>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
