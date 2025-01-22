<?php
include_once('./_common.php');
$g5['title'] = "도시락주문 결과";
if(!$month){
	$month=date("Y-m");
}
$sql="select m_price from lunch_order where order_no='$order_no'";
$row=sql_fetch($sql);
$m_price=$row[m_price];
$weekNames = array("1"=>"월","2"=>"화","3"=>"수","4"=>"목","5"=>"금");
include_once(G5_MSHOP_PATH.'/_head.php');
?>

<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>
<div id="mm">
<div id="sct">
	<form name="form" method="post" action="./month_menu_update.php" onsubmit="return formCheck(this)">
	<input type="hidden" name="order_no" value="<?php echo $orderNo?>">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">일자</th>
			<th scope="col">요일</th>
			<th scope="col">국</a></th>
			<th scope="col">주요리</th>
			<th scope="col">가열사이드</th>
			<th scope="col">절임식품</th>
			<th scope="col">비가열 사이드</th>
			<th scope="col">수량</th>
			<th scope="col">가격</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sql="select * from lunch_order_menu where order_no='$order_no'";
			$result=sql_query($sql);
			$totalCount=0;
			for($i=0;$row=sql_fetch_array($result);$i++){
				$sql="select * from month_menu where idx='$row[m_idx]'";
				$row2=sql_fetch($sql);
				$weekName = date("w",strtotime($row2[m_date]));
				if($row2[main]){
					$totalCount+=$row[m_count];
		?>
		
		<tr>
			<td scope="col">
				<?php echo substr($row2[m_date],-5)?>
			</td>
			<td scope="col"><?php echo $weekNames[$weekName]?></td>
			<td scope="col"><?php echo $row2[soup]?></td>
			<td scope="col"><?php echo $row2[main]?></td>
			<td scope="col"><?php echo $row2[heat]?></td>
			<td scope="col"><?php echo $row2[pickled]?></td>
			<td scope="col"><?php echo $row2[unheated]?></td>
			<td>
				<?php echo $row[m_count]?>
			</td>
			<td id="price<?php echo $i?>">
				<?php echo number_format($row[m_count]*$m_price);?>원
			</td>
		</tr>
		<?php }}
			if($i==0){
		?>
		<tr>
			<td colspan="9">데이터가 없습니다.</td>
		</tr>
		<?php }
		$sql="select * from lunch_order where order_no='$order_no'";
		$row=sql_fetch($sql);
		$sql="select * from apartment where idx='$row[a_idx]' order by idx asc";
		$arow=sql_fetch($sql);
		
		?>
		<tr>
			<td colspan="6" align="right">총수량</td>
			<td align="right" id="total-count"><?php echo $totalCount?>개</td>
			<td align="right">총금액</td>
			<td align="right" id="total-price"><?php echo number_format($totalCount*$m_price)?>원</td>
		</tr>
		</tbody>
	</table>
	<div id="sod_frm">
	
	<section id="sod_frm_orderer" >
	<div class="odf_tbl">
		<dl>
			<dt scope="row"><label for="mb_name">이름<strong class="sound_only"> 필수</strong></label></dt>
			<dd><?php echo $row[mb_name]?></dd>
		</dl>

		<dl>
			<dt scope="row"><label for="mb_tel">전화번호<strong class="sound_only"> 필수</strong></label></dt>
			<dd><?php echo $row[mb_tel]?></dd>
		</dl>
		<dl>
			<dt scope="row"><label for="mb_hp">핸드폰</label></dt>
			<dd><?php echo $row[mb_hp]?></dd>
		</dl>
		<dl>
			<dt scope="row">아파트단지</dt>
			<dd>
				<?php echo $arow[apartment_name]?> <?php echo $row[addr]?>
			</dd>
		</dl>
	</div>
	</div>
	</section>
	</div>
	</form>
</div>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
