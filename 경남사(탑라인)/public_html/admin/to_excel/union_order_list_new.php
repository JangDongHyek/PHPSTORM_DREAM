<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=order.xls" ); 
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
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$union_freight_limit  = $ary["union_freight_limit"];
	$union_freight_cost  = $ary["union_freight_cost"];
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
	<td class=shopstyle>주문번호</td>
	<td class=shopstyle>id</td>
	<td class=shopstyle>이름</td>
	<td class=shopstyle>주민번호</td>
	<td class=shopstyle>연락처1</td>
	<td class=shopstyle>연락처2</td>
	<td class=shopstyle>email</td>
	<td class=shopstyle>수신자</td>
	<td class=shopstyle>수신자전화1</td>
	<td class=shopstyle>수신자전화2</td>
	<td class=shopstyle>수신자우편번호</td>
	<td class=shopstyle>수신자주소</td>
	<td class=shopstyle>수신자상세주소</td>
	<td class=shopstyle>메모</td>
	<td class=shopstyle>배송료</td>
	<td class=shopstyle>결제방식</td>
	<td class=shopstyle>계좌번호</td>
	<td class=shopstyle>송장번호</td>
	<td class=shopstyle>상태</td>
	<td class=shopstyle>날짜</td>
	<td class=shopstyle>입금자</td>
	<td class=shopstyle>입금예정일</td>
	<td class=shopstyle>상품주문번호</td>
	<td class=shopstyle>상품번호</td>
	<td class=shopstyle>상품명</td>
	<td class=shopstyle>옵션</td>
	<td class=shopstyle>현재가</td>
	<td class=shopstyle>수량</td>
	<td class=shopstyle>배송비</td>
	<td class=shopstyle>총결재액</td>
</tr>
<? 
if($flag == 'find'){
	$pieces = explode("!", $union_clue);
	$SQL = "select * from $Union_Order_BuyTable T1, $Union_OrderTable T2 
	where T1.mart_id='$mart_id' 
	and T2.mart_id='$mart_id' 
	and T1.union_order_num = T2.union_order_num 
	and T2.union_no = '$pieces[0]' 
	and T2.type = '$pieces[1]' 
	order by substring(T1.union_order_num,2,8) desc , substring(T1.union_order_num,10)*1 desc";
}	
else	
	$SQL = "select * from $Union_Order_BuyTable 
	where mart_id='$mart_id' 
	order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";

//echo "sql=$SQL;";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$union_order_num = $ary["union_order_num"];
	$id = $ary["id"];
	$name = $ary["name"];
	$passport1 = $ary["passport1"];
	$passport2 = $ary["passport2"];
	$tel = $ary["tel"];
	$tel1 = $ary["tel1"];
	$email = $ary["email"];
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$address_d = $ary["address_d"];
	$message = $ary["message"];
	$paymethod = $ary["paymethod"];
	$account_no = $ary["account_no"];
	$status = $ary["status"];
	$freight_code = $ary["freight_code"];
	$date = $ary["date"];
	$money_sender = $ary["money_sender"];
	$pay_day = $ary["pay_day"];
	$card_paid = $ary["card_paid"];

	
	if($status == 0) $status_str = "신청";
	if($status == 1) $status_str = "주문";
	if($status == 5) $status_str = "주문취소";
	if($status == 2) $status_str = "입금확인";
	if($status == 6) $status_str = "배송중";
	if($status == 3) $status_str = "배송완료";
	if($status == 7) $status_str = "교환";
	if($status == 4) $status_str = "환불";
                  				
  if($account_no > 0){
		
		$SQL0 = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
		//echo "sql0=$SQL0";
		$dbresult0 = mysql_query($SQL0, $dbconn);
		mysql_data_seek($dbresult0,0);
		$ary0 = mysql_fetch_array($dbresult0);
		$account_no = $ary0["account_no"];
		$bank_name = $ary0["bank_name"];
		$bank_number = $ary0["bank_number"];
		$owner_name = $ary0["owner_name"];
		
		$account_str_tmp = "$bank_name $bank_number 예금주 : $owner_name";
	}
	else $account_str_tmp = '';
	
	$SQL1 = "select * from $Union_OrderTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
  //echo "sql=$SQL";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	if ($numRows1 > 0){
		mysql_data_seek($dbresult1, 0);
		$ary1=mysql_fetch_array($dbresult1);
		$item_no = $ary1["item_no"];
		$item_name = $ary1["item_name"];
		$quantity = $ary1["quantity"];
		$type = $ary1["type"];
	}	
	
	if($type == 'limit'){
		$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
	}
	if($type == 'slide'){
		$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
	}
	$mon_tot = $current_price * $quantity;
	
	if($mon_tot >= $union_freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $union_freight_cost;
	
	$mon_tot_freight = $mon_tot + $freight_fee;
	
	echo "
<tr>
<td class=shopstyle>$union_order_num</td>
<td class=shopstyle>$id</td>
<td class=shopstyle>$name</td>
<td class=shopstyle>$passport1-$passport2</td>
<td class=shopstyle>$tel</td>
<td class=shopstyle>$tel1</td>
<td class=shopstyle>$email</td>   
<td class=shopstyle>$receiver</td> 
<td class=shopstyle>$rev_tel</td>  
<td class=shopstyle>$rev_tel1</td>      
<td class=shopstyle>$zip</td>      
<td class=shopstyle>$address</td>  
<td class=shopstyle>$address_d</td>
<td class=shopstyle>$message</td>  
<td class=shopstyle>$freight_fee</td>
<td class=shopstyle>$paymethod</td>
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
<td class=shopstyle>$current_price</td>       
<td class=shopstyle>$quantity</td>      
<td class=shopstyle>$freight_fee</td>      
<td class=shopstyle>$mon_tot_freight</td>      
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