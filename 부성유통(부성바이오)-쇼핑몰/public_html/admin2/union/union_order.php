<?
include "../lib/Mall_Admin_Session.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");                          

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$icash_id = mysql_result($dbresult, 0, "icash_id");
	$telec_id = mysql_result($dbresult, 0, "telec_id");	
	$prepay_id = mysql_result($dbresult, 0, "prepay_id");	
	$allthegate_id = mysql_result($dbresult, 0, "allthegate_id");	
	$tgcorp_id = mysql_result($dbresult, 0, "tgcorp_id");	
	$if_provider = mysql_result($dbresult, 0, "if_provider");
		
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$union_freight_limit  = $ary["union_freight_limit"];
		$union_freight_cost  = $ary["union_freight_cost"];
	}

	$today = date("Ymd");
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매주문관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">주문번호를 클릭하시면 주문에 대한 상세내역과 수정가능한 페이지로 이동합니다.<br>
								주문검색은 오늘, 3일, 일주일 단위로 검색가능하며,
								조회기간을 따로이 입력하여 검색하실수도 있습니다.<br>
								주문관리는 일반출력과 디테일출력으로 구성되어 있습니다.<br><br>
								디테일출력은 주문건수가 많을때 주문을 한눈에 보실 수 있으며, <br>
								수정, 입금확인, 배송시작메일 등	을 일괄적으로 처리할 수 있습니다.
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="35" align="center"><strong>
						<a href='union_order.php'>[전체주문현황]</a>
						<?
						if($icash_id !='') echo "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH 카드결제현황]</a>";
						if($telec_id !='') echo "<a href='http://www.ebizpro.co.kr' target='_new'' target='_new'>[TELEC 카드결제현황]</a>";
						if($prepay_id !='') echo "<a href='https://pg.pre-pay.co.kr:4002/login.htm' target='_new'>[PREPAY 카드결제현황]</a>";
						if($allthegate_id !='') echo "<a href='http://www.allthegate.com/login/r_login.jsp' target='_new'>[ALLTHEGATE 카드결제현황]</a>";
						if($tgcorp_id !='') echo "<a href='https://npg.tgcorp.com/mdbop/login.jsp' target='_new'>[TGCORP 카드결제현황]</a>";
						?>
						</strong></td>
					</tr>
<form action='union_order.php' id=form1 name=form1 method=post>
<input type=hidden name='flag' value='find'>
<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
					<tr>
					<td vAlign="top" width="100%" bgColor="#ffffff" height="3">
						<div align="center"><center>
							<table border="0" width="95%" cellspacing="0" cellpadding="0">
							<tr>
								<td>
									<table cellSpacing="0" cellPadding="0" width="100%" border="0">
								<tr>
									<td width="100%" bgColor="#cccccc">
										<table cellSpacing="1" cellPadding="3" width="100%" border="0">
													<tr>
										<td width="100%" bgColor="#f7f7f7" height="20">
											<table cellSpacing="0" cellPadding="0" width="100%" border="0">
											
											<tr>
												<td width="13%">
													&nbsp; 조회차수</td>
												<td width="37%">
													<select name="union_clue" onchange="goTo(this.form)" style="background-color: #FECB8E; border-left: 1px dotted rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0)" size="1">
													<option value=''
													<?
													if($union_clue == '') echo "selected";
													?>
													>선택하세요</option>
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
													</td>
												<td width="22%">
													</td>
												<td width="28%">
													
													
													<?
													echo "
													<a href='../to_excel/union_order_list_new.php?flag=$flag&union_clue=$union_clue'>
													<img src='../images/excel.gif' align='bottom' border='0' WIDTH='84' HEIGHT='18'>
													</a>
													";
													?></td>
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
							</form>
							</table>
							</center></div>
							<table border="0" width="100%" height="10" cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%"></td>
								</tr>
							<form action='union_order.php' method=post>
							<input type=hidden name='flag' value='<?echo $flag?>'>
								<input type='hidden' name='keyset' value='<?echo $keyset?>'>
							<input type='hidden' name='searchword' value='<?echo $searchword?>'>
							<input type=hidden name='union_clue' value='<?echo $union_clue?>'>
								<input type=hidden name='page' value=''>
								<tr>
								<td width="100%"><p align="right"><br>
									<select name="cnfPagecount" onchange="goTo(this.form)" style="background-color: #FECB8E; border-left: 1px dotted rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0)" size="1">
									<option value=""
									<?
									if($cnfPagecount == '') echo " selected";
									?>
									>정렬갯수</option>
									<option value="10"
									<?
									if($cnfPagecount == '10') echo " selected";
									?>
									>10</option>
									<option value="15"
									<?
									if($cnfPagecount == '15') echo " selected";
									?>
									>15</option>
									<option value="20"
									<?
									if($cnfPagecount == '20') echo " selected";
									?>
									>20</option>
									<option value="25"
									<?
									if($cnfPagecount == '25') echo " selected";
									?>
									>25</option>
									<option value="30"
									<?
									if($cnfPagecount == '30') echo " selected";
									?>
									>30</option>
									</select>&nbsp;&nbsp;&nbsp; </td>
								</tr>
							<tr>
								<td width="100%"></td>
								</tr>
							</table>
							</td>
							</tr>
						</form>
						<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#e7e7e7" colspan="7">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												
