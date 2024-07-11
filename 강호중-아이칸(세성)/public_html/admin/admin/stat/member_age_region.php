<?
include "../lib/Mall_Admin_Session.php";
	include "../admin_head.php";
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
                        						<option value="member_age.php">연령대별 분포</option>
                        						<option value="member_sex.php">남녀비율 분포</option>
                        						<option value="member_age_region.php" selected>연령+지역별 분포</option>
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
					
						<table border="0" width="450" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20"></td>
								<td width="430">
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" bgcolor="#7BBEBD">
										
											<table border="0" width="100%" cellspacing="1" cellpadding="3">
												<tr>
												<td width="100%" bgcolor="#E9F5F5" height="30">
												
													<table border="0" width="100%">
														
														<form method='post'>
														<input type='hidden' name='flag' value='search'>
												
														<tr>
															<td width="83%">
																연령+지역별 분포
																<select name='age'size="1" style="height: 18px; border: 1px solid black">
																<option value="15"
																<?
																if($age == '15') echo " selected"
																?>
																>15~20세</option>
																<option value="21"
																<?
																if($age == '21') echo " selected"
																?>
																>21~29세</option>
																<option value="30"
																<?
																if($age == '30') echo " selected"
																?>
																>30~39세</option>
																<option value="40"
																<?
																if($age == '40') echo " selected"
																?>
																>40세 이상</option>
																<option value="etc"
																<?
																if($age == 'etc') echo " selected"
																?>
																>기타</option>
															</select>&nbsp;&nbsp; 
																
																<select name="address" size="1">
																<option value="서울"
																<?
																if($address == '서울') echo " selected"
																?>
																>서울</option>
																<option value="인천"
																<?
																if($address == '인천') echo " selected"
																?>
																>인천</option>
																<option value="대전"
																<?
																if($address == '대전') echo " selected"
																?>
																>대전</option>
																<option value="대구"
																<?
																if($address == '대구') echo " selected"
																?>
																>대구</option>
																<option value="부산"
																<?
																if($address == '부산') echo " selected"
																?>
																>부산</option>
																<option value="광주"
																<?
																if($address == '광주') echo " selected"
																?>
																>광주</option>
																<option value="울산"
																<?
																if($address == '울산') echo " selected"
																?>
																>울산</option>
																<option value="경기"
																<?
																if($address == '경기') echo " selected"
																?>
																>경기</option>
																<option value="경남"
																<?
																if($address == '경남') echo " selected"
																?>
																>경남</option>
																<option value="경북"
																<?
																if($address == '경북') echo " selected"
																?>
																>경북</option>
																<option value="전남"
																<?
																if($address == '전남') echo " selected"
																?>
																>전남</option>
																<option value="전북"
																<?
																if($address == '전북') echo " selected"
																?>
																>전북</option>
																<option value="충남"
																<?
																if($address == '충남') echo " selected"
																?>
																>충남</option>
																<option value="충북"
																<?
																if($address == '충북') echo " selected"
																?>
																>충북</option>
																<option value="강원"
																<?
																if($address == '강원') echo " selected"
																?>
																>강원</option>
																<option value="제주"
																<?
																if($address == '제주') echo " selected"
																?>
																>제주</option>
														</select>&nbsp; 
														</td>
															<td width="17%">
																<p align="right">
																<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="submit" value="검색"></td>
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
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						<?
							if($flag == 'search'){
							
								$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id'";
							
							//echo "sql4=$SQL4";
							$dbresult = mysql_query($SQL, $dbconn);
							$number_total = mysql_result($dbresult,0,0);
							
							$today_year = date("y") + 100;
								
								if($age == '15'){
									$age_str = "15~20세";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 15 and $today_year - substring(passport1,1,2)*1 <= 20 and binary address like '%$address%'";
								
							}
							
							if($age == '21'){
									$age_str = "21~29세";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 21 and $today_year - substring(passport1,1,2)*1 <= 29 and binary address like '%$address%'";
								
							}
							
							if($age == '30'){
									$age_str = "30~39세";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 30 and $today_year - substring(passport1,1,2)*1 <= 39 and binary address like '%$address%'";
								
							}
							
							if($age == '40'){
									$age_str = "40세 이상";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 >= 40 and binary address like '%$address%'";
							}
							
							if($age == 'etc'){
									$age_str = "기타";
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and $today_year - substring(passport1,1,2)*1 < 15 and binary address like '%$address%'";
							}
							
							//echo "sql=$SQL";
							$dbresult = mysql_query($SQL, $dbconn);
							if($number_total == 0){
								$number = 0;
								$number_percent = 0;	
								$graph_width = 0;
							}
							else{
								$number = mysql_result($dbresult,0,0);
								$number_percent = number_format($number / $number_total * 100,2);	
								$graph_width = number_format($number / $number_total * 250);
							}
							
						?>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="100%" bgcolor="#8FBECD" colspan="3">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%">
													<b>
													<font color="#FFFFFF">검색결과 : <?echo $address?>/<?echo $age_str?> 
													분포 현황</font></b></td>
												<td width="50%"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="23%" bgcolor="#FFFFFF" align="left">
											<p align="center">지역</td>
										<td width="23%" bgcolor="#FFFFFF" align="left">
											<p align="center">회원수</td>
										<td width="7%" bgcolor="#FFFFFF" align="center">
											그래프</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
											<?echo $address?></td>
										<td width="18%" height="25" bgcolor="#FFFFFF" align="center">
											<?echo $number?>명</td>
										<td width="66%" height="25" bgcolor="#FFFFFF" align="left">
											<img src="../images/graph1.gif" width="<?echo $graph_width?>" height="10"> 
											<?echo $number_percent?>%</td>
									</tr>
									<tr>
										<td width="16%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF">전체</font></b></td>
										<td width="18%" height="25" bgcolor="#FCB663" align="center">
											<b><font color="#FFFFFF"><?echo $number_total?>명</font></b></td>
										<td width="66%" height="25" bgcolor="#FCB663" align="leftr">
											<img src="../images/graph1.gif" width="250" height="10"> 100%</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
						<?
							}
						?>
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