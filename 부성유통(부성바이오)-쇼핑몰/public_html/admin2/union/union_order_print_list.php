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
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$freight_limit  = $ary["freight_limit"];
	$freight_cost  = $ary["freight_cost"];
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
<table border="0" width="646" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="646" bgcolor="#FFFFFF" valign="top"><div align="center"><center>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <?	
			for($k=0; $k<count($union_order_num); $k++) {
				$j_tmp = explode("|", $union_order_num[$k]);
				$union_order_num_tmp = $j_tmp[0];
			
				$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				if($numRows > 0){
					mysql_data_seek($dbresult, 0);	
					$ary=mysql_fetch_array($dbresult);	
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
					$resd = $ary["resd"];
					$address = $ary["address"];
					$address_d = $ary["address_d"];
					$message = $ary["message"];
					$paymethod = $ary["paymethod"];
					$account_no = $ary["account_no"];
					$freight_code = $ary["freight_code"];
					$status = $ary["status"];
					$date = $ary["date"];
					$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2)."/".substr($date,8);
					$pay_day = $ary["pay_day"];
				}
			
			
				if($paymethod == 'byonline') $paymethod_str = '온라인입금';
				if($paymethod == 'bycard') $paymethod_str = '신용카드';
				
				if($account_no != 0){
					$SQL0 = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
					$dbresult0 = mysql_query($SQL0, $dbconn);
					mysql_data_seek($dbresult0,0);
					$ary0 = mysql_fetch_array($dbresult0);
					$account_no = $ary0["account_no"];
					$bank_name = $ary0["bank_name"];
					$bank_number = $ary0["bank_number"];
					$owner_name = $ary0["owner_name"];
				}
				?>
				<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<p style="padding-left: 5px" align="center"><strong><span class="aa"><br>
        		</span><span class="cc">[주문번호 <?echo $union_order_num_tmp?>  | <?echo "$name($id)"?>님의 주문내역]</span></strong><br>
        		<br>
        	</td>
      	</tr>
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
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">연락처</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel" size="18" value='<?echo $tel?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">기타연락처</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="tel1" size="18" value='<?echo $tel1?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주문일시</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="center">
                				<span class="aa"><p align="left"><?echo $date_str?></span></td>
              				<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">입금예정일</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="pay_day" size="18" value='<?echo $pay_day?>' style="border: 1px solid rgb(136,136,136)" class="aa">
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
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan='3'><span class="aa">
                				<input name="receiver" size="18" value='<?echo $receiver?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                		</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">연락처</span></td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="rev_tel" size="18" value='<?echo $rev_tel?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                				</span></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">기타연락처</span></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><span class="aa">
                				<input name="rev_tel1" size="18" value='<?echo $rev_tel1?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</span></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">우편번호</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><span class="aa">
                				<input name="zip" size="18" value='<?echo $zip?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</span></td>
                			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">주소</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input name="address" size="36" value='<?echo $address?>' style="border: 1px solid rgb(136,136,136)" class="aa">
		        				</span>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center"><span class="aa">상세주소</span></td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input name="address_d" size="36" value='<?echo $address_d?>' style="border: 1px solid rgb(136,136,136)" class="aa">
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
                				<select class="aa" name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                  				<option value="0"<?
                  				if($status == 0) echo " selected";
                  				?>
                  				>신청</option>
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
                  				</select></span>
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
                			<td width="35%" bgcolor="#FFFFFF" align="center"><span class="aa">상품명</span></td>
                			<td width="15%" bgcolor="#FFFFFF" align="center"><span class="aa">수량</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">가격</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center"><span class="aa">합계</span></td>
              			</tr>
              			<?
              			$SQL1 = "select * from $Union_OrderTable where union_order_num='$union_order_num_tmp' and mart_id='$mart_id'";
						$dbresult1 = mysql_query($SQL1, $dbconn);
						$numRows1 = mysql_num_rows($dbresult1);
						if($numRows1 > 0){
							mysql_data_seek($dbresult1,0);
							$ary1 = mysql_fetch_array($dbresult1);
							$item_no = $ary1["item_no"];
							$item_name = $ary1["item_name"];
							$quantity = $ary1["quantity"];
							$status  = $ary1["status"];
							$type = $ary1["type"];
							$opt = $ary1["opt"];
							if($type == 'limit'){
								$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
							}
							if($type == 'slide'){
								$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
							}
						}
						$current_price_str = number_format($current_price);
						$mon_tot = $current_price * $quantity;
						$mon_tot_str = number_format($mon_tot);	
						echo ("
						<tr>
                			<input type='hidden' name='order_pro_no[]' value='$order_pro_no'>
                			<td width='35%' bgcolor='#FFFFFF'><span class='aa'>$item_name
                		");	
                		if(isset($opt)&&$opt!=""&&$opt!="!!"){
				        	echo ("	
				        	<br>
				          		<img src='../images/optionbar.gif'>옵션:
				          	");
				          	$opts = explode("!", $opt);
			        		if($opts[1] != "")
			        			echo "$opts[1]&nbsp;";
			        		if($opts[2] != "")
			        			echo "$opts[2]";
					    }
						echo ("
						    	</span></td>
                			<td width='15%' bgcolor='#FFFFFF'><p align='center'><span class='aa'>
                				$quantity </span></td>
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$current_price_str 원</span></td>
                			<td width='25%' bgcolor='#FFFFFF'><p align='right'><span class='aa'>$mon_tot_str 원</span></td>
              			</tr>
              			");
              			if($mon_tot >= $union_freight_limit) 
											$freight_fee = 0;
										else $freight_fee = $union_freight_cost;
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
                			</span>
                			</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        		<?
        		}
        		?>
        		<p align="center">
        		<input class="aa" style='cursor:hand' onclick="print_page();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="인쇄하기">&nbsp;
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
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>