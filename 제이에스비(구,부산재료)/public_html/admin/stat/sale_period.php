<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
	include "./cal.php";
?>
<script>
function fn_betdate(objname1, objname2, difvalue){	//'���س�¥�� �������� ���� ��¥ ��������
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?=date("Y")?>,<?=date("m")?>-1,<?=date("d")?>);
	var arrValue = new Array();
	obj2.value = fn_getdate(datD);
	arrValue = difvalue.split(":");
	if(arrValue[0] == "D"){
		datD.setDate(datD.getDate() - eval(arrValue[1]));
	}
	if(arrValue[0] == "M"){
		datD.setMonth(datD.getMonth() - eval(arrValue[1]));
	}
	obj1.value = fn_getdate(datD);
}
function fn_getdate(datArg){	//'���� ���� ��������
	var datD = datArg;
	var strTemp = "";
	strTemp = strTemp + datD.getYear() + "-";
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2);
	//strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	//strTemp = strTemp + fn_numformat(datD.getDate(),2);
	return strTemp;
}
function fn_numformat(intNum, intLen){	//'���ڼ��� ���߾� 0�� ���� ���� ����
	var strNum = intNum + "";
	var strTemp = "";
	for(i = 0; i < (eval(intLen) - strNum.length); i++){
		strTemp = "0" + strTemp;
	}
	strTemp = strTemp + strNum;
	return strTemp;
}
function MM_findObj(n, d, f) { //'��ü�� ã��
	var p,i,x;
	if(!d) d = document;
	if((p = n.indexOf("?"))>0 && parent.frames.length) {
		d = parent.frames[n.substring(p+1)].document;
		n = n.substring(0,p);
	}
	if(!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0;!x && i<d.forms.length;i++) x = d.forms[i][n];
	for(i = 0;!x && d.layers && i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
	if(!x  &&  document.getElementById) x = document.getElementById(n); 
	if(f) x = d.form1[n];
	return x;
}
function checkform(frm){
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("���ۿ��� �Է��ϼ���");
		frm.QryFromDate.focus();
		return false;
	}
	else{
		var len =frm.QryFromDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryFromDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryFromDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryToDate.value==""){
		alert("������� �Է��ϼ���");
		frm.QryToDate.focus();
		return false;
	}
	else{
		var len =frm.QryToDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryToDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryToDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryMonth.value==""){
		alert("�ش���� �Է��ϼ���");
		frm.QryMonth.focus();
		return false;
	}
	else{
		var len =frm.QryMonth.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryMonth.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("���Ŀ� �°� �Է� �ϼ���");
				frm.QryMonth.focus();
				return false;
			}
			ret = false;
		}	
	}
	return true;
}
</script>
<script>
function goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}
</script>



<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�Ǹ���� > �Ⱓ��</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" bgcolor="#FFFFFF">�Ǹſ� ���� ���ν�, ���Ǻ��� �˻��Ͻ� �� �ֽ��ϴ�. ���Ǻ� ��踦 �̿��Ͽ� �̵��ϼ���.<br>��ۿϷ�� ��ǰ�� ��迡 ���Ե˴ϴ�.</td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" height="3" valign="top"><table border="0" width="320" cellspacing="0" cellpadding="0">
					 <tr>
						<td width="20"></td>
						<td width="300"><table border="0" width="100%" cellspacing="0" cellpadding="0">
						  <tr>
							 <td width="100%" bgcolor="#CCCCCC"><table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
								  <td width="100%" bgcolor="#F7F7F7" height="20"><table border="0" width="100%" cellspacing="0" cellpadding="0">
									 <tr>
										<td width="33%" height="25" align="left">���� �˻�</td>
										<td width="67%" height="25" align="right">
											<select onchange="goto_byselect(this, 'self')" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
												<option value="sale_age.php">���ɺ�</option>
												<option value="sale_region.php">������</option>
												<option value="sale_item.php">��ǰ��</option>
												<option value="sale_period.php" selected>�Ⱓ��</option>
											</select>
										</td>
									 </tr>
								  </table>
								  </td>
								</tr>
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="100%"><br>
							 </td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  <table border="0" width="580" cellspacing="0" cellpadding="0">
					 <tr>
						<td width="20"></td>
						<td width="560"><table border="0" width="100%" cellspacing="0" cellpadding="0">
						  <tr>
							 <td width="100%" bgcolor="#7BBEBD"><table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="100%" bgcolor="#7BBEBD"><table border="0" width="100%" cellspacing="0" cellpadding="0">
									 <tr>
										<td width="100%" bgcolor="#7BBEBD"><table border="0" width="100%" cellspacing="1" cellpadding="3">
