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
	
	//���ŷ� ������� ����.
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
	if(confirm("\n������ �����Ͻðٽ��ϱ�?\n\n�����Ͻø� ���ֹ��� ���õ� ����Ÿ��\n\n�����Ǹ� ������ �����ʽ��ϴ�.")){
		window.location.href='union_order_detail.php?flag=delete_data&union_order_num='+union_order_num;
		return true;
	}
	return false; 
}

function checkform(f){
	if(confirm("\n����ó�� �ֹ������� �����ðڽ��ϱ�?\n")){
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
			<!--���ʺκн���-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������� �⺻��������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

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
		
		
		if($paymethod == 'byonline') $paymethod_str = '�¶����Ա�';
		if($paymethod == 'bycard') $paymethod_str = '�ſ�ī��(ICASH)';
		if($paymethod == 'bytelec') $paymethod_str = '�ſ�ī��(TELEC)';
		if($paymethod == 'byaccount') $paymethod_str = '������ü(TELEC)';
		
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
			<td width="100%" bgcolor="#FFFFFF" height="40" align="center"><strong>[�ֹ���ȣ <?echo $union_order_num?>  | <?echo "$name($id)"?>���� �ֹ�����]
				<input onclick="receipt_win('<?echo $Mall_Admin_ID?>', '<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="������ ���"></strong>
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
										<td width="50%">&nbsp; <strong>�ֹ��� ���� </strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="name" size="18" value='<?echo $name?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">�̸���</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="email" size="28" value='<?echo $email?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">����ó</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="tel" size="18" value='<?echo $tel?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">��Ÿ����ó</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="tel1" size="18" value='<?echo $tel1?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�Ա��ڸ�</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="money_sender" size="18" value='<?echo $money_sender?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">�Աݿ�����</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="pay_day" size="18" value='<?echo $pay_day?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�ֹ��Ͻ�</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo $date_str?></td>
								<td width="12%" bgcolor="#FFFFFF" align="center"></td>
								<td width="22%" bgcolor="#FFFFFF" align="left"></td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�޸�</td>
								<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
									<p align="left">
									<textarea cols="51" name="message" rows="6" class="input_03" style="width:90%"><?echo $message?></textarea>
									</td>
							</tr>
							<tr>
								<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
								
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="50%">&nbsp; <strong>������ ���� </strong></td>
										<td width="50%"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan='3'>
									<input name="receiver" size="18" value='<?echo $receiver?>' class="input_03">
									</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">����ó</td>
								<td width="29%" bgcolor="#FFFFFF" align="left">
									<input name="rev_tel" size="18" value='<?echo $rev_tel?>' class="input_03">
									</td>
								<td width="12%" bgcolor="#FFFFFF" align="center">��Ÿ����ó</td>
								<td width="22%" bgcolor="#FFFFFF" align="left">
									<input name="rev_tel1" size="18" value='<?echo $rev_tel1?>' class="input_03">
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�����ȣ</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="zip" size="18" value='<?echo $zip?>' class="input_03">
								</td>
								</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�ּ�</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="address" size="50" value='<?echo $address?>' class="input_03">
								
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">���ּ�</td>
								<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
									<input name="address_d" size="50" value='<?echo $address_d?>' class="input_03">
								
								</td>
							</tr>
							<tr>
								<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
										<tr>
										<td width="100%">&nbsp; <strong>���� ���� </strong></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�������</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo $paymethod_str?></td>
								<td width="12%" bgcolor="#FFFFFF" align="center">��������</td>
								<td width="22%" bgcolor="#FFFFFF" align="center">
									<p align="left"><?echo "$bank_name $bank_number"?></td>
							</tr>
							<tr>
								<td width="12%" bgcolor="#FFFFFF" align="center">�����ȣ</td>
								<td width="29%" bgcolor="#FFFFFF" align="center">
									<p align="left"><input name="freight_code" size="18" value='<?echo $freight_code?>' class="input_03"></td>
								<td width="12%" bgcolor="#FFFFFF" align="center">����ó��</td>
								<td width="22%" bgcolor="#FFFFFF" align="center"><p align="left">
									
									<select name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
										if($status == 0) $status_str = "��û";
								if($status == 1) $status_str = "�ֹ�";
								if($status == 5) $status_str = "�ֹ����";
								if($status == 2) $status_str = "�Ա�Ȯ��";
								if($status == 6) $status_str = "�����";
								if($status == 3) $status_str = "��ۿϷ�";
								if($status == 7) $status_str = "��ȯ";
								if($status == 4) $status_str = "ȯ��";
					
								<option value="0"<?
										if($status == 0) echo " selected";
										?>
										>��û</option>
										<option value="1"<?
										if($status == 1) echo " selected";
										?>
										>�ֹ�</option>
										<option value="5"<?
										if($status == 5) echo " selected";
										?>
										>�ֹ����</option>
									<option value="2"<?
										if($status == 2) echo " selected";
										?>
										>�Ա�Ȯ��</option>
										<option value="6"<?
										if($status == 6) echo " selected";
										?>
										>�����</option>
										<option value="3"<?
										if($status == 3) echo " selected";
										?>
										>��ۿϷ�</option>
										<option value="7"<?
										if($status == 7) echo " selected";
										?>
										>��ȯ</option>
										<option value="4"<?
										if($status == 4) echo " selected";
										?>
										>ȯ��</option>
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
										<td width="100%">&nbsp; <strong>�ֹ� ����</strong></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="35%" bgcolor="#FFFFFF" align="center">��ǰ��</td>
								<td width="15%" bgcolor="#FFFFFF" align="center">����</td>
								<td width="25%" bgcolor="#FFFFFF" align="center">����</td>
								<td width="25%" bgcolor="#FFFFFF" align="center">�հ�</td>
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
									<img src='../images/optionbar.gif'>�ɼ�:
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
								<td width='25%' bgcolor='#FFFFFF'><p align='right'>$current_price_str ��</td>
								<td width='25%' bgcolor='#FFFFFF'><p align='right'>$mon_tot_str ��</td>
							</tr>
							");
							if($mon_tot >= $union_freight_limit) 
							$freight_fee = 0;
						else $freight_fee = $union_freight_cost;
						$mon_tot_freight = $mon_tot + $freight_fee;
						?>
							
							<tr>
								<td width="35%" bgcolor="#FFFFFF"><p align="center">��ۺ�</td>
								<td width="65%" bgcolor="#FFFFFF" align="center" colspan="3">
									<p align="right"><?echo number_format($freight_fee)?>��</td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#FFFFFF" colspan="4"><p align="right">���� 
									�Ѿ�: <?echo number_format($mon_tot_freight)?>��<br>
								
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
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="����">&nbsp;
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">&nbsp;
					<input onclick="window.location.href='union_order.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
					<input onclick="javascript:window.location.href='union_order_detail.php?union_order_num=<?echo $union_order_num?>&email_flag=send'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="��۽��۸���">
					<input onclick="javascript:window.location.href='union_order_detail.php?union_order_num=<?echo $union_order_num?>&email_flag=money_ok'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Ա�Ȯ�θ���">
					<input onclick="javascript:printWin('union_order_print.php?union_order_num=<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
					<input onclick="javascript:return really('<?echo $union_order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�ֹ����� ����">
			</td>
			</tr>
		</table>

<br>
			<!--���� END~~-->
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
<title>������ �ֹ��Ͻ� ��ǰ�� ������� ����Ͽ����ϴ�. </title>
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
							�ȳ��ϼ��� $shopname ���θ��Դϴ�.<br>
							������ �ֹ��Ͻ� ��ǰ�� ������� ����Ͽ����ϴ�. <br>
							��۱Ⱓ�� 1~3���̳��� �޾ƺ��� �� �ֽ��ϴ�.<br>
							<br>
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>�ֹ� ����</td>
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
		
		
	if($paymethod == 'byonline') $paymethod_str = '�¶����Ա�';
	if($paymethod == 'bycard') $paymethod_str = '�ſ�ī��(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '�ſ�ī��(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '������ü(TELEC)';
		
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
							<p align='left'>�ֹ���ȣ</td>
						<td width='153' height='25' align='center'><p align='left'>
							$union_order_num</td>
						<td width='147' height='25' align='center'>
							<p align='left'>
							�ֹ��Ͻ�</td>
						<td width='159' height='25' align='center'>
							<p align='left'>
							$date_str</td>
					</tr>
					<tr>
						<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>�ֹ��ڸ�</td>
						<td width='145' height='25'>
							$name</td>
						<td width='144' height='25'>
							����ó</td>
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
								<td bgcolor='#FFFFFF' align='center' width='50%'>��ǰ��</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>�ܰ�</td>
								<td bgcolor='#FFFFFF' align='center' width='10%'>����</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>�Ұ�</td>
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
										<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>�ɼ�:
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
			$mailcontent .= "($opts_1[1] ��)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
									</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$current_price_str ��</td>
								<td bgcolor='#FFFFFF' width='10%'>
									<p align='center'>$quantity</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$mon_tot_str ��</td>
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
									<p align='center'>��۷�</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$freight_fee_str ��</td>
							</tr>
							<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>��&nbsp;&nbsp; 
									��</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>
									$mon_tot_freight_str ��</td>
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
							<p style='padding-left: 10px'>����� ����</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>������</td>
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
							<p align='left'>����ó</td>
						<td width='210' height='25'>
							$rev_tel</td>
						<td width='126' height='25'>
							��Ÿ ����ó</td>
						<td width='127' height='25'>
							<p align='left'>$rev_tel1</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�ּ�</td>
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
							<p style='padding-left: 10px'>������� �� �ݾ�</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�������</td>
						<td width='155' height='25'>
							
							$paymethod_str
							
						</td>
						<td width='154' height='25'>
							�ݾ�</td>
						<td width='154' height='25'>
							$mon_tot_freight_str ��</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�Ա��ڸ�</td>
						<td width='155' height='25'>
							$money_sender</td>
						<td width='154' height='25'>
							�Աݿ�����</td>
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
							<p style='padding-left: 10px'>�䱸 ����</td>
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
							���ǻ����� �����ø� ��ȭ $shoptel1, <br>email:$shopemail ���� �����ֽñ� �ٶ��ϴ�.
							
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
	mail($email, "�ֹ��Ͻ� ��ǰ�� ������� ����Ͽ����ϴ�.", "$mailcontent", "From: $shopname �Դϴ�.<$shopemail>\nContent-type: text/html");
	echo ("
	<script>
	alert(\"������ ���������ϴ�.\");
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
<title>�Ա��� Ȯ�̵Ǿ����ϴ�.</title>
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
							�ȳ��ϼ��� $shopname ���θ��Դϴ�.<br>
							������ �ֹ��Ͻ� ��ǰ�� ���� �Ա�Ȯ���� �Ϸ�Ǿ����ϴ�.<br>
									�Աݳ����� �Ʒ��� �����ϴ�.<br>
							<br>
							
						</td>
					</tr>
					<tr>
						<td width='536' bgcolor='#808080' height='2' colspan='4'></td>
					</tr>
					<tr>
						<td width='536' align='left' height='25' colspan='4' bgcolor='#EFEFEF'>
							<p style='padding-left: 10px'>�ֹ� ����</td>
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
		
		
	if($paymethod == 'byonline') $paymethod_str = '�¶����Ա�';
	if($paymethod == 'bycard') $paymethod_str = '�ſ�ī��(ICASH)';
	if($paymethod == 'bytelec') $paymethod_str = '�ſ�ī��(TELEC)';
	if($paymethod == 'byaccount') $paymethod_str = '������ü(TELEC)';
		
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
							<p align='left'>�ֹ���ȣ</td>
						<td width='153' height='25' align='center'><p align='left'>
							$union_order_num</td>
						<td width='147' height='25' align='center'>
							<p align='left'>
							�ֹ��Ͻ�</td>
						<td width='159' height='25' align='center'>
							<p align='left'>
							$date_str</td>
					</tr>
					<tr>
						<td width='536' height='1' align='center' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>�ֹ��ڸ�</td>
						<td width='145' height='25'>
							$name</td>
						<td width='144' height='25'>
							����ó</td>
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
								<td bgcolor='#FFFFFF' align='center' width='50%'>��ǰ��</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>�ܰ�</td>
								<td bgcolor='#FFFFFF' align='center' width='10%'>����</td>
								<td bgcolor='#FFFFFF' align='center' width='20%'>�Ұ�</td>
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
										<img src='http://bluecart.co.kr/autocart/market/images/optionbar.gif'>�ɼ�:
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
			$mailcontent .= "($opts_1[1] ��)&nbsp;";
		if($opts[1] != "")
			$mailcontent .= "$opts[1]&nbsp;";
		if($opts[2] != "")
			$mailcontent .= "$opts[2]";
	}
	$mailcontent .= ("
									</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$current_price_str ��</td>
								<td bgcolor='#FFFFFF' width='10%'>
									<p align='center'>$quantity</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$mon_tot_str ��</td>
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
									<p align='center'>��۷�</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>$freight_fee_str ��</td>
							</tr>
							<tr>
								<td bgcolor='#FFFFFF' width='80%' colspan='3'>
									<p align='center'>��&nbsp;&nbsp; 
									��</td>
								<td bgcolor='#FFFFFF' width='20%'>
									<p align='right'>
									$mon_tot_freight_str ��</td>
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
							<p style='padding-left: 10px'>����� ����</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#EFEFEF' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='center'>
							<p align='left'>������</td>
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
							<p align='left'>����ó</td>
						<td width='210' height='25'>
							$rev_tel</td>
						<td width='126' height='25'>
							��Ÿ ����ó</td>
						<td width='127' height='25'>
							<p align='left'>$rev_tel1</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�ּ�</td>
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
							<p style='padding-left: 10px'>������� �� �ݾ�</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' background='http://bluecart.co.kr/autocart/market/images/left_dot.gif'>
							</td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�������</td>
						<td width='155' height='25'>
							
							$paymethod_str
							
						</td>
						<td width='154' height='25'>
							�ݾ�</td>
						<td width='154' height='25'>
							$mon_tot_freight_str ��</td>
					</tr>
					<tr>
						<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
					</tr>
					<tr>
						<td width='99' height='25' align='left'>
							�Ա��ڸ�</td>
						<td width='155' height='25'>
							$money_sender</td>
						<td width='154' height='25'>
							�Աݿ�����</td>
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
							<p style='padding-left: 10px'>�䱸 ����</td>
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
							���ǻ����� �����ø� ��ȭ $shoptel1, <br>email:$shopemail ���� �����ֽñ� �ٶ��ϴ�.
							
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
	mail($email, "�Ա�Ȯ�� �Ǿ����ϴ�.", "$mailcontent", "From: $shopname �Դϴ�.<$shopemail>\nContent-type: text/html");
	echo ("
	<script>
	alert(\"������ ���������ϴ�.\");
	</script>
	");
}
?>
<?
mysql_close($dbconn);
?>