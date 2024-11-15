<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "8";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>설문조사관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">
<?
	$vote_sum = 0;
$SQL = "select * from $PollTable where mart_id='$mart_id' and poll_code = $poll_code order by poll_code desc";

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
mysql_data_seek($dbresult,0);
$ary = mysql_fetch_array($dbresult);
$content = $ary["content"];
$answer1 = $ary["answer1"];
$answer2 = $ary["answer2"];
$answer3 = $ary["answer3"];
$answer4 = $ary["answer4"];
$answer5 = $ary["answer5"];
$answer6 = $ary["answer6"];
$answer7 = $ary["answer7"];
$answer8 = $ary["answer8"];
$answer9 = $ary["answer9"];
$vote_num1 = $ary["vote_num1"];
$vote_num2 = $ary["vote_num2"];
$vote_num3 = $ary["vote_num3"];
$vote_num4 = $ary["vote_num4"];
$vote_num5 = $ary["vote_num5"];
$vote_num6 = $ary["vote_num6"];
$vote_num7 = $ary["vote_num7"];
$vote_num8 = $ary["vote_num8"];
$vote_num9 = $ary["vote_num9"];

$vote_sum = $vote_num1 + $vote_num2 + $vote_num3 + $vote_num4 + $vote_num5 + $vote_num6 + $vote_num7 + $vote_num8 + $vote_num9;
$vote_sum_real = $vote_sum;
if($vote_sum == 0) $vote_sum = 1;
$vote_num1_per = intval(($vote_num1 / $vote_sum) *100);
$vote_num2_per = intval(($vote_num2 / $vote_sum) *100);
$vote_num3_per = intval(($vote_num3 / $vote_sum) *100);
$vote_num4_per = intval(($vote_num4 / $vote_sum) *100);
$vote_num5_per = intval(($vote_num5 / $vote_sum) *100);
$vote_num6_per = intval(($vote_num6 / $vote_sum) *100);
$vote_num7_per = intval(($vote_num7 / $vote_sum) *100);
$vote_num8_per = intval(($vote_num8 / $vote_sum) *100);
$vote_num9_per = intval(($vote_num9 / $vote_sum) *100);        
	
	$width1 = $vote_num1_per*2;
	$width2 = $vote_num2_per*2;
	$width3 = $vote_num3_per*2;
	$width4 = $vote_num4_per*2;
	$width5 = $vote_num5_per*2;
	$width6 = $vote_num6_per*2;
	$width7 = $vote_num7_per*2;
	$width8 = $vote_num8_per*2;
	$width9 = $vote_num9_per*2;
	
?>
							<tr>
								<td width="100%" height="10"><p align="left"><strong>&nbsp; [설문 결과보기]<br>
									<br>
									&nbsp; </strong>제 목 : <?echo $content?></td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="7%" bgcolor="#8FBECD" align="center">
											<strong>번호</strong></td>
										<td width="22%" bgcolor="#8FBECD" align="center">
											<strong>항목</strong></td>
										<td width="35%" bgcolor="#8FBECD" align="center">
											<strong>그래프</strong></td>
										<td width="9%" bgcolor="#8FBECD" align="center">
											<strong>투표수</strong></td>
										<td width="9%" bgcolor="#8FBECD" align="center">
											<strong>투표율</strong></td>
									</tr>
									<?
									
								
								if($answer1 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											1.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer1</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width1'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num1</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num1_per%</td>
									</tr>
										");
									}
									if($answer2 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											2.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer2</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width2'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num2</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num2_per%</td>
									</tr>
										");
									}
									if($answer3 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											3.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer3</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width3'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num3</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num3_per%</td>
									</tr>
										");
									}
									if($answer4 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											4.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer4</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width4'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num4</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num4_per%</td>
									</tr>
										");
									}
									if($answer5 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											5.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer5</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width5'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num5</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num5_per%</td>
									</tr>
										");
									}
									if($answer6 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											6.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer6</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width6'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num6</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num6_per%</td>
									</tr>
										");
									}
									if($answer7 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											7.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer7</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width7'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num7</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num7_per%</td>
									</tr>
										");
									}
									if($answer8 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											8.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer8</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width8'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num8</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num8_per%</td>
									</tr>
										");
									}
									if($answer9 != ""){
									echo ("		
								<tr>
										<td width='7%' bgcolor='#FFFFFF' align='center'>
											9.</td>
										<td width='22%' bgcolor='#FFFFFF' align='left'>
											$answer9</td>
										<td width='35%' bgcolor='#FFFFFF' align='left'>
											<img src='../images/graph.gif' height='13' width='$width9'></td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num9</td>
										<td width='9%' bgcolor='#FFFFFF' align='center'>$vote_num9_per%</td>
									</tr>
										");
									}			      
									?>
									<tr>
										<td width="64%" bgcolor="#C8DFEC" align="center" colspan="3">합 
												계</td>
										<td width="9%" bgcolor="#C8DFEC" align="center"><?echo $vote_sum_real?></td>
										<td width="9%" bgcolor="#C8DFEC" align="center">100%</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
				</center>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input onclick="window.location.href='poll_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로"></td>
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