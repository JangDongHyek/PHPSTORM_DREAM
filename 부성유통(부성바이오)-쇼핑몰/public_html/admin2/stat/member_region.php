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


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="InitializeStaticMenu();">
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span> <span class="text_gray2_c">통계관리</span> &gt; <span class="text_gray2_c">회원통계</span> </div></td>
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
							<td width="10"></td>
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
															<option value="member_region.php" selected>지역별 분포</option>
															<option value="member_age.php">연령대별 분포</option>
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
					
					<table border="0" width="98%">
						<tr>
							<td width="90%" bgcolor="#ffffff">
								
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="3">
										
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%"><b><font color="#FFFFFF">지역별 회원분포</font></b></td>
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
								<?
								$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id'";
							//echo "sql4=$SQL4";
							$dbresult = mysql_query($SQL, $dbconn);
							$number_total = mysql_result($dbresult,0,0);
								$number_total_width = 250;
								
								$area = array("서울", "인천", "대전", "대구", "부산", "광주", "울산", "경기", "경남", "경북", "전남", "전북", "충남", "충북", "강원", "제주");
							while (list($key, $val) = each($area)) {
								if($val=='서울'||$val=='인천'||$val=='대전'||$val=='대구'||$val=='부산'||$val=='광주'||$val=='울산'||$val=='경기'||$val=='강원'||$val=='제주')
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and binary substring(address,1,8) like '%$val%'";
								if($val=='경남') 
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%경상남%')";
								if($val=='경북') 
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%경상북%')";
								if($val=='전남') 
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%전라남%')";
								if($val=='전북') 
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%전라북%')";
								if($val=='충남') 
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%충청남%')";
								if($val=='충북')
										$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and (binary substring(address,1,8) like '%$val%' or binary substring(address,1,8) like '%충청북%')";
									
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL, $dbconn);
								
									if($number_total == 0){
										$number = 0;
										$number_percent = 0;
										$number_width = 0;
									}
									else{
										$number = mysql_result($dbresult,0,0);
										$number_percent = number_format($number / $number_total * 100,2);
										$number_width = number_format($number / $number_total * 250);
								}
									echo ("
								<tr>
									<td width='16%' height='25' bgcolor='#FFFFFF' align='center'>
										$val</td>
									<td width='18%' height='25' bgcolor='#FFFFFF' align='center'>
										$number 명</td>
									<td width='66%' height='25' bgcolor='#FFFFFF' align='left'>
										<img src='../images/graph1.gif' width='$number_width' height='10'>
										$number_percent %</td>
								</tr>
									");
								}
								
								?>
								<tr>
									<td width="16%" height="25" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">합계</font></b></td>
									<td width="18%" height="25" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF"><?echo number_format($number_total)?>명</font></b></td>
									<td width="66%" height="25" bgcolor="#FCB663" align="left">
										<img src='../images/graph1.gif' width='<?echo $number_total_width?>' height='10'>
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