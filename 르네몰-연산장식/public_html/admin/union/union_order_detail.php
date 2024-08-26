<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == "delete_data"){
	$SQL = "select * from $Union_OrderTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$item_no = $ary["item_no"];
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		$status  = $ary["status"];
		$type = $ary["type"];
		$opt = $ary["opt"];
	}
	
	//구매량 원래대로 복원.
	$SQL = "update $Union_ItemTable set current_num = current_num-$quantity where item_no = '$item_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $Union_OrderTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL = "delete from $Union_Order_BuyTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=union_order.php'>";
	exit;
}
if($flag == "update_all"){
	$SQL = "update $Union_OrderTable set status='$status' where union_order_num='$union_order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL = "update $Union_Order_BuyTable set name='$name', email='$email', tel='$tel', tel1='$tel1', message='$message', receiver='$receiver', rev_tel='$rev_tel', rev_tel1='$rev_tel1', zip='$zip', address='$address',  address_d='$address_d', freight_code='$freight_code', status = '$status', money_sender='$money_sender',pay_day = '$pay_day'  where union_order_num='$union_order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	$ary=mysql_fetch_array($dbresult);
	$union_freight_limit  = $ary["union_freight_limit"];
	$union_freight_cost  = $ary["union_freight_cost"];
}
	include "../admin_head.php";
