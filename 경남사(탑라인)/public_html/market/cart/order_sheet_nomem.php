<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

include( '../include/getmartinfo.php' );

$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('�̵�� ���θ��Դϴ�.');
		history.go(-1);
	</script>
	");
	exit;
}

$SQL = "select * from order_config where mart_id ='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$buyer_name_use = $ary["buyer_name_use"];
	$buyer_passport_nomem_use = $ary["buyer_passport_use"];
	$buyer_email_use = $ary["buyer_email_use"];
	$buyer_tel_use = $ary["buyer_tel_use"];
	$buyer_tel1_use = $ary["buyer_tel1_use"];
	$buyer_zip_use = $ary["buyer_zip_use"];
	$buyer_address_use = $ary["buyer_address_use"];
	$receiver_use = $ary["receiver_use"];
	$rev_tel_use = $ary["rev_tel_use"];
	$rev_tel1_use = $ary["rev_tel1_use"];
	$zip_use = $ary["zip_use"];
	$address_use = $ary["address_use"];
	$money_sender_use = $ary["money_sender_use"];
	$pay_day_use = $ary["pay_day_use"];
	$field1_text = $ary["field1_text"];
	$field1_use = $ary["field1_use"];
	$field2_text = $ary["field2_text"];
	$field2_use = $ary["field2_use"];
	$field3_text = $ary["field3_text"];
	$field3_use = $ary["field3_use"];
	$field4_text = $ary["field4_text"];
	$field4_use = $ary["field4_use"];
	$field5_text = $ary["field5_text"];
	$field5_use = $ary["field5_use"];
}
if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>
<SCRIPT language=JavaScript>
	function Svalue(sarray) { return sarray.options[sarray.selectedIndex].value }
	var MSIE, VERSION;
	
	MSIE = navigator.userAgent.indexOf('MSIE') == -1;
	VERSION = navigator.userAgent.substring(8,12);
	
	function Tcheck(target, cmt, astr, lmin, lmax)
	{
		var i
		var t = target.value
	
		if (t.length < lmin || t.length > lmax) {
			if (lmin == lmax) alert(cmt + '�� ' + lmin + ' �� �̾�� �մϴ�.');
				 else alert(cmt + '�� ' + lmin + ' ~ ' + lmax + ' �� �̳��� ���� �� ���ڷ� �Է��ϼ���.');
			target.focus()
			return true
		}
		if (astr.length > 1) {
		        for (i=0; i<t.length; i++)
		                if(astr.indexOf(t.substring(i,i+1))<0) {
					alert(cmt + '�� ����� �� ���� ���ڰ� �ԷµǾ����ϴ�');
					target.focus()
					return true
				}
		}
	        return false
		
	}
		
	function Jumin_chk(it) {
		IDtot = 0;
		IDAdd = "234567892345";
	
		for(i=0; i<12; i++) IDtot = IDtot + parseInt(it.substring(i, i+1)) * parseInt(IDAdd.substring(i, i+1));
		IDtot = 11 - (IDtot%11);
		if (IDtot == 10) IDtot = 0;
		else if (IDtot == 11) IDtot = 1;
	
		if(parseInt(it.substring(12, 13)) != IDtot) return true;
		else return false
	} 
	
	function Eaddcheck(target, cmt)
	{
		var i
		var t = target.value
	
		if (t.length > 1) {
		        for (i=0; i<t.length; i++)
		                if(t.substring(i,i+1) == '@') {
					return false;
				}
		}
	        	alert(cmt + '�� ��Ȯ�� �Է��Ͽ� �ֽʽÿ�.');
		target.focus()
		return true	
	}
		
		
