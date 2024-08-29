<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_전체등록상품"."_".date("Ymd")."_item.xls";

header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=\"$filename\""); 
header( "Content-Description: PHP4 Generated Data" ); 

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<body bgcolor=white> 
<table cellspacing='0' cellpadding='2' border='1' bordercolor='black'>

<tr>
	<td bgcolor="#D8D88C">번 호</td>
	<td bgcolor="#D8D88C">상품명</td>
	<td bgcolor="#D8D88C">제조사</td>
	<td bgcolor="#D8D88C">상품규격</td>
	<td bgcolor="#D8D88C">상품코드</td>
	<td bgcolor="#D8D88C">재고사용여부</td>
	<td bgcolor="#D8D88C">재고수량</td>
	<td bgcolor="#D8D88C">공급가</td>
	<td bgcolor="#D8D88C">마진</td>
	<td bgcolor="#D8D88C">판매가</td>
	<td bgcolor="#D8D88C">포인트</td>
	<td bgcolor="#D8D88C">소비자가</td>
	<td bgcolor="#D8D88C">옵션명</td>
	<td bgcolor="#D8D88C">옵션명2</td>
	<td bgcolor="#D8D88C">옵션명3</td>
	<td bgcolor="#D8D88C">옵션명4</td>
	<td bgcolor="#D8D88C">옵션재고여부</td>
	<td bgcolor="#D8D88C">옵션재고여부2</td>
	<td bgcolor="#D8D88C">옵션재고여부3</td>
	<td bgcolor="#D8D88C">옵션재고여부4</td>
	<td bgcolor="#D8D88C">배송방법</td>
	<td bgcolor="#D8D88C">상점출력</td>
	<!--<td bgcolor="#D8D88C">출력예</td>-->
</tr>
<?
	for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$sql="select * from $ItemTable where item_no='$itemno[$i]'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$if_hide=$row[if_hide];
		$if_hide=str_replace("?","",$if_hide);
		if($if_hide=="0"){
			$hide="출력";
			$bgcolor="#ffffff";
		}else if($if_hide=="1"){
			$hide="숨김";
			$bgcolor="#cbdfec";
		}
?>
	<tr>
		<td bgcolor="<?=$bgcolor?>"><?=$row[item_no]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[item_name]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[item_company]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[item_kyukyuk]?></td>
		<td bgcolor="<?=$bgcolor?>">&nbsp;<?=$row[item_code]?> </td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[jaego_use]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[jaego]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[member_price]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[g_margin]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[z_price]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[bonus]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[price]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[opt]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[opt2]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[opt3]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[opt4]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[if_opt_jaego]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[if_opt_jaego2]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[if_opt_jaego3]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[if_opt_jaego4]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$row[fee]?></td>
		<td bgcolor="<?=$bgcolor?>"><?=$hide?></td>
		<!--<td bgcolor="<?=$bgcolor?>">
			0: 출력 1: 숨김
		</td>-->
	</tr> 
<? }?>
</table> 
</body> 
</html> 
<?
mysql_close( $dbconn );
?>