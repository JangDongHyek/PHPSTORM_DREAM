<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if (isset($flag) == false) {
	
	if (isset($prevno) == false) $prevno = 0;
	
$mart_id_tmp = "powerweb";	
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td>'item_no',</td>
	<td>'item_name',</td>
	<td>'price',</td>
	<td>'z_price',</td>
	<td>'bonus',</td>
	<td>'jaego',</td>
	<td>'opt',</td>
	<td>'item_explain',</td>
	<td>'item_company',</td>
	<td>'item_code'</td>
</tr>

<?	
$SQL = "select * from $ItemTable where mart_id = '$mart_id_tmp' order by item_no";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);
	$item_no = $ary["item_no"];
	$mart_id = $ary["mart_id"];
	$prevno = $ary["prevno"];
	$category_num = $ary["category_num"];
	$item_name = $ary["item_name"];
	$price = $ary["price"];
	$z_price = $ary["z_price"];
	$bonus = $ary["bonus"];
	$use_bonus = $ary["use_bonus"];
	$jaego = $ary["jaego"];
	$img = $ary["img"];
	$opt = $ary["opt"];
	$doctype = $ary["doctype"];
	$item_explain = $ary["item_explain"];
	$item_explain = htmlspecialchars($item_explain);
	$reg_date = $ary["reg_date"];
	$item_company = $ary["item_company"];
	$read_num = $ary["read_num"];
	$item_code = $ary["item_code"];
	$icon_no = $ary["icon_no"];
	$use_opt1 = $ary["use_opt1"];
	$use_opt23 = $ary["use_opt23"];
	$item_order = $ary["item_order"];
	$img_big = $ary["img_big"];
	$jaego_use = $ary["jaego_use"];
	$provide_price = $ary["provide_price"];
	$if_strike = $ary["if_strike"];
	$gnt_category_num = $ary["gnt_category_num"];
	$gnt_category_num_s = $ary["gnt_category_num_s"];
	$if_provide_item = $ary["if_provide_item"];

	echo ("		
<tr>
    <td>'$item_no',</td>
	<td>'$item_name',</td>
	<td>'$price',</td>
	<td>'$z_price',</td>
	<td>'$bonus',</td>
	<td>'$jaego',</td>
	<td>'$opt',</td>
	<td>'$item_explain',</td>
	<td>'$item_company',</td>
	<td>'$item_code'</td>
</tr>

	");
}
?>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>