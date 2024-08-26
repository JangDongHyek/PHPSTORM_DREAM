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
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
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
	<td class=shopstyle>구매자명</td>
	<td class=shopstyle>수취인명</td>
	<td class=shopstyle>수신자우편번호</td>
	<td class=shopstyle>수신자주소</td>
	<td class=shopstyle>수신자전화1</td>
	<td class=shopstyle>수신자전화2</td>
	<td class=shopstyle></td>
	<td class=shopstyle>배송료</td>
	<td class=shopstyle>상품명</td>
	<td class=shopstyle>옵션</td>
	<td class=shopstyle>배송메세지</td>
	<td class=shopstyle>수량</td>
	<td class=shopstyle>가격</td>
	<td class=shopstyle>주문번호</td>
	<td class=shopstyle>id</td>
	<td class=shopstyle>주민번호</td>
	<td class=shopstyle>연락처1</td>
	<td class=shopstyle>연락처2</td>
	<td class=shopstyle>email</td>
	<td class=shopstyle>결제방식</td>
	<td class=shopstyle>계좌번호</td>
	<td class=shopstyle>송장번호</td>
	<td class=shopstyle>상태</td>
	<td class=shopstyle>날짜</td>
	<td class=shopstyle>입금자</td>
	<td class=shopstyle>입금예정일</td>
	<td class=shopstyle>상품주문번호</td>
	<td class=shopstyle>상품번호</td>
	<td class=shopstyle>소비자가</td>
	<td class=shopstyle>접속구분</td>
</tr>
<?
if(!empty($status_flag)) {
	$status_str = " and status='$status_flag' ";
}

if($mobile_chk_flag=='y'){
	$status_str .= " and mobile_chk='y' ";
}elseif($mobile_chk_flag=='n'){
	$status_str .= " and mobile_chk is null ";
}else $status_str = '';





if($flag == 'find'){


	$SQL = "select * from $Order_BuyTable 
	where mart_id='$mart_id' and left(date,7) >= '$QryFromDate' and left(date,7) <= '$QryToDate' and status != '9' $status_str order by index_no desc";
}	
else	
	$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str order by index_no desc";

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	mysql_data_seek($dbresult, $i);
	$ary=mysql_fetch_array($dbresult);
	$order_num = $ary["order_num"];
	$id = $ary["id"];
	$name = $ary["name"];
	$passport1 = $ary["passport1"];
	$passport2 = $ary["passport2"];
	$tel1 = $ary["tel1"];
	$tel2 = $ary["tel2"];
	$email = $ary["email"];
	$receiver = $ary["receiver"];
	$rev_tel = $ary["rev_tel"];
	$rev_tel1 = $ary["rev_tel1"];
	$zip = $ary["zip"];
	$address = $ary["address"];
	$message = $ary["message"];
	$freight_fee = $ary["freight_fee"];
	$paymethod = $ary["paymethod"];
	$account_no = $ary["account_no"];
	$freight_code = $ary["freight_code"];
	$date = $ary["date"];
	$address_d = $ary["address_d"];
	$money_sender = $ary["money_sender"];
	$pay_day = $ary["pay_day"];
	$status = $ary["status"];
	$secret_message = $ary["secret_message"];
	$mobile_chk = $ary["mobile_chk"];

	if($mobile_chk=='y'){
		$mobile_chk_str="모바일";
	}else{
		$mobile_chk_str="PC";
	}
	
	if($status == 8) $status_str = "고객주문취소";
	if($status == 1) $status_str = "주문";
	if($status == 5) $status_str = "주문취소";
	if($status == 2) $status_str = "입금확인/출고중";
	if($status == 6) $status_str = "배송중";
	if($status == 3) $status_str = "배송완료";
	if($status == 7) $status_str = "교환";
	if($status == 4) $status_str = "환불";
                  				
  if($account_no > 0){
		
		$SQL0 = "select * from $BankTable where account_no = '$account_no' and mart_id='$mart_id'";
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
		}
		$account_str_tmp = "$bank_name $bank_number 예금주 : $owner_name";
	}
	else $account_str_tmp = '';
	
	$SQL1 = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' order by order_pro_no desc";
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

		if(isset($opt)&&$opt!=""&&$opt!="!!"){
			$opt_echo = "<br>옵션:";
				$opts = explode("!", $opt);
			if(strstr($opts[0],'^'))
				$opts_1 = explode("^", $opts[0]);
			else {
				$opts_1[0] = $opts[0];
				$opts_1[1] = '';
			}
			if($opts_1[0] != "")
				$opt_echo .= "$opts_1[0]";
			if($opts_1[1] != "")
				$opt_echo .= "(".number_format($opts_1[1])." 원)&nbsp;";
			if($opts[1] != "")
				$opt_echo .= "$opts[1]&nbsp;";
			if($opts[2] != "")
				$opt_echo .= "$opts[2]";
		}

		$z_price = $ary1["z_price"];
		$quantity = $ary1["quantity"];
		
	  $opt = str_replace('!','',$opt); 
		$opt = str_replace('.','',$opt); 
  	$status  = $ary1["status"];
		$bonus  = $ary1["bonus"]; 
			
		$price = '';
		$SQL2 = "select price,provide_price from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
		//echo "sql1=$SQL1";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		$numRows2 = mysql_num_rows($dbresult2);
		if($numRows2>0){
			$price = mysql_result($dbresult2,0,0);
			$provide_price = mysql_result($dbresult2,0,1);
		}
		echo "
<tr>
<td class=shopstyle>$name</td>
<td class=shopstyle>$receiver</td> 
<td class=shopstyle>$zip</td>      
<td class=shopstyle>$address $address_d</td>  
<td class=shopstyle>$rev_tel</td>  
<td class=shopstyle>$rev_tel1</td>      
<td class=shopstyle></td>      
<td class=shopstyle>$freight_fee</td>
<td class=shopstyle>$item_name</td>     
<td class=shopstyle>$opt_echo</td>           
<td class=shopstyle>$message</td>  
<td class=shopstyle>$quantity</td>      
<td class=shopstyle>$z_price</td>       
<td class=shopstyle>$order_num</td>
<td class=shopstyle>$id</td>
<td class=shopstyle>$passport1-$passport2</td>
<td class=shopstyle>$tel1</td>
<td class=shopstyle>$tel2</td>
<td class=shopstyle>$email</td>   
<td class=shopstyle>$paymethod</td>
<td class=shopstyle>$account_str_tmp</td>
<td class=shopstyle>$freight_code</td>
<td class=shopstyle>$status_str</td>
<td class=shopstyle>$date</td>    
<td class=shopstyle>$money_sender</td>  
<td class=shopstyle>$pay_day</td>       
<td class=shopstyle>$order_pro_no</td>  
<td class=shopstyle>$item_no</td>
<td class=shopstyle>$price</td>
<td class=shopstyle>$mobile_chk_str</td>
</tr>
		";
$opt_echo="";
	}	
}
?>
</table> 
</body> 
</html> 
<?
mysql_close($dbconn);
?>