<?
if($QryFromDate == '') $QryFromDate = date("Y-m");
if($QryToDate == '') $QryToDate = date("Y-m");
if($QryMonth == '') $QryMonth = date("Y-m");
?>
										<form id=form1 name=form1 method=post onsubmit='return checkform(this)'>
										<input type='hidden' name='flag' value='search'>
										<tr>
											<td width="100%" bgcolor="#E9F5F5" height="30"><table border="0" width="100%">
										<tr>
											<td width="7%">
												<input type="radio" value="month" name="out_form" <?if($out_form == 'month') echo "checked"?>>
											</td>
											<td width="93%" colspan="2">�Ⱓ�� ���Ͽ� �˻��մϴ�.</td>
										</tr>
										<tr>
											<td width="7%"></td>
											<td width="28%">
												<input name="QryFromDate" value="<?=$QryFromDate?>" class="input_03" size="8"> 
												<font color="#3d918a">~</font> 
												<input name="QryToDate" value="<?=$QryToDate?>" class="input_03" size="7">&nbsp; &nbsp;
											</td>
											<td width="70%">
												<input type='button' class='butt_none' style='width:40' value='1����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='2����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='3����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='4����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='5����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='6����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='12����' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">
											</td>
										</tr>
										<tr>
											<td width="7%" height="8">
												<input type="radio" value="day" name="out_form" <?if($out_form == 'day'||$out_form == '') echo " checked"?>>
											</td>
											<td width="80%" colspan="2">�������� �˻��մϴ�.</td>
										</tr>
										<tr>
											<td width="7%" height="8"></td>
											<td width="80%" colspan="2">
												<table border="0" width="100%" cellspacing="0" cellpadding="0">
													<tr>
														<td width="19%">
															<input name="QryMonth" value="<?=$QryMonth?>" class="input_03" size="7">
														</td>
														<td width="81%">
															<input type='image' src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'>
														</td>
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
								  </td>
								</tr>
							 </table>
							 </td>
						  </tr>
						</table>
						</td>
					 </tr>
					 <tr>
						<td width="20" height="3"></td>
						<td width="560" height="3"><br>
						</td>
					 </tr>
					 <tr>
						<td width="20" height="2"></td>
						<td width="560" height="2"><table border="0" width="100%" cellspacing="0" cellpadding="0">
						  <tr>
							 <td width="90%" bgcolor="#999999">
							 <table border="0" width="100%" cellspacing="1" cellpadding="3">
<?
//================================= �Ϻ� �Ǹ���� ���� ===================================
if($out_form == 'day'||$out_form == ''){
	
	if($out_form == '') $QryMonth = date("Y-m");
	$SQL = "select count(*) from $Order_BuyTable where substring(date,1,6)= concat(substring('$QryMonth',1,4),substring('$QryMonth',6,2)) and mart_id='$mart_id' and status = '3'";
		 
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows_temp = mysql_result($dbresult,0,0);
					
	$SQL = "select * from $Order_ProTable t1, $Order_BuyTable t2 where t1.mart_id='$mart_id' and t2.mart_id='$mart_id'  and substring(t1.date,1,6)=concat(substring('$QryMonth',1,4),substring('$QryMonth',6,2)) and t1.order_num = t2.order_num and t2.status = '3'"; //��ۿϷ�
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$sum_tot = 0;
	$quantity_total = 0;
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult,$i);
		$ary=mysql_fetch_array($dbresult);
		$z_price = $ary["z_price"];
		$quantity = $ary["quantity"];
		$quantity_total += $quantity;
		$sum = $z_price * $quantity;
		$sum_tot += $sum;	
	}
	
	$sum_tot_str = number_format($sum_tot);
	$quantity_total_str = number_format($quantity_total);
	$QryYear = substr($QryMonth,0,4);
	$QryMonth_tmp =substr($QryMonth,5,2);
