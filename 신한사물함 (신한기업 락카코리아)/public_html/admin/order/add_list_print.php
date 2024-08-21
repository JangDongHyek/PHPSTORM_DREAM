<?
include "../lib/Mall_Admin_Session.php";
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
</head>

<body leftmargin='0' onload='window.print();'>
<?
$order_num = explode("|", $order_num_list);

for($i=0;$i<count($order_num);$i++){
	$SQL = "select * from $Order_BuyTable where order_num='$order_num[$i]'";	
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

<table border='0'>
  <tr>
    <td width='650'><b><font size='4'><p align='right'>$address  
    $address_d<br>
    $receiver 귀하 (연락처 : $rev_tel)<br>
    우 : </font><font size='5'>$zip</font></b>
		";
		$SQL = "select * from $Order_ProTable where order_num='$order_num[$i]' order by order_pro_no desc";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$prev_status = "";
		$mon_tot = 0;
		$bonus_tot = 0;
		for($j=0;$j<$numRows;$j++){
			mysql_data_seek($dbresult,$j);
			$ary = mysql_fetch_array($dbresult);
			$item_name = $ary["item_name"];
			$quantity = $ary["quantity"];
			echo "<br><span class='dd'>$item_name : $quantity</span>";
		}
		echo "
		</td>
  </tr>
</table>
<br>
		";
	}	
}
?>
</body>
</html>
<?
mysql_close($dbconn);
?>