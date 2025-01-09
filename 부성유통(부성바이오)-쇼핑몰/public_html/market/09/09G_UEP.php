<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
//$mart_id = 'toolmt';
?>
<html>
<body>
<?
$SQL = "select domain from $Domain_forwardTable where mart_id='$mart_id' and if_confirm = '1'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";
$domain = mysql_result($dbresult, 0, 0);

$SQL = "select shopname from $MartInfoTable where mart_id ='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$shopname = mysql_result($dbresult, 0, 0);

$SQL = "select item_no, item_name, item_order, z_price from $ItemTable 
where mart_id='$mart_id' and if_hide='0' 
UNION select T1.item_no, T1.item_name, T2.item_order, T1.z_price from $ItemTable T1, $Gnt_ItemTable T2 
where T2.seller_id='$mart_id' and T1.item_no = T2.item_no and T1.if_provide_item='1'   
order by item_order asc, item_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
																	      		
$cnfPagecount = 500;
if ($page == ""||$page <= 0) $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;
$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;
if($page % 10 == 0)
$start_page = $page - 9;
else
$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;
for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);

	$item_no = $ary["item_no"];
	
	$SQL1 = "select * from $ItemTable where item_no=$item_no";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	mysql_data_seek($dbresult1, 0);
	$ary1 = mysql_fetch_array($dbresult1);
	$mart_id_tmp = $ary1["mart_id"];
	$prevno = $ary1["prevno"];
	$category_num = $ary1["category_num"];
	$item_name = $ary1["item_name"];
	$item_code = $ary1["item_code"];
	$z_price = $ary1["z_price"];
	$item_company = $ary1["item_company"];
	
	$SQL2 = "select category_name from $CategoryTable where category_num='$prevno'";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	
	$prev_name = mysql_result($dbresult2,0,0);
	
	$SQL2 = "select category_name from $CategoryTable where category_num='$category_num'";
	$dbresult2 = mysql_query($SQL2, $dbconn);
	
	$category_name = mysql_result($dbresult2,0,0);
	$tmp='\r\n';
	 
	if($mart_id != $mart_id_tmp){ // gnt 로 가져온 상품이면?
		$SQL1 = "select * from $Gnt_ItemTable where item_no=$item_no and seller_id='$mart_id'";
		//echo "sql1=$SQL1";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		if($numRows1 > 0){
			mysql_data_seek($dbresult1, 0);
			$ary1 = mysql_fetch_array($dbresult1);
			$seller_price = $ary1["seller_price"];
		}
		else {
			$seller_price = 0;
		}	
	}
	else {
		$seller_price = 0;
	}
	if($seller_price > 0)	$z_price = $seller_price;
	echo "<p>$item_code^$prev_name^$category_name^^$item_company^$item_name^http://$domain/autocart/market/product/product_detail.php?mart_id=$mart_id&item_no=$item_no^$z_price\n";
}	
?>
</BODY></HTML>
