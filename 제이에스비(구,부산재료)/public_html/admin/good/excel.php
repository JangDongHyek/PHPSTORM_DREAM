<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_�űԵ�ϻ�ǰ"."_".date("Ymd").".xls";

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

<?
//================================= ��ǰ ���̺� ��� ���� ================================
if( $table == "item" ){
	$query = "select item_no, item_name, item_company, member_price, z_price, reg_date from $table where mart_id='$mart_id' and z_price='0' order by reg_date desc";
	$result = mysql_query($query, $dbconn );
	$total = mysql_affected_rows();
?>
<tr>
	<td bgcolor="#D8D88C">�� ȣ</td>
	<td bgcolor="#D8D88C">��ǰ��</td>
	<td bgcolor="#D8D88C">������</td>
	<td bgcolor="#D8D88C">���ް�</td>
	<td bgcolor="#D8D88C">�ǸŰ�</td>
	<td bgcolor="#D8D88C">�����</td>
</tr>
<? 
// ���̺��� �����.
	for( $i=1; $i<=$total; $i++ ){
		$row = mysql_fetch_array( $result );
?> 
	<tr>
		<td bgcolor="#F6F5CC"><?=$row[item_no]?></td>
		<td bgcolor="#F6F5CC"><?=$row[item_name]?></td>
		<td bgcolor="#F6F5CC"><?=$row[item_company]?></td>
		<td bgcolor="#F6F5CC"><?=$row[member_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[z_price]?></td>
		<td bgcolor="#F6F5CC"><?=$row[reg_date]?></td> 
	</tr> 
<?
	}
}
//================================= ��ǰ ���̺� ��� �� ==================================
?> 

</table> 
</body> 
</html> 
<?
mysql_free_result( $result );
mysql_close( $dbconn );
?>