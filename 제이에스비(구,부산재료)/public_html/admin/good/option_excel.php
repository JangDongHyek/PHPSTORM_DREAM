<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_��ü��ϻ�ǰ"."_".date("Ymd").".xls";

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
	<td bgcolor="#D8D88C">�� ȣ</td>
	<td bgcolor="#D8D88C">�ɼ��ڸ�</td>
	<td bgcolor="#D8D88C">��ǰ��ȣ</td>
	<td bgcolor="#D8D88C">��ǰ��</td>
	<td bgcolor="#D8D88C">�ɼǸ�</td>
	<td bgcolor="#D8D88C">�ɼǰ���</td>
	<td bgcolor="#D8D88C">������</td>
	<td bgcolor="#D8D88C">�ɼ��ڵ�</td>
	<td bgcolor="#D8D88C">�ɼ������</TD>
	<td bgcolor="#D8D88C">��������</TD>
</tr>
<?for($i=0; $i<count($checkSel); $i++) {
		$checkSels = explode("!", $checkSel[$i]);
		$item_no = $checkSels[0];
		$sql="select * from $ItemTable where item_no='$itemno[$i]'";
		$i_result=mysql_query($sql);
		$i_row=mysql_fetch_array($i_result);
		$item_name=$i_row[item_name];
		$opt=$i_row[opt];
		$opt2=$i_row[opt2];
		$opt3=$i_row[opt3];
		$opt4=$i_row[opt4];
		$if_opt_jaego=$i_row[if_opt_jaego];
		$if_opt_jaego2=$i_row[if_opt_jaego2];
		$if_opt_jaego3=$i_row[if_opt_jaego3];
		$if_opt_jaego4=$i_row[if_opt_jaego4];
		$OptionTable="opt_table".$no;
		$sql="select * from  $OptionTable where item_no='$item_no'";
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			
?>
	<tr>
		<td bgcolor="#1582d9"><?=$row[opt_no]?></td>
		<td bgcolor="#1582d9">�ɼ�1</td>
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
			
?>
	<tr>
		<td bgcolor="#40b040"><?=$row[opt_no]?></td>
		<td bgcolor="#40b040">�ɼ�2</td>
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
		<td bgcolor="#f1dc77">�ɼ�3</td>
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
			
?>
	<tr>
		<td bgcolor="#ff99ff"><?=$row[opt_no]?></td>
		<td bgcolor="#ff99ff">�ɼ�4</td>
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
		if(($opt!="=="&&$opt)||$opt2||$opt3||$opt4){
	?>
	<tr>
		<td colspan="8" height="10" bgcolor="#cccccc"></td>
	</tr>
	<? }?>
<?}?>

</table> 
</body> 
</html> 
<?
mysql_close( $dbconn );
?>