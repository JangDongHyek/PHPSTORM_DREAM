<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_��ü��ϻ�ǰ"."_".date("Ymd")."_item.xls";

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
	<td bgcolor="#D8D88C">��ǰ��</td>
	<td bgcolor="#D8D88C">������</td>
	<td bgcolor="#D8D88C">��ǰ�԰�</td>
	<td bgcolor="#D8D88C">��ǰ�ڵ�</td>
	<td bgcolor="#D8D88C">����뿩��</td>
	<td bgcolor="#D8D88C">������</td>
	<td bgcolor="#D8D88C">���ް�</td>
	<td bgcolor="#D8D88C">����</td>
	<td bgcolor="#D8D88C">�ǸŰ�</td>
	<td bgcolor="#D8D88C">����Ʈ</td>
	<td bgcolor="#D8D88C">�Һ��ڰ�</td>
	<td bgcolor="#D8D88C">�ɼǸ�</td>
	<td bgcolor="#D8D88C">�ɼǸ�2</td>
	<td bgcolor="#D8D88C">�ɼǸ�3</td>
	<td bgcolor="#D8D88C">�ɼǸ�4</td>
	<td bgcolor="#D8D88C">�ɼ������</td>
	<td bgcolor="#D8D88C">�ɼ������2</td>
	<td bgcolor="#D8D88C">�ɼ������3</td>
	<td bgcolor="#D8D88C">�ɼ������4</td>
	<td bgcolor="#D8D88C">��۹��</td>
	<td bgcolor="#D8D88C">�������</td>
	<!--<td bgcolor="#D8D88C">��¿�</td>-->
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
			$hide="���";
			$bgcolor="#ffffff";
		}else if($if_hide=="1"){
			$hide="����";
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
			0: ��� 1: ����
		</td>-->
	</tr> 
<? }?>
</table> 
</body> 
</html> 
<?
mysql_close( $dbconn );
?>