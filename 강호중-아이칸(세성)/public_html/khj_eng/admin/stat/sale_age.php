<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
	include "./cal.php";
?>
<script>
function goto_byselect(sel, targetstr){
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
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu7.html'; ?>
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
            <td width="310"><img src="../img/page_title7.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span> <span class="text_gray2_c">������</span> &gt; <span class="text_gray2_c">�Ǹ����</span> </div></td>
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
		<td width="200" height="500">
			<!--���ʺκн���-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�Ǹ���� > ���ɺ�</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF">�Ǹſ� ���� ���ν�, ���Ǻ��� �˻��Ͻ� �� �ֽ��ϴ�. ���Ǻ� ��踦 �̿��Ͽ� �̵��ϼ���.<br>��ۿϷ�� ��ǰ�� ��迡 ���Ե˴ϴ�.</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						
						<table border="0" width="320" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="300">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#CCCCCC">
											
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<tr>
												<td width="100%" bgcolor="#F7F7F7" height="20">
													
													<table border="0" width="100%" cellspacing="0" cellpadding="0">
														<tr>
															<td width="33%" height="25"><p align="left">���� ���</td>
															<td width="67%" height="25"><p align="right">
																<select onChange="goto_byselect(this, 'self')" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
																<option value="sale_age.php" selected>���ɺ�</option>
																<option value="sale_region.php">������</option>
																<option value="sale_item.php">��ǰ��</option>
																<option value="sale_period.php">�Ⱓ��</option>
																</select></td>
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
												<td width="50%">
													<b><font color="#FFFFFF">�˻���� : ���ɴ뺰 
													�Ǹ����</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="12%" bgcolor="#FFFFFF" align="center" height="25">����</td>
										<td width="13%" bgcolor="#FFFFFF" align="center" height="25">�ǸŰǼ�</td>
										<td width="20%" bgcolor="#FFFFFF" align="center" height="25">�Ǹž�</td>
										<td width="55%" bgcolor="#FFFFFF" align="center" height="25">�׷���</td>
									</tr>
									<?
									//status : 1=>�ֹ�, 2=>�Ա�Ȯ��, 3=>��ۿϷ�, 6=>�����
									$today_year = date("y") + 100;
									
									$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
									"(status = '1' or status = '2' or status = '3' or status = '6')";
							
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows_total = mysql_num_rows($dbresult);
								
								$sum_total = 0; 
								for($i=0;$i<$numRows_total;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sum_total += $sum_tot;
								}
								
								//echo "sum_total=$sum_total";
								$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
									"(status = '1' or status = '2' or status = '3' or status = '6') and ".
									"$today_year - substring(passport1,1,2)*1 >= 15 and $today_year - substring(passport1,1,2)*1 <= 20 ";
							
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows15 = mysql_num_rows($dbresult);
								
								$sum15 = 0; 
								for($i=0;$i<$numRows15;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sum15 += $sum_tot;
								}
								
								if($sum_total == 0){
									$sum15_percent = 0;
									$sum15_graph = 0;
								}
								else{
									$sum15_percent = number_format($sum15 / $sum_total * 100,2);
									$sum15_graph = number_format($sum15 / $sum_total * 200);
								}	
									
								
								
								$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
								"(status = '1' or status = '2' or status = '3' or status = '6') and ".
								"$today_year - substring(passport1,1,2)*1 >= 21 and $today_year - substring(passport1,1,2)*1 <= 29 ";
								
								//echo "sql2=$SQL2";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows21 = mysql_num_rows($dbresult);
								$sum21 = 0; 
								for($i=0;$i<$numRows21;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sum21 += $sum_tot;
								}
								if($sum_total == 0){
									$sum21_percent = 0;
									$sum21_graph = 0;
								}
								else{
									$sum21_percent = number_format($sum21 / $sum_total * 100,2);
									$sum21_graph = number_format($sum21 / $sum_total * 200);
								}	
								
								
								
								$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
								"(status = '1' or status = '2' or status = '3' or status = '6') and ".
								"$today_year - substring(passport1,1,2)*1 >= 30 and $today_year - substring(passport1,1,2)*1 <= 39 ";
								
								//echo "sql3=$SQL3";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows30 = mysql_num_rows($dbresult);
								$sum30 = 0; 
								for($i=0;$i<$numRows30;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sum30 += $sum_tot;
								}
								if($sum_total == 0){
									$sum30_percent = 0;
									$sum30_graph = 0;
								}
								else{
									$sum30_percent = number_format($sum30 / $sum_total * 100,2);
									$sum30_graph = number_format($sum30 / $sum_total * 200);
								}	
								
								$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
								"(status = '1' or status = '2' or status = '3' or status = '6') and ".
								"$today_year - substring(passport1,1,2)*1 >= 40";
								
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows40 = mysql_num_rows($dbresult);
								$sum40 = 0; 
								for($i=0;$i<$numRows40;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sum40 += $sum_tot;
								}
								if($sum_total == 0){
									$sum40_percent = 0;
									$sum40_graph = 0;
								}
								else{
									$sum40_percent = number_format($sum40 / $sum_total * 100,2);
									$sum40_graph = number_format($sum40 / $sum_total * 200);
								}	
								
								$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
								"(status = '1' or status = '2' or status = '3' or status = '6') and ".
								"$today_year - substring(passport1,1,2)*1 < 15";
								
								$dbresult = mysql_query($SQL, $dbconn);
								$numRowsetc = mysql_num_rows($dbresult);
								$sumetc = 0; 
								for($i=0;$i<$numRowsetc;$i++){
									mysql_data_seek($dbresult,$i);
									$ary=mysql_fetch_array($dbresult);
									$order_num = $ary["order_num"];
									
									$SQL1 = "select * from $Order_ProTable where order_num = '$order_num'";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$sum_tot = 0;
									for($j=0;$j<$numRows1;$j++){
										mysql_data_seek($dbresult1,$j);
										$ary1=mysql_fetch_array($dbresult1);
										$z_price = $ary1["z_price"];
										$quantity = $ary1["quantity"];
										$sum = $z_price * $quantity;
										$sum_tot += $sum;	
									}
									$sumetc += $sum_tot;
								}
								if($sum_total == 0){
									$sumetc_percent = 0;
									$sumetc_graph = 0;
								}
								else{
									$sum40_percent = number_format($sum40 / $sum_total * 100,2);
									$sum40_graph = number_format($sum40 / $sum_total * 200);
								}	
								?>
								
								<tr>
										<td width="16%" height="25" align="center" bgcolor="#FFFFFF">
											15~20</td>
										<td width="13%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($numRows15)?> ��</td>
										<td width="20%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($sum15)?> ��</td>
										<td width="55%" height="25" align="left" bgcolor="#FFFFFF">
											<p align="left"><img src="../images/graph1.gif" width="<?echo $sum15_graph?>" height="10">
											<?echo $sum15_percent?> %</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
											21~29</td>
										<td width="13%" height="25" bgcolor="#FFFFFF" align="right">
											<?echo number_format($numRows21)?> ��</td>
										<td width="20%" height="25" bgcolor="#FFFFFF" align="right">
											<?echo number_format($sum21)?> ��</td>
										<td width="55%" height="25" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $sum21_graph?>" height="10">
											<?echo $sum21_percent?> %</td>
									</tr>
									<tr>
										<td width="16%" height="25" align="center" bgcolor="#FFFFFF">
											30~39</td>
										<td width="13%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($numRows30)?> ��</td>
										<td width="20%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($sum30)?> ��</td>
										<td width="55%" height="25" align="left" bgcolor="#FFFFFF">
											<img src="../images/graph1.gif" width="<?echo $sum30_graph?>" height="10">
											<?echo $sum30_percent?> %</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
											40�� �̻�</td>
										<td width="13%" height="25" bgcolor="#FFFFFF" align="right">
											<?echo number_format($numRows40)?> ��</td>
										<td width="20%" height="25" bgcolor="#FFFFFF" align="right">
											<?echo number_format($sum40)?> ��</td>
										<td width="55%" height="25" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $sum40_graph?>" height="10">
											<?echo $sum40_percent?> %</td>
									</tr>
									<tr>
										<td width="16%" height="25" align="center" bgcolor="#FFFFFF">
											��Ÿ</td>
										<td width="13%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($numRowsetc)?> ��</td>
										<td width="20%" height="25" align="right" bgcolor="#FFFFFF">
											<?echo number_format($sumetc)?> ��</td>
										<td width="55%" height="25" align="left" bgcolor="#FFFFFF">
											<img src="../images/graph1.gif" width="<?echo $sumetc_graph?>" height="10">
											<?echo $sumetc_percent?> %</td>
									</tr>
									<tr>
										<td width="12%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF">�հ�</font></b></td>
										<td width="17%" height="25" bgcolor="#FCB663" align="right">
											<b><font color="#FFFFFF"><?echo number_format($numRows_total)?> ��</font></b></td>
										<td width="16%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF"><?echo number_format($sum_total)?>��</font></b></td>
										<td width="55%" height="25" bgcolor="#FCB663" align="left">
											<img src="../images/graph1.gif" width="200" height="10">
											100 %</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div></td>
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