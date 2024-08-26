<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
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
<OBJECT ID="IEPrint" style="display:none" CLASSID="CLSID:F290B058-CB26-460E-B3D4-8F36AEEDBE44" 
codebase="../cab/IEPrint.cab#version=1,0,0,7"></OBJECT>
<table border="0" width="664" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="646" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
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
			$id = $ary[id];
			$name = $ary[name];
			$passport1 = $ary[passport1];
			$passport2 = $ary[passport2];
			$tel1 = $ary[tel1];
			$tel2 = $ary[tel2];
			$email = $ary[email];
			$receiver = $ary[receiver];
			$rev_tel = $ary[rev_tel];
			$rev_tel1 = $ary[rev_tel1];
			$zip = $ary[zip];
			$address = $ary[address];
			$message = $ary[message];
			$mon_tot = $ary[mon_tot];
			$use_bonus_tot = $ary[use_bonus_tot];
			$freight_fee = $ary[freight_fee];
			$paymethod = $ary[paymethod];
			$account_no = $ary[account_no];
			$freight_code = $ary[freight_code];
			$deposite = $ary[deposite];
			$delivery = $ary[delivery];
			$status = $ary[status];
			$date = $ary[date];
			$address_d = $ary[address_d];
			$money_sender = $ary[money_sender];
			$pay_day = $ary[pay_day];
			$date_str = substr($date,0,4)."년 ".substr($date,5,2)."월 ".substr($date,8,2)."일";
		}

		//====================== 결제방법 정보 ===========================================
		if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
			$pay_sql = "select * from $BankTable where mart_id='$mart_id' and account_no='$account_no'";
			$pay_res = mysql_query($pay_sql, $dbconn);
			$pay_row = mysql_fetch_array($pay_res);
			$account_no = $pay_row[account_no];
			$bank_name = $pay_row[bank_name];
			$bank_number = $pay_row[bank_number];
			$owner_name = $pay_row[owner_name];
		}

		if($paymethod== 'bycard' || $paymethod== 'bytelec' || $paymethod== 'byesignpay' || $paymethod== 'byprepay' || $paymethod== 'byallthegate' || $paymethod== 'bytgcorp' ||$paymethod== 'by_dacom_card' ){
			$paystr = "카드결제";
			$totpaystr = "카드결제 금액";
		}
		if($paymethod== 'byaccount'||$paymethod== 'by_telec_account'||$paymethod== 'by_allthegate_account'||$paymethod== 'by_tg_account'||$paymethod== 'by_dacom_account'){
			$paystr = "계좌이체";
			$totpaystr = "계좌이체 금액";
		}

		//====================== 온라인 입금시 계좌 정보 =================================
		if($paymethod== 'byonline'){
			if( $account_no ){
				$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
				$paystr = "온라인입금";
				$totpaystr = "온라인 입금 금액";
			}else{
				$account_str ="";
				$paystr = "";
				$totpaystr = "온라인 입금 금";
			}
		}

		if($paymethod== 'byonline_point'){
			if( $account_no ){
				$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
				$paystr = "온라인입금 + 포인트결제";
				$totpaystr = "온라인 입금 금액";
			}else{
				$account_str ="";
				$paystr = "";
				$totpaystr = "온라인 입금 금";
			}
		}

		if($paymethod== 'bypoint'){
			$paystr = "포인트결제";
			$totpaystr = "결제 금액";
		}

		if($status == 1) $status_str = "주문";
		if($status == 2) $status_str = "입금확인";
		if($status == 3) $status_str = "배송완료";
		if($status == 4) $status_str = "환불";
		if($status == 5) $status_str = "주문취소";
		if($status == 6) $status_str = "배송중";
		if($status == 7) $status_str = "교환";
		if($status == 8) $status_str = "<font color='red'>고객주문취소</font>";	
