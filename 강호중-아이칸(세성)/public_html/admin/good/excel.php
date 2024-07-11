<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$dbname = $mart_id;
$filename = "$mart_id_신규등록상품"."_".date("Ymd").".xls";

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
//================================= 상품 테이블 백업 시작 ================================
if( $table == "item" ){
	$query = "select item_no, item_name, item_company, member_price, z_price, reg_date from $table where mart_id='$mart_id' and z_price='0' order by reg_date desc";
	$result = mysql_query($query, $dbconn );
	$total = mysql_affected_rows();
?>
<tr>
	<td bgcolor="#D8D88C">번 호</td>
	<td bgcolor="#D8D88C">상품명</td>
	<td bgcolor="#D8D88C">제조사</td>
	<td bgcolor="#D8D88C">공급가</td>
	<td bgcolor="#D8D88C">판매가</td>
	<td bgcolor="#D8D88C">등록일</td>
</tr>
<? 
// 테이블을 만든다.
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
//================================= 상품 테이블 백업 끝 ==================================
?> 

</table> 
</body> 
</html> 
<?
mysql_free_result( $result );
mysql_close( $dbconn );
?>