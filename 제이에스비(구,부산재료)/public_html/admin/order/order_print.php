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
	if(confirm("\n������ �����Ͻðٽ��ϱ�?\n\n�����Ͻø� ���ֹ��� ���õ� ����Ÿ��\n\n�����Ǹ� ������ �����ʽ��ϴ�.")){
		window.location.href='order_detail.php?flag=delete_data&order_num='+order_num;
		return true;
	}
	return false; 
}
</script>
<!-- ���� ���� �����Ϳ� ���� ��ũ��Ʈ -->
<script language="JavaScript">  
function print_page(){  
	IEPrint.left = 0;  
	IEPrint.right = 0;  
	IEPrint.top = 0;  
	IEPrint.bottom = 0;  
	IEPrint.header = "";  
	IEPrint.footer = "";  
	IEPrint.printbg = true; // ���������� �޸� true, false�� �����Ѵ�.  
	IEPrint.landscape = false; // ���� ����� ���Ͻø� true�� ������ �˴ϴ�. ��������� false�Դϴ�.  
	IEPrint.print(); // ���� ������ ���� ���� �����ϰ�, ����Ʈ���̾�α׸� ���ϴ�.  
}  
print_page();  
</script>
<!-- ������ �κ� ��ũ��Ʈ �� -->
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
			$date_str = substr($date,0,4)."�� ".substr($date,5,2)."�� ".substr($date,8,2)."��";
		}

		//====================== ������� ���� ===========================================
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
			$paystr = "ī�����";
			$totpaystr = "ī����� �ݾ�";
		}
		if($paymethod== 'byaccount'||$paymethod== 'by_telec_account'||$paymethod== 'by_allthegate_account'||$paymethod== 'by_tg_account'||$paymethod== 'by_dacom_account'){
			$paystr = "������ü";
			$totpaystr = "������ü �ݾ�";
		}

		//====================== �¶��� �Աݽ� ���� ���� =================================
		if($paymethod== 'byonline'){
			if( $account_no ){
				$account_str ="( $bank_name $bank_number ������ : $owner_name )";
				$paystr = "�¶����Ա�";
				$totpaystr = "�¶��� �Ա� �ݾ�";
			}else{
				$account_str ="";
				$paystr = "";
				$totpaystr = "�¶��� �Ա� ��";
			}
		}

		if($paymethod== 'byonline_point'){
			if( $account_no ){
				$account_str ="( $bank_name $bank_number ������ : $owner_name )";
				$paystr = "�¶����Ա� + ����Ʈ����";
				$totpaystr = "�¶��� �Ա� �ݾ�";
			}else{
				$account_str ="";
				$paystr = "";
				$totpaystr = "�¶��� �Ա� ��";
			}
		}

		if($paymethod== 'bypoint'){
			$paystr = "����Ʈ����";
			$totpaystr = "���� �ݾ�";
		}

		if($status == 1) $status_str = "�ֹ�";
		if($status == 2) $status_str = "�Ա�Ȯ��";
		if($status == 3) $status_str = "��ۿϷ�";
		if($status == 4) $status_str = "ȯ��";
		if($status == 5) $status_str = "�ֹ����";
		if($status == 6) $status_str = "�����";
		if($status == 7) $status_str = "��ȯ";
		if($status == 8) $status_str = "<font color='red'>���ֹ����</font>";	
