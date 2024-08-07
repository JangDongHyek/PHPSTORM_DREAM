<?php
include_once('./_common.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

// 주문상품 재고체크 js 파일
add_javascript('<script src="'.G5_JS_URL.'/shop.order.js"></script>', 0);
$g5['title']="인터넷주문조회";
if(G5_IS_MOBILE)
    include_once(G5_MSHOP_PATH.'/_head.php');
else
    include_once(G5_SHOP_PATH.'/_head.php');

$sql="select * from g5_shop_order where od_id='$od_id'";
$od=sql_fetch($sql);
// 상품목록
$sql = " select it_id,
                it_name,
                cp_price,
                ct_notax,
                ct_send_cost,
                it_sc_type
           from {$g5['g5_shop_cart_table']}
          where od_id = '{$od['od_id']}'
          group by it_id
          order by ct_id ";
$result = sql_query($sql);

?>
<div>
	주문번호 : <?echo $od_id?>
	<table class="table">
		<thead>
			<tr>
				<th colspan="2">상품내용</th>
				<th>수량</th>
				<th>가격</th>
			</tr>
		</thead>
		<tbody>
			 <?php
				$chk_cnt = 0;
				for($i=0; $row=sql_fetch_array($result); $i++) {
					// 상품이미지
		            $image = get_it_image($row['it_id'], 50, 50);
				?>
			<tr>
				<td>
					<?php echo $image?>
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	
</div>
<?				
if(G5_IS_MOBILE)
    include_once(G5_MSHOP_PATH.'/_tail.php');
else
    include_once(G5_SHOP_PATH.'/_tail.php');
?>
