<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel >2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if($flag=="vote"){
	$vote_num = "vote_num".$ans_no;
	
	$SQL = "update $PollTable set $vote_num = $vote_num + 1 where poll_code = $poll_code and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
?>
<?
	include "../admin_head.php";
?>
</head>

<body leftmargin="0" topmargin="0">
<table border="0" width="400">
<tr>
	 <td width="100%">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
<?
$vote_sum = 0;
$SQL = "select * from $PollTable where mart_id='$mart_id' and poll_code = $poll_code order by poll_code desc";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
mysql_data_seek($dbresult,0);
$ary = mysql_fetch_array($dbresult);
$content = $ary["content"];
$date = $ary["date"];
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

$width1 = $vote_num1_per*1.5;
$width2 = $vote_num2_per*1.5;
$width3 = $vote_num3_per*1.5;
$width4 = $vote_num4_per*1.5;
$width5 = $vote_num5_per*1.5;
$width6 = $vote_num6_per*1.5;
$width7 = $vote_num7_per*1.5;
$width8 = $vote_num8_per*1.5;
$width9 = $vote_num9_per*1.5;
?>
		  <tr>
				<td width="100%" bgcolor="#FFFFFF">
					<table border="0" width="100%">
					<tr>
						<td width="100%" colspan="2"><?echo $content?></td>
					</tr>
					<tr>
						<td width="100%" colspan="2">
								<p align="right">전체응답자 수 : <?echo $vote_sum?>명 / 등록일 : 
								<?echo substr($date,0,10)?></td>
					</tr>
					<tr>
						<td width="100%" height="10" colspan="2"></td>
					</tr>
					<?
					if($answer1 != ""){
					echo ("	
				<tr>
						<td width='41%'>1. $answer1 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width1'>
							<font color='#006699'>$vote_num1 표($vote_num1_per %)</font></td>
					</tr>
						");
					}
					if($answer2 != ""){
					echo ("	
				<tr>
						<td width='41%'>2. $answer2 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width2'>
							<font color='#006699'>$vote_num2 표($vote_num2_per %)</font></td>
					</tr>
						");
					}
					if($answer3 != ""){
					echo ("	
				<tr>
						<td width='41%'>3. $answer3 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width3'>
							<font color='#006699'>$vote_num3 표($vote_num3_per %)</font></td>
					</tr>
						");
					}
					if($answer4 != ""){
					echo ("	
				<tr>
						<td width='41%'>4. $answer4 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width4'>
							<font color='#006699'>$vote_num4 표($vote_num4_per %)</font></td>
					</tr>
						");
					}
					if($answer5 != ""){
					echo ("	
				<tr>
						<td width='41%'>5. $answer5 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width5'>
							<font color='#006699'>$vote_num5 표($vote_num5_per %)</font></td>
					</tr>
						");
					}
					if($answer6 != ""){
					echo ("	
				<tr>
						<td width='41%'>6. $answer6 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width6'>
							<font color='#006699'>$vote_num6 표($vote_num6_per %)</font></td>
					</tr>
						");
					}
					if($answer7 != ""){
					echo ("	
				<tr>
						<td width='41%'>7. $answer7 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width7'>
							<font color='#006699'>$vote_num7 표($vote_num7_per %)</font></td>
					</tr>
						");
					}
					if($answer8 != ""){
					echo ("	
				<tr>
						<td width='41%'>8. $answer8 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width8'>
							<font color='#006699'>$vote_num8 표($vote_num8_per %)</font></td>
					</tr>
						");
					}
					if($answer9 != ""){
					echo ("	
				<tr>
						<td width='41%'>9. $answer9 </td>
						<td width='59%'><img src='../images/graph.gif' height='13' width='$width9'>
							<font color='#006699'>$vote_num9 표($vote_num9_per %)</font></td>
					</tr>
						");
					}
					?>
					</table>
					<p align="center">
					<input onclick='window.close()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="닫기">
					<br>
					<br>
					</p>
				</td>
		</tr>
			</table>
	</td>
</tr>
</table>
<?
mysql_close($dbconn);
?>