<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span> <span class="text_gray2_c">통계관리</span> &gt; <span class="text_gray2_c">회원통계</span> </div></td>
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
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원통계</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" height="35">가입한 회원들을 조건별로 검색하실 수 있습니다. 조건별 통계를 이용하여 이동하세요.</td>
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
														<td width="33%" height="25">
															<p align="left">조건 검색</td>
														<td width="67%" height="25">
															<p align="right">
															<select onChange="goto_byselect(this, 'self')" size="1" style="height: 18px; border: 1px solid black">
															<option value="member_region.php">지역별 분포</option>
															<option value="member_age.php" selected>연령대별 분포</option>
															<option value="member_sex.php">남녀비율 분포</option>
															<option value="member_age_region.php">연령+지역별 분포</option>
															</select></td>
													</tr>
												</table>
											</td>
											</tr>
										</table>
									</td>
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
										<td width="100%" bgcolor="#8FBECD" colspan="3">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">
													<b><font color="#FFFFFF">연령대별 회원분포</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="23%" bgcolor="#FFFFFF" align="left"><p align="center">연령</td>
										<td width="23%" bgcolor="#FFFFFF" align="left"><p align="center">회원수</td>
										<td width="7%" bgcolor="#FFFFFF" align="center">그래프</td>
									</tr>
									<?
									$today_year = date("y") + 100;
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id'";
								
								//echo "SQL=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
								$number_total = mysql_result($dbresult,0,0);
								$number_total_width = 250;
								if($number_total == 0){
										
										$number_15_20 = 0;
									$number_15_20_percent = 0;
									$number_15_20_width = 0;
									
									$number_21_29 = 0;
									$number_21_29_percent = 0;
									$number_21_29_width = 0;
									
									$number_30_39 = 0;
									$number_30_39_percent = 0;
									$number_30_39_width = 0;
									
									$number_40 = 0;
									$number_40_percent = 0;
									$number_40_width = 0;
									
									$number_etc = 0;
									$number_etc_percent = 0;
									$number_etc_width = 0;
									}
								else {	
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 15 and $today_year - substring(passport1,1,2)*1 <= 20";
								
									//echo "sql=$SQL";
									$dbresult = mysql_query($SQL, $dbconn);
									$number_15_20 = mysql_result($dbresult,0,0);
									$number_15_20_percent = number_format($number_15_20 / $number_total * 100,2);
									$number_15_20_width = number_format($number_15_20 / $number_total * 250);
									
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 21 and $today_year - substring(passport1,1,2)*1 <= 29";
									
									//echo "sql2=$SQL2";
									$dbresult = mysql_query($SQL, $dbconn);
									$number_21_29 = mysql_result($dbresult,0,0);
									$number_21_29_percent = number_format($number_21_29 / $number_total * 100,2);
									$number_21_29_width = number_format($number_21_29 / $number_total * 250);
									
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 30 and $today_year - substring(passport1,1,2)*1 <= 39";
									
									//echo "sql3=$SQL3";
									$dbresult = mysql_query($SQL, $dbconn);
									$number_30_39 = mysql_result($dbresult,0,0);
									$number_30_39_percent = number_format($number_30_39 / $number_total * 100,2);
									$number_30_39_width = number_format($number_30_39 / $number_total * 250);
									
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2) >= 40";
									
									//echo "sql4=$SQL4";
									$dbresult = mysql_query($SQL, $dbconn);
									$number_40 = mysql_result($dbresult,0,0);
									$number_40_percent = number_format($number_40 / $number_total * 100,2);
									$number_40_width = number_format($number_40 / $number_total * 250);
									
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2) < 15";
									
									//echo "sql4=$SQL4";
									$dbresult = mysql_query($SQL, $dbconn);
									$number_etc = mysql_result($dbresult,0,0);
									$number_etc_percent = number_format($number_etc / $number_total * 100,2);
									$number_etc_width = number_format($number_etc / $number_total * 250);
								}
								?>
								<tr>
										<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
											15~20</td>
										<td width="18%" height="25" bgcolor="#FFFFFF" align="center">
											<?echo $number_15_20?>명</td>
										<td width="66%" height="25" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_15_20_width?>" height="10">
											<?echo $number_15_20_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="5" bgcolor="#FFFFFF" align="center">
											21~29</td>
										<td width="18%" height="5" bgcolor="#FFFFFF" align="center">
											<?echo $number_21_29?>명</td>
										<td width="66%" height="5" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_21_29_width?>" height="10">
											<?echo $number_21_29_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="5" bgcolor="#FFFFFF" align="center">
											30~39</td>
										<td width="18%" height="5" bgcolor="#FFFFFF" align="center">
											<?echo $number_30_39?>명</td>
										<td width="66%" height="5" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_30_39_width?>" height="10">
											<?echo $number_30_39_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="5" bgcolor="#FFFFFF" align="center">
											40세이상</td>
										<td width="18%" height="5" bgcolor="#FFFFFF" align="center">
											<?echo $number_40?>명</td>
										<td width="66%" height="5" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_40_width?>" height="10">
											<?echo $number_40_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="5" bgcolor="#FFFFFF" align="center">
											기타</td>
										<td width="18%" height="5" bgcolor="#FFFFFF" align="center">
											<?echo $number_etc?>명</td>
										<td width="66%" height="5" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_etc_width?>" height="10">
											<?echo $number_etc_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF">합계</font></b></td>
										<td width="18%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF"><?echo $number_total?>명</font></b></td>
										<td width="66%" height="25" bgcolor="#FCB663" align="left">
											<img src="../images/graph1.gif" width="<?echo $number_total_width?>" height="10">
											100%</td>
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