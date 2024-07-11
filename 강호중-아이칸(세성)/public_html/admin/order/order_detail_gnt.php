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

if($flag == "update_status"){
	$SQL = "update $Order_ProTable set status='$status', quantity = $quantity where order_pro_no='$order_pro_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
else if($flag == "update_all"){
	$SQL = "update $Order_ProTable set status = '$status', pro_freight_code='$pro_freight_code' where order_num='$order_num' and provider_id='$Mall_Admin_ID'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	if($status_old != '6'&& $status == '6'){
		$send_date = date("Y-m-d H:i:s");
		$SQL = "update $Order_ProTable set send_date='$send_date' where order_num='$order_num' and provider_id='$Mall_Admin_ID'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	if($status_old == '6'&& $status != '6'){
		$SQL = "update $Order_ProTable set send_date='' where order_num='$order_num' and provider_id='$Mall_Admin_ID'";
		$dbresult = mysql_query($SQL, $dbconn);
	}	
			
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<link href='../css/style.css' rel='stylesheet' type='text/css'>
<script>
function printWin(url){ 
	window.open(url, 'printWin', 'width=650,height=500,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
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
        		<p style="padding-left: 10px"><span class="aa">주문번호에 대한 
        		상세내역입니다.<br>
        		기본설정에서 포인트 사용으로 세팅되어 있고,<br>
        		배송완료로 수정하실 경우에만 회원에게 포인트가 적립됩니다.
        		<br>
        		파트너 아이디를 삭제하시면 파트너 수입금에서 해당 주문이 삭제됩니다.
        		<br>배송완료로 수정하실 경우에만 각 상품의 재고량에서 주문량만큼 마이너스됩니다.
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
      	</tr>
      	<?
		$SQL = "select * from $Order_BuyTable where order_num='$order_num'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$mart_id = $ary["mart_id"];
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
		}
		$paymethod_str = '온라인입금';
		
		$SQL = "select * from $Order_ProTable where order_num='$order_num' and provider_id='$Mall_Admin_ID' order by order_pro_no desc";
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
			$account_no = $ary["account_no"];
			$status = $ary["status"];
			$send_date = $ary["send_date"];
			$pro_freight_code = $ary["pro_freight_code"];
		}
		
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
        		</span><span class="cc">[주문번호 <?echo $order_num?> | <?echo "$name($id)"?>님의 주문내역]</span></strong><br>
        		<br>
        	</td>
      	</tr>
      	
      	<form method="POST">
		<input type='hidden' name='flag' value='update_all'>
		<input type='hidden' name='order_num' value='<?echo $order_num?>'>
		<input type='hidden' name='seller_id' value='<?echo $seller_id?>'>
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
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">판매처</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="mart_id" size="18" value='<?echo $mart_id?>' style="border: 1px solid rgb(136,136,136)" class="aa" readonly>
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">이메일</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="email" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">전화</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel1" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">핸드폰</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel2" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">입금자명</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="money_sender" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">입금예정일</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="pay_day" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주문일시</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="center">
                				<span class="aa"><p align="left"></span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">파트너</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="partner" size="18" value='' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>	
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">메모</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<span class="aa"><p align="left">
                				<?echo $message?>
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
                				<p align="left"><input name="pro_freight_code" size="18" value='<?echo $pro_freight_code?>' style="border: 1px solid rgb(136,136,136)" class="aa"></span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">진행처리</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="center"><p align="left">
                				<span class="bb">
                				<select class="aa" name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                  				<option value='2'<?if($status=='2') echo " selected"?>>주문</option>
								<option value='3'<?if($status=='3') echo " selected"?>>주문취소</option>
								<option value='4'<?if($status=='4') echo " selected"?>>입금확인</option>
								<option value='5'<?if($status=='5') echo " selected"?>>배송중</option>
								<option value='6'<?if($status=='6') echo " selected"?>>배송완료</option>
								<option value='7'<?if($status=='7') echo " selected"?>>교환</option>
								<option value='8'<?if($status=='8') echo " selected"?>>환불</option>
								</select>
<?
 		if($status == '6'){
?>
								<br><?=$send_date?>
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
              			$SQL = "select * from $Order_ProTable where order_num='$order_num' and provider_id='$Mall_Admin_ID' order by order_pro_no desc";
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
							$provide_price = $ary["provide_price"];
							$provide_price_str = number_format($provide_price);
									
							$quantity = $ary["quantity"];
							$opt = $ary["opt"];
							$status  = $ary["status"];
							
							$sum = $provide_price*$quantity;
							$sum_str = number_format($sum);
							
							$mon_tot += $sum; //합계금액
									
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
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$provide_price_str 원</span></td>
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$sum_str 원</span></td>
                		</tr>
              				");
              			}
              			/*
              			if($freight_fee == ''){
	              			
	              			if($mon_tot >= $freight_limit) 
												$freight_fee = 0;
											else 
											$freight_fee = $freight_cost;
										}
											*/
											$freight_fee = $freight_cost;
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
                			<td width="100%" bgcolor="#FFFFFF" colspan="4"><span class="aa"><p align="right">구매 
                				총액: <?echo number_format($mon_tot_freight)?> 원<br>
                				</span>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		<table border="0" width="95%" cellspacing="1">
          <tr>
            <td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
              <?
              $SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and provider_id='$Mall_Admin_ID'";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows>0){
								mysql_data_seek($dbresult,0);
								$ary = mysql_fetch_array($dbresult);
								$content = $ary["content"];
							}
              ?>
              <tr>
                <td width="100%" bgColor="#8fbecd"><table cellSpacing="0" cellPadding="0" width="100%"
                border="0">
                  <tr>
                    <td width="100%">&nbsp; <strong><span class="dd">판매자메모</span></strong></td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <td align="middle" width="100%" bgColor="#ffffff" rowspan="3"><p align="left"><span class="aa">
                <textarea class="aa" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid" rows="6" cols="92"><?echo $content?></textarea></span></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td width="100%"></td>
          </tr>
        </table>
        		<p align="center">
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">&nbsp;
        		<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp;
        		<input class="aa" onclick="javascript:window.location.href='order_gnt.php?seller_id=<?echo $seller_id?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">&nbsp;
        		<input class="aa" onclick="javascript:printWin('order_print_gnt.php?order_num=<?echo $order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="프린트">&nbsp;
        		</p>
        		</div>
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
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