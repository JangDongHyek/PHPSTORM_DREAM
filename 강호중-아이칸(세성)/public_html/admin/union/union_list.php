<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "delete from $Union_ListTable where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "delete from $Union_ItemTable where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "select * from $Union_OrderTable where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult, $i);
		$ary=mysql_fetch_array($dbresult);
		$union_order_num = $ary["union_order_num"];	
		
		$SQL1 = "delete from $Union_Order_BuyTable where union_order_num = '$union_order_num' and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
	}
	
	$SQL = "delete from $Union_OrderTable where union_no = '$union_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function really(union_no){
	if(confirm("정말로 삭제하시겠습니까? \n\n속해 있는 상품과 주문데이타가 모두 삭제됩니다.")){
		window.location.href='union_list.php?flag=del&union_no='+union_no
	}
	else return;
}
</script>
</head>

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매 기본정보설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">1. 공동구매 등록을 클릭하여 설정합니다.<br>
					2. 분류를 클릭하면 해당 공구에 대한 상품을 등록하실 수 있습니다.</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#B584C6" colspan="5">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">&nbsp; 
													<strong>
													차수별 공동구매 리스트</strong></td>
												<td width="50%">
													<p align="right">
													<input onclick="window.location.href='union_write.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="공동구매 등록"> 
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="6%" bgcolor="#DDC5E4" align="center">번호</td>
										<td width="13%" bgcolor="#DDC5E4" align="center">분류</td>
										<td width="13%" bgcolor="#DDC5E4" align="center">시작일시</td>
										<td width="13%" bgcolor="#DDC5E4" align="center">마감일시</td>
										<td width="6%" bgcolor="#DDC5E4" align="center">관리</td>
									</tr>
									<?
									$SQL = "select * from $Union_ListTable where mart_id='$mart_id' order by union_no desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if ($cnfPagecount == "") $cnfPagecount = 5;
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
									$union_no = $ary["union_no"];
									$limit_chk = $ary["limit_chk"];
									$limit_no = $ary["limit_no"];
									$limit_order_date = $ary["limit_order_date"];
									$limit_order_date1 = $ary["limit_order_date1"];
									$limit_pay_date = $ary["limit_pay_date"];
									$limit_pay_date1 = $ary["limit_pay_date1"];
									$limit_send_date = $ary["limit_send_date"];
									$limit_send_date1 = $ary["limit_send_date1"];
									$slide_chk = $ary["slide_chk"];
									$slide_no = $ary["slide_no"];
									$slide_order_date = $ary["slide_order_date"];
									$slide_order_date1 = $ary["slide_order_date1"];
									$slide_pay_date = $ary["slide_pay_date"];
									$slide_pay_date1 = $ary["slide_pay_date1"];
									$slide_send_date = $ary["slide_send_date"];
									$slide_send_date1 = $ary["slide_send_date1"];
									$date = $ary["date"];
									
									$limit_order_date_str = substr($limit_order_date,0,4)."/".substr($limit_order_date,4,2)."/".substr($limit_order_date,6,2);
									$limit_order_date1_str = substr($limit_order_date1,0,4)."/".substr($limit_order_date1,4,2)."/".substr($limit_order_date1,6,2);
									$slide_order_date_str = substr($slide_order_date,0,4)."/".substr($slide_order_date,4,2)."/".substr($slide_order_date,6,2);
									$slide_order_date1_str = substr($slide_order_date1,0,4)."/".substr($slide_order_date1,4,2)."/".substr($slide_order_date1,6,2);
									//echo "limit_chk = $limit_chk";
									//echo "slide_chk = $slide_chk";
									$j = $numRows - $i;
									if($limit_chk == 1 && $slide_chk == 1){ 
										echo ("
								<tr>
										<td width='6%' bgcolor='#FFFFFF' align='center' rowspan='2'>
											$j
										</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>
											<a href='union_limit_item_list.php?union_no=$union_no'>
											제$limit_no 차 한정판매</a></td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$limit_order_date_str</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$limit_order_date1_str</td>
										<td width='10%' bgcolor='#FFFFFF' align='center' rowspan='2'>
											<input class='aa' onclick=\"window.location.href='union_edit.php?union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> 
											<input class='aa' onclick=\"return really('$union_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'> 
										</td>
									</tr>
									<tr>
										<td width='13%' bgcolor='#FFFFFF' align='center'>
											<a href='union_slide_item_list.php?union_no=$union_no'>
											제$slide_no 차 슬라이딩</a></td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$slide_order_date_str</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$slide_order_date1_str</td>
									</tr>
											");
										}
										if($limit_chk == 1 && $slide_chk == ''){ 
										echo ("
								<tr>
										<td width='6%' bgcolor='#FFFFFF' align='center'>
											<a href='union_edit.php?union_no=$union_no'>
											$j</a>
										</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>
											<a href='union_limit_item_list.php?union_no=$union_no'>
											제$limit_no 차 한정판매</a></td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$limit_order_date_str</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$limit_order_date1_str</td>
										<td width='10%' bgcolor='#FFFFFF' align='center'>
											<input class='aa' onclick=\"window.location.href='union_edit.php?union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> 
											<input class='aa' onclick=\"return really('$union_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'> 
										</td>
									</tr>
											");
										}
										if($limit_chk == '' && $slide_chk == 1){ 
										echo ("
								<tr>
										<td width='6%' bgcolor='#FFFFFF' align='center' rowspan='1'>
											<a href='union_edit.php?union_no=$union_no'>
											$j</a>
										</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>
											<a href='union_slide_item_list.php?union_no=$union_no'>
											제$slide_no 차 슬라이딩</a></td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$slide_order_date_str</td>
										<td width='13%' bgcolor='#FFFFFF' align='center'>$slide_order_date1_str</td>
										<td width='10%' bgcolor='#FFFFFF' align='center'>
											<input class='aa' onclick=\"window.location.href='union_edit.php?union_no=$union_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> 
											<input class='aa' onclick=\"return really('$union_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'> 
										</td>
									</tr>
											");
										}
									}
									?>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<p align="right">
						<?
						if($page == 1){
							echo ("
							처음
							");
						}
						else{
							echo ("
							<a href='union_list.php?page=1'>처음</a> 
							");
						}
					
						if($start_page > 1){
							echo ("
							<a href='union_list.php?page=$prev_start_page'>
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
							<a href='union_list.php?page=$i'>$i</a> 
								");
							}
						}
						if($end_page < $total_page){
							echo ("
							<a href='union_list.php?page=$next_start_page'>
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
							<a href='union_list.php?page=$total_page'>끝</a> 
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
mysql_close($dbconn);
?>