<form action='union_order.php' method='post' onsubmit='return checkform(this)'>
<input type='hidden' name='flag' value='search'>
<input type=hidden name='cnfPagecount' value='<?echo $cnfPagecount?>'>
												<tr>
												<td width="50%">&nbsp; 
												</td>
												<td width="50%">
													<p align="right">
													<select name="keyset" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
														<option value="name">이름</option>
														<option value="money_sender">입금자명</option>
														<option value="order_union_num">날짜</option>
													</select>
													&nbsp; 
													<input name="searchword" size="20" class="input_03"> &nbsp; 
													<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">&nbsp;&nbsp; 
												</td>
												</tr>
												</form>
											
											</table>
										</td>
									</tr>
									
									<form action='union_order.php' method='post'>
									<input type='hidden' name='update_flag' value='update'>
									<input type='hidden' name='page' value='<?echo $page?>'>
									<input type='hidden' name='keyset' value='<?echo $keyset?>'>
									<input type='hidden' name='searchword' value='<?echo $searchword?>'>
									<input type='hidden' name='flag' value='<?echo $flag?>'>
									<input type='hidden' name='cnfPagecount' value='<?echo $cnfPagecount?>'>
									<input type='hidden' name='union_clue' value='<?echo $union_clue?>'>
									
									<tr>
										<td width="8%" bgcolor="#FFFFFF" align="center">번호</td>
										<td width="14%" bgcolor="#FFFFFF" align="center">주문번호</td>
										<td width="20%" bgcolor="#FFFFFF" align="center">이름</td>
										<td width="18%" bgcolor="#FFFFFF" align="center">날짜</td>
										<td width="14%" bgcolor="#FFFFFF" align="center">총결제액</td>
										<td width="14%" bgcolor="#FFFFFF" align="center">진행상태</td>
										<td width="18%" bgcolor="#FFFFFF" align="center">결제방법</td>
									</tr>
									<?
									if($flag == "search")
											$SQL = "select * from $Union_Order_BuyTable where $keyset like '%$searchword%' and mart_id='$mart_id' order by substring(union_order_num,2,8) desc , substring(union_order_num,10) desc";
												else if($flag == 'find'){
											$pieces = explode("!", $union_clue);
													
													$SQL = "select T1.* from $Union_Order_BuyTable T1, $Union_OrderTable T2 
											where T1.mart_id='$mart_id' 
											and T2.mart_id='$mart_id' 
											and T1.union_order_num = T2.union_order_num 
											and T2.union_no = '$pieces[0]' 
											and T2.type = '$pieces[1]' 
											order by substring(T1.union_order_num,2,8) desc , substring(T1.union_order_num,10)*1 desc";
										}	
										else	
													$SQL = "select * from $Union_Order_BuyTable 
													where mart_id='$mart_id' 
													order by substring(union_order_num,2,8) desc , substring(union_order_num,10)*1 desc";
													
												//echo "union_clue=$union_clue <br>";
												//echo "sql=$SQL";
												
												$dbresult = mysql_query($SQL, $dbconn);
												$numRows = mysql_num_rows($dbresult);
												if ($cnfPagecount == "") $cnfPagecount = 10;
												if ($page == "") $page = 1;
												$skipNum = ($page - 1) * $cnfPagecount;
												$total_page = ($numRows - 1)/$cnfPagecount;
												$total_page=intval($total_page)+1;	
												
												$prev_page = $page - 1;
												$next_page = $page + 1;
						
						
												for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {	
													if ($i >= $numRows) break;	
													mysql_data_seek($dbresult, $i);	
													$ary=mysql_fetch_array($dbresult);	
													$name = $ary["name"];
													$union_order_num = $ary["union_order_num"];
													$paymethod = $ary["paymethod"];
													$date = $ary["date"];
													$status = $ary["status"];
													$card_paid = $ary["card_paid"];
													
													$j = $numRows - $i;
													$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
													
													$paymethod_str = '';
													
													if($paymethod == 'byonline') $paymethod_str = '온라인입금';
													if($paymethod == 'bycard') $paymethod_str = '신용카드(ICASH)';
													if($paymethod == 'bytelec') {
														$paymethod_str = '신용카드(TELEC)';
														if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
														else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
													}
													if($paymethod == 'by_telec_account') {
														if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
														else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
													}
													if($paymethod == 'byallthegate') {
														$paymethod_str = '신용카드';
													}
													if($paymethod == 'by_allthegate_account') {
														if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
														else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
													}
													if($paymethod == 'bytgcorp'){
														if($card_paid == 't') $paymethod_str = "신용카드(<font color='green'>성공</font>)";
														else $paymethod_str = "신용카드(<font color='red'>실패</font>)";
													}
													if($paymethod == 'by_tg_account') {
														if($card_paid == 't') $paymethod_str = "계좌이체(<font color='green'>성공</font>)";
														else $paymethod_str = "계좌이체(<font color='red'>실패</font>)";
													}
													
													$SQL1 = "select * from $Union_OrderTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
														//echo "sql=$SQL";
													$dbresult1 = mysql_query($SQL1, $dbconn);
													$numRows1 = mysql_num_rows($dbresult1);
													if ($numRows1 > 0){
														mysql_data_seek($dbresult1, 0);
														$ary1=mysql_fetch_array($dbresult1);
														$item_no = $ary1["item_no"];
														$item_name = $ary1["item_name"];
														$quantity = $ary1["quantity"];
														$type = $ary1["type"];
													}	
													
													if($type == 'slide'){		
														$SQL2 = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
														//echo "sql=$SQL";
														$dbresult2 = mysql_query($SQL2, $dbconn);
														$numRows2 = mysql_num_rows($dbresult2);
														if($numRows2 > 0){
															mysql_data_seek($dbresult2, 0);
															$ary2=mysql_fetch_array($dbresult2);
															$price_str = number_format($price);
															$number1_from = $ary2["number1_from"];
															$number1_to = $ary2["number1_to"];
															$number2_from = $ary2["number2_from"];
															$number2_to = $ary2["number2_to"];
															$number3_from = $ary2["number3_from"];
															
															$price1 = $ary2["price1"];
															$price1_str = number_format($price1);
															$price2 = $ary2["price2"];
															$price2_str = number_format($price2);
															$price3 = $ary2["price3"];
															$price3_str = number_format($price3);
															$current_num = $ary2["current_num"];
															$current_num_str = number_format($current_num);
															
															if($current_num >= $number1_from && $current_num <= $number1_to){ 
																$current_price = $price1;
															}
															else if($current_num >= $number2_from && $current_num <= $number2_to){ 
																$current_price = $price2;
															}
															else if($current_num >= $number3_from){ 
																$current_price = $price3;
															}
															else {
																$current_price = $price1;
															}
															$current_price_str = number_format($current_price);
														}
													}
													
													if($type == 'limit'){		
													
														$SQL3 = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
														//echo "sql=$SQL";
														$dbresult3 = mysql_query($SQL3, $dbconn);
														$numRows3 = mysql_num_rows($dbresult3);
														if($numRows3 > 0){
															mysql_data_seek($dbresult3, 0);
															$ary3=mysql_fetch_array($dbresult3);
															$z_price = $ary3["z_price"];
															$z_price_str = number_format($z_price);
															
															$current_price = $z_price;
														}
													}
													
													$item_detail_head = $item_detail_body = $item_detail_tail ="";
													$item_detail_head = "
											<tr>
									<td align='middle' width='98%' bgColor='#F3F3F3' colspan='6'>
									<table border='0' width='100%'>
										<tr>
										";
													$item_detail_body .= "<td width='50%'><img src='../images/dot.gif' width='5' height='7'>$item_name : $quantity</td>";
													$item_detail_tail = "
													</tr>
									 </table>
									 </td>
								  </tr>
										";
										$item_detail_str = $item_detail_head.$item_detail_body.$item_detail_tail;
										
										$mon_tot = $quantity * $current_price;
													
													if($mon_tot >= $union_freight_limit) 
														$freight_fee = 0;
													else $freight_fee = $union_freight_cost;
													
													$mon_tot_freight = $mon_tot + $freight_fee;
													
													$mon_tot_freight_str = number_format($mon_tot_freight);
													
													echo "
												<tr>
										<input type='hidden' name='union_order_num[]' value='$union_order_num'>
										<td width='8%' bgcolor='#FFFFFF' align='center' rowspan='2'>$j</td>
										<td width='14%' bgcolor='#FFFFFF' align='center'>
											<a href='union_order_detail.php?union_order_num=$union_order_num'>
											$union_order_num</a></td>
										<td width='20%' bgcolor='#FFFFFF' align='center'>
											$name</td>
										<td width='18%' bgcolor='#FFFFFF' align='center'>
											$date_str</td>
										<td width='14%' bgcolor='#FFFFFF' align='center'>
											$mon_tot_freight_str 원</td>
										<td width='14%' bgcolor='#FFFFFF' align='center'>
										";
										echo "
										<select name='status[]' class='aa' style='height: 18px; background-color: rgb(193,219,227); border: 1px solid black' size='1'>
										<option value='1'";
										if($status == '1') echo " selected";
										echo ">주문</option>
										<option value='5'
										";
										if($status == '5') echo " selected";
										echo ">주문취소</option>
										<option value='2'
										";
										if($status == '2') echo " selected";
										echo ">입금확인/출고중</option>
										<option value='6'
										";
										if($status == '6') echo " selected";
										echo ">배송중</option>
										<option value='3'
										";
										if($status == '3') echo " selected";
										echo ">배송완료</option>
										<option value='7'
										";
										if($status == '7') echo " selected";
										echo ">교환</option>
										<option value='4'
										";
										if($status == '4') echo " selected";
										echo ">환불</option>
										</select>
										";			
										echo "</td>
										<td width='18%' bgcolor='#FFFFFF' align='center'>$paymethod_str</td>	
									</tr>
										$item_detail_str
										";
									}
									?>
									</table>
								</td>
							</tr>
							<tr>
							  <td vAlign="top" width="100%" bgColor="#ffffff">
							  <p align="right">　
							  <input style="BORDER-RIGHT: #929292 1px solid; BORDER-TOP: #929292 1px solid; BORDER-LEFT: #929292 1px solid; COLOR: #929292; BORDER-BOTTOM: #929292 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="진행상태 저장"></td>
							</tr>
							</form>
							</table>
						</center></div>
					</td>
				</tr>
				<?
				if($page % 10 == 0)
				$start_page = $page - 9;
				else
				$start_page = $page - ($page % 10) + 1;
				
				$end_page = $start_page + 9;
				if($end_page >= $total_page)
					$end_page = $total_page;
				$prev_start_page = $start_page - 10;
				$next_start_page = $start_page + 10;
				?>
				<tr align="center">
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<p style="padding-right: 20px" align="right">
						
						<?
						if($page == 1){
							echo ("
							처음
							");
						}
						else{
							echo ("
							<a href='union_order.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>처음</a> 
							");
						}
					
						if($start_page > 1){
							echo ("
							<a href='union_order.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>
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
							<a href='union_order.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>$i</a> 
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='union_order.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>
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
							<a href='union_order.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>끝</a> 
							");
						}
						?>
						
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
}
else if($update_flag=='update'){
	
	for($i=0; $i<count($union_order_num); $i++) {
		$SQL = "update $Union_Order_BuyTable set status='$status[$i]' where union_order_num='$union_order_num[$i]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "<meta http-equiv='refresh' content='0; URL=union_order.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&union_clue=$union_clue'>";
}	
?>
<?
mysql_close($dbconn);
?>