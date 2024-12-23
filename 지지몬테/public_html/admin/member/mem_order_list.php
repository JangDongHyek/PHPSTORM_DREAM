<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
  <tr>
	 <td valign="top" bgcolor="#D3CCA2"><table border="0" width="100%" cellspacing="1"
	 height="500">
		<tr>
		  <td width="100%" bgcolor="#FFFFFF" valign="top">
			<div align="center"><center>
			<table border="0" width="95%" cellspacing="0" cellpadding="0">
			 <tr>
				<td width="100%" bgcolor="#FFFFFF" height="20"></td>
			 </tr>
			 <tr>
				<td width="100%" bgcolor="#FFFFFF" height="20"><img src="Home%20Page.files/order-list.gif"
				width="3" height="13" alt="order-list.gif (808 bytes)" align="absmiddle"> <b><?=$username?>님의 구매이력입니다.</b></td>
			 </tr>
			 <tr>
				<td width="100%" height="2" bgcolor="#D3CCA2"></td>
			 </tr>
			 <tr>
				<td width="100%" height="20"></td>
			 </tr>
			 <?
			 $SQL = "select order_num from $Order_BuyTable where mart_id='$mart_id' and id = '$username' and status='3' order by index_no desc";
					$dbresult = mysql_query($SQL, $dbconn);
					$numRows = mysql_num_rows($dbresult);
					$mon_tot = 0;
					for ($i=0; $i < $numRows; $i++) {
						$order_num_tmp = mysql_result($dbresult,$i,0);
									
						$SQL1 = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num_tmp'";
						//echo "sql1=$SQL1";
						$dbresult1 = mysql_query($SQL1, $dbconn);
						$numRows1 = mysql_num_rows($dbresult1);
						for ($j=0; $j<$numRows1; $j++) {
							mysql_data_seek($dbresult1,$j);
							$ary1 = mysql_fetch_array($dbresult1);
							$z_price = $ary1["z_price"];
							$quantity = $ary1["quantity"];
							$opt_price = $ary1["opt_price"];
							$opt_price2 = $ary1["opt_price2"];
							$opt_price3 = $ary1["opt_price3"];
							$opt_price4 = $ary1["opt_price4"];

							$sum = ($z_price+$opt_price+$opt_price2+$opt_price3+$opt_price4)*$quantity;
							$mon_tot += $sum; //합계금액
						}
					}
					$mon_tot_str = number_format($mon_tot);	
					?>
					<tr>
				<td width="100%" height="20"><p align="right">총 <b><?=$numRows?>건(<?=$mon_tot_str?> 원)</b>의 
				배송완료 구매이력이 있습니다.</td>
			 </tr>
			 <tr>
				<td width="100%" bgcolor="#C0C0C0"><table border="0" width="100%" cellspacing="1">
				  <tr>
					 <td width="12%" bgcolor="#F2EFE1" height="25" align="center"><b><font face="돋움">날짜</font></b></td>
					 <td width="45%" bgcolor="#F2EFE1" height="25" align="center"><b><font face="돋움">주문내역</font></b></td>
					 <td width="12%" bgcolor="#F2EFE1" height="25" align="center"><b><font face="돋움">금액</font></b></td>
				  </tr>
				  <?
							$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and id = '$username' and status='3' order by index_no desc";
							//echo "sql=$SQL";
							$dbresult = mysql_query($SQL, $dbconn);
							$numRows = mysql_num_rows($dbresult);
							
							if($numRows > 0){
								if ($cnfPagecount == "") $cnfPagecount = 20;
								if ($page == "") $page = 1;
								$skipNum = ($page - 1) * $cnfPagecount;
								
								$prev_page = $page - 1;
								$next_page = $page + 1;
								
								$total_page = ($numRows - 1) / $cnfPagecount;
								$total_page = intval($total_page)+1;
										
								if($page % 10 == 0)
								$start_page = $page - 9;
								else
								$start_page = $page - ($page % 10) + 1;
								
								$end_page = $start_page + 9;
								if($end_page >= $total_page)
									$end_page = $total_page;
								$prev_start_page = $start_page - 10;
								$next_start_page = $start_page + 10;
								
								
								for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
									if ($i >= $numRows) break;
									mysql_data_seek($dbresult, $i);
									$ary=mysql_fetch_array($dbresult);
										
									$order_num_query = $ary["order_num"];
									$freight_code = $ary["freight_code"];
									$date = str_replace("-","",$ary["date"]);
									$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
									
								 $SQL1 = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num_query' and status > 0";
									//echo "sql1=$SQL1";
									$dbresult1 = mysql_query($SQL1, $dbconn);
									$numRows1 = mysql_num_rows($dbresult1);
									$mon_tot = 0;
									$item_str = '';
									for ($j=0; $j<$numRows1; $j++) {
										mysql_data_seek($dbresult1,$j);
										$ary1 = mysql_fetch_array($dbresult1);
										$order_pro_no = $ary1["order_pro_no"];
										$opt_price = $ary1["opt_price"];
										$opt_price2 = $ary1["opt_price2"];
										$opt_price3 = $ary1["opt_price3"];
										$opt_price4 = $ary1["opt_price4"];
										$z_price = $ary1["z_price"];
										$bonus = $ary1["bonus"];
										$use_bonus = $ary1["use_bonus"];
										$status = $ary1["status"];
										$quantity = $ary1["quantity"];
										$item_name = $ary1["item_name"];
										$sum = ($z_price+$opt_price+$opt_price2+$opt_price3+$opt_price4)*$quantity;
										$item_str .= " 
										<tr>
							  <td width='100%'><font face='돋움'>$item_name : $quantity</font></td>
							</tr>
							";
							
										$mon_tot += $sum; //합계금액
									}
									$mon_tot_str = number_format($mon_tot);
									
									echo "
							<tr>
					 <td width='12%' bgcolor='#FFFFFF' height='40' align='center'>
					 <font face='돋움'>$date_str</font></td>
					 <td width='45%' bgcolor='#FFFFFF' height='40' align='left'>
					 <table border='0' width='100%'>
						$item_str
					 </table>
					 </td>
					 <td width='12%' bgcolor='#FFFFFF' height='40' align='right'><font face='돋움'>
					 $mon_tot_str&nbsp; </font></td>
				  </tr>
						";
					}
				  }
				  else{	
					echo "
				  <tr>
					 <td width='80%' bgcolor='#FFFFFF' height='40' align='center' colspan='4'><font
					 face='돋움'>구매이력이 없습니다.</font><table
					 border='0' width='100%'>
						<tr>
						  <td width='100%'></td>
						</tr>
					 </table>
					 </td>
				  </tr>
					";
				  }
				  ?>	
				</table>
				</td>
			 </tr>
		  </table>
			<table border="0" width="95%">
			 <tr>
				<td width="100%"><p align="right"><font face="돋움">
				<br>
				<?
						if($page == 1){
							echo ("
							처음
							");
						}
						else{
							echo ("
							<a href='mem_order_list.php?username=$username&page=1'>처음</a> 
							");
						}
					
						if($start_page > 1){
							echo ("
							<a href='mem_order_list.php?username=$username&page=$prev_start_page'>
							◁&nbsp; 
							</a>
							");
						}
						else{
							echo ("
							◁&nbsp; 
							");
						}
						for($i=$start_page;$i<=$end_page;$i++){
							if($i == $page){
								echo ("	
								[<b>$i</b>]
								");
							}
							else{
								echo ("
							<a href='mem_order_list.php?username=$username&page=$i'>$i</a> 
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='mem_order_list.php?username=$username&page=$next_start_page'>
							&nbsp;▷
							</a>
							");
						}
						else{
							echo ("
							&nbsp;▷
							");
						}
						if($page == $total_page){
							echo ("
							끝
							");
						}
						else{
							echo ("
							<a href='mem_order_list.php?username=$username&page=$total_page'>끝</a> 
							");
						}
						?>
						</font></p>
				<p align="right">　</td>
			 </tr>
		  </table>
		  </center></div></td>
		</tr>
	 </table>
	 </td>
  </tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>