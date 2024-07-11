<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$freight_limit = mysql_result($dbresult, 0, "freight_limit");
$freight_cost = mysql_result($dbresult, 0, "freight_cost");	
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	
$if_gnt_item = mysql_result($dbresult, 0, "if_gnt_item");	//0:일반상점 1:공급상점 2:판매상점

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_provider = $ary["if_provider"];
	$if_seller = $ary["if_seller"];
	$mycoupon_id = $ary["mycoupon_id"];
}

$SQL = "select * from order_config where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
  $field1_text = $ary["field1_text"];
  $field2_text = $ary["field2_text"];
  $field3_text = $ary["field3_text"];
  $field4_text = $ary["field4_text"];
  $field5_text = $ary["field5_text"];
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script language="JavaScript">
<!-- 
function OpenWindow() {
	RemindWindow = window.open( "", "mainpage","toolbar=no,width=610,height=150,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}
// -->
</script>
<script>
function really(order_num){
	if(confirm("\n정말로 삭제하시겟습니까?\n\n삭제하시면 현주문과 관련된 데이타가\n\n삭제되며 복구는 되지않습니다.")){
		window.location.href='order_detail.php?flag=delete_data&order_num='+order_num;
		return true;
	}
	return false; 
}

function checkform(f){
	if(confirm("\n공급처로 주문정보를 보내시겠습니까?\n")){
		return true;
	}
	else
		return false; 
}
</script>
<script>
function printWin(url){ 
	window.open(url, 'printWin', 'width=650,height=500,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
}	
</script>
<script>
function receipt_win(mart_id,order_num){
	var url = "../../market/receipt/receipt.php?mart_id="+mart_id+"&order_num="+order_num
	var uploadwin = window.open(url,"receipt","width=590,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top">
    	<p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a4.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
        		<small>▶</small> <font face="돋움">쇼핑몰 <strong>주문현황 및 <br>
        		&nbsp;&nbsp; 배송정보</strong>를 관리하실 <br>
        		&nbsp;&nbsp;&nbsp; 수 있습니다.<br>
        		<small>▶</small> <a href='order_new.php'>주문관리</a>
        		</font><br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><span class="aa">
        		삭제된 주문번호에 대한 상세내역입니다.<br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<?
		$SQL = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
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
			$message = nl2br($ary["message"]);
			$mon_tot = $ary["mon_tot"];
			$use_bonus_tot = $ary["use_bonus_tot"];
			$freight_fee = $ary["freight_fee"];
			$paymethod = $ary["paymethod"];
			$account_no = $ary["account_no"];
			$freight_code = $ary["freight_code"];
			$deposite = $ary["deposite"];
			$delivery = $ary["delivery"];
			$status = $ary["status"];
			$date = $ary["date"];
			$address_d = $ary["address_d"];
			$money_sender = $ary["money_sender"];
			$pay_day = $ary["pay_day"];
			$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2)."/".substr($date,8);
			$if_use_bonus = $ary["if_use_bonus"];
			$use_bonus_tot = $ary["use_bonus_tot"];
			$partner = $ary["partner"];
			$send_date = $ary["send_date"];
			$keeper_message = $ary["keeper_message"];
			$secret_message = $ary["secret_message"];
			$jaego_back = $ary["jaego_back"];
			$field1 = $ary["field1"];
			$field2 = $ary["field2"];
			$field3 = $ary["field3"];
			$field4 = $ary["field4"];
			$field5 = $ary["field5"];
		}
		if($paymethod == 'byonline') $paymethod_str = '온라인입금';
		
		if($paymethod == 'bycard') $paymethod_str = '신용카드';
		if($paymethod == 'bytelec') $paymethod_str = '신용카드';
		if($paymethod == 'byprepay') $paymethod_str = '신용카드';
		if($paymethod == 'byallthegate') $paymethod_str = '신용카드';
		if($paymethod == 'by_dacom_card') $paymethod_str = '신용카드';
		
		if($paymethod == 'byaccount') $paymethod_str = '계좌이체';
		if($paymethod == 'by_telec_account') $paymethod_str = '계좌이체';
		if($paymethod == 'by_allthegate_account') $paymethod_str = '계좌이체';
		if($paymethod == 'by_dacom_account') $paymethod_str = '신용카드';
		
		if($account_no > 0){
			$SQL = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$account_no = $ary["account_no"];
			$bank_name = $ary["bank_name"];
			$bank_number = $ary["bank_number"];
			$owner_name = $ary["owner_name"];
		}
		
	?>
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<p style="padding-left: 5px" align="center"><strong><span class="aa"><br>
        		</span><span class="cc">[주문번호 <?echo $order_num?> | <?echo "$name($id)"?>님의 주문내역]
        		</span></strong><br>
        		<br>
        	</td>
      	</tr>
      	
      	<form method="POST">
		<input type='hidden' name='flag' value='update_all'>
		<input type='hidden' name='order_num' value='<?echo $order_num?>'>
		<input type='hidden' name='mart_id' value='<?echo $mart_id?>'>
		<input type='hidden' name='email_flag' value=''>
		<input type='hidden' name='status_old' value='<?echo $status?>'>
		
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="center"><div align="center"><center>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="4">
                			
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="50%">&nbsp; <strong><span class="dd">주문자 정보 </span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">이름</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="name" size="18" value='<?echo $name?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">이메일</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="email" size="18" value='<?echo $email?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">전화</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel1" size="18" value='<?echo $tel1?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">핸드폰</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel2" size="18" value='<?echo $tel2?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">입금자명</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="money_sender" size="18" value='<?echo $money_sender?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">입금예정일</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="pay_day" size="18" value='<?echo $pay_day?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주문일시</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="center">
                				<span class="aa"><p align="left"><?echo $date_str?></span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">파트너</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="partner" size="18" value='<?echo $partner?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>	
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">메모</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $message?>
                				</span></td>
              			</tr>
              			<?
              			if(!empty($field1_text)){
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"><?echo $field1_text?></span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $field1?>
                				</span></td>
              			</tr>
              			<?
              			}
              			?>
              			<?
              			if(!empty($field2_text)){
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"><?echo $field2_text?></span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $field2?>
                				</span></td>
              			</tr>
              			<?
              			}
              			?>
              			<?
              			if(!empty($field3_text)){
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"><?echo $field3_text?></span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $field3?>
                				</span></td>
              			</tr>
              			<?
              			}
              			?>
              			<?
              			if(!empty($field4_text)){
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"><?echo $field4_text?></span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $field4?>
                				</span></td>
              			</tr>
              			<?
              			}
              			?>
              			<?
              			if(!empty($field5_text)){
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"><?echo $field5_text?></span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $field5?>
                				</span></td>
              			</tr>
              			<?
              			}
              			?>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">고객알림메모</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<textarea cols="51" class='aa' name="keeper_message" rows="6" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid"><?echo $keeper_message?></textarea>
                				</span></td>
              			</tr>
              			<tr>
			                <td align="middle" width="12%" bgColor="#ffffff"><span class="aa">구매내역</span></td>
			                <td align="middle" width="63%" bgColor="#ffffff" colSpan="3"><span class="aa"><p align="left">
			                <?
			                if($id!=''){
			                	$SQL = "select order_num from $Order_BuyTable where id='$id' and status='3' and mart_id='$mart_id'";//배송완료
												//echo "sql=$SQL";
												$dbresult = mysql_query($SQL, $dbconn);
												$numRows = mysql_num_rows($dbresult);
												$mon_tot = 0;
												for($i=0;$i<$numRows;$i++){
													$order_num_tmp = mysql_result($dbresult,$i,0);
													
													$SQL1 = "select z_price,quantity from $Order_ProTable where order_num='$order_num_tmp' and mart_id='$mart_id' order by order_pro_no desc";
													//echo "sql1=$SQL1";
													$dbresult1 = mysql_query($SQL1, $dbconn);
													$numRows1 = mysql_num_rows($dbresult1);
													for($j=0;$j<$numRows1;$j++){
														$z_price = mysql_result($dbresult1,$j,0);
														$quantity = mysql_result($dbresult1,$j,1);
														$sum = $z_price*$quantity;
														$mon_tot += $sum;
													}
												}
												$mon_tot_str = number_format($mon_tot);
												if($numRows > 0){
													echo "
													주문횟수 $numRows 건, 총주문금액 $mon_tot_str 원(배송완료기준)
													";
												}
												else{
													echo "
											구매내역이 없습니다.
													";
												}
											}			
											else{
											echo "
											구매내역이 없습니다.
											";
											}	
											?>
			               </span></td>
			              </tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                			
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="50%">&nbsp; <strong><span class="dd">수신자 정보 </span></strong></td>
                    				<td width="50%"></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<!--
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">이름</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="receiver" size="18" value='<?echo $receiver?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">전화</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="rev_tel" size="18" value='<?echo $rev_tel?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">우편번호</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="zip" size="18" value='<?echo $zip?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">기타연락처</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="rev_tel1" size="18" value='<?echo $rev_tel1?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</span></td>
                		</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주소</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input name="address" size="50" value='<?echo $address?>' style="border: 1px solid rgb(136,136,136)" class="aa">
		        				</span>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">상세주소</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input name="address_d" size="50" value='<?echo $address_d?>' style="border: 1px solid rgb(136,136,136)" class="aa">
		        				</span>
		        				<a href='add_print.php?order_num=<?echo $order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
                			</td>
              			</tr>
              			//-->
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">이름</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<?echo $receiver?>
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">전화</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<?echo $rev_tel?>
                			</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">우편번호</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<?echo $zip?>
                			</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">기타연락처</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<?echo $rev_tel1?>
                			</span></td>
                		</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주소</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<span class="aa"><?echo "$address &nbsp;$address_d"?>
                		</span>
		        				&nbsp;<a href='add_print.php?order_num=<?echo $order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
                			</td>
              			</tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                				
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="100%">&nbsp; <strong><span class="dd">결제 정보 </span></strong></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">결제방법</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="center">
                				<p align="left"><span class="aa"><?echo $paymethod_str?></span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">계좌정보</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				<p align="left"><span class="aa"><?echo "$bank_name $bank_number"?></span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">송장번호</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="center"><span class="aa">
                				<p align="left"><input name="freight_code" size="18" value='<?echo $freight_code?>' style="border: 1px solid rgb(136,136,136)" class="aa"></span></td>
                			<td width="12%" bgcolor="#C1DBE3" align="center"><span class="aa">진행처리</span></td>
                			<td width="22%" bgcolor="#C1DBE3" align="center"><p align="left">
                				<span class="bb">
                				<?
                				if($status == '9'){
                					echo "
	                			<font color='red'>삭제</font>
	                			<input type='hidden' name='status' value='9'>
	                				";
                				}
                				else if($status == '8'){
                					echo "
	                			<font color='red'>고객주문취소</font>
	                			<input type='hidden' name='status' value='8'>
	                				";
                				}
                				else{
                				?>	
                				<select class="aa" name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                  				<option value="1"<?
                  				if($status == 1) echo " selected";
                  				?>
                  				>주문</option>
                  				<option value="5"<?
                  				if($status == 5) echo " selected";
                  				?>
                  				>주문취소</option>
                					<option value="2"<?
                  				if($status == 2) echo " selected";
                  				?>
                  				>입금확인</option>
                  				<option value="6"<?
                  				if($status == 6) echo " selected";
                  				?>
                  				>배송중</option>
                  				<option value="3"<?
                  				if($status == 3) echo " selected";
                  				?>
                  				>배송완료</option>
                  				<option value="7"<?
                  				if($status == 7) echo " selected";
                  				?>
                  				>교환</option>
                  				<option value="4"<?
                  				if($status == 4) echo " selected";
                  				?>
                  				>환불</option>
                  				</select>
                  				<?
                  				if($status == '3') echo "<br>$send_date";
                  				?>
                  			</span>
                  			<?
                  			}
                  			?>
                			</td>
                		</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="100%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="100%">&nbsp; <strong><span class="dd">주문 내역</span></strong></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<?
              			if(!empty($mycoupon_id)){
              				$coupon_str = ",쿠폰사용내역";
              			}	
              			?>
              			<tr>
                			<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">상품명(사이버머니<?echo $coupon_str?>)</span></td>
                			<td width="15%" bgcolor="#FFFFFF" align="center"><span class="aa">수량</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">가격</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">합계</span></td>
                		</tr>
              			<?
              			$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' order by order_pro_no desc";
						//echo "sql=$SQL";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						$prev_status = "";
						$mon_tot = 0;
						$bonus_tot = 0;
						for($i=0;$i<$numRows;$i++){
							mysql_data_seek($dbresult,$i);
							$ary = mysql_fetch_array($dbresult);
							$order_pro_no = $ary["order_pro_no"];
							$item_name = $ary["item_name"];
							$opt = $ary["opt"];
							$z_price = $ary["z_price"];
							$coupon_used = $ary["coupon_used"];
							$cpntype = $ary["cpntype"];
							$rate = $ary["rate"];
							$provider_id = $ary["provider_id"];
							$z_price_str = number_format($z_price);
							
							$quantity = $ary["quantity"];
							$opt = $ary["opt"];
							$status  = $ary["status"];
							$bonus  = $ary["bonus"]; 
							$sum = $z_price * $quantity;
							$sum_str = number_format($sum);
							
							$bonus_sum = $bonus * $quantity;
							
							$mon_tot += $sum;
							$bonus_tot += $bonus_sum;
							if(($i > 0) &&($prev_status != $status)){
								$total_status = "Not Equal";
							}
							if($coupon_used == '1'){
								if($cpntype == '1'){
									$cpntype_str = ",정율:$rate %";
								}
								if($cpntype == '2'){
									$cpntype_str = ",정액:$rate 원";
								}
								if($cpntype == '3'){
									$cpntype_str = ",사은품:$rate";
								}	
							}
							else $cpntype_str = '';
							
						echo ("
						<tr>
                			<input type='hidden' name='order_pro_no[]' value='$order_pro_no'>
                			<td width='35%' bgcolor='#FFFFFF'><span class='aa'>$item_name($bonus$cpntype_str)
                			");
                			if(isset($opt)&&$opt!=""&&$opt!="!!"){
					        	echo ("	
					        	<br>
					          		<img src='../images/optionbar.gif'>옵션:
					          	");
					          	$opts = explode("!", $opt);
				        		if(strstr($opts[0],'^'))
				        			$opts_1 = explode("^", $opts[0]);
				        		else {
				        			$opts_1[0] = $opts[0];
				        			$opts_1[1] = '';
				        		}
				        		if($opts_1[0] != "")
				        			echo "$opts_1[0]";
				        		if($opts_1[1] != "")
				        			echo "($opts_1[1] 원)&nbsp;";
				        		if($opts[1] != "")
				        			echo "$opts[1]&nbsp;";
				        		if($opts[2] != "")
				        			echo "$opts[2]";
						    }
				    		echo ("	
				    			</span></td>
                			<td width='15%' bgcolor='#FFFFFF'><p align='center'><span class='aa'>
                				<input name='quantity[]' size='3' value='$quantity' style='border: 1px solid rgb(136,136,136)' class='aa'></span></td>
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$z_price_str 원</span></td>
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$sum_str 원</span></td>
                		</tr>
              				");
              			}
              			
										if($freight_fee == ''){
	              			if($mon_tot >= $freight_limit) 
												$freight_fee = 0;
											else $freight_fee = $freight_cost;
										}
										$mon_tot_freight = $mon_tot + $freight_fee;
						
										if($if_use_bonus == 1){
											$use_bonus_tot_str = number_format($use_bonus_tot);
											$money_to_pay = $mon_tot_freight - $use_bonus_tot;
											$money_to_pay_str = number_format($money_to_pay);
											
										}
										?>
              			
              			<tr>
                			<td width="35%" bgcolor="#FFFFFF"><span class="aa"><p align="center">배송비</span></td>
                			<td width="65%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="right"><?echo number_format($freight_fee)?>원</span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="4"><span class="aa"><p align="right"><b>
                			<font color='#FF0000'>구매 총액: <?echo number_format($mon_tot_freight)?> 원</font></b><br>
                				포인트 총액: <?echo number_format($bonus_tot)?> 원<br>
                				<?
                				if($if_use_bonus == 1){
                					echo ("
                				포인트 사용총액: $use_bonus_tot_str 원<br>	
                				결제할 금액	: $money_to_pay_str 원	
                					");
                				}
                				?>
                				</span>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		<p align="center">
        		<input class="aa" onclick="javascript:window.location.href='order_gabage.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
        		</p>
        		</div>
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
			</form>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>