<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $Order_BuyTable where order_num='$order_num'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($numRows > 0 ) {
	mysql_data_seek($dbresult, 0);	
	$ary=mysql_fetch_array($dbresult);	
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$address_d = $ary["address_d"];
	
	echo "
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=ks_c_5601-1987'>
<title>주소 출력 </title>
<style type='text/css'>
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {  line-height: 13pt; font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #4CAABE}
.dd {  font-size: 8pt; color: #6B6B6B}

A            {font-size: 9pt;line-height: 12pt;text-decoration: none;color: #000000 }  
A:hover      {text-decoration: none;  }  
-->
</style>
</head>

<body leftmargin='0' onload='window.print();'>

<table border='0'>
  <tr>
    <td width='650'><b><font size='4'><p align='right'>$address  
    $address_d<br>
    $receiver 귀하 (연락처 : $rev_tel)<br>
    우 : </font><font size='5'>$zip</font></b>
	";
	$SQL = "select * from $Order_ProTable where order_num='$order_num' order by order_pro_no desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$prev_status = "";
	$mon_tot = 0;
	$bonus_tot = 0;
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		echo "<br><span class='dd'>$item_name : $quantity</span>";
	}
	
	echo "
		</td>
  </tr>
</table>
</body>
</html>
	";
}
?>
<?
mysql_close($dbconn);
?>