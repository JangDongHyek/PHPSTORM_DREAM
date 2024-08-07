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
$sqlWhere =" where 1";
if($search){
	$sqlWhere .= " and od_name like '%$search'";
}
	
if($member[mb_level]!="10"){
	$sqlWhere .=" and mb_id='$member[mb_id]'";
}
//총카운터 쿼리문
$sql="select count(od_id) as cnt from g5_shop_order $sqlWhere";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));		// 글번호(내림차순)



$firstRow=0;
$lastRow=15;

$sql="select * from g5_shop_order  $sqlWhere order by od_id desc limit $from_record, $rows";
$result=sql_query($sql);
$qstr = "search=".$search;
?>

<style>
	.search_wrap{
		display: flex;
		justify-content: flex-end;
	}
	.search_wrap input[type="text"]{
		background: #fff;
		border: 1px solid #333;
		border-radius: 5px;
		padding: 2px 12px;
		box-shadow: none;
	}
	.search_wrap button{
		background: #333;
		color: #fff;
		padding: 3px 10px;
		border-radius: 5px;
		border: none;
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
	.list_table thead th{
		background: #ecf1dd;
		text-align: center !important;
	}
	.list_table tbody td{
		background: rgb(255 248 230);
	}
	.list_table tbody td.od_status{
		color: chocolate;
		font-weight: 600;
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
		margin: 10px 0 0;
	}
</style>

	<div class="search_wrap">
		<form name="form" method="get" action="./orderlist.php">
			<input type="text" name="search" value="<?php echo $search?>">
			<button type="submit">검색</button>
		</form>
	</div>
<div  class="table-responsive">
	<table class="list_table">
		<thead>
			<tr>
				<th>번호</th>
				<th>지역</th>
				<th>주문자명</th>
				<th>주문상품명</th>
				<th>주문일자</th>
				<th>희망배송일</th>
				<th>단계</th>
			</tr>
		</thead>
		<tbody>
			<?php
				for($i=0;$row=sql_fetch_array($result);$i++){
					$sql = "SELECT it_name FROM g5_shop_cart WHERE od_id = '{$row['od_id']}' ORDER BY ct_id ASC;";
					$item_list = sql_query($sql);
					$item_cnt = sql_num_rows($item_list);
					$item_names = "";

					for ($ii = 0; $item = sql_fetch_array($item_list); $ii++) {
						if ($ii > 0) continue;
						$item_names = $item['it_name'];
						
					}
			?>
			<tr onclick="location.href='./orderview.php?od_id=<?php echo $row[od_id]?>&page=<?php echo $page?>&search=<?php echo $search?>';" style="cursor:pointer">
				<td><?php echo $list_no?></td>
				<td><?php echo mb_substr($row[od_addr1],0,2)?></td>
				<td><?php echo $row[od_name]?></td>
				<td><?php echo $item_names?></td>
				<td><?php echo substr($row[od_time],0,10)?></td>
				<td><?php echo $row[od_delivery_date]?></td>
				<td class="od_status"><?php echo $row['od_status']; ?></td>
			</tr>
			<tr class="peedback">
				<td colspan="7"><span class="ic">답변</span> 영남잔치상을 이용해 주셔서 감사합니다.</td>
			</tr>
			<?php }
				if($i==0){
			?>
			<tr>
				<td colspan="7">현재 인터넷 주문조회 데이터가 없습니다.</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
	<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?				
if(G5_IS_MOBILE)
    include_once(G5_MSHOP_PATH.'/_tail.php');
else
    include_once(G5_SHOP_PATH.'/_tail.php');
?>