?>
		<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<p style="padding-left: 5px" align="center"><b><br>
        		<span class="cc">[�ֹ���ȣ <?=$order_num?> | <?="$name($id)"?>���� �ֹ�����]</span></b><br>
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
										<td width="50%">&nbsp; <b><span class="dd">�ֹ��� ���� </span></b></td>
										<td width="50%"></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$name?> <?if($id){?>(<?=$id?>)<?}?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�̸���</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$email?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">��ȭ</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$tel1?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�޴���</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$tel2?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�Ա��ڸ�</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$money_sender?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�Աݿ�����</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$pay_day?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�ֹ��Ͻ�</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$date_str?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center"></td>
                			<td width="22%" bgcolor="#FFFFFF" align="left">
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�޸�</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$message?></td>
              			</tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="50%">&nbsp; <b><span class="dd">������ ���� </span></b></td>
										<td width="50%"></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left"><?=$receiver?></td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">��ȭ</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$rev_tel?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�����ȣ</td>
                			<td width="29%" bgcolor="#FFFFFF" align="left">
                				<input name="zip" size="18" value='<?=$zip?>' style="border: 1px solid rgb(136,136,136)" class="aa">
                			</td>
                			<td width="12%" bgcolor="#FFFFFF" align="center">��Ÿ����ó</td>
                			<td width="22%" bgcolor="#FFFFFF" align="left"><?=$rev_tel1?></td>
                		</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�ּ�</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$address?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">���ּ�</td>
                			<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3"><?=$address_d?></td>
              			</tr>
              			<tr>
                			<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
                				<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%">&nbsp; <b><span class="dd">���� ���� </span></b></td>
									</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">�������</td>
                			<td bgcolor="#FFFFFF" align="left" colspan='3'><?=$paystr?> <?=$account_str?></td>
              			</tr>
              			<tr>
                			<td width="12%" bgcolor="#FFFFFF" align="center">����ó��</td>
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
                    				<td width="100%">&nbsp; <b><span class="dd">�ֹ� ����</span></b></td>
                  				</tr>
                				</table>
                			</td>
              			</tr>

						<tr bgcolor="#FFFFFF" align="center">
							<td width="29%">��ǰ��(����<?=$coupon_str?>)</td>
							<td width="6%">�� ��</td>
							<td width="19%">�� ��</td>
							<td width="12%">�� ��</td>
							<td width="9%">�� ��</td>
							<td width="13%">�����ȣ</td>
							<td width="10%">�ù�ȸ��</td>
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
	$item_code = $ary[item_code];
	$item_no = $ary[item_no];
	$opt=$ary[opt];
	$opt2=$ary[opt2];
	$opt3=$ary[opt3];
	$opt4=$ary[opt4];
	$opt_price = $ary[opt_price];
	$sql="select * from $ItemTable where item_no='$item_no'";
		$resultss=mysql_query($sql);
		$rss=mysql_fetch_array($resultss);
		$item_code=$rss[item_code];
	/*$opt_price2 = $ary[opt_price2];
	$opt_price3 = $ary[opt_price3];
	$opt_price4 = $ary[opt_price4];*/
	//�ɼ�1
	if($opt){
		$sql="select * from $OptionTable where opt_no='$opt'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		
		$opt_name=$rs[opt_name];
		
	}else{$opt_name="";}
	//�ɼ�2
	if($opt2){
		$sql="select * from $OptionTable2 where opt_no='$opt2'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		
		$opt_name2=$rs[opt_name];
		
	}else{$opt_name2="";}
	//�ɼ�3
	if($opt3){
		$sql="select * from $OptionTable3 where opt_no='$opt3'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		
		$opt_name3=$rs[opt_name];
		
	}else{$opt_name3="";}
	//�ɼ�4
	if($opt4){
		$sql="select * from $OptionTable4 where opt_no='$opt4'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		
		$opt_name4=$rs[opt_name];
		
	}else{$opt_name4="";}
	$z_price = $ary[z_price];
	if($opt_price>0){
		$z_price=$opt_price;
	}
	$coupon_used = $ary[coupon_used];
    $tax_price = $z_price * 0.1;
	$z_price = $z_price + $tax_price;


	$provider_id = $ary[provider_id];
	$z_price_str = number_format($z_price);
	$pro_freight_code = $ary[pro_freight_code];
	$pro_delivery = $ary[pro_delivery];
	$quantity = $ary[quantity];
	$good_status  = $ary[status];
	$bonus  = $ary[bonus]; 
	
	
	$sum = ($z_price * $quantity);
	$sum_str = number_format($sum);
	
	$bonus_sum = $bonus * $quantity;

	if($good_status == 1){
		$good_status_str = "�ֹ�";
	}else if($good_status == 2){
		$good_status_str = "�Ա�Ȯ��";
	}else if($good_status == 3){
		$good_status_str = "��ۿϷ�";
	}else if($good_status == 4){
		$good_status_str = "ȯ��";
	}else if($good_status == 5){
		$good_status_str = "�ֹ����";
	}else if($good_status == 6){
		$good_status_str = "�����";
	}else if($good_status == 7){
		$good_status_str = "��ȯ";
	}
	if($coupon_used == '1'){
		if($cpntype == '1'){
			$cpntype_str = ",����:$rate %";
		}
		if($cpntype == '2'){
			$cpntype_str = ",����:$rate ��";
		}
		if($cpntype == '3'){
			$cpntype_str = ",����ǰ:$rate";
		}	
	}else{
		$cpntype_str = '';
	}
	$mon_tot += $sum;
	$bonus_tot += $bonus_sum;
	if(($i > 0) &&($prev_status != $status)){
		$total_status = "Not Equal";
	}
	if(0<$bonus){
	$bonus_str="($bonus $cpntype_str)";
	}else{
	$bonus_str="";
	}
	echo ("
						<tr bgcolor='#FFFFFF'>
                			<input type='hidden' name='order_pro_no[]' value='$order_pro_no'>
                			<td>$item_name $bonus_str
	");
			 if($opt_name||$opt_name2||$opt_name3||$opt_name4){
										echo "�ɼ�";
										if($opt_name){
											echo $opt_name."-".$opt_price."��";
										}else{}
										if($opt_name2){
											echo $opt_name2."-".$opt_price2."��";
										}else{}
										if($opt_name3){
											echo $opt_name3."-".$opt_price3."��";
										}else{}
										if($opt_name4){
											echo $opt_name4."-".$opt_price4."��";
										}else{}
										}
?>
(<?=$item_code?>)
				    		</td>
                			<td align='center'><?=$quantity?></td>
                			<td align='center'><?=$z_price_str?>��<BR>(�ΰ���:<?=$tax_price?>������)</td>
                			<td align='center'><?=$sum_str?>��</td>
							<td align='center'><?=$good_status_str?></td>
							<td align='center'><?=$pro_freight_code?></td>
							<td align='center'><?=$pro_delivery?></td>
                		</tr>
<?
}
	
if($freight_fee == ''){
	if($mon_tot >= $freight_limit) 
		$freight_fee = 0;
	else $freight_fee = $freight_cost;
}
$mon_tot_freight = $mon_tot + $freight_fee;
?>
              			
              			<!-- <tr>
                			<td width="35%" bgcolor="#FFFFFF" align="center">��ۺ�</td>
                			<td width="65%" bgcolor="#FFFFFF" align="right" colspan="4">
                				<?=number_format($freight_fee)?>��
							</td>
              			</tr> -->
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan='7' align="right">�Ѿ�: <?=number_format($mon_tot_freight)?>��<br>
							<?if($freight_fee){?>
							��ۺ�:<?=$freight_fee?>������<BR>
							<?}?>
                			<?if($bonus){?>
							����Ʈ �Ѿ�: <?=number_format($bonus_tot)?>��<br>
							<?}?>
<?
	if($if_use_bonus == 1){
		echo ("
	����Ʈ ����Ѿ�: $use_bonus_tot_str ��<br>	
	$totpaystr	: $money_to_pay_str ��	
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
        		<input class="aa" style='cursor:hand' onclick="print_page();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�μ��ϱ�">&nbsp;<input class="aa" style='cursor:hand' onclick="self.close();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="â�ݱ�">
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