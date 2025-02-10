<?php
$sub_menu = '400400';
include_once('./_common.php');
auth_check($auth[$sub_menu], "r");
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = order.xls" );   
header( "Content-Description: PHP4 Generated Data" ); 
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 
?>
<table width="100%" border="1">
	<tr>
		<td align="center">주문일자</td>
		<td align="center">주문번호</td>
		<td align="center">상품명</td>
		<td align="center">주문자이름</td>
		<td align="center">주문자전화번호</td>
		<td align="center">수령인이름</td>
		<td align="center">수령인주소</td>
		<td align="center">송장번호</td>
		<td align="center">주문금액</td>
		<td align="center">결제수단</td>
	</tr>
	<?
		$sql="select * from g5_shop_order order by od_id desc";
		$result=sql_query($sql);
		while($row=sql_fetch_array($result)){
			$sql="select * from g5_shop_cart c left outer join g5_shop_item i on c.it_id=i.it_id
						where c.od_id='$row[od_id]'";
			$result2=sql_query($sql);
			
	    $ioArray=explode("",$row2[io_id]);
			$color=$ioArray[0];
			$size=$ioArray[1];
	?>
	<tr>
		<td align="center"><?=date("Y-m-d", strtotime($row['od_time']))?><br><?=date("H:i:s", strtotime($row['od_time']))?></td>
		<td align="center" style="mso-number-format:'\@'"><?=$row[od_id]?></td>
		<td align="center">
			<? while($row2=sql_fetch_array($result2)){?>
			<?=$row2[it_name]?>/
			<? }?>
		</td>
		<td align="center"><?=$row[od_name]?></td>
		<td align="center"><?=$row[od_tel]?></td>
		<td align="center"><?=$row[od_b_name]?></td>
		<td align="center"><?=$row[od_b_addr1]?> <?=$row[od_r_addr2]?></td>
		<td align="center"><?=$row[od_invoice]?></td>
		<td align="center"><?=number_format($row[od_cart_price])?></td>
		<td align="center"><?=$row[od_settle_case]?></td>
	</tr>
	<? }?>
</table>