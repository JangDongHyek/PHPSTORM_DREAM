<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=order.xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 
?>
<?
//================== DB ���� ������ �ҷ��� ===============================================
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
	<td class=shopstyle>�ֹ���ȣ</td>
	<td class=shopstyle>�Ǹ�ó</td>
	<td class=shopstyle>������</td>
	<td class=shopstyle>��������ȭ1</td>
	<td class=shopstyle>��������ȭ2</td>
	<td class=shopstyle>�����ڿ����ȣ</td>
	<td class=shopstyle>�������ּ�</td>
	<td class=shopstyle>�����ڻ��ּ�</td>
	<td class=shopstyle>�޸�</td>
	<td class=shopstyle>��۷�</td>
	<td class=shopstyle>�������</td>
	<td class=shopstyle>���¹�ȣ</td>
	<td class=shopstyle>�����ȣ</td>
	<td class=shopstyle>����</td>
	<td class=shopstyle>��¥</td>
	<td class=shopstyle>�Ա���</td>
	<td class=shopstyle>�Աݿ�����</td>
	<td class=shopstyle>��ǰ�ֹ���ȣ</td>
	<td class=shopstyle>��ǰ��ȣ</td>
	<td class=shopstyle>��ǰ��</td>
	<td class=shopstyle>�ɼ�</td>
	<td class=shopstyle>���ް�</td>
	<td class=shopstyle>�ǸŰ�</td>
	<td class=shopstyle>����</td>
</tr>
<?
if(!empty($status_flag)) {
	$status_str_T2 = " and T2.status='$status_flag' ";
	$status_str = " and status='$status_flag' ";
}
else {
	$status_str_T2 = '';
	$status_str = '';
}

if($seller_id == ''){ 
	if($flag == 'find'){
		$SQL = "select DISTINCT T1.* from $Order_BuyTable T1, $Order_ProTable T2  where 
		(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
		and concat(substring(T1.date,1,4),'-',substring(T1.date,5,2),'-',substring(T1.date,7,2)) 
		between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
		and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
		order by order_num desc";
	}	
	else	
		$SQL = "select DISTINCT T1.* from $Order_BuyTable T1, $Order_ProTable T2  where 
		(T1.order_num = T2.order_num and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2) 
		order by order_num desc";
}
else{
	if($flag == 'find'){
		$SQL = "select DISTINCT T1.* from $Order_BuyTable T1, $Order_ProTable T2  where 
		(T1.order_num = T2.order_num and T1.mart_id='$seller_id' and T2.mart_id='$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2)
		and concat(substring(T1.date,1,4),'-',substring(T1.date,5,2),'-',substring(T1.date,7,2)) 
		between concat(substring('$QryFromDate',1,4),'-',substring('$QryFromDate',6,2),'-',substring('$QryFromDate',9,2))
		and concat(substring('$QryToDate',1,4),'-',substring('$QryToDate',6,2),'-',substring('$QryToDate',9,2))
		order by order_num desc";
	}	
	else	
		$SQL = "select DISTINCT T1.* from $Order_BuyTable T1, $Order_ProTable T2  where 
		(T1.order_num = T2.order_num and T1.mart_id='$seller_id' and T2.mart_id='$seller_id' and T2.provider_id ='$Mall_Admin_ID' and T2.status >= 2 $status_str_T2) 
		order by order_num desc";
}
//echo "sql=$SQL;";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$order_num = $ary["order_num"];
	$mart_id_tmp = $ary["mart_id"];
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$message = $ary["message"];
	$freight_fee = $ary["freight_fee"];
	$paymethod = $ary["paymethod"];
	$freight_code = $ary["freight_code"];
	$date = $ary["date"];
	$address_d = $ary["address_d"];
	$money_sender = $ary["money_sender"];
	$pay_day = $ary["pay_day"];
	
	$SQL1 = "select * from $Order_ProTable where order_num = '$order_num' and provider_id='$Mall_Admin_ID'";
	//echo "sql1=$SQL1";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	$prev_status = "";
	$mon_tot = 0;
	$bonus_tot = 0;
	for($j=0;$j<$numRows1;$j++){
		mysql_data_seek($dbresult1,$j);
		$ary1 = mysql_fetch_array($dbresult1);
		$order_pro_no = $ary1["order_pro_no"];
		$item_no = $ary1["item_no"];
		$item_name = $ary1["item_name"];
		$opt = $ary1["opt"];
		$z_price = $ary1["z_price"];
		$quantity = $ary1["quantity"];
		$opt = $ary1["opt"];
		$status  = $ary1["status"];
		$bonus  = $ary1["bonus"]; 
		$account_no  = $ary1["account_no"]; 
		
		$paymethod_str = '�¶����Ա�';
		if($account_no > 0){
		
			$SQL0 = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
			//echo "sql0=$SQL0";
			$dbresult0 = mysql_query($SQL0, $dbconn);
			$numRows0 = mysql_num_rows($dbresult0);
			if($numRows0>0){
				mysql_data_seek($dbresult0,0);
				$ary0 = mysql_fetch_array($dbresult0);
				$account_no = $ary0["account_no"];
				$bank_name = $ary0["bank_name"];
				$bank_number = $ary0["bank_number"];
				$owner_name = $ary0["owner_name"];
				
				$account_str_tmp = "$bank_name $bank_number ������ : $owner_name";
			}
			else $account_str_tmp = '';
		}
		else $account_str_tmp = '';
		
		if($status=='2') $status_str = "�ֹ�";
		if($status=='3') $status_str = "�ֹ����";
		if($status=='4') $status_str = "�Ա�Ȯ��";
		if($status=='5') $status_str = "�����";
		if($status=='6') $status_str = "��ۿϷ�";
		if($status=='7') $status_str = "��ȯ";
		if($status=='8') $status_str = "ȯ��";
								
		$SQL2 = "select provide_price from $ItemTable where item_no = '$item_no'";
		//echo "sql1=$SQL1";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		$numRows2 = mysql_num_rows($dbresult2);
		if($numRows2 > 0){
			$provide_price = mysql_result($dbresult2,0,0);
		}	
	
		echo "
<tr>
<td class=shopstyle>$order_num</td>
<td class=shopstyle>$mart_id_tmp</td>
<td class=shopstyle>$receiver</td> 
<td class=shopstyle>$rev_tel</td>  
<td class=shopstyle>$rev_tel1</td>      
<td class=shopstyle>$zip</td>      
<td class=shopstyle>$address</td>  
<td class=shopstyle>$address_d</td>
<td class=shopstyle>$message</td>  
<td class=shopstyle>$freight_fee</td>
<td class=shopstyle>$paymethod_str</td>
<td class=shopstyle>$account_str_tmp</td>
<td class=shopstyle>$freight_code</td>
<td class=shopstyle>$status_str</td>
<td class=shopstyle>$date</td>    
<td class=shopstyle>$money_sender</td>  
<td class=shopstyle>$pay_day</td>       
<td class=shopstyle>$order_pro_no</td>  
<td class=shopstyle>$item_no</td>       
<td class=shopstyle>$item_name</td>     
<td class=shopstyle>$opt</td>           
<td class=shopstyle>$provide_price</td>
<td class=shopstyle>$z_price</td> 
<td class=shopstyle>$quantity</td>      
</tr>
		";
	}	
}
?>
</table> 
</body> 
</html> 
<?
mysql_close($dbconn);
?>