?>
<script>
function really(union_order_num){
	if(confirm("\n정말로 삭제하시겟습니까?\n\n삭제하시면 현주문과 관련된 데이타가\n\n삭제되며 복구는 되지않습니다.")){
		window.location.href='union_order_detail.php?flag=delete_data&union_order_num='+union_order_num;
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
function receipt_win(mart_id,union_order_num){
	var url = "../../market/receipt/union_receipt.php?mart_id="+mart_id+"&union_order_num="+union_order_num
	var uploadwin = window.open(url,"receipt","width=590,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매 기본정보설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<?
		$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
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
			$money_sender = $ary["money_sender"];
		}
		
		
		if($paymethod == 'byonline') $paymethod_str = '온라인입금';
		if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
		if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
		if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
		
		if($account_no != 0){
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
			<td width="100%" bgcolor="#FFFFFF" height="40" align="center"><strong>[주문번호 <?echo $union_order_num?>  | <?echo "$name($id)"?>님의 주문내역]
				<input onclick="receipt_win('<?echo $Mall_Admin_ID?>', '<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="영수증 출력"></strong>
			</td>
			</tr>
			
<form method="POST">
<input type='hidden' name='flag' value='update_all'>
<input type='hidden' name='order_num' value='<?echo $order_num?>'>
<input type='hidden' name='mart_id' value='<?echo $mart_id?>'>
		
		<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<div align="center"><center>
				
				<table border="0" width="95%">
					<tr>
						<td width="90%" bgcolor="#999999">
							<table border="0" width="100%" cellspacing="1" cellpadding="3">
							<tr>
								<td width="100%" bgcolor="#8FBECD" colspan="4">
								
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="50%">&nbsp; <strong>주문자 정보 </strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="name" size="18" value='<?echo $name?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">이메일</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="email" size="28" value='<?echo $email?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">연락처</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="tel" size="18" value='<?echo $tel?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">기타연락처</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="tel1" size="18" value='<?echo $tel1?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">입금자명</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="money_sender" size="18" value='<?echo $money_sender?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">입금예정일</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="pay_day" size="18" value='<?echo $pay_day?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">주문일시</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo $date_str?></td>
								<td width="12%" bgcolor="#FFFFFF" align="center"></td>
								<td width="22%" bgcolor="#FFFFFF" align="left"></td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">메모</td>
								<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
									<p align="left">
									<textarea cols="51" name="message" rows="6" class="input_03" style="width:90%"><?echo $message?></textarea>
									</td>
							</tr>
							<tr>
								<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
								
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="50%">&nbsp; <strong>수신자 정보 </strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan='3'>
									<input name="receiver" size="18" value='<?echo $receiver?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">연락처</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="rev_tel" size="18" value='<?echo $rev_tel?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">기타연락처</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="rev_tel1" size="18" value='<?echo $rev_tel1?>' class="input_03">
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">우편번호</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="zip" size="18" value='<?echo $zip?>' class="input_03">
								</td>
								</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">주소</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="address" size="50" value='<?echo $address?>' class="input_03">
								
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">상세주소</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="address_d" size="50" value='<?echo $address_d?>' class="input_03">
								
								</td>
							</tr>
							<tr>
								<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="100%">&nbsp; <strong>결제 정보 </strong></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">결제방법</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo $paymethod_str?></td>
								<td width="12%" bgcolor="#FFFFFF" align="center">계좌정보</td>
								<td width="22%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo "$bank_name $bank_number"?></td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">송장번호</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><input name="freight_code" size="18" value='<?echo $freight_code?>' class="input_03"></td>
								<td width="12%" bgcolor="#FFFFFF" align="center">진행처리</td>
								<td width="22%" bgcolor="#FFFFFF" align="center"><p align="left">
									
									<select name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
										if($status == 0) $status_str = "신청";
								if($status == 1) $status_str = "주문";
								if($status == 5) $status_str = "주문취소";
								if($status == 2) $status_str = "입금확인";
								if($status == 6) $status_str = "배송중";
								if($status == 3) $status_str = "배송완료";
								if($status == 7) $status_str = "교환";
								if($status == 4) $status_str = "환불";
					
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
										</select>
								</td>
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
								<td width="100%" bgcolor="#8FBECD" colspan="4">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="100%">&nbsp; <strong>주문 내역</strong></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="35%" bgcolor="#FFFFFF" align="center">상품명</td>
								<td width="15%" bgcolor="#FFFFFF" align="center">수량</td>
								<td width="25%" bgcolor="#FFFFFF" align="center">가격</td>
								<td width="25%" bgcolor="#FFFFFF" align="center">합계</td>
							</tr>
							<?
							$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
						//echo "sql=$SQL";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						if($numRows > 0){
							mysql_data_seek($dbresult,0);
							$ary = mysql_fetch_array($dbresult);
							$item_no = $ary["item_no"];
							$item_name = $ary["item_name"];
							$quantity = $ary["quantity"];
							$status  = $ary["status"];
							$type = $ary["type"];
							$opt = $ary["opt"];
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
								<td width='35%' bgcolor='#FFFFFF'>$item_name
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
								</td>
								<td width='15%' bgcolor='#FFFFFF'><p align='center'>
									$quantity </td>
								<td width='25%' bgcolor='#FFFFFF'><p align='right'>$current_price_str 원</td>
								<td width='25%' bgcolor='#FFFFFF'><p align='right'>$mon_tot_str 원</td>
							</tr>
							");
							if($mon_tot >= $union_freight_limit) 
							$freight_fee = 0;
						else $freight_fee = $union_freight_cost;
						$mon_tot_freight = $mon_tot + $freight_fee;
						?>
							
							<tr>
								<td width="35%" bgcolor="#FFFFFF"><p align="center">배송비</td>
								<td width="65%" bgcolor="#FFFFFF" align="center" colspan="3">
									<p align="right"><?echo number_format($freight_fee)?>원</td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#FFFFFF" colspan="4"><p align="right">구매 
									총액: <?echo number_format($mon_tot_freight)?>원<br>
								
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
			<td width="100%" bgcolor="#FFFFFF" align="center">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">&nbsp;
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">&nbsp;
					<input onclick="window.location.href='union_order.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
					<input onclick="javascript:window.location.href='union_order_detail.php?union_order_num=<?echo $union_order_num?>&email_flag=send'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="배송시작메일">
					<input onclick="javascript:window.location.href='union_order_detail.php?union_order_num=<?echo $union_order_num?>&email_flag=money_ok'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="입금확인메일">
					<input onclick="javascript:printWin('union_order_print.php?union_order_num=<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="프린트">
					<input onclick="javascript:return really('<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="주문정보 삭제">
			</td>
			</tr>
		</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
if($email_flag == 'send'){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$shopname = $ary["shopname"];
		$shopemail  = $ary["email"];
		$icash_id  = $ary["icash_id"];
		$shoptel1= $ary["tel1"];
	}
	$mailcontent = ("<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<title>고객님이 주문하신 상품이 배송지로 출발하였습니다. </title>
<style type='text/css'>
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
</head>

<body topmargin='0' bgcolor='#FFFFFF' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD'>
<table border='0' width='750' cellspacing='0' cellpadding='0' height='100%'>
<tr>
	<td width='609' valign='top'>
		<div align='center'><center>
		
		<table border='0' width='571'>
			<tr>
			<td width='100%' height='15'></td>
			</tr>
			<tr>
			<td width='100%'>
				<div align='center'><center>
				<table border='0' width='540' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='536' bgcolor='#FFFFFF' colspan='4'>
							안녕하세요 $shopname 쇼핑몰입니다.<br>
							고객님이 주문하신 상품이 배송지로 출발하였습니다. <br>
							배송기간은 1~3일이내에 받아보실 수 있습니다.<br>
							<br>
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>주문 내역</td>
					</tr>
					<tr>
						<td width='536' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif' colspan='4'></td>
					</tr>
	");          			

	$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
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
		$money_sender = $ary["money_sender"];
	}
		
		
	if($paymethod == 'byonline') $paymethod_str = '온라인입금';
	if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
		
	if($account_no != 0){
		$SQL = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];
		$bank_name = $ary["bank_name"];
		$bank_number = $ary["bank_number"];
		$owner_name = $ary["owner_name"];
	}
		
	$mailcontent .= "
							<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>주문번호</td>
						<td width='153' height='25' align='center'><p align='left'>
							$union_order_num</td>
						<td width='147' height='25' align='center'>
							<p align='left'>
							주문일시</td>
						<td width='159' height='25' align='center'>
							<p align='left'>
							$date_str</td>
					</tr>
					<tr>
						<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>주문자명</td>
						<td width='145' height='25'>
							$name</td>
						<td width='144' height='25'>
							연락처</td>
						<td width='144' height='25'>
							$tel1</td>
					</tr>
					<tr>
						<td width='532' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='532' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td align='center' colspan='4' bgcolor='#808080'>
							<table border='0' width='100%' cellspacing='1' cellpadding='3'>
							<tr>
								<td bgcolor='#FFFFFF' align='center' width='50%'>상품명</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>단가</td>
								<td bgcolor='#FFFFFF' align='center' width='10%'>수량</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>소계</td>
							</tr>
	";             

	$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$item_no = $ary["item_no"];
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		$status  = $ary["status"];
		$type = $ary["type"];
		$opt = $ary["opt"];
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
	$mailcontent .= "						
										<tr>
								<td bgcolor='#FFFFFF' width='50%'>
									$item_name
	";                			
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		$mailcontent .= ("
								<br>
										<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>옵션:
		");
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else {
			$opts_1[0] = $opts[0];
			$opts_1[1] = '';
		}		        		
		if($opts_1[0] != "")
			$mailcontent .= "$opts_1[0]";
		if($opts_1[1] != "")
			$mailcontent .= "($opts_1[1] 원)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
									</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$current_price_str 원</td>
								<td bgcolor='#FFFFFF' width='10%'>
									<p align='center'>$quantity</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$mon_tot_str 원</td>
							</tr>
  ");

	if($mon_tot >= $union_freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $union_freight_cost;

	$freight_fee_str = number_format($freight_fee);
	$mon_tot_freight = $mon_tot + $freight_fee;
	$mon_tot_freight_str = number_format($mon_tot_freight);

	$mailcontent .= ("
						<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>배송료</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$freight_fee_str 원</td>
							</tr>
							<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>합&nbsp;&nbsp; 
									계</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>
									$mon_tot_freight_str 원</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>배송지 정보</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>수령자</td>
						<td width='208' height='25' align='center'>
							<p align='left'>$receiver</td>
						<td width='125' height='25' align='center'></td>
						<td width='126' height='25' align='center'></td>
					</tr>
					<tr>
						<td width='562' height='1' align='center' colspan='4' bgcolor='#C0C0C0'>
						</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>연락처</td>
						<td width='210' height='25'>
							$rev_tel</td>
						<td width='126' height='25'>
							기타 연락처</td>
						<td width='127' height='25'>
							<p align='left'>$rev_tel1</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							주소</td>
						<td width='433' height='25' colspan='3'>
							$address&nbsp;&nbsp;$address_d</td>
					</tr>
					<tr>
						<td width='562' height='10' align='left' colspan='4'></td>
					</tr>
					<tr>
						<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>결제방법 및 금액</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							결제방법</td>
						<td width='155' height='25'>
							
							$paymethod_str
							
						</td>
						<td width='154' height='25'>
							금액</td>
						<td width='154' height='25'>
							$mon_tot_freight_str 원</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							입금자명</td>
						<td width='155' height='25'>
							$money_sender</td>
						<td width='154' height='25'>
							입금예정일</td>
						<td width='154' height='25'>
							$pay_day</td>
					</tr>
					<tr>
						<td width='562' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>요구 사항</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4'><br>
						$message</td>
					</tr>
					<tr>
						<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'>
							<p align='center'> 
							문의사항이 있으시면 전화 $shoptel1, <br>email:$shopemail 으로 연락주시기 바랍니다.
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
					</tr>
				</table>
				</center></div>
			</td>
			</tr>
		</table>
		</center></div>
	 </td>
</tr>
</table>
</body>
</html> 
	");
	mail($email, "주문하신 상품이 배송지로 출발하였습니다.", "$mailcontent", "From: $shopname 입니다.<$shopemail>\nContent-type: text/html");
	echo ("
	<script>
	alert(\"메일이 보내졌습니다.\");
	</script>
	");
}
if($email_flag == 'money_ok'){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$shopname = $ary["shopname"];
		$shopemail  = $ary["email"];
		$icash_id  = $ary["icash_id"];
		$shoptel1= $ary["tel1"];
	}
	$mailcontent = ("<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<title>입금이 확이되었습니다.</title>
<style type='text/css'>
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
</head>

<body topmargin='0' bgcolor='#FFFFFF' link='#B9B6BD' vlink='#B9B6BD' alink='#B9B6BD'>
<table border='0' width='750' cellspacing='0' cellpadding='0' height='100%'>
<tr>
	<td width='609' valign='top'>
		<div align='center'><center>
		
		<table border='0' width='571'>
			<tr>
			<td width='100%' height='15'></td>
			</tr>
			<tr>
			<td width='100%'>
				<div align='center'><center>
				<table border='0' width='540' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='536' bgcolor='#FFFFFF' colspan='4'>
							안녕하세요 $shopname 쇼핑몰입니다.<br>
							고객님이 주문하신 상품에 대해 입금확인이 완료되었습니다.<br>
									입금내역은 아래와 같습니다.<br>
							<br>
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>주문 내역</td>
					</tr>
					<tr>
						<td width='536' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif' colspan='4'></td>
					</tr>
	");          			

	$SQL = "select * from $Union_Order_BuyTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
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
		$money_sender = $ary["money_sender"];
	}
		
		
	if($paymethod == 'byonline') $paymethod_str = '온라인입금';
	if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '신용카드(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '계좌이체(TELEC)';
		
	if($account_no != 0){
		$SQL = "select * from $BankTable where account_no = $account_no and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];
		$bank_name = $ary["bank_name"];
		$bank_number = $ary["bank_number"];
		$owner_name = $ary["owner_name"];
	}
		
	$mailcontent .= "
							<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>주문번호</td>
						<td width='153' height='25' align='center'><p align='left'>
							$union_order_num</td>
						<td width='147' height='25' align='center'>
							<p align='left'>
							주문일시</td>
						<td width='159' height='25' align='center'>
							<p align='left'>
							$date_str</td>
					</tr>
					<tr>
						<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>주문자명</td>
						<td width='145' height='25'>
							$name</td>
						<td width='144' height='25'>
							연락처</td>
						<td width='144' height='25'>
							$tel1</td>
					</tr>
					<tr>
						<td width='532' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='532' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td align='center' colspan='4' bgcolor='#808080'>
							<table border='0' width='100%' cellspacing='1' cellpadding='3'>
							<tr>
								<td bgcolor='#FFFFFF' align='center' width='50%'>상품명</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>단가</td>
								<td bgcolor='#FFFFFF' align='center' width='10%'>수량</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>소계</td>
							</tr>
	";             

	$SQL = "select * from $Union_OrderTable where union_order_num='$union_order_num' and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$item_no = $ary["item_no"];
		$item_name = $ary["item_name"];
		$quantity = $ary["quantity"];
		$status  = $ary["status"];
		$type = $ary["type"];
		$opt = $ary["opt"];
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
	$mailcontent .= "						
										<tr>
								<td bgcolor='#FFFFFF' width='50%'>
									$item_name
	";                			
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
		$mailcontent .= ("
								<br>
										<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>옵션:
		");
		$opts = explode("!", $opt);
		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else {
			$opts_1[0] = $opts[0];
			$opts_1[1] = '';
		}		        		
		if($opts_1[0] != "")
			$mailcontent .= "$opts_1[0]";
		if($opts_1[1] != "")
			$mailcontent .= "($opts_1[1] 원)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
									</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$current_price_str 원</td>
								<td bgcolor='#FFFFFF' width='10%'>
									<p align='center'>$quantity</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$mon_tot_str 원</td>
							</tr>
  ");

	if($mon_tot >= $union_freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $union_freight_cost;

	$freight_fee_str = number_format($freight_fee);
	$mon_tot_freight = $mon_tot + $freight_fee;
	$mon_tot_freight_str = number_format($mon_tot_freight);

	$mailcontent .= ("
						<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>배송료</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$freight_fee_str 원</td>
							</tr>
							<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>합&nbsp;&nbsp; 
									계</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>
									$mon_tot_freight_str 원</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>배송지 정보</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>수령자</td>
						<td width='208' height='25' align='center'>
							<p align='left'>$receiver</td>
						<td width='125' height='25' align='center'></td>
						<td width='126' height='25' align='center'></td>
					</tr>
					<tr>
						<td width='562' height='1' align='center' colspan='4' bgcolor='#C0C0C0'>
						</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>연락처</td>
						<td width='210' height='25'>
							$rev_tel</td>
						<td width='126' height='25'>
							기타 연락처</td>
						<td width='127' height='25'>
							<p align='left'>$rev_tel1</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							주소</td>
						<td width='433' height='25' colspan='3'>
							$address&nbsp;&nbsp;$address_d</td>
					</tr>
					<tr>
						<td width='562' height='10' align='left' colspan='4'></td>
					</tr>
					<tr>
						<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>결제방법 및 금액</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							결제방법</td>
						<td width='155' height='25'>
							
							$paymethod_str
							
						</td>
						<td width='154' height='25'>
							금액</td>
						<td width='154' height='25'>
							$mon_tot_freight_str 원</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							입금자명</td>
						<td width='155' height='25'>
							$money_sender</td>
						<td width='154' height='25'>
							입금예정일</td>
						<td width='154' height='25'>
							$pay_day</td>
					</tr>
					<tr>
						<td width='562' height='10' align='left' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='562' height='2' align='left' colspan='4' bgcolor='#808080'></td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>요구 사항</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='562' height='25' align='left' colspan='4'><br>
						$message</td>
					</tr>
					<tr>
						<td width='536' height='10' align='center' colspan='4' bgcolor='#FFFFFF'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'>
							<p align='center'> 
							문의사항이 있으시면 전화 $shoptel1, <br>email:$shopemail 으로 연락주시기 바랍니다.
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#FFFFFF' height='11' colspan='4'></td>
					</tr>
				</table>
				</center></div>
			</td>
			</tr>
		</table>
		</center></div>
	 </td>
</tr>
</table>
</body>
</html> 
	");
	mail($email, "입금확인 되었습니다.", "$mailcontent", "From: $shopname 입니다.<$shopemail>\nContent-type: text/html");
	echo ("
	<script>
	alert(\"메일이 보내졌습니다.\");
	</script>
	");
}
?>
<?
mysql_close($dbconn);
?>