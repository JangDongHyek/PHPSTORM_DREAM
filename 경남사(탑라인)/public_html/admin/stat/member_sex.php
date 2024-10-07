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
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "9";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원통계</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
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
															<select onchange="goto_byselect(this, 'self')" size="1" style="height: 18px; border: 1px solid black">
															<option value="member_region.php">지역별 분포</option>
															<option value="member_age.php">연령대별 분포</option>
															<option value="member_sex.php" selected>남녀비율 분포</option>
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
											<td width="50%"><b><font color="#FFFFFF">남녀비율 
												분포</font></b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="23%" bgcolor="#FFFFFF" align="left"><p align="center">성별</td>
									<td width="23%" bgcolor="#FFFFFF" align="left"><p align="center">회원수</td>
									<td width="7%" bgcolor="#FFFFFF" align="center">그래프</td>
								</tr>
								<?
								$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id'";
							//echo "sql4=$SQL4";
							$dbresult = mysql_query($SQL, $dbconn);
							$total_number = mysql_result($dbresult,0,0);
								
								if($total_number == 0){
									$man_number = 0;
									$man_graph_width = 0;
								$man_percent = 0;
								
								$woman_number = 0;
									$woman_graph_width = 0;
									$woman_percent = 0;
							
								}
								else{
									$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and substring(passport2,1,1) = '1'";
								
								//echo "sql4=$SQL4";
								$dbresult = mysql_query($SQL, $dbconn);
								$man_number = mysql_result($dbresult,0,0);
									$man_graph_width = number_format($man_number / $total_number * 250);
								$man_percent = number_format($man_number / $total_number * 100,2);
								
								$SQL = "select count(*) FROM $Mart_Member_NewTable where mart_id='$mart_id' and substring(passport2,1,1) = '2'";
								
								//echo "sql4=$SQL4";
								$dbresult = mysql_query($SQL, $dbconn);
								$woman_number = mysql_result($dbresult,0,0);
									$woman_graph_width = number_format($woman_number / $total_number * 250);
									$woman_percent = number_format($woman_number / $total_number * 100,2);
							}
							?>
							<tr>
									<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
										남</td>
									<td width="18%" height="25" bgcolor="#FFFFFF" align="center">
										<?echo $man_number?>명</td>
									<td width="66%" height="25" bgcolor="#FFFFFF" align="left">
										<img src="../images/graph1.gif" width="<?echo $man_graph_width?>" height="10"> 
										<?echo $man_percent?>%</td>
								</tr>
								<tr>
									<td width="16%" height="25" bgcolor="#FFFFFF" align="center">
										여</td>
									<td width="18%" height="25" bgcolor="#FFFFFF" align="center">
										<?echo $woman_number?>명</td>
									<td width="66%" height="25" bgcolor="#FFFFFF" align="left">
										<img src="../images/graph1.gif" width="<?echo $woman_graph_width?>" height="10"> 
										<?echo $woman_percent?>%</td>
								</tr>
								<tr>
									<td width="16%" height="25" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF">합계</font></b></td>
									<td width="18%" height="25" bgcolor="#FCB663" align="center">
										<b><font color="#FFFFFF"><?echo $total_number?>명</font></b></td>
									<td width="66%" height="25" bgcolor="#FCB663" align="left">
										<img src="../images/graph1.gif" width="250" height="10"> 
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