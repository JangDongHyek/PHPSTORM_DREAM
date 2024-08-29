<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_전체등록상품"."_".date("Ymd").".xls";

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
	<td bgcolor="#D8D88C">옵션자리</td>
	<td bgcolor="#D8D88C">상품번호</td>
	<td bgcolor="#D8D88C">상품명</td>
	<td bgcolor="#D8D88C">옵션명</td>
	<td bgcolor="#D8D88C">옵션가격</td>
	<td bgcolor="#D8D88C">재고수량</td>
	<td bgcolor="#D8D88C">옵션코드</td>
	<td bgcolor="#D8D88C">옵션재고여부</TD>
	<td bgcolor="#D8D88C">삭제여부</TD>
</tr>
<?
$sql="select * from $ItemTable";
echo " ";
$i_result=mysql_query($sql);
if(!$i_result){
	echo mysql_error();
	echo mysql_errno();
}
while($rs=mysql_fetch_array($i_result)) {
		$item_name=$rs[item_name];
		$opt=$rs[opt];
		$opt2=$rs[opt2];
		$opt3=$rs[opt3];
		$opt4=$rs[opt4];
		$item_no=$rs[item_no];
		$if_opt_jaego=$rs[if_opt_jaego];
		$if_opt_jaego2=$rs[if_opt_jaego2];
		$if_opt_jaego3=$rs[if_opt_jaego3];
		$if_opt_jaego4=$rs[if_opt_jaego4];
		$OptionTable="opt_table".$no;
		$sql="select * from  $OptionTable where item_no='$item_no'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			$item_name=str_replace(",","-",$item_name);
			$opt_name=str_replace('"','',$row[opt_name]);
			$opt_name=str_replace(',','',$opt_name);
			
			if($opt_name=="=="){
				$opt_name="옵션";
			}
?>
	<tr>
		<td bgcolor="#1582d9"><?=$row[opt_no]?></td>
		<td bgcolor="#1582d9">옵션1</td>
		<td bgcolor="#1582d9"><?=$row[item_no]?></td>
		<td bgcolor="#1582d9"><?=$item_name?></td>
		
		<td bgcolor="#F6F5CC"><?=$opt_name?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_ea]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$row[opt_code]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$if_opt_jaego?></td>
		<td bgcolor="#D8D88C">N</TD>
	</tr> 
<? }?>
<?
		$OptionTable2="opt_table2";
		$sql="select * from  $OptionTable2 where item_no='$item_no'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			$opt_name=str_replace('"','',$row[opt_name]);
			$opt_name=str_replace(',','',$opt_name);
			if($opt_name=="=="){
				$opt_name="옵션";
			}
?>
	<tr>
		<td bgcolor="#40b040"><?=$row[opt_no]?></td>
		<td bgcolor="#40b040">옵션2</td>
		<td bgcolor="#40b040"><?=$row[item_no]?></td>
		<td bgcolor="#40b040"><?=$item_name?></td>
		
		<td bgcolor="#F6F5CC"><?=$opt_name?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_ea]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$row[opt_code]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$if_opt_jaego2?></td>
		<td bgcolor="#F6F5CC">N</TD>
	</tr> 
<? }?>
<?
		$OptionTable3="opt_table3";
		$sql="select * from  $OptionTable3 where item_no='$item_no'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			
?>
	<tr>
		<td bgcolor="#f1dc77"><?=$row[opt_no]?></td>
		<td bgcolor="#f1dc77">옵션3</td>
		<td bgcolor="#f1dc77"><?=$row[item_no]?></td>
		<td bgcolor="#f1dc77"><?=$item_name?></td>
		
		<td bgcolor="#F6F5CC"><?=$opt_name?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_ea]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$row[opt_code]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$if_opt_jaego3?></td>
		<td bgcolor="#F6F5CC">N</TD>
	</tr> 
<? }?>
<?
		$OptionTable4="opt_table4";
		$sql="select * from  $OptionTable4 where item_no='$item_no'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			$opt_name=str_replace('"','',$row[opt_name]);
			$opt_name=str_replace(',','',$opt_name);
			if($opt_name=="=="){
				$opt_name="옵션";
			}
?>
	<tr>
		<td bgcolor="#ff99ff"><?=$row[opt_no]?></td>
		<td bgcolor="#ff99ff">옵션4</td>
		<td bgcolor="#ff99ff"><?=$row[item_no]?></td>
		<td bgcolor="#ff99ff"><?=$item_name?></td>
		
		<td bgcolor="#F6F5CC"><?=$opt_name?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[opt_ea]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$row[opt_code]?></td>
		<td bgcolor="#F6F5CC">&nbsp;<?=$if_opt_jaego4?></td>
		<td bgcolor="#F6F5CC">N</TD>
	</tr> 
<? }?>
	<?
		if(($opt)||$opt2||$opt3||$opt4){
	?>
	<tr>
		<td colspan="9" height="10" bgcolor="#cccccc"></td>
	</tr>
	<? }?>
<?}?>

</table> 
</body> 
</html> 
<?
mysql_close( $dbconn );
?>