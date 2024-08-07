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

<style>	
	p.tit{
		font-size: 1.2em;
		font-weight: 600;
	}
	.list_table{
		width: 100%;
		min-width: 700px;
		text-align: center !important;
	}
	.list_table th,
	.list_table td{
		padding: 5px 20px;
		color: #333;
		font-size: 1.1em;
		border-right: 2px solid #fff;
		border-bottom: 2px solid #fff;
	}
	.list_table th{
		background: #ecf1dd;
		text-align: center !important;
	}
	.list_table td{
		background: rgb(255 248 230);
	}
	.list_table .peedback{
		text-align: left !important;
		background: rgb(242, 249, 232);
	}
	.list_table .peedback td{
		color: #30ae48;
		background: #fbfff0;
		font-weight: 600;
	}
	.list_table .peedback .ic{
		font-size: 0.9em;
		color: #fff;
		background: orangered;
		padding: 2px 3px;
		margin: 0 3px 0 0;
		border-radius: 3px;
	}
	
	.table-responsive{
		border: none;
		margin: 0 0 10px 0 ;
	}
	.btn_list{
		color: #fff !important;
		background: #333;
		font-size: 1.2em;
		font-weight: 600;
		padding: 10px 25px;
		display: table;
		margin: 20px auto 0;
	}
</style>

<p class="tit">주문번호 : <?echo $od_id?></p>
<div class="table-responsive">
	<table class="list_table">
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
		            $image = get_it_image($row['it_id'], 100, 100);
					// 상품의 옵션정보
					$sql = " select ct_id, it_id, ct_price, ct_point, ct_qty, ct_option, ct_status, cp_price, ct_stock_use, ct_point_use, ct_send_cost, io_type, io_price,io_id
								from {$g5['g5_shop_cart_table']}
								where od_id = '{$od['od_id']}'
								  and it_id = '{$row['it_id']}'
								order by io_type asc, ct_id asc ";
					$res = sql_query($sql);
					$rowspan = sql_num_rows($res);

					// 합계금액 계산
					$sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
									SUM(ct_qty) as qty
								from {$g5['g5_shop_cart_table']}
								where it_id = '{$row['it_id']}'
								  and od_id = '{$od['od_id']}' ";
					$sum = sql_fetch($sql);

					// 배송비
					switch($row['ct_send_cost'])
					{
						case 1:
							$ct_send_cost = '착불';
							break;
						case 2:
							$ct_send_cost = '무료';
							break;
						default:
							$ct_send_cost = '선불';
							break;
					}

					// 조건부무료
					if($row['it_sc_type'] == 2) {
						$sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od['od_id']);

						if($sendcost == 0)
							$ct_send_cost = '무료';
					}

					for($k=0; $opt=sql_fetch_array($res); $k++) {
						if($opt['io_type'])
							$opt_price = $opt['io_price'];
						else
							$opt_price = $opt['ct_price'] + $opt['io_price'];
						// 소계
						$ct_price['stotal'] = $opt_price * $opt['ct_qty'];
						$ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];
				?>
			<tr>
				<td>
					<?php echo $image?>
				</td>
				<td><?php echo $row[it_name]?></td>
				<td><?php echo $opt['ct_qty']; ?></td>
				<td><?php echo number_format($opt_price); ?></td>
			</tr>
			<?php }}?>
		</tbody>
		<?php
		// 주문금액 = 상품구입금액 + 배송비 + 추가배송비
		$amount['order'] = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2'];?>
		<tfoot>
			<tr>
				<th colspan="3">총 가격 </th>
				<td><?php echo number_format($amount['order'])?>원</td>
			</tr>
		</tfoot>
	</table>
</div>

<p class="tit">주문 정보</p>
<div class="table-responsive">
	<table class="list_table">
		<tbody>
			<tr>
				<th>주문인 성명</th>
				<td><?php echo $od[od_name]?></td>
				<th>주문일</th>
				<td><?php echo date("Y년 m월 d일",strtotime($od[od_time]))?></td>
				<th>배송지역</th>
				<td><?php echo mb_substr($od[od_b_addr1],0,2)?></td>
			</tr>
			<tr>
				<th>받을분 성명</th>
				<td><?php echo $od[od_b_name]?></td>
				<th>희망배송일</th>
				<td style="color:blue;"><?php echo date("Y년 m월 d일",strtotime($od[od_delivery_date]))?></td>
				<th>진행상태</th>
				<td style="color:red;"><?php echo $od[od_status]?></td>
			</tr>
		</tbody>
	</table>
	
</div>
<a class="btn_list" href="./orderlist.php?page=<?php echo $page?>">목록으로</a>
<?				
if(G5_IS_MOBILE)
    include_once(G5_MSHOP_PATH.'/_tail.php');
else
    include_once(G5_SHOP_PATH.'/_tail.php');
?>