?>
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<p style="padding-left: 5px" align="center"><b><br>
        		<span class="cc">[주문번호 <?=$order_num?> | <?="$name($id)"?>님의 주문내역]</span></b><br>
        		<br>
        	</td>
      	</tr>
      	
      	<form method="POST">
		<input type='hidden' name='flag' value='update_all'>
		<input type='hidden' name='order_num' value='<?=$order_num?>'>
		<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
		<input type='hidden' name='email_flag' value=''>
		
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp; <b><span class="dd">주문자 정보 </span></b></td>
										<td width="50%"></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$name?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">이메일</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$email?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">전화</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$tel1?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">휴대폰</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$tel2?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">입금자명</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$money_sender?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">입금예정일</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$pay_day?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">주문일시</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$date_str?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left">
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">메모</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$message?></td>
              			</tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp; <b><span class="dd">수신자 정보 </span></b></td>
										<td width="50%"></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$receiver?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">전화</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$rev_tel?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">우편번호</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$zip?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">기타연락처</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$rev_tel1?></td>
                		</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">주소</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$address?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">상세주소</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$address_d?></td>
              			</tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%">&nbsp; <b><span class="dd">결제 정보 </span></b></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">결제방법</td>
                			<td bgcolor="#FFFFFF" align="left" colspan='3'><?=$paystr?> <?=$account_str?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">진행처리</td>
                			<td bgcolor="#FFFFFF"  align="left" colspan='3'><?=$status_str?></td>
                		</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		
        		<table border="0" width="95%">
          		<tr>
            		<td width="100%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="100%" bgcolor="#8FBECD" colspan="7">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
                  				<tr>
                    				<td width="100%">&nbsp; <b><span class="dd">주문 내역</span></b></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>

						<tr bgcolor="#FFFFFF" align="center">
							<td width="29%">상품명(쿠폰<?=$coupon_str?>)</td>
							<td width="13%">수 량</td>
							<td width="12%">가 격</td>
							<td width="12%">합 계</td>
							<td width="10%">상 태</td>
							<td width="12%">송장번호</td>
							<td width="10%">택배회사</td>
						</tr>
