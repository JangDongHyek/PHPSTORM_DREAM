<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=item.xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 
?>
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<style>
<!--
.shopstyle
	{mso-style-parent:style0;
	border:.5pt solid black;
	white-space:normal;}
-->
</style>
</head>

<body bgcolor=white > 
<table cellspacing=0 cellpadding=2 border=0 > 
<tr>
	<td class=shopstyle>상품번호</td>
	<td class=shopstyle>상위카테고리</td>
	<td class=shopstyle>현재카테고리</td>
	<td class=shopstyle>상품명</td>
	<td class=shopstyle>소비자가</td>
	<td class=shopstyle>판매가</td>
	<td class=shopstyle>적립금</td>
	<td class=shopstyle>적립금사용여부</td>
	<td class=shopstyle>재고량</td>
	<td class=shopstyle>이미지(소)</td>
	<td class=shopstyle>이미지(중)</td>
	<td class=shopstyle>이미지(대)</td>
	<td class=shopstyle>이미지(고화질)</td>
	<td class=shopstyle>옵션</td>
	<td class=shopstyle>설명</td>
	<td class=shopstyle>등록일</td>
	<td class=shopstyle>제조사</td>
	<td class=shopstyle>조회수</td>
	<td class=shopstyle>상품코드</td>
	<td class=shopstyle>아이콘넘버</td>
	<td class=shopstyle>옵션사용여부1</td>
	<td class=shopstyle>옵션사용여부23</td>
	<td class=shopstyle>상품순서</td>
	<td class=shopstyle>재고사용여부</td>
	<td class=shopstyle>공급가</td>
	<td class=shopstyle>공급여부</td>
	<td class=shopstyle>대이미지길이</td>
	<td class=shopstyle>대이미지높이</td>
	<td class=shopstyle>숨김여부</td>
	
 </tr>
<?
//if($Mall_Admin_ID == 'cosmi') $limit_str = "limit 10";
$SQL = "select * from $ItemTable where mart_id='$mart_id' order by item_no desc $limit_str";
//echo "sql=$SQL;";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$item_no = $ary["item_no"];
 	$prevno  = $ary["prevno"];
 	$category_num = $ary["category_num"];
	$item_name = $ary["item_name"];
 	$price = $ary["price"];     
 	$z_price = $ary["z_price"];     
 	$bonus = $ary["bonus"];       
 	$use_bonus = $ary["use_bonus"];   
 	$jaego = $ary["jaego"];       
 	$img_sml = $ary["img_sml"];       
 	$img = $ary["img"];         
 	$img_big = $ary["img_big"];     
 	$img_high = $ary["img_high"];          
 	$opt = $ary["opt"];         
 	$item_explain = $ary["item_explain"];
 	if($Mall_Admin_ID == 'wuga77'||$Mall_Admin_ID == 'cosmi') $item_explain = '';
 	$reg_date = $ary["reg_date"];    
 	$item_company = $ary["item_company"];
 	$read_num = $ary["read_num"];    
 	$item_code = $ary["item_code"];   
 	$icon_no = $ary["icon_no"];     
 	$use_opt1 = $ary["use_opt1"];    
 	$use_opt23 = $ary["use_opt23"];   
 	$item_order = $ary["item_order"];  
 	$jaego_use = $ary["jaego_use"];   
 	$provide_price = $ary["provide_price"]; 
 	$if_provide_item = $ary["if_provide_item"];   
 	$flash_big_height = $ary["flash_big_height"];  
 	$flash_big_width = $ary["flash_big_width"];   
 	$if_hide = $ary["if_hide"];           
 
	echo "
<tr>
<td class=shopstyle>$item_no</td>
<td class=shopstyle>$prevno</td>
<td class=shopstyle>$category_num</td>
<td class=shopstyle>$item_name</td>
<td class=shopstyle>$price</td>
<td class=shopstyle>$z_price</td>
<td class=shopstyle>$bonus</td>
<td class=shopstyle>$use_bonus</td>
<td class=shopstyle>$jaego</td>
<td class=shopstyle>$img_sml</td>
<td class=shopstyle>$img</td>
<td class=shopstyle>$img_big</td>
<td class=shopstyle>$img_high</td>
<td class=shopstyle>$opt</td>
<td class=shopstyle>$item_explain</td>
<td class=shopstyle>$reg_date</td>
<td class=shopstyle>$item_company</td>
<td class=shopstyle>$read_num</td>
<td class=shopstyle>$item_code</td>
<td class=shopstyle>$icon_no</td>
<td class=shopstyle>$use_opt1</td>
<td class=shopstyle>$use_opt23</td>
<td class=shopstyle>$item_order</td>
<td class=shopstyle>$jaego_use</td>
<td class=shopstyle>$provide_price</td>
<td class=shopstyle>$if_provide_item</td>
<td class=shopstyle>$flash_big_height</td>
<td class=shopstyle>$flash_big_width</td>
<td class=shopstyle>$if_hide</td></td>
</tr>
	";
}
?>
</table> 
</body> 
</html> 
<?
mysql_close($dbconn);
?>