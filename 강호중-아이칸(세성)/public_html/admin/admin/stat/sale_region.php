<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
	include "./cal.php";
?>
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span> <span class="text_gray2_c">통계관리</span> &gt; <span class="text_gray2_c">판매통계</span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
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
			<!--왼쪽부분시작-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->	  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>판매통계 > 지역별</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF">판매에 대한 통계로써, 조건별로 검색하실 수 있습니다. 조건별 통계를 이용하여 이동하세요.<br>배송완료된 상품만 통계에 포함됩니다.</td>
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
															<td width="33%" height="25"><p align="left">조건 검색</td>
															<td width="67%" height="25"><p align="right">
																<select onChange="goto_byselect(this, 'self')" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
																<option value="sale_age.php">연령별</option>
																<option value="sale_region.php"  selected>지역별</option>
																<option value="sale_item.php">상품별</option>
																<option value="sale_period.php">기간별</option>
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
														<b><font color="#FFFFFF">검색결과 : 지역별 판매통계</font></b></td>
													<td width="50%"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="12%" bgcolor="#FFFFFF" align="center" height="25">지역</td>
											<td width="13%" bgcolor="#FFFFFF" align="center" height="25">판매건수</td>
											<td width="20%" bgcolor="#FFFFFF" align="center" height="25">판매액</td>
											<td width="55%" bgcolor="#FFFFFF" align="center" height="25">그래프</td>
										</tr>
										<?
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
								
									$area = array("서울", "인천", "대전", "대구", "부산", "광주", "울산", "경기", "경남", "경북", "전남", "전북", "충남", "충북", "강원", "제주");
										while (list($key, $val) = each($area)) {
											$SQL = "select * FROM $Order_BuyTable where mart_id='$mart_id' and ".
											"(status = '1' or status = '2' or status = '3' or status = '6') and ".
										"address like '%$val%'";
										
										//echo "sql=$SQL";
										$dbresult = mysql_query($SQL, $dbconn);
										$numRows = mysql_num_rows($dbresult);
											$sum_region = 0;
											for($i=0;$i<$numRows;$i++){
												mysql_data_seek($dbresult,$i);
												$ary = mysql_fetch_array($dbresult);
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
											$sum_region += $sum_tot;
											
										}	
											if($sum_total == 0){
											$sum_region_percent = 0;
											$sum_region_graph = 0;
										}
										else{
											$sum_region_percent = number_format($sum_region / $sum_total * 100,2);
											$sum_region_graph = number_format($sum_region / $sum_total * 200);
										}	
										
											$numRows = number_format($numRows);
											$sum_region = number_format($sum_region);
											
											echo ("
										<tr>
											<td width='5%' height='25' align='center' bgcolor='#FFFFFF'>
												<span class='bb'>$val</td>
											<td width='14%' height='25' align='right' bgcolor='#FFFFFF'>
												<span class='bb'>$numRows 건</td>
											<td width='22%' height='25' align='right' bgcolor='#FFFFFF'>
												<span class='bb'>$sum_region 원</td>
											<td width='59%' height='25' align='left' bgcolor='#FFFFFF'>
												<p align='left'><img src='../images/graph1.gif' width='$sum_region_graph' height='10'>
												<span class='bb'>$sum_region_percent %</td>
										</tr>
											");
										}
										?>
										<tr>
											<td width="12%" height="25" bgcolor="#FCB663" align="center">
												<b><font color="#FFFFFF">합계</font></b></td>
											<td width="17%" height="25" bgcolor="#FCB663" align="right">
												<b><font color="#FFFFFF"><?echo number_format($numRows_total)?> 건</font></b></td>
											<td width="16%" height="25" bgcolor="#FCB663" align="center">
												<b><font color="#FFFFFF"><?echo number_format($sum_total)?> 원</font></b></td>
											<td width="55%" height="25" bgcolor="#FCB663" align="center">
												<p align='left'><img src='../images/graph1.gif' width='200' height='10'>
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