?>
								<tr>
								  <td width='102%' bgcolor='#8FBECD' colspan='3'>
								  <table border='0' width='100%' cellspacing='0' cellpadding='0'>
									 <tr>
										<td width='39%' height='25'><b><?=$QryYear?>�� <?=$QryMonth_tmp?>��</b></td>
										<td width='61%' height='25' align='right'><b><font color='#000000'>�Ѹ��� : <?=$sum_tot_str?>�� (<?=$numRows?>��)</font></b>�ΰ��� ������ </td>
									 </tr>
								  </table>
								  </td>
								</tr>
								<tr>
								  <td width='60%' bgcolor='#FFFFFF' align='left' colspan='3' height='25'>
								  <p align='left'>
								  <img src='../images/t-icon.gif' width='298' height='28'></td>
								</tr>
								<tr>
								  <td width='16%' bgcolor='#EFEFEF' align='left' height='25'>
								  <p align='center'>��¥</td>
								  <td width='37%' bgcolor='#EFEFEF' align='left' height='25'>
								  <p align='center'>�ǸŰǼ�</td>
								  <td width='7%' bgcolor='#EFEFEF' align='center' height='25'>
								  �Ǹž�</td>
								</tr>
<?
$end_day = how_many_days($QryYear, $QryMonth_tmp);

$j = 0;
for($j=1;$j<=$end_day;$j++){
	if(strlen($j) == 1) $j_temp = '0'.$j;
	else $j_temp = $j;
	
	$what_day = which_day_of_week($QryYear, $QryMonth_tmp, $j);

	if($what_day == 6) $bg_color='#CAE4FF';
	else if($what_day == 0) $bg_color='#FFAAAA';
	else $bg_color='#FFFFFF';

	$query_date = substr($QryMonth,0,4).substr($QryMonth,5,2).$j_temp;
	$query_date1 = substr($QryMonth,0,4)."-".substr($QryMonth,5,2)."-".$j_temp;
	
	for($k=1;$k<9;$k++){
		$SQL = "select order_num from $Order_BuyTable where mart_id='$mart_id' and date like '%$query_date1%' and status='$k'"; //3:��ۿϷ� 4:ȯ�� 5:�ֹ����
		$dbresult = mysql_query($SQL, $dbconn);
		$total = number_format(mysql_num_rows($dbresult));

		if($k == 3){
			$tot_3 = $total;
		}else if($k == 4){
			$tot_4 = $total;
		}else if( $k == 5 ){
			$tot_5 = $total;
		}else if( $k == 8 ){
			$tot_5 = $tot_5 + $total;
		}else{
			$tot_etc = $total;
		}
	}
	
	$SQL = "select order_num, z_price, quantity from $Order_ProTable where date='$query_date' and mart_id='$mart_id' and status*1>0";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	$sum_tot_3 = 0;
	$sum_tot_4 = 0;
	$sum_tot_5 = 0;
	$sum_tot_etc = 0;
	
	for($i=0;$i<$numRows;$i++){
		$order_num = mysql_result($dbresult,$i,0);
		$z_price = mysql_result($dbresult,$i,1);
		$quantity = mysql_result($dbresult,$i,2);
		
		$SQL1 = "select status from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		if($numRows1 == 0) continue;
		$status = mysql_result($dbresult1,0,0);

		$sum = $z_price * $quantity;

		if($status == 3) $sum_tot_3+=$sum;
		else if($status == 4) $sum_tot_4+=$sum;
		else if($status == 5||$status == 8) $sum_tot_5+=$sum;
		else $sum_tot_etc+=$sum;
	}
	
	$sum_tot_3_str = number_format($sum_tot_3);
	$sum_tot_4_str = number_format($sum_tot_4);
	$sum_tot_5_str = number_format($sum_tot_5);
	$sum_tot_etc_str = number_format($sum_tot_etc);
?>
								<tr>
								  <td width='9%' height='52' align='center' bgcolor='<?=$bg_color?>'><?=$j?> ��</td>
								  <td width='32%' height='52' align='right' bgcolor='#FFFFFF'>
									<table border='0' width='100%' cellspacing='1' cellpadding='2'>
										<tr>
											<td width='12%'><img src='../images/tt-1.gif' width='11' height='11'></td>
											<td width='88%' align='right'><b><font color='#588ECD'><?=$tot_3?> ��</font></b</td>
										</tr>
										<tr>
											<td><img src='../images/tt-2.gif' width='11' height='10'></td>
											<td align='right'><font color='#A5BEE7'><?=$tot_4?> ��</font></td>
										</tr>
										<tr>
											<td><img src='../images/tt-3.gif' width='11' height='10'></td>
											<td align='right'><font color='#42BEB5'><?=$tot_5?> ��</font></td>
										</tr>
										<tr>
											<td><img src='../images/tt-4.gif' width='11' height='10'></td>
											<td align='right'><font color='#FFAE31'><?=$tot_etc?> ��</font></td>
										</tr>
									</table>
								  </td>
								  <td width='61%' height='52' align='left' bgcolor='#FFFFFF'>
								  <table border='0' width='100%' cellspacing='1' cellpadding='2'>
									 <tr>
										<td width='20%' height='0'>
										<img src='../images/tt-1.gif' width='11' height='11'></td>
										<td width='80%' align='right'>
										<b><font color='#588ECD'><?=$sum_tot_3_str?> ��</font></b></td>
									 </tr>
									 <tr>
										<td width='20%' height='0'>
										<img src='../images/tt-2.gif' width='11' height='10'></td>
										<td width='80%' align='right'>
										<?=$sum_tot_4_str?> ��</td>
									 </tr>
									 <tr>
										<td width='20%' height='0'>
										<img src='../images/tt-3.gif' width='11' height='10'></td>
										<td width='80%' align='right'>
										<?=$sum_tot_5_str?> ��</td>
									 </tr>
									 <tr>
										<td width='20%' height='0'>
										<img src='../images/tt-4.gif' width='11' height='10'></td>
										<td width='80%' align='right'>
										<?=$sum_tot_etc_str?> ��</td>
									 </tr>
								  </table>
								  </td>
								</tr>
<?
	}
}
//================================= �Ϻ� �Ǹ���� �� =====================================
?>
<?
//================================= ���� �Ǹ���� ���� ===================================
if($out_form == 'month'){
	$end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

	$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

	$QryFromDate1 = $QryFromDate."-01";
	$QryToDate1 = $QryToDate."-".$to_end_day;
	
	$SQL = "select * from $Order_BuyTable where status='3' and ( date >= '$QryFromDate1' and date <= '$QryToDate1' )";	 
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows_temp = mysql_num_rows($dbresult);
					
	$SQL = "select T1.z_price, T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T2.mart_id='$mart_id' and T2.status='3' and T1.order_num=T2.order_num and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1' )"; //��ۿϷ�
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$sum_tot = 0;
	$quantity_total = 0;
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult,$i);
		$ary=mysql_fetch_array($dbresult);
		$z_price = $ary[0];
		$quantity = $ary[1];
		$sum = $z_price * $quantity;
		$sum_tot += $sum;	
	}
	
	$quantity_total_str = number_format($quantity_total);
	$sum_tot_str = number_format($sum_tot);
	
	$QryFromYear = substr($QryFromDate,0,4);
	$QryFromMonth = substr($QryFromDate,5,2);
	
	$QryToYear = substr($QryToDate,0,4);
	$QryToMonth = substr($QryToDate,5,2);
