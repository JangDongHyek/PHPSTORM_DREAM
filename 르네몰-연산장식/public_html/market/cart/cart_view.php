<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

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

if($flag == "del"){
	$SQL = "delete from $Order_ProTable where order_pro_no = $order_pro_no and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($flag == "cart_del"){
	$SQL = "delete from $Order_ProTable where order_num = '$order_num' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($flag == "update"){
	for($i=0; $i<count($quantity); $i++) {
		$SQL = "select item_no, quantity from $Order_ProTable where mart_id='$mart_id' and order_pro_no = $order_pro_no[$i] and status = '0'";
		$dbresult = mysql_query($SQL, $dbconn);
		$item_no_in_order = mysql_result($dbresult,0,0);
		$quantity_prev = mysql_result($dbresult,0,1);
		
		$SQL = "select jaego_use,jaego from $ItemTable where item_no='$item_no_in_order'";
		$dbresult = mysql_query($SQL, $dbconn);
		$jaego_use = mysql_result($dbresult,0,0);
		$jaego = mysql_result($dbresult,0,1);
		
	 	if($jaego_use == '1' && $quantity[$i] > $quantity_prev && $quantity[$i] > $jaego){
			echo "
			<script>
			alert(\"����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $jaego ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
		}
		else{	
			$SQL = "update $Order_ProTable set quantity = $quantity[$i] where mart_id='$mart_id' and order_pro_no = $order_pro_no[$i] and status = '0'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
	}
}
if($flag == "coupon_update"){
	
	if($cpntype == '1') //����
		$SQL = "update $Order_ProTable set z_price = z_price - (z_price*($rate/100)), coupon_used='1', cpntype='$cpntype', rate='$rate' where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no'";
	if($cpntype == '2') //����
		$SQL = "update $Order_ProTable set z_price = z_price - $rate, coupon_used='1', cpntype='$cpntype', rate='$rate'  where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no'";
	if($cpntype == '3'){ //����ǰ
		$SQL = "update $Order_ProTable set cpntype='$cpntype', rate='$rate' where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no'";
	}
	$dbresult = mysql_query($SQL, $dbconn);
	
	//echo "<meta http-equiv='refresh' content='0; URL=cart_view.php?mart_id=$mart_id'>";
	//exit;
}

include( '../include/getmartinfo.php' );

if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>	
<script language="javascript">
function CouponWin(pid){ // ������� �� �� �ִ� â�� ������ 
	var url = "http://www.mocoupon.co.kr/onlineShop/useCoupon.php?_PID="+pid+"&_SHOPID=<?=$mart_id?>&_SHOPGROUP=bluecart&url=<?=$url?>";
	window.open(url,'Coupon','scrollbars=no,toolbar=no,location=no,directories=no,width=280,height=180,resizable=no,mebar=no,left=250,top=65');
}

function UseCoupon(pid,cpntype,rate){  // ���� ���â���� ����� ȣ���� �� ���
	//alert("PID:"+pid+", CPNTYPE:"+cpntype+", RATE:"+rate); // ���� : ����� ������������� �޴��� �������� ����. Cpntype 1:���� 2:���� 3:����ǰ, rate : ������/���αݾ�/����ǰ����

	// ���� ������ �����Ͽ� ��ǰ������ �����Ű�� ��ƾ����, �� ����Ʈ����
	// �ڽ��� ����Ʈ�� �´� ����� ���
	//window.location.href='cart_view.php?mart_id=<?=$mart_id?>&flag=coupon_update&item_no='+pid+'&cpntype='+cpntype+'&rate='+rate;
}
</script>
<script>
function next_send(f){
	var f = document.form1
	f.submit();
}

function go_order_sheet(){
	window.location.href='order_sheet.php?mart_id=<?=$mart_id?>&item_no=<?=$item_no?>&provider_id=<?=$provider_id?>'
}
function really(){
	if(confirm("�����Ͻðڽ��ϱ�?")) return true;
	else return false;
}

function re_count(f){
	var Digit = '1234567890'
	
	if(f.quantityid.length == null){
		if (f.quantityid.value==""){
			alert("������ �Է��ϼ���");
			f.quantityid.focus();
			return;
		}
		else{
			var len =f.quantityid.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
				var ch = f.quantityid.value.substring(i,i+1);
				
				for (var k=0;k<=Digit.length;k++){				
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						alert("���ڸ� �Է� �ϼ���");
						f.quantityid.focus();
						return false;
				}
				ret = false;
			}	
		}
		
		if(f.quantityid.value <= 0){
			f.quantityid.focus();
    	alert("1�̻��� ���� �Է��ϼ���.");
    	return;
    }	
	}
	else{
		for(i=0;i<f.quantityid.length;i++){
	  	
	  	if (f.quantityid[i].value==""){
				alert("������ �Է��ϼ���");
				f.quantityid[i].focus();
				return;
			}
			else{
				var len =f.quantityid[i].value.length;
				var ret;
				ret =false;		
				for(var j=0;j<len;j++){
					var ch = f.quantityid[j].value.substring(j,j+1);
					
					for (var k=0;k<=Digit.length;k++){				
						if(Digit.substring(k,k+1) == ch)
						{					
							ret = true;
							break;					
						}
					}	
					
					if (!ret){
							alert("���ڸ� �Է� �ϼ���");
							f.quantityid[i].focus();
							return false;
					}
					ret = false;
				}	
			}
			
	  	
	  	if(f.quantityid[i].value <= 0){
	    	f.quantityid[i].focus();
	    	alert("1�̻��� ���� �Է��ϼ���.");
	      return;
	    }
	 	}
	}
	f.action = "cart_view.php";
	f.flag.value="update";
	f.submit();
}

function cart_del(f){
	var f = document.form1;
	var msg = "��ٱ��ϸ� ���ðڽ��ϱ�?";
	if (confirm(msg)==false){
		return;
	}
	else{

		f.action = "cart_view.php";
		f.flag.value = "cart_del";
		f.submit();
	}

}
function pur_limit_warn(t){
	alert(t+"�� ���ϴ� �ֹ������� ���� �ʽ��ϴ�.");
	return;	
}
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
    Ȩ &gt; ��ٱ���
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
?>	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_cart_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_cart_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_cart_img' width='89' height='27'>
	";
}
else{
	echo "
<img src='../images/cart-title.gif' width='89' height='27'>
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
<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' width='571' height='12'>
	";
}
else{
	echo "
<img src='../images/line.gif' width='571' height='12'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"><span class="aa"></span></td>
      	</tr>
<?
if($order_num != ""){
	$SQL = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' and status = '0' order by order_pro_no desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
}
else $numRows = 0;
if($numRows > 0){
?>
		<form id=form1 action='order_sheet.php?order_num=<?=$order_num?>' name='form1'>
		<input type=hidden name='flag'>
      	<input type=hidden name='mart_id' value='<?=$mart_id?>'>
      	<input type=hidden name='provider_id' value='<?=$provider_id?>'>
      	<input type=hidden name='item_no' value='<?=$item_no?>'>
	    <tr>
        	<td width="100%">
        		<div align="center"><center>
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
          		<tr>
            		<td width="100%" bgcolor="#808080" height="2" colspan="5"></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="11" colspan="5"><span class="zz"></span></td>
          		</tr>
          		<tr>
            		<td width="100%" bgColor="#ffffff" colSpan="5" height="11"><span class="bb">
            		<p align="center"><font color="#0060BF"><?=number_format($freight_limit)?>�� �̸��� �����ݾ��� ��۷� <?=number_format($freight_cost)?>���� 
            		�ΰ��˴ϴ�.</font></span></td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="11" colspan="5">
            			<span class="zz"><strong><p align="center">
            			<?
        				$SQL = "select * from $ItemTable where item_no = '$item_no_tmp'";
						//echo "<font color='white'> sql=$SQL</font>";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						if($numRows > 0){
							mysql_data_seek($dbresult, 0);
							$ary=mysql_fetch_array($dbresult);
							$mart_id_tmp = $ary["mart_id"];
							$category_num = $ary["prevno"];
							if($category_num == 0) $category_num = $ary["category_num"];
							
							if($mart_id != $mart_id_tmp){ //gnt ��ǰ
								$SQL1 = "select * from $Gnt_ItemTable where item_no=$item_no_tmp and seller_id='$mart_id'";
								//echo "<font color='white'> sql=$SQL</font>";
								$dbresult1 = mysql_query($SQL1, $dbconn);
								$numRows1 = mysql_num_rows($dbresult1);
								if($numRows1 > 0){
									mysql_data_seek($dbresult1,0);
									$ary1 = mysql_fetch_array($dbresult1);
									$category_num = $ary1["prevno"];
									if($category_num == 0) $category_num = $ary1["category_num"];
								}
							
							}
							
							$SQL = "select * from $GiveNTakeTable where category_num = '$category_num' and seller_id='$mart_id'";
							//echo "<font color='white'> sql=$SQL</font>";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							if($numRows > 0){
								mysql_data_seek($dbresult,0);
								$ary=mysql_fetch_array($dbresult);
								$provider_id = $ary["provider_id"];
							}
						}
						echo "<input class='bb' onclick=\"window.location.href='../product/product_list.php?mart_id=$mart_id&category_num=$category_num&provider_id=$provider_id'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px' type='button' value='���ΰ��'>&nbsp;";
						
						?>
            			
            			<input class="bb" onclick="re_count(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px" type="button" value="�ٱ��ϼ���">&nbsp;
            			<!-- <input class="bb" onclick="cart_del(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px" type="button" value="��� ����">&nbsp; //-->
            			<?
				        if($mon_tot >= $pur_limit){
				        	/*
				        	echo ("
				        	 <input class='bb' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px' type='submit' value='�ֹ����ۼ��ϱ�'>
				        	 ");
				        	 */
				        	 echo "
				        <input onclick=\"javascript:go_order_sheet()\" class='bb' style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px' type='button' value='�ֹ����ۼ��ϱ�'>
				        	";
				        }
				        else{
				        	echo ("
				        	 <input class='bb' onclick=\"pur_limit_warn('$pur_limit')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; height: 18px' type='button' value='�ֹ����ۼ��ϱ�'>
				        	 ");
				        }
				        ?>
					    </strong></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF" height="11" colspan="5">
            		<?
          			$SQL = "select content from $Cart_ExplainTable where mart_id = '$mart_id'";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if($numRows > 0){
									$content = mysql_result($dbresult,0,0);
								}
								echo $content;
								?>	
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
      	
      	</form>
      	<?
    	}
    	else{
    	?>
    	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		<table cellspacing="1" background="../images/dot2.gif" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top"><p align="center"><br>
            			<br>
            			<span class="bb">��ٱ��Ͽ� ��� ��ǰ�� �����ϴ�.</span><strong><span class="zz"><br>
            			<br><br>
            			</span></strong>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	<?
    	}
    	?>
    	</table>
    	</center></div>
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
if($direct_submit_flag == "direct_submit"){
	if($mon_tot >= $pur_limit){
		echo ("
	<script>
	document.form1.submit();
	</script>
		");
	}
	else{
		echo ("
	<script>
	pur_limit_warn('$pur_limit');
	</script>
		");
	}	
}
?>