function checkform(form){

var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'

var Digit = '1234567890'
 
	<?
	if($buyer_name_use == 0){
	?>	
	if (form.name.value==""){
		alert("\n�����Ͻ� ���� �̸��� �Է��ϼ���.");
		form.name.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($buyer_passport_nomem_use == 0){
	?>
  
	if (form.passport1.value==""){
	  	alert("�����Ͻ� ���� �ֹε�Ϲ�ȣ ���ڸ��� �Է��ϼ���.");
	  	form.passport1.focus();  
	  	return false;
	}
	else{
		var len =form.passport1.value.length;
	  	var ret;
	  	ret =false;  
	  	for(var i=0;i<len;i++){  
	      	var ch = form.passport1.value.substring(i,i+1);
      
	   		for (var k=0;k<=Digit.length;k++){    
	    		if(Digit.substring(k,k+1) == ch)
	    		{     
	     			ret = true;
	     			break;     
	    		}
			} 
    
	   		if (!ret){
	     		alert("���ڸ� �Է� �ϼ���");
	     		form.passport1.focus();
	     		return false;
	   		} 
	   		ret = false;
		}
 	}
	
	if (form.passport2.value==""){
	  	alert("\n�����Ͻ� ���� �ֹε�Ϲ�ȣ ���ڸ��� �Է��ϼ���.");
	  	form.passport2.focus();  
	  	return false;
	}
	else{
	  	var len =form.passport2.value.length;
	  	var ret;
	  	ret =false;  
  
	  	for(var i=0;i<len;i++){  
	      	var ch = form.passport2.value.substring(i,i+1);
	   		
	   		for (var k=0;k<=Digit.length;k++){     		
	    		if(Digit.substring(k,k+1) == ch)
	    		{
	     			ret = true
	     			break;
	    		}
	   		} 
	   		if (!ret){     
	     		alert("���ڸ� �Է� �ϼ���");
	     		form.passport2.focus();
	     		return false;
	   		} 
	   		ret = false;
	  	}
	}
	
	 if (form.passport1.value.length != 6 || form.passport2.value.length != 7){
	  	alert("��ȿ�� �ֹι�ȣ�� �Է� �ϼ���");
	  	form.passport2.focus();
	  	return false;
	 }

	var jumin;
	jumin = form.passport1.value + form.passport2.value;

	if(Jumin_chk(jumin)){
		alert("�ֹε�Ϲ�ȣ�� Ʋ���ϴ�.");	
		return false;	
	} 
	
	<?
	}
	?>
	
	<?
	if($buyer_email_use == 0){
	?>
	if (form.email.value==""){
		alert("\n�����Ͻ� ���� �̸����ּҸ� �Է��ϼ���.");
		form.email.focus();
		return false;
	}
	var emailchk;
	emailchk = 0;

    if (form.email.value !=""){
        for (var j=0; j < form.email.value.length ; j++ ) {
    		var ch= form.email.value.substring(j,j+1)
            if (ch == "@" | ch== "." ){
     			emailchk = emailchk + 1;
         	}
        }
        if (emailchk < 2 ){
         	alert("��ȿ�� ���ڿ��� �Է��ϼ���!");
		 	form.email.focus(); 
		 	return false;
        }
    } 
	<?
	}
	?>
	
	<?
	if($buyer_tel_use == 0){
	?>	
	if (form.buyer_tel.value==""){
		alert("\n�����Ͻ� ���� ����ó�� �Է��ϼ���.");
		form.buyer_tel.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($buyer_tel1_use == 0){
	?>	
	if (form.buyer_tel1.value==""){
		alert("\n�����Ͻ� ���� �ڵ�����ȣ�� �Է��ϼ���.");
		form.buyer_tel1.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($buyer_zip_use == 0){
	?>
	if (form.buyer_zip.value==""){
		alert("\n�����Ͻ� ���� �����ȣ�� �Է��ϼ���.");
		form.buyer_zip.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($buyer_address_use == 0){
	?>
	if (form.buyer_address.value==""){
		alert("\n�����Ͻ� ���� �ּҸ� �Է��ϼ���.");
		form.buyer_address.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($receiver_use == 0){
	?>
	
	if (form.receiver.value==""){
		alert("\n������ �̸��� �Է��ϼ���.");
		form.receiver.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($rev_tel_use == 0){
	?>
	
	if (form.rev_tel.value==""){
		alert("\n����Ͻ� ���� ����ó�� �Է��ϼ���.");
		form.rev_tel.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($rev_tel1_use == 0){
	?>
	if (form.rev_tel1.value==""){
		alert("\n����Ͻ� ���� ��Ÿ ����ó�� �Է��ϼ���.");
		form.rev_tel1.focus();
		return false;
	}
	<?
	}	
	?>
	
	<?
	if($zip_use == 0){
	?>
	if (form.zip.value==""){
		alert("\n����Ͻ� ���� �����ȣ�� �Է��ϼ���.\n\n'�����ȣ �˻�'���� ���� ã�� �� �ֽ��ϴ�.");
		form.zip.focus();
		return false;
	}
	<?
	}	
	?>
	/*
	if (form.zip.value==""){
		alert("\n����Ͻ� ���� �����ȣ�� �Է��ϼ���.\n'�����ȣ �˻�'���� ���� ã�� �� �ֽ��ϴ�.");
		form.zip.focus();
		return false;
	}
	*/
	<?
	if($address_use == 0){
	?>
	if (form.address.value==""){
		alert("\n����Ͻ� ���� �ּҸ� �Է��ϼ���.");
		form.address.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if($money_sender_use == 0){
	?>
	if(form.paymethod.length > 1){
		if(form.paymethod[0].checked) {
			if (form.money_sender.value==""){
				alert("\n�Ա��ڸ��� �Է��ϼ���.");
				form.money_sender.focus();
				return false;
			}
		}
	}	  
	else{
		if(form.paymethod.checked) {
			if (form.money_sender.value==""){
				alert("\n�Ա��ڸ��� �Է��ϼ���.");
				form.money_sender.focus();
				return false;
			}
		}
	}
	<?
	}
	?>
	<?
	if($pay_day_use == 0){
	?>
	if(form.paymethod.length > 1){
		if(form.paymethod[0].checked) {
			if (form.pay_day.value==""){
				alert("\n�Աݿ������� �Է��ϼ���.");
				form.pay_day.focus();
				return false;
			}
		}
	}	  
	else{
		if(form.paymethod.checked) {
			if (form.pay_day.value==""){
				alert("\n�Աݿ������� �Է��ϼ���.");
				form.pay_day.focus();
				return false;
			}
		}
	}
	<?
	}
	?>
	
	<?
	if(!empty($field1_text) && $field1_use == 0){
	?>
	if (form.field1.value==""){
		alert("\n<?=$field1_text?>��/�� �Է��ϼ���.");
		form.field1.focus();
		return false;
	}
	<?
	}
	?>
	  
  <?
	if(!empty($field2_text) && $field2_use == 0){
	?>
	if (form.field2.value==""){
		alert("\n<?=$field2_text?>��/�� �Է��ϼ���.");
		form.field2.focus();
		return false;
	}
	<?
	}
	?>
	        		
	<?
	if(!empty($field3_text) && $field3_use == 0){
	?>
	if (form.field3.value==""){
		alert("\n<?=$field3_text?>��/�� �Է��ϼ���.");
		form.field3.focus();
		return false;
	}
	<?
	}
	?>
	        		
	<?
	if(!empty($field4_text) && $field4_use == 0){
	?>
	if (form.field4.value==""){
		alert("\n<?=$field4_text?>��/�� �Է��ϼ���.");
		form.field4.focus();
		return false;
	}
	<?
	}
	?>
	
	<?
	if(!empty($field5_text) && $field5_use == 0){
	?>
	if (form.field5.value==""){
		alert("\n<?=$field5_text?>��/�� �Է��ϼ���.");
		form.field5.focus();
		return false;
	}
	<?
	}
	?>
	
	/*
	if (form.address_d.value==""){
		alert("\n����Ͻ� ���� ���ּҸ� �Է��ϼ���.");
		form.address_d.focus();
		return false;
	}
	*/
  if(form.paymethod.length > 1){
		if(form.paymethod[0].checked) {
			if(form.account_no.value=="") {
			    alert("\n�¶��� ������ �����ϼ̽��ϴ�.\n\n�ݵ�� �Ա������� �����ϼ���.");
			    form.account_no.focus();
			    return false;
			}
			if(form.account_no.value=="nobank") {
			    alert("\n�������� �˼��մϴ�.\n\n�¶��� ������ �غ���� �ʾҽ��ϴ�.\n\n���� �ð����� �غ��ϰڽ��ϴ�.");
			    // form.bank.focus();
			    return false;
			}
		}
	}	  
	else{
		if(form.paymethod.checked) {
			if(form.account_no.value=="") {
			    alert("\n�¶��� ������ �����ϼ̽��ϴ�.\n\n�ݵ�� �Ա������� �����ϼ���.");
			    form.account_no.focus();
			    return false;
			}
			if(form.account_no.value=="nobank") {
			    alert("\n�������� �˼��մϴ�.\n\n�¶��� ������ �غ���� �ʾҽ��ϴ�.\n\n���� �ð����� �غ��ϰڽ��ϴ�.");
			    // form.bank.focus();
			    return false;
			}
		}
	}
	
	return true;
}

	
function find_zip()
{
   	var Sel = window.open ( '../member/find_zip.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}
function buyer_find_zip()
{
   	var Sel = window.open ( '../member/find_zip.php?flag=buyer', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}

function check()
{
    var str = document.f.passport1.value.length;
    if(str == 6) {
       document.f.passport2.focus();
    }
	
} 
	
function check1()
{
    var str = document.f.passport2.value.length;
    if(str == 7) {
       document.f.email.focus();
       
	}   	
}

function val_sel(f){
	<?
	if($buyer_name_use < 2 && $receiver_use < 2){
	?>
	f.receiver.value = f.name.value;
	<?
	}
	?>
	
	<?
	if($buyer_address_use < 2 && $address_use < 2){
	?>
	f.address.value= f.buyer_address.value;
	f.address_d.value= f.buyer_address_d.value;
	<?
	}
	?>
	
	<?
	if($buyer_tel_use < 2 && $rev_tel_use < 2){
	?>
	f.rev_tel.value=f.buyer_tel.value;
	<?
	}
	?>
	
	<?
	if($buyer_tel1_use < 2 && $rev_tel1_use < 2){
	?>
	f.rev_tel1.value=f.buyer_tel1.value;
	<?
	}
	?>
	
	<?
	if($buyer_zip_use < 2 && $zip_use < 2){
	?>
	f.zip.value=f.buyer_zip.value;
	<?
	}
	?>
}
</script>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 

<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( '../include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--�˻��κ�-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?=$mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="../images/template6/image/top/search_bg.gif" class="text_left"><img src="../images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    Ȩ &gt; �ֹ����ۼ�
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--�˻��κг�-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--Ÿ�̵��̹��� ����-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--Ÿ�̵��̹���  ��-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?
	include( '../include/leftmenu_template6.inc' );
}
?>
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	<table border="0" width="571">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_order1_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_order1_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_order1_img' WIDTH='120' HEIGHT='27'>
	";
}
else{
	echo "
<img src='../images/ordersheet-title.gif' WIDTH='120' HEIGHT='27'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
	";
}
else{
	echo "
<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"></td>
      	</tr>
<!--------------------------------- ��ٱ��Ͽ� �� ��ǰ ���� ----------------------------->
<?
if($order_num != ""){
	$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' and status = '0' order by order_pro_no desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
}
else $numRows = 0;
if($numRows > 0){
?>
	    <tr>
        	<td width="100%" align="center">
        		<table border="0" width="95%">
					<tr>
						<td width="100%" bgcolor="#808080" height="2" colspan="5"></td>
					</tr>
					<tr>
						<td width="35%" align="center" height="22"><p align="center"><span class="aa">��ǰ��</span></td>
						<td width="15%" height="22" align="center"><span class="aa">�ܰ�</span></td>
						<td width="13%" height="22" align="center"><span class="aa">����</span></td>
						<td width="15%" height="22" align="center"><p align="center"><span class="aa">�Ұ�</span></td>
						<td width="7%" height="22" align="center"><span class="aa">����</span></td>
					</tr>
					<tr>
						<td width="100%" background="../images/left_dot.gif" colspan="5"></td>
					</tr>
<?
$mon_tot = 0;
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$order_pro_no = $ary["order_pro_no"];
	$mart_id = $ary["mart_id"];
	$item_no_coupon = $ary["item_no"];
	if($i == 0){
		$item_no_tmp = $ary["item_no"]; //���� ���� ������ ��ǰ
	}
	$item_name = $ary["item_name"];
	$opt = $ary["opt"];
	$z_price = $ary["z_price"];
	$bonus = $ary["bonus"];
	$coupon_used = $ary["coupon_used"];
	$item_no_forcash = $ary["item_no"];
	
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ary["use_bonus"];
	$status = $ary["status"];
	$quantity = $ary["quantity"];
	$sum = $z_price*$quantity;
	
	$sum_str = number_format($sum);	
	$mon_tot += $sum;
	
	$SQL_C = "select use_coupon from $ItemTable where item_no = '$item_no_coupon'";
	$dbresult_C = mysql_query($SQL_C, $dbconn);
	$use_coupon = mysql_result($dbresult_C,0,0);
	
	if($use_coupon == '1' && $coupon_used=='0'){ 
		$coupon_str = "<a href=\"javascript:CouponWin('$item_no_coupon')\"><img src='http://www.mocoupon.co.kr/onlineShop/img/button-u8.gif' border='0'></a>";	
	}else{
		$coupon_str = '';
	}
  
	$if_cash_str = '';
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_forcash'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}
	else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_forcash'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}
?>
					<tr>
						<input type=hidden name='order_pro_no[]' value='<?=$order_pro_no?>' >
						<td width='35%' height='20' align='center'>
							<p align='left'>
							<span class='bb'><?=$item_name?> <?=$if_cash_str?> <?=$coupon_str?> 
<?
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
?>
			        		<br><img src='../images/optionbar.gif'>�ɼ�:
<?
		$opts = explode("!", $opt);

		if(strstr($opts[0],'^'))
			$opts_1 = explode("^", $opts[0]);
		else $opts_1[0] = $opts[0];
		
		if($opts_1[0] != "")
			echo "$opts_1[0]";
		if($opts_1[1] != "")
			echo "($opts_1[1] ��)&nbsp;";
		if($opts[1] != "")
			echo "$opts[1]&nbsp;";
		if($opts[2] != "")
			echo "$opts[2]";
		}
?>
							</span>
						</td>
						<td width='15%' height='20' align='right'><span class='bb'><?=$z_price_str?>��</span>
						</td>
						<td width='13%' height='20' align='center'>
							<input class='bb' id='quantityid' name='quantity[]' value='<?=$quantity?>' size='4' style='BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; height: 18px;'>
						</td>
						<td width='15%' height='20' align='right'><span class='bb'><?=$sum_str?>��</span>
						</td>
						<td width='7%' height='20' align='center'>
							<a href='cart_view.php?flag=del&order_pro_no=<?=$order_pro_no?>&mart_id=<?=$mart_id?>&provider_id=<?=$provider_id?>&category_num=<?=$category_num?>&item_no=<?=$item_no?>'><img onclick='return really()' src='../images/delete.gif' border='0' width='17' height='16'></a>
						</td>
					</tr>
					<tr>
						<td width='100%' height='1' align='center' colspan='5' bgcolor='#C0C0C0'></td>
					</tr>
<?
}
if($mon_tot >= $freight_limit){
	$freight_fee = 0;
}else{
	$freight_fee = $freight_cost;
}

$mon_tot_freight = $mon_tot + $freight_fee;
?>
					<tr>
						<td width="63%" height="20" align="center" colspan="3">
							<span class="bb">�� �� ��</span>
						</td>
						<td width="15%" height="20" align="center">
							<p align="right"><span class="bb"><?=number_format($freight_fee)?>��</span>
						</td>
						<td width="7%" height="20" align="center"></td>
					</tr>
					<tr>
						<td width="85%" height="1" align="center" colspan="5" bgcolor="#C0C0C0"><span class="bb"></span></td>
					</tr>
					<tr>
						<td width="63%" height="20" align="center" colspan="3" bgcolor="#EFEFEF">
							<span class="bb">��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</span></td>
						<td width="15%" height="20" align="center" bgcolor="#EFEFEF">
							<p align="right"><span class="bb"><?=number_format($mon_tot_freight)?>��</span></td>
						<td width="7%" height="20" align="center" bgcolor="#EFEFEF"></td>
					</tr>
				</table>
				</td>
				</tr>
<?
}
?>
<!--------------------------------- ��ٱ��Ͽ� �� ��ǰ �� ----------------------------->
<?
$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' and status = '0' order by order_pro_no desc";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
$mon_tot = 0;
$if_cash_flag = 0;
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$order_pro_no = $ary["order_pro_no"];
	$z_price = $ary["z_price"];
	$bonus = $ary["bonus"];
	$use_bonus = $ary["use_bonus"];
	$status = $ary["status"];
	$quantity = $ary["quantity"];
	$sum = $z_price*$quantity;
	
	$mon_tot += $sum; //�հ�ݾ�
	
	$item_no_tmp =  $ary["item_no"];
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_tmp'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_flag = 1;
	}
	else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_tmp'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_flag = 1;
	}
}
		
if($mon_tot >= $freight_limit) 
	$freight_fee = 0;
else $freight_fee = $freight_cost;

$mon_tot_freight = $mon_tot + $freight_fee;

$SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and username ='$UnameSess'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$name = $ary["name"];
	$email = $ary["email"];
	$passport1 = $ary["passport1"];
	$passport2 = $ary["passport2"];
	$buyer_tel = $ary["tel"];
	$buyer_tel1 = $ary["tel1"];
	$buyer_zip = $ary["zip"];
	$buyer_address = $ary["address"];
	$buyer_address_d = $ary["address_d"];
	$date = $ary["date"];
	$partner = $ary["partner"];
}
?>
				<form action='order_sheet_nomem_ok.php' id='form1' name='f' onsubmit="return checkform(this)" method=post>
				<input type=hidden name='flag' value='addinfo'> 
				<input type=hidden name='mart_id' value='<?=$mart_id?>'> 
				<input type=hidden name='partner' value='<?=$partner?>'>
				<input type=hidden name='mon_tot_freight' value='<?=$mon_tot_freight?>'>
				<input type=hidden name='freight_fee' value='<?=$freight_fee?>'>
				<tr>
        		<td width="100%" align="center">
        		<table border="0" width="540" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="536" bgcolor="#808080" height="2" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" align="left" height="25" colspan="4" bgcolor="#EFEFEF">
            			<p style="padding-left: 10px">�ֹ��� ����</p> (�ֹ���ȣ : <?=$order_num?>)
					</td>
          		</tr>
          		<tr>
            		<td width="536" background="../images/left_dot.gif" colspan="4"></td>
          		</tr>  		
<?
if($buyer_name_use < 2 || $buyer_passport_nomem_use){
?>
          		<tr>
            		<td width="99" height="25">
<?
	if($buyer_name_use < 2){
?>
						�� ��
<?
}
?>
            		</td>
            		<td width="153" height="25">
<?
	if($buyer_name_use < 2){
?>
            			<input class="bb" name="name" value='<?=$name_query?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
	}
?>
            		</td>
            		<td width="147" height="25">
<?
	if($buyer_passport_nomem_use < 2){
?>
						�ֹε�Ϲ�ȣ
<?
	}
?>
					</td>
            		<td width="159" height="25">
<?
	if($buyer_passport_nomem_use < 2){
?>
            			<input class="bb" name="passport1" value='<?=$passport1?>' size="6" onkeyup=check(); style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<strong><span class="zz"> - </span></strong>
            			<input type='password' class="bb" name="passport2" value='<?=$passport2?>' size="7" onkeyup=check1(); style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
	}
?>
            		</td>
          		</tr>
<?
}
?>
<?
if($buyer_email_use < 2){
?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�̸���
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="email" value='<?=$email?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
					</td>
          		</tr>
          		<tr>
            		<td width="99" height="25"></td>
            		<td width="433" height="25" colspan="3">
            			<p align="left"><span class="bb">�̸����� �Է��Ͻø� �ֹ�,���� ������ ���ϰ� Ȯ���Ͻ� �� �ֽ��ϴ�.</span>
					</td>
          		</tr>
<?
}
?>
<?
if($buyer_tel_use < 2 || $buyer_tel1_use < 2){
?>
          		<tr>
            		<td width="532" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
<?
if($buyer_tel_use < 2){
?>
						����ó
<?
}
?>
            		</td>
            		<td width="210" height="25">
<?
if($buyer_tel_use < 2){
?>
						<input class="bb" name="buyer_tel" value='<?=$buyer_tel?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
}
?>
            		</td>
            		<td width="126" height="25">
<?
if($buyer_tel1_use < 2){
?>
						�ڵ���
<?
}
?>
					</td>
            		<td width="127" height="25">
<?
if($buyer_tel1_use < 2){
?>
          				<input class="bb" name="buyer_tel1" value='<?=$buyer_tel1?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
}
?>
          			</td>
          		</tr>
<?
}
?>      		
<?
if($buyer_zip_use < 2){
?>
							
				<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�����ȣ
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="buyer_zip" value='<?=$buyer_zip?>' size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">&nbsp; 
            			<input class="bb" onclick="buyer_find_zip();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="ã��">
            		</td>
          		</tr>
<?
}
?>

<?
if($buyer_address_use < 2){
?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�ּ�
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="buyer_address" value='<?=$buyer_address?>' size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			���ּ�
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="buyer_address_d" value='<?=$buyer_address_d?>' size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
<?
}
?>
          		<tr>
            		<td width="536" height="10" align="left" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="536" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF">
            			<p style="padding-left: 10px">������ ����&nbsp;&nbsp;&nbsp; 
            			<input name="C1" onclick="val_sel(this.form)" type="checkbox"> �ֹ��ڿ� ����</p>
					</td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#EFEFEF" background="../images/left_dot.gif"></td>
          		</tr>
<?
if($receiver_use < 2){
?>
          		
          		<tr>
            		<td width="99" height="25">
            			�� ��
					</td>
            		<td width="208" height="25">
            			<input class="bb" name="receiver" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
            		<td width="125" height="25" align="center"></td>
            		<td width="126" height="25" align="center"></td>
          		</tr>
<?
}
?>
<?
if($rev_tel_use < 2 || $rev_tel1_use < 2){
?>
          		<tr>
            		<td width="562" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
<?
if($rev_tel_use < 2){
?>
						����ó
<?
}
?>
					</td>
            		<td width="210" height="25">
<?
if($rev_tel_use < 2){
?>
						<input class="bb" name="rev_tel" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
}
?>
            		</td>
            		<td width="126" height="25">
<?
if($rev_tel1_use < 2){
?>
						��Ÿ ����ó
<?
}
?>
            		</td>
            		<td width="127" height="25">
<?
if($rev_tel1_use < 2){
?>
						<input class="bb" name="rev_tel1" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
<?
}
?>
            		</td>
          		</tr>
<?
}
?>
<?
if($zip_use < 2){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�����ȣ
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="zip" size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			&nbsp;
						<input class="bb" onclick="find_zip();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="ã��">
            		</td>
          		</tr>
<?
}
?>
<?
if($address_use < 2){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�ּ�
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address" size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			���ּ�
					</td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address_d" size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
<?
}
?>
          		<tr>
            		<td width="562" height="10" align="left" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="562" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4" bgcolor="#EFEFEF">
            			<p style="padding-left: 10px">������� ����</p>
					</td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" background="../images/left_dot.gif"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
						�����ݾ�
					</td>
            		<td width="463" height="25" colspan="3">
						<font color="#FF0000"><?=number_format($mon_tot_freight)?>��</font>
					</td>
          		</tr>	
        		<tr>
            		<td width="99" height="1" bgcolor="#C0C0C0"></td>
            		<td width="463" height="1" colspan="3" bgcolor="#C0C0C0"></td>
          		</tr>
        		<tr>
            		<td width="99" height="25">
            			�¶��� �Ա�
					</td>
            		<td width="463" height="25" colspan="3">
            			<input type='radio' checked name='paymethod' value='byonline'>&nbsp;
            			<select class="bb" name="account_no" style="height: 18px; border: 1px solid black" size="1">
<?
$SQL = "select * from $BankTable where mart_id='$mart_id' and bank_name != '' ".
"and bank_number != '' and owner_name != ''";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	echo "<option value='' selected>�Ա��Ͻ� ����</option>";
	echo "<option value=''>==================</option>";
	for ($i=0; $i<$numRows; $i++) {
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];
		$bank_name = $ary["bank_name"];
		$bank_number = $ary["bank_number"];
		$owner_name = $ary["owner_name"];
			
		echo ("<option value='$account_no'>$bank_name $bank_number ������ : $owner_name</option>");
	}
}else{
	echo ("
		<option value='nobank'>�غ����Դϴ�.</option>
	");
}
?>	
              			</select>
            		</td>
          		</tr>
<?
if($mon_tot_freight < $card_limit){//�������� ī�� �����ݾ� ���ɾ׺��� ������
?>
          		<tr>
            		<td width='99' height='25'>
            			�ſ�ī��
					</td>
            		<td width='463' height='25' colspan='3'>
			          	<input type='radio' name='paymethod' value='bytelec' disabled>&nbsp;&nbsp;<?=$card_limit?>�� �̸��� �ݾ��� ī������� �� �������ϴ�.
			    	</td>
          		</tr>
<?
}else{//�������� ī�� �����ݾ� ���ɾ׺��� Ŭ�� ī�� ����â�� ����
?>
<?
	if($if_cash_flag == 0){
		if($card_yes=='t' && $card_module != ""){
			$pay_how = "bycard";
			$pay_how_name = "$card_module ī����� ���񽺸� �̿��մϴ�.";
		}else{
			$pay_how = "";
			$pay_how_name = "ī����� ���񽺸� �غ����Դϴ�.";
		}
?>
			    <tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25' align='left'>
            			�ſ�ī��
					</td>
            		<td width='463' height='25' colspan='3'>
			          	<input type='radio' name='paymethod' value=<?=$pay_how?>>&nbsp;&nbsp;<?=$pay_how_name?>
			    	</td>
          		</tr>
<?
	}// if_cash_flag end
?>
<?		  
	if($if_cash_flag == 0){
		if($account_yes=='t'){//�������� ������ü �����ݾ� ���ɾ׺��� Ŭ�� ī�� ����â�� ����
			if($card_module){
				$pay1_how = "by_account";
				$pay1_how_name = "������ü ���񽺸� �̿��մϴ�.";
			}else{
				$pay_how = "";
				$pay_how_name = "������ü ���񽺸� �غ����Դϴ�.";
			}
?>
			    <tr>
            		<td width='562' height='1' align='left' colspan='4' bgcolor='#C0C0C0'></td>
          		</tr>
          		<tr>
            		<td width='99' height='25'>
            			������ü
					</td>
            		<td width='463' height='25' colspan='3'>
            	      	<input type='radio' name='paymethod' value='<?=$pay1_how?>'>&nbsp;&nbsp;<?=$pay1_how_name?>
			    	</td>
          		</tr>
<?
		}
	}//������ü ���� �� 
?>
<?
}
?>
<?
if($money_sender_use < 2){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�Ա��ڸ�
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="money_sender" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			(�¶����Աݽ� �ʼ��Է�)
            		</td>
          		</tr>
<?
}
?>
<?
if($pay_day_use < 2){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			�Աݿ�����
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="pay_day" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			(�¶����Աݽ� �ʼ��Է�, �Է¿�: 2003-01-01)
            		</td>
          		</tr>
<?
}
?>
<?
if(!empty($field1_text)){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<?=$field1_text?>
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="field1" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>       		
<?
}
?>
<?
if(!empty($field2_text)){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<?=$field2_text?>
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="field2" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>      		
<?
}
?>
<?
if(!empty($field3_text)){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<?=$field3_text?>
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="field3" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>    		
<?
}
?>
<?
if(!empty($field4_text)){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<?=$field4_text?>
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="field4" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>     		
<?
}
?>
<?
if(!empty($field5_text)){
?>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<?=$field5_text?>
					</td>
            		<td width="463" height="25" colspan="3">
            			<input class="bb" name="field5" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr> 		
<?
}
?>
          		<tr>
            		<td width="562" height="10" align="left" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="562" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25"  colspan="4" bgcolor="#EFEFEF">
            			<p style="padding-left: 10px">�䱸 ���� �� �޽���</p>
					</td>
          		</tr>
          		<tr>
            		<td width="562" height="1" align="left" colspan="4" bgcolor="#EFEFEF" background="../images/left_dot.gif"></td>
          		</tr>
          		<tr>
            		<td width="562" height="25" align="left" colspan="4"><br>
            			<textarea cols="55" name="message" rows="4" style="width:80%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid"><?=$message_temp?><�䱸����>
            			
<�޽���></textarea>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="10" align="center" colspan="4" bgcolor="#FFFFFF"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#808080" height="2" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4">
            			<p align="center">&nbsp; &nbsp; 
            			<input class="bb" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="�����ϱ�">
            			<input class="bb" onclick="window.location.href='cart_view.php?mart_id=<?=$mart_id?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="���ư���">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
    	</form>
    	</table>
    </td>
</tr>
</table>
</td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
mysql_close($dbconn);
?>