?>
								<tr>
								  <td width='102%' bgcolor='#8FBECD' colspan='3'>
								  <table border='0' width='100%' cellspacing='0' cellpadding='0'>
									 <tr>
										<td width='35%' height='25'><b><?=$QryFromYear?>�� <?=$QryFromMonth?>�� <font color='#3d918a'>~</font> <?=$QryToYear?>�� <?=$QryToMonth?>��</b></td>
										<td width='65%' height='25'><b><p align='right'><font color='#000000'>�Ѹ��� 
										: <?=$sum_tot_str?> ��(<?=$numRows?>��)</font></b></td>
									 </tr>
								  </table>
								  </td>
								</tr>
								<tr>
								  <td width='60%' bgcolor='#FFFFFF' align='left' colspan='3' height='25'><p
								  align='left'><img src='../images/t-icon.gif' width='298' height='28'></td>
								</tr>
								<tr>
								  <td width='16%' bgcolor='#EFEFEF' align='left' height='25'><p
								  align='center'>��¥</td>
								  <td width='37%' bgcolor='#EFEFEF' align='left' height='25'><p
								  align='center'>�ǸŰǼ�</td>
								  <td width='7%' bgcolor='#EFEFEF' align='center' height='25'>�Ǹž�</td>
								</tr>
<?									
	$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

	$QryFromDate1 = $QryFromDate."-01";
	$QryToDate1 = $QryToDate."-".$to_end_day;									
