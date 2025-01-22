<?php
include_once('./_common.php');
$g5['title'] = "도시락주문 결과";
if(!$month){
	$month=date("Y-m");
}
$sql="select m_price from lunch_order where order_no='$order_no'";
$row=sql_fetch($sql);
$m_price=$row[m_price];
$mb_name=$row[mb_name];
$mb_tel = $row[mb_tel];
$mb_hp = $row[mb_hp];

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
	<div class="table table-bordered">
		<ul>
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
		<li>
            <div class="box">
                <div class="date"><i class="fas fa-calendar-check"></i> <?php echo substr($row2[m_date],-5)?> <?php echo $weekNames[$weekName]?></div>
                <div class="menu">
                    <dl><dt>국</dt><dd><?php echo $row2[soup]?></dd></dl>
                    <dl><dt>주요리</dt><dd><?php echo $row2[main]?></dd></dl>
                    <dl><dt>가열사이드</dt><dd><?php echo $row2[heat]?></dd></dl>
                    <dl><dt>절임식품</dt><dd><?php echo $row2[pickled]?></dd></dl>
                    <dl><dt>비가열사이드</dt><dd><?php echo $row2[unheated]?></dd></dl>
                </div>
                <div class="price">
                    <dl><dt>수량</dt><dd><strong><?php echo $row[m_count]?></strong>개</dd></dl>
                    <dl id="price<?php echo $i?>"><dt>가격</dt><dd><strong><?php echo number_format($row[m_count]*$m_price);?></strong>원</dd></dl>
                </div>
            </div>
        </li>
		<?php }}
			if($i==0){
		?>
        <li>
            <div class="box">
                <p class="empty_table">데이터가 없습니다.</p>
            </div>
        </li>
		<?php }
		$sql="select * from lunch_order where order_no='$order_no'";
		$row=sql_fetch($sql);
		$sql="select * from apartment where idx='$row[a_idx]' order by idx asc";
		$arow=sql_fetch($sql);
		
		?>
        <li class="total">
            <div class="box">
                <dl>
                <dt>총수량</dt>
                    <dd id="total-count"><strong><?php echo $totalCount?></strong>개</dd>
                </dl>
                <dl>
                <dt>총금액</dt>
                <dd id="total-price"><strong><?php echo number_format($totalCount*$m_price)?></strong>원</dd>
                </dl>
            </div>
        </li>
		</ul>
	</div>
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
