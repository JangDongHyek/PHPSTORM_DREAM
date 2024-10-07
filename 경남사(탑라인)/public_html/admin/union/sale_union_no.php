<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$union_freight_limit  = $ary["union_freight_limit"];
	$union_freight_cost  = $ary["union_freight_cost"];
}
	include "../admin_head.php";
?>
<script>
function goTo(f){
	f.submit();
}
function checkform(f){
	if(f.searchword.value==""){
		alert("검색어를 입력하세요.");
		f.searchword.focus();
		return false;
	}
	return true;
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매판매통계</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td width="90%" height="30" bgColor="#ffffff"><b>판매에 대한 통계로써, 차수별로 검색하실 수 있습니다.</b></td></tr>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table cellSpacing="0"
				  cellPadding="0" width="320" border="0">
					 <tr>
						<td width="20"></td>
						<td width="300"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						  <tr>
							 <td width="100%" bgColor="#cccccc"><table cellSpacing="1" cellPadding="3" width="100%"
							 border="0">
								<tr>
								  <td width="100%" bgColor="#f7f7f7" height="20">
								  <table cellSpacing="0" cellPadding="0" width="100%" border="0">
									 
<form action='sale_union_no.php' id=form1 name=form1 method=post>
<input type=hidden name='flag' value='find'>
										<tr>
										<td width="33%" height="25"><p align="left">차수별 통계</td>
										<td width="67%" height="25"><p align="right">
										<select name="union_clue" onchange="goTo(this.form)" class="bb" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; HEIGHT: 18px" size="1">
<?
$SQL = "select * from $Union_ListTable where mart_id='$mart_id' order by union_no desc";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		for ($i=0; $i < $numRows; $i++) {
			mysql_data_seek($dbresult, $i);
			$ary=mysql_fetch_array($dbresult);
			$union_no_tmp = $ary["union_no"];
			$limit_chk = $ary["limit_chk"];
			$limit_no = $ary["limit_no"];
			$slide_chk = $ary["slide_chk"];
			$slide_no = $ary["slide_no"];
			
			if($union_clue == '') {
				if($limit_chk == 1) $union_clue = "$union_no_tmp!limit";
				else if($slide_chk == 1) $union_clue = "$union_no_tmp!slide";
			}
			if($limit_chk == 1 && $slide_chk == 1){ 
				echo "
				<option value='$union_no_tmp!limit'
				";
				if($union_clue == "$union_no_tmp!limit") echo "selected";
				
				echo "
				>제$limit_no 차 한정판매</option>		
				<option value='$union_no_tmp!slide'
				";
				if($union_clue == "$union_no_tmp!slide") echo "selected";
				echo "
				>제$slide_no 차 슬라이딩</option>
				";
	}
	if($limit_chk == 1 && $slide_chk == ''){ 
				echo "
				<option value='$union_no_tmp!limit'
				";
				if($union_clue == "$union_no_tmp!limit") echo "selected";
				echo "
				>제$limit_no 차 한정판매</option>		
				";
	}
	if($limit_chk == '' && $slide_chk == 1){ 
				echo "
				<option value='$union_no_tmp!slide'
				";
				if($union_clue == "$union_no_tmp!slide") echo "selected";
				echo "
				>제$slide_no 차 슬라이딩</option>
				";
			}
}
?>
										 </select></td>
									 </tr>
									 </form>
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
				  <table cellSpacing="0" cellPadding="0" width="580" border="0">
					 <tr>
						<td width="20"></td>
						<td width="560"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						  <tr>
							 <td width="100%" bgColor="#7bbebd"><table cellSpacing="0" cellPadding="0" width="100%"
							 border="0">
								<tr>
								  <td width="100%" bgColor="#7bbebd"><table cellSpacing="0" cellPadding="0" width="100%"
								  border="0">
									 <tr>
										<td width="100%" bgColor="#7bbebd"><table cellSpacing="1" cellPadding="3" width="100%"
										border="0">
										<tr>
										<td width="100%" bgColor="#e9f5f5" height="30"><table width="100%" border="0">
										<tr>
										<td width="87%" height="30">
										<?
										$pieces = explode("!", $union_clue);
								//echo "$union_clue";		
														$SQL = "select * from $Union_ListTable where union_no = '$pieces[0]'";
														//echo "sql=$SQL";
														$dbresult = mysql_query($SQL, $dbconn);
														mysql_data_seek($dbresult, 0);
														$ary=mysql_fetch_array($dbresult);
														
														$limit_chk = $ary["limit_chk"];
														$limit_no = $ary["limit_no"];
														$slide_chk = $ary["slide_chk"];
														$slide_no = $ary["slide_no"];
														$limit_order_date = $ary["limit_order_date"];
														$limit_order_date1 = $ary["limit_order_date1"];
														$limit_pay_date = $ary["limit_pay_date"];
														$limit_pay_date1 = $ary["limit_pay_date1"];
														$limit_send_date = $ary["limit_send_date"];
														$limit_send_date1 = $ary["limit_send_date1"];
														$slide_order_date = $ary["slide_order_date"];
														$slide_order_date1 = $ary["slide_order_date1"];
														$slide_pay_date = $ary["slide_pay_date"];
														$slide_pay_date1 = $ary["slide_pay_date1"];
														$slide_send_date = $ary["slide_send_date"];
														$slide_send_date1 = $ary["slide_send_date1"];
														
														$limit_order_date_str = substr($limit_order_date,0,4)."/".substr($limit_order_date,4,2)."/".substr($limit_order_date,6,2);
														$limit_order_date1_str = substr($limit_order_date1,0,4)."/".substr($limit_order_date1,4,2)."/".substr($limit_order_date1,6,2);
														$limit_pay_date_str = substr($limit_pay_date,0,4)."/".substr($limit_pay_date,4,2)."/".substr($limit_pay_date,6,2);
														$limit_pay_date1_str = substr($limit_pay_date1,0,4)."/".substr($limit_pay_date1,4,2)."/".substr($limit_pay_date1,6,2);
														$limit_send_date_str = substr($limit_send_date,0,4)."/".substr($limit_send_date,4,2)."/".substr($limit_send_date,6,2);
														$limit_send_date1_str = substr($limit_send_date1,0,4)."/".substr($limit_send_date1,4,2)."/".substr($limit_send_date1,6,2);
														
														$slide_order_date_str = substr($slide_order_date,0,4)."/".substr($slide_order_date,4,2)."/".substr($slide_order_date,6,2);
														$slide_order_date1_str = substr($slide_order_date1,0,4)."/".substr($slide_order_date1,4,2)."/".substr($slide_order_date1,6,2);
														$slide_pay_date_str = substr($slide_pay_date,0,4)."/".substr($slide_pay_date,4,2)."/".substr($slide_pay_date,6,2);
														$slide_pay_date1_str = substr($slide_pay_date1,0,4)."/".substr($slide_pay_date1,4,2)."/".substr($slide_pay_date1,6,2);
														$slide_send_date_str = substr($slide_send_date,0,4)."/".substr($slide_send_date,4,2)."/".substr($slide_send_date,6,2);
														$slide_send_date1_str = substr($slide_send_date1,0,4)."/".substr($slide_send_date1,4,2)."/".substr($slide_send_date1,6,2);
														
												if($pieces[1] == 'limit'){
													echo "
												$limit_no 차 한정판매 : <br>
										신청기간 $limit_order_date_str~$limit_order_date1_str, <br>
										입금기간 $limit_pay_date_str~$limit_pay_date1_str, <br>
										배송기간 $limit_send_date_str~$limit_send_date1_str
											";
										}
										if($pieces[1] == 'slide'){
													echo "
												$slide_no 차 슬라이딩 : <br>
										신청기간 $slide_order_date_str~$slide_order_date1_str, <br>
										입금기간 $slide_pay_date_str~$slide_pay_date1_str, <br>
										배송기간 $slide_send_date_str~$slide_send_date1_str
											";
										}
										?>
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
						<td width="560" height="2"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						  <tr>
							 <td width="90%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%"
							 border="0">
								<?
								$SQL = "select distinct T1.* from $Union_OrderTable T1, $Union_Order_BuyTable T2 
								where T1.mart_id='$mart_id' 
								and T2.mart_id='$mart_id'  
								and T1.union_order_num = T2.union_order_num 
									 and T1.union_no='$pieces[0]' 
								and T1.type='$pieces[1]'
								and T2.status = '3'"; //배송완료
								
								//echo "sql=$SQL";
											$dbresult = mysql_query($SQL, $dbconn);
											$numRows = mysql_num_rows($dbresult);
											$total_numRows = $numRows;
											$sum_tot = 0;
											$quantity_total = 0;
											
											for($i=0;$i<$numRows;$i++){
												mysql_data_seek($dbresult,$i);
												$ary = mysql_fetch_array($dbresult);
												$item_no = $ary["item_no"];
												$quantity = $ary["quantity"];
												$type = $ary["type"];
												
												if($type == 'limit'){
													$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
												}
												if($type == 'slide'){
													$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
												}
												
												$quantity_total += $quantity;
												$sum = $current_price * $quantity;
												
												if($sum >= $union_freight_limit) 
													$freight_fee = 0;
												else $freight_fee = $union_freight_cost;
													$sum = $sum + $freight_fee;
												
												$sum_tot += $sum;	
											}
											$sum_tot_str = number_format($sum_tot);
											
											$SQL = "select distinct T1.item_no, T1.quantity, T1.type, T2.status from $Union_OrderTable T1, $Union_Order_BuyTable T2 
											where T1.mart_id='$mart_id' 
								and T2.mart_id='$mart_id'  
								and T1.union_order_num = T2.union_order_num 
									 and T1.union_no='$pieces[0]' 
								and T1.type='$pieces[1]'
								"; //3:배송완료 5:주문취소 4:환불 8:고객주문취소 
											//echo "sql1=$SQL <br>";
											$dbresult = mysql_query($SQL, $dbconn);
											$numRows = mysql_num_rows($dbresult);
											
											$sum_tot_3 = 0;
											$sum_tot_4 = 0;
											$sum_tot_5 = 0;
											$sum_tot_etc = 0;
											
											for($i=0;$i<$numRows;$i++){
												mysql_data_seek($dbresult,$i);
												$ary=mysql_fetch_array($dbresult);
												$item_no = $ary["item_no"];
												$quantity = $ary["quantity"];
												$type = $ary["type"];
												$status = $ary["status"];
												
												if($type == 'limit'){
													$current_price = Get_Limit_Price($item_no, $Mall_Admin_ID);
												}
												if($type == 'slide'){
													$current_price = Get_Slide_Price($item_no, $Mall_Admin_ID);
												}
													
												$sum = $current_price * $quantity;
												
												if($sum >= $union_freight_limit) 
													$freight_fee = 0;
												else $freight_fee = $union_freight_cost;
													$sum = $sum + $freight_fee;
												
												//echo "status = $status";
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
								  <td width="102%" bgColor="#8fbecd" colSpan="2"><table cellSpacing="0" cellPadding="0"
								  width="100%" border="0">
									 <tr>
										<td width="39%" height="25"><b>
										<?
										if($pieces[1] == 'limit') echo "$limit_no 차 한정판매";
										if($pieces[1] == 'slide') echo "$slide_no 차 슬라이딩";
										?>
										</b></td>
										<td width="61%" height="25"><b><p align="right"><font color="#000000">총매출 
										: <?echo $sum_tot_str?> 원(<?echo $total_numRows?> 건)</font></b></td>
									 </tr>
								  </table>
								  </td>
								</tr>
								<tr>
								  <td align="left" width="60%" bgColor="#ffffff" colSpan="2" height="25"><p
								  align="left"><img height="28" src="../images/t-icon.gif" width="298"></td>
								</tr>
								<tr>
								  <td align="left" width="37%" bgColor="#efefef" height="25"><p
								  align="center">판매건수</td>
								  <td align="middle" width="7%" bgColor="#efefef" height="25">판매액</td>
								</tr>
								<tr>
								  <td align="right" width="32%" bgColor="#ffffff" height="52"><?echo $numRows?> 건</td>
								  <td align="left" width="61%" bgColor="#ffffff" height="52"><table cellSpacing="1"
								  cellPadding="2" width="100%" border="0">
									 <tr>
										<td width="20%" height="0"><img height="11" src="../images/tt-1.gif" width="11"></td>
										<td align="right" width="80%"><strong><font color="#588ecd"><?echo $sum_tot_3_str?> 원</font></strong></td>
									 </tr>
									 <tr>
										<td width="20%" height="0"><img height="10" src="../images/tt-2.gif" width="11"></td>
										<td align="right" width="80%"><?echo $sum_tot_5_str?> 원</td>
									 </tr>
									 <tr>
										<td width="20%" height="0"><img height="10" src="../images/tt-3.gif" width="11"></td>
										<td align="right" width="80%"><?echo $sum_tot_4_str?> 원</td>
									 </tr>
									 <tr>
										<td width="20%" height="0"><img height="10" src="../images/tt-4.gif" width="11"></td>
										<td align="right" width="80%"><?echo $sum_tot_etc_str?> 원</td>
									 </tr>
								  </table>
								  </td>
								</tr>
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
				  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
				</tr>
				<tr align="middle">
				  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
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
mysql_close($dbconn);
?>