//for(;;){										
	$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and concat(substring(date,1,4),'-',substring(date,5,2),'-',substring(date,7,2)) between concat('$QryFromYear','-','$QryFromMonth','-','01') and concat('$QryFromYear','-','$QryFromMonth','-','$end_day') and status*1 >= 1"; 
			
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows_temp = number_format(mysql_num_rows($dbresult));
	
	$sum_tot_3 = 0;
	$sum_tot_4 = 0;
	$sum_tot_5 = 0;
	$sum_tot_etc = 0;
	
	for($k=1;$k<9;$k++){
		$SQL1 = "select T1.z_price, T1.quantity from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T2.mart_id='$mart_id' and T2.status='$k' and T1.order_num=T2.order_num and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1')";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);

		for($j=0;$j<$numRows1;$j++){
			mysql_data_seek($dbresult1,$j);
			$ary1 = mysql_fetch_array($dbresult1);
			$z_price = $ary1[0];
			$quantity = $ary1[1];
			
			$sum = $z_price * $quantity;
			
			if($k == 3){
				$sum_tot_3 += $sum;
				$tot_3 = $numRows1;
			}else if($k == 4){
				$sum_tot_4 += $sum;
				$tot_4 = $numRows1;
			}else if($k == 5||$k == 8 ){
				$sum_tot_5 += $sum;
				$tot_5 = $numRows1;
			}else{
				$sum_tot_etc += $sum;
				$tot_etc = $numRows1;
			}
		}
	}

	$sum_tot_3_str = number_format($sum_tot_3);
	$sum_tot_4_str = number_format($sum_tot_4);
	$sum_tot_5_str = number_format($sum_tot_5);
	$sum_tot_etc_str = number_format($sum_tot_etc);
?>
								<tr>
								  <td width='9%' height='52' bgcolor='#FFFFFF'><?=$QryFromYear?>�� <?=$QryFromMonth?>�� <font color='#3d918a'>~</font><br><?=$QryToYear?>�� <?=$QryToMonth?>��</td>
								  <td width='32%' height='52' align='right' bgcolor='#FFFFFF'>
								<table border='0' width='100%' cellspacing='1' cellpadding='2'>
									<tr>
										<td width='12%'><img src='../images/tt-1.gif' width='11' height='11'></td>
										<td width='88%' align='right'><b><font color='#588ECD'><?=$tot_3?> ��</font></b</td>
									</tr>
									<tr>
										<td><img src='../images/tt-2.gif' width='11' height='10'></td>
										<td align='right'><font color='#A5BEE7'><?=$tot_4?> ��</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-3.gif' width='11' height='10'></td>
										<td align='right'><font color='#42BEB5'><?=$tot_5?> ��</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-4.gif' width='11' height='10'></td>
										<td align='right'><font color='#FFAE31'><?=$tot_etc?> ��</font></td>
									</tr>
								</table>								  
								  </td>
								  <td width='61%' height='52' align='left' bgcolor='#FFFFFF'>
								<table border='0' width='100%' cellspacing='1' cellpadding='2'>
									<tr>
										<td width='12%'><img src='../images/tt-1.gif' width='11' height='11'></td>
										<td width='88%' align='right'><b><font color='#588ECD'><?=$sum_tot_3_str?> ��</font></b></td>
									</tr>
									<tr>
										<td><img src='../images/tt-2.gif' width='11' height='10'></td>
										<td align='right'><font color='#A5BEE7'><?=$sum_tot_4_str?> ��</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-3.gif' width='11' height='10'></td>
										<td align='right'><font color='#42BEB5'><?=$sum_tot_5_str?> ��</font></td>
									</tr>
									<tr>
										<td><img src='../images/tt-4.gif' width='11' height='10'></td>
										<td align='right'><font color='#FFAE31'><?=$sum_tot_etc_str?> ��</font></td>
									</tr>
								</table>
								  </td>
								</tr>
<?									
	if($QryFromMonth == 12) {
		if($QryFromYear < $QryToYear){
			$QryFromYear++;
			$QryFromMonth = 1;
		}
		else $QryFromMonth++;
	}
	else $QryFromMonth++;
		
	if($QryFromYear == $QryToYear && $QryFromMonth > $QryToMonth) break;
	//}	
}
?> 
							 </table>
							 </td>
						  </tr>
						  <tr>
							 <td width="100%"></td>
						  </tr>
						</table>
						</td>
					 </tr>
				  </table>
				  </td>
				</tr>
				<tr>
				  <td width="100%" bgcolor="#FFFFFF" valign="top"></td>
				</tr>
				<tr align="center">
				  <td width="100%" bgcolor="#FFFFFF" valign="top"><p align="right"></td>
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
mysql_close($dbconn);
?>