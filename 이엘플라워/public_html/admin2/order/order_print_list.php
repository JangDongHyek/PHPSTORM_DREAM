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
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
function really(order_num){
	if(confirm("\n정말로 삭제하시겟습니까?\n\n삭제하시면 현주문과 관련된 데이타가\n\n삭제되며 복구는 되지않습니다.")){
		window.location.href='order_detail.php?flag=delete_data&order_num='+order_num;
		return true;
	}
	return false; 
}
</script>
<!-- 여기 부터 프린터에 대한 스크립트 -->
<script language="JavaScript">  
function print_page(){  
	IEPrint.left = 0;  
	IEPrint.right = 0;  
	IEPrint.top = 0;  
	IEPrint.bottom = 0;  
	IEPrint.header = "";  
	IEPrint.footer = "";  
	IEPrint.printbg = true; // 이전버전과 달리 true, false로 설정한다.  
	IEPrint.landscape = false; // 가로 출력을 원하시면 true로 넣으면 됩니다. 세로출력은 false입니다.  
	IEPrint.print(); // 위에 설정한 값을 실제 적용하고, 프린트다이얼로그를 띄웁니다.  
}  
print_page();  
</script>
<!-- 프린터 부분 스크립트 끝 -->
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<OBJECT ID="IEPrint" style="display:none" CLASSID="CLSI
<table border="0" width="664" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="646" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<?
				for($k=0; $k<count($order_num); $k++) {
					$j_tmp = explode("|", $order_num[$k]);
					$order_num_tmp = $j_tmp[0];
				
					$SQL = "select * from $Order_BuyTable where order_num='$order_num_tmp' and mart_id='$mart_id'";
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
						$message = $ary["message"];
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
					}
					if($paymethod == 'byonline') $paymethod_str = '온라인입금';
					if($paymethod == 'bycard') $paymethod_str = '신용카드';
					if($paymethod == 'bytelec') $paymethod_str = '신용카드';
					if($paymethod == 'by_dacom_card') $paymethod_str = '신용카드';
					
					if($paymethod == 'byaccount') $paymethod_str = '계좌이체';
					if($paymethod == 'by_telec_account') $paymethod_str = '계좌이체';
					if($paymethod == 'by_allthegate_account') $paymethod_str = '계좌이체';
					if($paymethod == 'by_dacom_account') $paymethod_str = '계좌이체';
					
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
        		</span><span class="cc">[주문번호 <?echo $order_num_tmp?> | <?echo "$name($id)"?>님의 주문내역]</span></strong><br>
        		<br>
        	</td>
      	</tr>
      	
      	<form method="POST">
		<input type='hidden' name='flag' value='update_all'>
		<input type='hidden' name='order_num' value='<?echo $order_num_tmp?>'>
		<input type='hidden' name='mart_id' value='<?echo $mart_id?>'>
		<input type='hidden' name='email_flag' value=''>
		
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
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa"></span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				</span></td>	
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">메모</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<textarea cols="51" class='aa' name="message" rows="6" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid"><?echo $message?></textarea>
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
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">진행처리</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="center"><p align="left">
                				<span class="bb">
                				<?
                				if($status == '8'){
		                			echo "
		                			<span class='bb'><font color='red'>고객주문취소</font></span>
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
                  				}
                  				?>
                  				</span>
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
              			<tr>
                			<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">상품명(사이버머니)</span></td>
                			<td width="15%" bgcolor="#FFFFFF" align="center"><span class="aa">수량</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">가격</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">합계</span></td>
                		</tr>
              			<?
              			$SQL = "select * from $Order_ProTable where order_num='$order_num_tmp' and mart_id='$mart_id' order by order_pro_no desc";
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
							
							echo ("
						<tr>
                			<input type='hidden' name='order_pro_no[]' value='$order_pro_no'>
                			<td width='35%' bgcolor='#FFFFFF'><span class='aa'>$item_name($bonus)
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
						?>
              			
              			<tr>
                			<td width="35%" bgcolor="#FFFFFF"><span class="aa"><p align="center">배송비</span></td>
                			<td width="65%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="right"><?echo number_format($freight_fee)?>원</span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="4"><span class="aa"><p align="right">구매 
                				총액: <?echo number_format($mon_tot_freight)?>원<br>
                				포인트 총액: <?echo number_format($bonus_tot)?>원</span>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		</div>
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
      	<?
      	}
      	?>
    		</table>
    	  		<p align="center">
        		<input class="aa" style='cursor:hand' onclick="print_page();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="인쇄하기">&nbsp;
        		</p>
      </center></div>
    </td>
</tr>
</form>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>