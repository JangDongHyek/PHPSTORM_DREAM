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
		<td align="center">주문번호</td>
		<td align="center">주문자주소</td>
		<td align="center">성명</td>
		<td align="center">전화번호</td>
		<td align="center">위탁자</td>
		<td align="center">매장</td>
		<td align="center">상품번호</td>
		<td align="center">색상</td>
		<td align="center">사이즈</td>
		<td align="center">상품명</td>
		<td align="center">사이트주소</td>
		<td align="center">송장번호</td>
		<td align="center">중국원가</td>
	</tr>
	<?
		$sql="select * from g5_shop_order";
		$result=sql_query($sql);
		while($row=sql_fetch_array($result)){
			$sql="select * from g5_shop_cart c left outer join g5_shop_item i on c.it_id=i.it_id
						where c.od_id='$row[od_id]'";
			$result2=sql_query($sql);
			$row2=sql_fetch_array($result2);
	    $ioArray=explode("",$row2[io_id]);
			$color=$ioArray[0];
			$size=$ioArray[1];
	?>
	<tr>
		<td style="mso-number-format:'\@'"><?=$row[od_id]?></td>
		<td><?=$row[od_b_addr1]." ".$row[od_b_addr2]?></td>
		<td align="center"><?=$row[od_b_name]?></td>
		<td align="center"><?=$row[od_b_tel]?></td>
		<td><?=$row[od_name]?></td>
		<td><?=$row2[maejang]?></td>
		<td><?=$row2[indentee]?></td>
		<td><?=$color?></td>
		<td><?=$size?></td>
		<td><?=$row2[it_name]?></td>
		<td><?=$row2[it_1]?></td>
		<td><?=$row[od_invoice]?></td>
		<td><?=$row2[china_price]?></td>
	</tr>
	<? }?>
</table>