<?
//if (!headers_sent()) {
//Header("Cache-Control: No-Cache\n");
//Header("Pragma: No-Cache\n");
//Header("expires: now\n");
//}
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL1 = "select order_num from order_buy_temp2 where index_no='$index_no'";
$dbresult1 = mysql_query($SQL1, $dbconn);
$rows1 = mysql_fetch_array($dbresult1);
$order_num = $rows1[order_num];


$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$freight_limit = mysql_result($dbresult, 0, "freight_limit");
$freight_cost = mysql_result($dbresult, 0, "freight_cost");	
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	
$if_gnt_item = mysql_result($dbresult, 0, "if_gnt_item");	//0:�Ϲݻ��� 1:���޻��� 2:�ǸŻ���


$SQL = "select * from order_config where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$field1_text = $ary[field1_text];
	$field2_text = $ary[field2_text];
	$field3_text = $ary[field3_text];
	$field4_text = $ary[field4_text];
	$field5_text = $ary[field5_text];
}
if($update_flag == ''){
	include "../admin_head.php";
?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
	RemindWindow = window.open( "", "mainpage","toolbar=no,width=610,height=150,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}
function opensub(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  


// -->
</script>
<script>
function really(index_no){
	if(confirm("\n������ �����Ͻðٽ��ϱ�?\n\n�����Ͻø� ���ֹ��� ���õ� ����Ÿ��\n\n�����Ǹ� ������ �����ʽ��ϴ�.")){
		window.location.href='order_detail2.php?status_flag=<?=$status_flag?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&update_flag=delete_data&index_no='+index_no;
		return true;
	}
	return false; 
}

/*
function checkform(f){
	if(confirm("\n����ó�� �ֹ������� �����ðڽ��ϱ�?\n")){
		return true;
	}
	else
		return false; 
}
*/
</script>
<script language="JavaScript">  
/*function print_page(){  
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
print_page();*/

//////////////   print_form ��ũ����   //////////////
function printWindow(Type,Check){
	if (Check == 1){
		IEPrint.left	= 0;
		IEPrint.right	= 0;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}else{
		IEPrint.left	= 10;
		IEPrint.right	= 10;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}

	IEPrint.header		= "";
	IEPrint.footer		= "";
	IEPrint.printbg		= true;		// ���������� �޸� true, false�� �����Ѵ�.
	IEPrint.landscape	= Type;		// ���� ����� ���Ͻø� true�� ������ �˴ϴ�. ��������� false�Դϴ�.	
	IEPrint.print();				// ���� ������ ���� ���� �����ϰ�, ����Ʈ���̾�α׸� ���ϴ�.
}

function printDiv(type,check){
	if (document.all && window.print)
	{
		window.onbeforeprint	= beforeDivs;
		window.onafterprint		= afterDivs;
		printWindow(type,check);
	}
}
function beforeDivs () {
  if (document.all) {
    objContents.style.display = 'none';
    objSelection.innerHTML = document.all['d1'].innerHTML;
  }
}
function afterDivs () {
  if (document.all) {
    objContents.style.display = 'block';
    objSelection.innerHTML = "";
  }
}
</script>
<script>
function printWin(url){ 
	window.open(url, 'printWin', 'width=700,height=600,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
}	
function person_mail(email){
	window.open('person_mail_pop.php?email='+email, 'printWin', 'width=700,height=660,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
}
</script>
<script>

function order_update(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}


function send_to_provider(f){
	if(confirm("\n����ó�� �ֹ������� �����ðڽ��ϱ�?\n")){
		f.action='order_update.php';
		window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
		f.target='order_update_win';
		f.submit();
	}	
}

function add_memo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function add_mymemo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function add_secretmemo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function jaego_back(){
	var conf = confirm("�������� �����Ͻðڽ��ϱ�?");
	if(conf == true)
	window.open("order_update.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&update_flag=jaego_back&order_num=<?=$order_num?>","0x0","top=3000,left=3000,width=0,height=0");
}
function receipt_win(mart_id,order_num){
	var url = "../../market/receipt/receipt.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&mart_id="+mart_id+"&order_num="+order_num
	var uploadwin = window.open(url,"receipt","width=590,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}

function product_send_mail(order_num){
	var conf = confirm("����߸����� �����ðڽ��ϱ�?");
	if(conf == true)
	window.open("./product_send_mail.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&order_num="+order_num,"0x0","top=3000,left=3000,width=0,height=0");
}

function money_ok_mail(order_num){
	var conf = confirm("�Ա�Ȯ�θ����� �����ðڽ��ϱ�?");
	if(conf == true)
	window.open("./money_ok_mail.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&order_num="+order_num,"0x0","top=3000,left=3000,width=0,height=0");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<OBJECT ID="IEPrint" style="display:none" CLASSID="CLSID:F290B058-CB26-460E-B3D4-8F36AEEDBE44" 
codebase="../cab/IEPrint.cab#version=1,0,0,7"></OBJECT>
<DIV ID="objContents">
  <?  include '../inc/menu4.html'; ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�̿Ϸ��ֹ�</span> &gt; <span class="text_gray2_c">�̿Ϸ��ֹ� </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�̿Ϸ��ֹ� </b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>
			<span id="d1">
			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center" style="word-break:break-all">
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
<?
	$SQL = "select * from order_buy_temp2 where order_num='$order_num' and mart_id='$mart_id'";



	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$id = $ary[id];
		$name = $ary[name];
		$anonymity = $ary[anonymity];
		$passport1 = $ary[passport1];
		$passport2 = $ary[passport2];
		$tel1 = $ary[tel1];
		$tel2 = $ary[tel2];
		$email = $ary[email];
		$buyer_zip = $ary[buyer_zip];
		$buyer_address = $ary[buyer_address];
		$buyer_address_d = $ary[buyer_address_d];
		$receiver = $ary[receiver];
		$rev_tel = $ary[rev_tel];
		$rev_tel1 = $ary[rev_tel1];
		$zip = $ary[zip];
		$address = $ary[address];
		$message = nl2br($ary[message]);
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
		$date_str = $date;
		//$date_str = substr($date,0,4)."�� ".substr($date,5,2)."�� ".substr($date,8,2)."��";
		$if_use_bonus = $ary[if_use_bonus];
		$use_bonus_tot = $ary[use_bonus_tot];
		$partner = $ary[partner];
		$send_date = $ary[send_date];
		$keeper_message = $ary[keeper_message];
		$secret_message = $ary[secret_message];
		$jaego_back = $ary[jaego_back];
		$field1 = $ary[field1];
		$field2 = $ary[field2];
		$field3 = $ary[field3];
		$field4 = $ary[field4];
		$field5 = $ary[field5];
		$card_paid = $ary[card_paid];
		$field1 = $ary[field1];
		$authnumber = $ary[authnumber];
		$card_content = $ary[card_content];
		$occ_choice = $ary[occ_choice];
		$ment = $ary[ment];
		$send_name = $ary[send_name];
		$hope_date = $ary[hope_date];
		$hope_time = $ary[hope_time];
		$ampm = $ary[ampm];
		$hope_type = $ary[hope_type];
		
		if( !$id ){
			$id = "��ȸ��";
		}
	}

	//====================== ������� ���� ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$bank_sql = "select * from $BankTable where mart_id='$mart_id' and bank_name != '' and bank_number != '' and owner_name != ''";
		$bank_res = mysql_query($bank_sql, $dbconn);
		$bank_tot = mysql_num_rows($bank_res);
		$bank_str = "<select class='input_03' name='account_no'>";
		if($bank_tot > 0){
			$bank_str .= "<option value=''>�Ա��Ͻ� ����</option>";
			while($bank_row = mysql_fetch_array($bank_res))
			{
				//$account_no = $bank_row[account_no];
				$bank_name = $bank_row[bank_name];
				$bank_number = $bank_row[bank_number];
				$owner_name = $bank_row[owner_name];
				$selected = "";
				if($account_no == $bank_row[account_no])
					$selected = "selected";
				$bank_str .= "<option value='$bank_row[account_no]' $selected >$bank_name $bank_number ������ : $owner_name</option>";
			}
		}else{
			$bank_str .= "<option value='nobank'>�غ����Դϴ�.</option>";
		}
		$bank_str .= "</select>";
	}

	if($paymethod== 'bycard'){
		$paystr = "ī�����";
		$totpaystr = "ī����� �ݾ�";
	}
	if($paymethod== 'bycard_point'){
		$paystr = "ī����� + ����Ʈ����";
		$totpaystr = "ī����� �ݾ�";
	}
	if($paymethod== 'byaccount'){
		$paystr = "�ǽð�������ü";
		$totpaystr = "�ǽð�������ü �ݾ�";
	}
	if($paymethod== 'byaccount_point'){
		$paystr = "�ǽð�������ü + ����Ʈ����";
		$totpaystr = "�ǽð�������ü �ݾ�";
	}
	if($paymethod== 'kakao_pay'){
		$paystr = "īī������";
	}
	//====================== �¶��� �Աݽ� ���� ���� =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str = $bank_str;
			$paystr = "�������Ա�";
			$totpaystr = "�¶��� �Ա� �ݾ�";
		}else{
			$account_str = $bank_str;
			$paystr = "�������Ա�";
			$totpaystr = "�¶��� �Ա� �ݾ�";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�������Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�������Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա� �ݾ�";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "����Ʈ����";
		$totpaystr = "���� �ݾ�";
	}
?>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
					<b>[�ֹ���ȣ <?=$order_num?> | <?="$name($id)"?>���� �ֹ�����]
					
<?
	if($jaego_back == '0'){
?>
					
<?
	}else{
	}
?>	
					</b>
				</td>
			</tr>
				
<form method="POST">
<input type='hidden' name='update_flag' value='update_all'>
<input type='hidden' name='order_num' value='<?=$order_num?>'>
<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
<input type='hidden' name='email_flag' value=''>
<input type='hidden' name='status_old' value='<?=$status?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='keyset' value='<?=$keyset?>'>
<input type='hidden' name='searchword' value='<?=$searchword?>'>
<input type='hidden' name='flag' value='<?=$flag?>'>
<input type='hidden' name='cnfPagecount' value='<?=$cnfPagecount?>'>
<input type='hidden' name='QryFromDate' value='<?=$QryFromDate?>'>
<input type='hidden' name='QryToDate' value='<?=$QryToDate?>'>
<input type='hidden' name='status_flag' value='<?=$status_flag?>'>
								
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table border="0" width="95%">
						<tr>
							<td width="100%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan='7'>
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="100%">&nbsp; <b>�ֹ� ����</b></td>
											</tr>
										</table>
									</td>
								</tr>
<?
	if(!empty($mycoupon_id)){
		$coupon_str = ",������볻��";
	}	
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td width="29%">��ǰ��(����Ʈ<?=$coupon_str?>)</td>
									<td width="7%">�� ��</td>
									<td width="10%">�� ��</td>
									<td width="12%">�� ��</td>
									<td width="15%">�� ��</td>
								</tr>
<?
	$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' order by order_pro_no desc";
	//echo $SQL;
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$prev_status = "";
	$mon_tot = 0;
	$bonus_tot = 0;
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$order_pro_no = $ary[order_pro_no];
		$item_no = $ary[item_no];
		$item_name = $ary[item_name];
		$z_price = $ary[z_price];
		$coupon_used = $ary[coupon_used];
		$cpntype = $ary[cpntype];
		$rate = $ary[rate];
		$provider_id = $ary[provider_id];
		$pro_freight_code = $ary[pro_freight_code];
		$pro_delivery = $ary[pro_delivery];
		$priceKind=$ary[priceKind];
		$z_price_str = number_format($z_price);
		$quantity = $ary[quantity];
		
		$good_status  = $ary[status];
		$bonus  = $ary[bonus]; 
		$opt = $ary[opt];
		$opt2 = $ary[opt2];
		$opt3 = $ary[opt3];
		$opt4 = $ary[opt4];
		$opt5 = $ary[opt5];
		$opt6 = $ary[opt6];
		
		$opt_price = $ary[opt_price];
		$opt_price2 = $ary[opt_price2];
		$opt_price3 = $ary[opt_price3];
		$opt_price4 = $ary[opt_price4];
		$opt_price5 = $ary[opt_price5];
		$opt_price6 = $ary[opt_price6];
		//�ɼ� ���� �߰�
		//�ɼ�1
		if($opt){
			$sql="select * from $OptionTable where opt_no='$opt'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name=$rs[opt_name];
			
		}else{}
		//�ɼ�2
		if($opt2){
			$sql="select * from $OptionTable2 where opt_no='$opt2'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name2=$rs[opt_name];
			
		}else{}
		//�ɼ�3
		if($opt3){
			$sql="select * from $OptionTable3 where opt_no='$opt3'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name3=$rs[opt_name];
			
		}else{}
		//�ɼ�4
		if($opt4){
			$sql="select * from $OptionTable4 where opt_no='$opt4'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name4=$rs[opt_name];
			
		}else{}
		//�ɼ�5
		if($opt5){
			$sql="select * from $OptionTable5 where opt_no='$opt5'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name5=$rs[opt_name];
			
		}else{}
		//�ɼ�6
		if($opt6){
			$sql="select * from $OptionTable6 where opt_no='$opt6'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			
			$opt_name6=$rs[opt_name];
			
		}else{}
		
		$sum = ($z_price*$quantity)+(($opt_price+$opt_price2+$opt_price3+$opt_price4+$opt_price5+$opt_price6)*$quantity);
		$sum_str = number_format($sum);
	
		$bonus_sum = $bonus * $quantity;
		
		$mon_tot += $sum;
		$bonus_tot += $bonus_sum;
		if(($i > 0) &&($prev_status != $status)){
			$total_status = "Not Equal";
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

		//====================== ������ �⺻ ������ ������ ===============================
		$in_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$in_res = mysql_query($in_sql, $dbconn);
		$in_row = mysql_fetch_array($in_res);
		$me_delivery = $in_row[me_delivery];
		if( $in_res ){
			mysql_free_result( $in_res );
		}
?>
								<tr bgcolor='#FFFFFF'>
									<input type='hidden' name='order_pro_no[]' value='<?=$order_pro_no?>'>
									<input type='hidden' name='good_status_old[]' value='<?=$good_status?>'>
									<input type='hidden' name='provider_id[]' value='<?=$provider_id?>'>
									<?
									$cate_que = "select * from item where item_no='$item_no'";
									$cate_res = mysql_query($cate_que,$dbconn);
									$cate_rows = mysql_fetch_array($cate_res);
									?>
									<td>
									<table width="100%" cellpadding=0 cellspacing=0>
										<tr>
											<td>
											<a onClick="window.open('../good/item_edit_old.php?item_no=<?=$item_no?>&category_num=<?=$cate_rows[category_num]?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?>(<?=$bonus?><?=$cpntype_str?>) </a>
											</td>
											<td>
											<td align="right" valign="middle">
												<?
													if(isset($opt)&&$opt!=""){
												?>
												�ɼ�:
												<?=$optionNameArray[1]?>
												<?=$opt_name?>-<?=$opt_price?>��
												<?}?>
												<? if(isset($opt2)&&$opt2!=""){?><br>
												<?=$optionNameArray[2]?>
												<?=$opt_name2?>-<?=$opt_price2?>��
												<? }?>
												<? if(isset($opt3)&&$opt3!=""){?><br>
												<?=$optionNameArray[3]?>
												<?=$opt_name3?>-<?=$opt_price3?>��
												<? }?>
												<? if(isset($opt4)&&$opt4!=""){?><br>
												<?=$optionNameArray[4]?>
												<?=$opt_name4?>-<?=$opt_price4?>��
												<? }?>
												<? if(isset($opt5)&&$opt5!=""){?><br>
												<?=$optionNameArray[5]?>
												<?=$opt_name5?>-<?=$opt_price5?>��
												<? }?>
												<? if(isset($opt6)&&$opt6!=""){?><br>
												<?=$optionNameArray[6]?>
												<?=$opt_name6?>-<?=$opt_price6?>��
												<? }?>
												</span>
													</td>
											</td>
										</tr>
									</table>
									
									

									</td>
									<td align='center'><input name='quantity[]' size='3' value='<?=$quantity?>' style='border: 1px solid rgb(136,136,136)'></td>
									<td align='right'>
										<?=$priceKindArray[$priceKind]?><br>
										<?=$z_price_str?>��
									</td>
									<td align='right'><?=$sum_str?>��</td>
									<td align='center'>
					�̿Ϸ��ֹ�
									</td>
									
								</tr>
<?
	}

	if($freight_fee == ''){
		if($mon_tot >= $freight_limit){		// ��۷ἳ��
			$freight_fee = 0;
		}else{
			$freight_fee = $freight_cost;
		}
	}
	$mon_tot_freight = $mon_tot + $freight_fee;

	if($if_use_bonus == 1){
		$use_bonus_tot_str = number_format($use_bonus_tot);
		$money_to_pay = $mon_tot_freight - $use_bonus_tot;
		$money_to_pay_str = number_format($money_to_pay);
	}
?>
								
								<!-- <tr>
									<td width="35%" bgcolor="#FFFFFF"><p align="center">��ۺ�</td>
									<td width="65%" bgcolor="#FFFFFF" align="center" colspan="4">
										<p align="right"><?=number_format($freight_fee)?>��</td>
								</tr> -->
								<tr>
									<td width="100%" bgcolor="#FFFFFF" colspan='7'><p align="right"><b>
									<font color='#FF0000'>�Ѿ�: <?=number_format($mon_tot_freight)?> ��</font></b><br>
									
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
<?###################################################################Start ���ݿ����� ####################################################################
/*
$shop_sql2 = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$shop_res2 = mysql_query($shop_sql2, $dbconn);
if( mysql_num_rows($shop_res2) > 0 ){
	$row2 = mysql_fetch_array($shop_res2);
	$xpay_id = $row2[xpay_id];
	$xpay_key = $row2[xpay_key];
}

?>
<script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script>
<?
$LGD_HASHDATA = md5($xpay_id.$field1.$xpay_key);	
?>
<?
if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>									
	<input onclick="javascript:showCashReceipts('<?=$xpay_id?>','<?=$order_num?>','seqno','CR','service')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="���ݿ����� ���">
	
	<input onclick="javascript:window.open('../../market/cart/CashReceipt.html?order_num=<?=$order_num?>&mon_tot_freight=<?=$mon_tot_freight?>&item_name=<?=$item_name?>&mart_id=<?=$mart_id?>','','left=100,top=50,width=400,height=500,scrollbars=yes');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="���ݿ����� �߱�">
<?
}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
?>	
	<input onclick="javascript:showCashReceipts('<?=$xpay_id?>','<?=$order_num?>','seqno','BANK','service')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="���ݿ����� ���">
<?
}else{//ī�����
?>
	<input onclick="javascript:showReceiptByTID('<?=$xpay_id?>', '<?=$field1?>', '<?=$LGD_HASHDATA?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="ī����ǥ ���">
<?}
*/
?>
<?###################################################################End ���ݿ����� ####################################################################?>

					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="4">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
												<td width="50%">&nbsp; <b>�ֹ��� ���� </b></td>
												<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="name" size="25" value='<?=$name?>' class="input_03"> (<?=$id?>)
										<?php if($anonymity == 'y') echo '[�͸���]'; ?>
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">�̸���</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="email" size="25" value='<?=$email?>' class="input_03">&nbsp;<a href="#" onClick="person_mail('<?=$email?>');"><img src="./outlook.jpg" border="0" width="22" height="18" align="middle"></a>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">��ȭ</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="tel1" size="25" value='<?=$tel1?>' class="input_03">
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">�޴���</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="tel2" size="25" value='<?=$tel2?>' class="input_03">
										
								</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�ּ�</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										(<?=$buyer_zip?>) <?=$buyer_address?> &nbsp;<?=$buyer_address_d?>
									</td>
								</tr>								
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�ֹ��Ͻ�</td>
									<td width="29%" bgcolor="#FFFFFF" align="left" colspan='3'><?=$date_str?></td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�޸�</td>
									<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
										<p align="left">
										<?=$message?>
								  </td>
								</tr>								
								
								
								<tr>
									 <td align="middle" width="12%" bgColor="#ffffff">���ų���</td>
									 <td align="middle" width="63%" bgColor="#ffffff" colSpan="3"><p align="left">
									 <?
									 if($id!=''){
										$SQL = "select order_num,id from order_buy_temp2 where id='$id' and status='3' and mart_id='$mart_id'";//��ۿϷ�
													//echo "sql=$SQL";
													$dbresult = mysql_query($SQL, $dbconn);
													$numRows = mysql_num_rows($dbresult);
													$mon_tot = 0;
													for($i=0;$i<$numRows;$i++){
														$order_num_tmp = mysql_result($dbresult,$i,0);
														$id_tmp = mysql_result($dbresult,$i,1);
														
														$SQL1 = "select z_price,quantity,opt_price,opt_price2,opt_price3,opt_price4 from $Order_ProTable where order_num='$order_num_tmp' and mart_id='$mart_id' order by order_pro_no desc";
														//echo "sql1=$SQL1";
														$dbresult1 = mysql_query($SQL1, $dbconn);
														$numRows1 = mysql_num_rows($dbresult1);
														for($j=0;$j<$numRows1;$j++){
															$z_price = mysql_result($dbresult1,$j,0);
															$quantity = mysql_result($dbresult1,$j,1);

															$opt_price =  mysql_result($dbresult1,$j,2);
															$opt_price2 = mysql_result($dbresult1,$j,3);
															$opt_price3 = mysql_result($dbresult1,$j,4);
															$opt_price4 = mysql_result($dbresult1,$j,5);


															$sum = ($z_price+$opt_price+$opt_price2+$opt_price3+$opt_price4)*$quantity;
															$mon_tot += $sum;
														}
													}
													$mon_tot_str = number_format($mon_tot);
													if($numRows > 0){
														?>
														<a href="javascript:opensub('../member/mem_order_list.php?username=<?=$id_tmp?>', 620, 500)">�ֹ�Ƚ�� <?=$numRows?> ��, ���ֹ��ݾ� <?=$mon_tot_str?> ��</a>(�����ֹ������� ��ۿϷ����)
														<?
													}
													else{
														echo "
												���ų����� �����ϴ�.
														";
													}
												}				
												else{//��ȸ��
													$SQL0 = "select order_num from order_buy_temp2 where status='3' and mart_id='$mart_id' ";
													
													if(!empty($passport1)&&!empty($passport1))
														$SQL1 = "(passport1='$passport1' and passport2='$passport2')";
													else $SQL1 = "(passport1='my!!@passport' and passport2='my!!@passport')";
													
													if(!empty($email))
														$SQL2 = "email='$email'";
													else $SQL2 = "email='my!!@email123'";
													
													if(!empty($tel1))
														$SQL3 = "tel1='$tel1'";
													else $SQL3 = "tel1='my!!@tel123'";
													
													if(!empty($tel2))
														$SQL4 = "tel2='$tel2'";
													else $SQL4 = "tel2='my!!@tel123'";
													
													$SQL = $SQL0.' and ('.$SQL1.' or '.$SQL2.' or '.$SQL3.' or '.$SQL4.')';
													//if($Mall_Admin_ID == 'test1')
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
														�ֹ�Ƚ�� $numRows ��, ���ֹ��ݾ� $mon_tot_str ��(��ۿϷ����)
														";
													}
													else{
														echo "
												���ų����� �����ϴ�.
														";
													}
												}	
												?>
									</td>
								  </tr>
								<tr>
									<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
									
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <b>������ ���� </b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<!--
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="receiver" size="25" value='<?=$receiver?>' class="input_03">
										</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">��ȭ</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="rev_tel" size="25" value='<?=$rev_tel?>' class="input_03">
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�����ȣ</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="zip" size="25" value='<?=$zip?>' class="input_03">
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">��Ÿ����ó</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="rev_tel1" size="25" value='<?=$rev_tel1?>' class="input_03">
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�ּ�</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<input name="address" size="50" value='<?=$address?>' class="input_03">
									
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">���ּ�</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<input name="address_d" size="50" value='<?=$address_d?>' class="input_03">
									
									<a href='add_print.php?order_num=<?=$order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
									</td>
								</tr>
								//-->
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�̸�</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<?=$receiver?>
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">��ȭ</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<?=$rev_tel?>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�����ȣ</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<?=$zip?>
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">��Ÿ����ó</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<?=$rev_tel1?>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�ּ�</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<?="$address &nbsp;$address_d"?>
								
									&nbsp;<a href='add_print.php?order_num=<?=$order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">���޸޼���</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<table width="100%" cellpadding="0" cellspacing="0">
											<tr>
												<td width="20%">ī�帮������</td>
												<td><?=$occChoiceArray[$occ_choice]?></td>
											</tr>
											<?
												if($occ_choice=="card"||$occ_choice=="card+ribon"){
											?>
											<tr>
												<td>ī��޼���</td>
												<td><?=$card_content?></td>
											</tr>
											<? }
											if($occ_choice=="ribon"||$occ_choice=="card+ribon"){
											?>
											<tr>
												<td>�������</td>
												<td><?=$ment?></td>
											</tr>
											<tr>
												<td>������ ��</td>
												<td><?=$send_name?></td>
											</tr>
											<? }?>
										</table>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">��������</td>
									<td width="29%" bgcolor="#FFFFFF" align="left" colspan=3>
										<?=$hope_date?> <?=$ampm." ".$hope_time." ".$hope_type?>
									</td>

								</tr>								
								<tr>
									<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
										
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="100%">&nbsp; <b>���� ���� </b></td>
											</tr>
										</table>
									</td>
								</tr>
<?
if($if_use_bonus == 1){
	$use_bonus_tot_str = number_format($use_bonus_tot);
	//���� �����ؾߵ� �ݾ� 
	$money_to_pay = $mon_tot_freight - $use_bonus_tot;
	$money_to_pay_str = number_format($money_to_pay);
	/*
	if( !empty($paystr) ){
		$paystr = $paystr." + ����Ʈ ���";
	}else{
		$paystr = "����Ʈ ���";
	}*/
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td>����Ʈ ���</td>
									<td align="left"><?=$use_bonus_tot_str?>��</td>
									<td><?=$totpaystr?></td>
									<td align="left"><?=$money_to_pay_str?>��</td>
								</tr>
<?
}

if($paymethod=="bycard" || $paymethod=="bycard_point")
{
	if($field2 == "00")
		$field2 = "�Ͻú�";

	$pay_info_str = "���ι�ȣ : ".$authnumber."<br>";
	//$pay_info_str .= "DACOM �ŷ���ȣ : ".$field1."<br>";
	$pay_info_str .= "ī��� : ".$field3."<br>";
	$pay_info_str .= "�Һ� : ".$field2;
	if($card_paid == 'f')
		$pay_info_str = $field5;
}else if($paymethod=="byaccount" || $paymethod=="byaccount_point")
{
	$pay_info_str = "����� : ".$field3;
	if($card_paid == 'f')
		$pay_info_str = $field5;
}else if($paymethod=="byonline")
{
	$paystr = "";
}
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td>�������</td>
									<td align="left" ><?=$paystr?> <?=$account_str?></td>
									<td>��������</td>
									<td align="left" ><?=$pay_info_str?></td>
								</tr>
<?
if($paymethod=="byonline" ||$paymethod=="byonline_point")
{
?>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">�Ա��ڸ�</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="money_sender" size="25" value='<?=$money_sender?>' class="input_03">
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">�Աݿ�����</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="pay_day" size="25" value='<?=$pay_day?>' class="input_03">
								  </td>
								</tr>
<?
}
?>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">����ó��</td>
									<td colspan='3' bgcolor="#FFFFFF">
�̿Ϸ��ֹ�
									</td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
					<?
					/*
					?>
					<p align="center">
					<input onClick="javascript:order_update(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�">
					<input onClick="javascript:window.location.href='order_new2.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
					<input onClick="javascript:product_send_mail('<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����߸���">
					<input onClick="javascript:money_ok_mail('<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Ա�Ȯ�θ���">
					<input onClick="javascript:printWin('order_print.php?order_num=<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ">
					<!-- <input onclick="printDiv('false','');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ"> -->
					<input onClick="javascript:return really('<?=$index_no?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�ֹ����� ����">
					</p>
					<?
					*/	
					?>
				</td>
				</tr>
			</form>
			</table>
			</span>
			

<?
if($if_gnt_item == '2' && $numRows > 0){

	$content = '';
	$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id='$provider_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows1 = mysql_num_rows($dbresult);
	if($numRows1>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$content = $ary[content];
	}

?>

	<?
	}
	?>
<?
	if($if_gnt_item == '2' && $numRows > 0){
	
		$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id=''";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows1 = mysql_num_rows($dbresult);
		if($numRows1>0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$content1 = $ary[content];
		}
	
	?>	
			  
<?
	}else{
?>

			
		</td>
	</tr>
  </table>

<?
	}
?>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</DIV>
<DIV ID="objSelection">

</DIV>
</form>
</body>
</html>
<?
}
if($update_flag == "delete_data"){

$SQL1 = "select order_num from order_buy_temp2 where index_no='$index_no'";
$dbresult1 = mysql_query($SQL1, $dbconn);
$rows1 = mysql_fetch_array($dbresult1);
$order_num = $rows1[order_num];
	
	$id = '';
	$status = '';
	//������ id �˾Ƴ���
	$SQL = "select id,status from order_buy_temp2 where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$id = mysql_result($dbresult,0,0);
		$status = mysql_result($dbresult,0,1);
	}
	
	if(!empty($id)&&$status=='3'){
		//�����Ѿ׺���
		$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
				
		$order_num_tmp = $order_num[$i];
		$sum_total = 0;
		for ($i=0; $i<$numRows; $i++) {
			mysql_data_seek($dbresult,$i);
			$ary = mysql_fetch_array($dbresult);
			$z_price_tmp = $ary[z_price];
			$quantity_tmp = $ary[quantity];
			$sum_tmp = $z_price_tmp * $quantity_tmp;
			$sum_total += $sum_tmp;
		}
		$SQL = "update $Mart_Member_NewTable set money_total = money_total - $sum_total 
		where username='$id' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	$sql="select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id'";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt=$rs[opt];
		$opt2=$rs[opt2];
		$opt3=$rs[opt3];
		$opt4=$rs[opt4];
		$item_no2=$rs[item_no];
		$sql="select if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4 from $ItemTable where item_no='$item_no2'";
		$result2=mysql_query($sql);
		$rs2=mysql_fetch_array($result2);
		$if_opt_jaego=$rs2[if_opt_jaego];
		$if_opt_jaego2=$rs2[if_opt_jaego2];
		$if_opt_jaego3=$rs2[if_opt_jaego3];
		$if_opt_jaego4=$rs2[if_opt_jaego4];
		$quantity=$rs[quantity];
		if($status_old == '5'||$status_old=="4"||$status_old=="10"){
			if($if_opt_jaego&&$opt){
				$sql="update $OptionTable set opt_ea=opt_ea+$quantity where opt_no='$opt'";
				mysql_query($sql);
			}
			if($if_opt_jaego2&&$opt2){
				$sql="update $OptionTable2 set opt_ea=opt_ea+$quantity where opt_no='$opt2'";
				mysql_query($sql);
			}
			if($if_opt_jaego3&&$opt3){
				$sql="update $OptionTable3 set opt_ea=opt_ea+$quantity where opt_no='$opt3'";
				mysql_query($sql);
			}
			if($if_opt_jaego4&&$opt4){
				$sql="update $OptionTable4 set opt_ea=opt_ea+$quantity where opt_no='$opt4'";
				mysql_query($sql);
			}
		}
	}
	
	$SQL = "delete from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update order_buy_temp2 set status='9' where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//����� ���ʽ� ����
	$SQL = "select id, use_bonus_tot from order_buy_temp2 where order_num = '$order_num' and mart_id='$mart_id'";;
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	$SQL1 = "select * from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	
	if($numRows > 0 &&$numRows1>0){
		$id = mysql_result($dbresult,0,0);
		$use_bonus_tot = mysql_result($dbresult,0,1);
		
		if(!empty($id)&&!empty($use_bonus_tot)){
			//ȸ�����̺��� ���ʽ� �Ѿ� ����
			$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//���ʽ� ���̺��� ����
			$SQL = "delete from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
		}	
	}
	
	//������ ���ʽ����� ����
	$SQL = "select id,bonus from $BonusTable where order_num ='$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$bonus_total = 0;
	for ($i=0; $i<$numRows; $i++) {
		$id = mysql_result($dbresult,$i,0);
		$bonus = mysql_result($dbresult,$i,1);
		$bonus_total += $bonus;
	}
	if(!empty($id)){		
		$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total-$bonus_total where username='$id' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	
	$SQL = "delete from $BonusTable where order_num='$order_num' and bonus>0 and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
						
	echo "<meta http-equiv='refresh' content='0; URL=order_new2.php?page=$page&keyset=$keyset&searchword=$searchword&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>";
	
}
?>
<?
mysql_close($dbconn);
?>