<?
$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' order by order_pro_no desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$prev_status = "";
$mon_tot = 0;
$bonus_tot = 0;
for($i=0;$i<$numRows;$i++){
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$order_pro_no = $ary[order_pro_no];
	$item_name = $ary[item_name];
	$opt = $ary[opt];
	$z_price = $ary[z_price];
	$provider_id = $ary[provider_id];
	$z_price_str = number_format($z_price);
	$pro_freight_code = $ary[pro_freight_code];
	$pro_delivery = $ary[pro_delivery];
	$quantity = $ary[quantity];
	$opt = $ary[opt];
	$opt1_price = $ary[opt1_price];
	$opt2_price = $ary[opt2_price];
	$opt3_price = $ary[opt3_price];
	$opt1_quantity_total = $ary[opt1_quantity_total];
	$opt2_quantity_total = $ary[opt2_quantity_total];
	$opt3_quantity_total = $ary[opt3_quantity_total];
	$good_status  = $ary[status];
	$bonus  = $ary[bonus]; 
	$sum = $z_price * $quantity;
	$sum_str = number_format($sum);

	$sum_total = $sum;
	
	$bonus_sum = $bonus * $quantity;

	if($good_status == 1){
		$good_status_str = "주문";
	}else if($good_status == 2){
		$good_status_str = "입금확인";
	}else if($good_status == 3){
		$good_status_str = "배송완료";
	}else if($good_status == 4){
		$good_status_str = "환불";
	}else if($good_status == 5){
		$good_status_str = "주문취소";
	}else if($good_status == 6){
		$good_status_str = "배송중";
	}else if($good_status == 7){
		$good_status_str = "교환";
	}
		
	$mon_tot += $sum;
	$bonus_tot += $bonus_sum;
	if(($i > 0) &&($prev_status != $status)){
		$total_status = "Not Equal";
	}
							
	echo ("
						<tr bgcolor='#FFFFFF'>
                			<input type='hidden' name='order_pro_no[]' value='$order_pro_no'>
                			<td>$item_name($bonus)
	");
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		echo ("	
					        	<br>
					          		▼옵션▼<BR>
		");
		$opts = explode("!", $opt);
		if($opts[0] != ""){
				$opt1_arr = explode("^", $opts[0]);
				echo "옵션1 : ";
				if($opt1_arr[1] != ""){
					echo $opt1_arr[0]."<BR>";
					$opt1_qtt_str = "옵션1:".$opt1_quantity_total."개<BR>";
					$opt1_price_str = "".number_format($opt1_price)."원"."<BR>";
					$sum_total = $sum_total + ($opt1_price * $opt1_quantity_total);
				}else{
					$opt1_qtt_str = "";
					$opt1_price_str = "";
					echo $opt1_arr[0];
					echo "<BR>";
				}
			}
			if($opts[1] != ""){
				$opt2_arr = explode("^", $opts[1]);
				echo "옵션2 : ";
				if($opt2_arr[1] != ""){
					echo $opt2_arr[0]."<BR>";
					$opt2_qtt_str = "옵션2:".$opt2_quantity_total."개<BR>";
					$opt2_price_str = "".number_format($opt2_price)."원"."<BR>";
					$sum_total = $sum_total + ($opt2_price * $opt2_quantity_total);
				}else{
					$opt2_qtt_str = "";
					$opt2_price_str = "";
					echo $opt2_arr[0];
					echo "<BR>";
				}
			}
			if($opts[2] != ""){
				$opt3_arr = explode("^", $opts[2]);
				echo "옵션3 : ";
				if($opt3_arr[1] != ""){
					echo $opt3_arr[0]."<BR>";
					$opt3_qtt_str = "옵션3:".$opt3_quantity_total."개<BR>";
					$opt3_price_str = "".number_format($opt3_price)."원"."<BR>";
					$sum_total = $sum_total + ($opt3_price * $opt3_quantity_total);
				}else{
					$opt3_qtt_str = "";
					$opt3_price_str = "";
					echo $opt3_arr[0];
					echo "<BR>";
				}
			}

			$tot_price_str = $tot_price_str + $sum_total;


		/*
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
		*/
	}
?>
				    		</td>
                			<td align='center'>
							제품1:<?=$quantity?>개<BR>
							  <?
							  echo $opt1_qtt_str;
							  echo $opt2_qtt_str;
							  echo $opt3_qtt_str;
							  ?>
							</td>
                			<td align='right'>
							<?=$z_price_str?>원<BR>
							  <?
							  echo $opt1_price_str;
							  echo $opt2_price_str;
							  echo $opt3_price_str;
							  ?>
							  <?
							  $opt1_qtt_str = "";
							  $opt1_price_str = "";
							  $opt2_qtt_str = "";
							  $opt2_price_str = "";
							  $opt3_qtt_str = "";
							  $opt3_price_str = "";
							  ?>
							</td>
                			<td align='right'><?=number_format($sum_total)?>원</td>
							<td align='center'><?=$good_status_str?></td>
							<td align='center'><?=$pro_freight_code?></td>
							<td align='center'><?=$pro_delivery?></td>
                		</tr>
<?
}
	
if($freight_fee == ''){
	if($tot_price_str >= $freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $freight_cost;
}
$mon_tot_freight = $mon_tot + $freight_fee;
$tot_price_str += $freight_fee;
?>
              			
              			<!-- <tr>
                			<td width="35%" bgcolor="#FFFFFF" align="center">배송비</td>
                			<td width="65%" bgcolor="#FFFFFF" align="right" colspan="4">
                				<?=number_format($freight_fee)?>원
							</td>
              			</tr> -->
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan='7' align="right">총액: <?=number_format($tot_price_str)?>원 <?if($freight_fee > 0){echo "(배송료 : ".number_format($freight_fee)."원 포함)";}?><br>
                				포인트 총액: <?=number_format($bonus_tot)?>원<br>
<?
	if($if_use_bonus == 1){
		echo ("
	포인트 사용총액: $use_bonus_tot_str 원<br>	
	$totpaystr	: $money_to_pay_str 원	
		");
	}
?>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		<p align="center">
        		<input class="aa" style='cursor:hand' onclick="print_page();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="인쇄하기">&nbsp;<input class="aa" style='cursor:hand' onclick="self.close();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="창닫기">
        		</p>
        		</div>
        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
    </td>
</tr>
</form>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>