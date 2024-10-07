<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
  <tr>
	 <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
	 <table cellSpacing="0" cellPadding="0" width="520" border="0">
		<tr>
		  <td vAlign="top" width="90%" bgColor="#ffffff"><br>
		  <strong>&nbsp;&nbsp; [오늘 로그인 업체회원 목록]</strong> <br>
		  <font color="red">&nbsp;&nbsp; </font><font color="#0000FF">오늘 
		  로그인한 업체회원목록을 살펴보실 수 있습니다.</font><font color="red"><br>
		  &nbsp;&nbsp; <br>
		  </font></td>
		</tr>
		<tr>
		  <td><font color="#000000">&nbsp; 
		  <?
		  $today = date("Y-m-d");
		  ?>
		  [<?echo $today?>]</font></td>
		</tr>
		<tr>
		  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table width="97%" border="0">
			 <tr>
				<td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table border="0" width="500"
				cellspacing="0" cellpadding="0">
				  <tr>
					 <td width="100%" bgcolor="#C0C0C0">
					 <table border="0" width="100%" cellspacing="1"  cellpadding="2">
					 <tr>
					 <?
					$SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id' 
					and substring(login_date,1,10)='$today' order by username";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								if ($cnfPagecount == "") $cnfPagecount = 50;
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
									$username = $ary["username"];
									$login_count = $ary["login_count"];
									$j = $numRows - $i;
									echo "<td width='11%' bgcolor='#EEEEEE' align='center'>$j</td>
												<td width='39%' bgcolor='#FFFFFF'>$username ($login_count 회)</td>";
						if($i%2==1){
							echo "
						</tr>
							";
							if($i+1 < ($cnfPagecount+$skipNum) && $i+1 < $numRows){
								echo "<tr>";
							}	
						}
						if(($i+1 >= ($cnfPagecount+$skipNum) || $i+1 >= $numRows)&&$i%2==0){
							echo "
							<td width='11%' bgcolor='#EEEEEE' align='center'></td>
						  <td width='39%' bgcolor='#FFFFFF'></td>
						  </tr>
							";
						}
						}
						?>
					 </table>
					 </td>
				  </tr>
				</table>
				</td>
			 </tr>
			 <tr>
				<td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table border="0" width="500">
				  <tr>
					 <td width="100%"><p align="right">
					 <?
				if($page == 1){
					echo ("
					처음
					");
				}
				else{
					echo ("
					<a href='today_login.php?page=1'>처음</a> 
					");
				}
			
				if($start_page > 1){
					echo ("
					<a href='today_login.php?page=$prev_start_page'>
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
					<a href='today_login.php?page=$i'>$i</a> 
						");
					}
				}
				if($end_page < $total_page){
					echo ("
					<a href='today_login.php?page=$next_start_page'>
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
					<a href='today_login.php?page=$total_page'>끝</a> 
					");
				}
				?>
				</td>
				  </tr>
				  <tr>
					 <td width="100%"><p align="center"><input onclick="window.close()" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="닫기"></td>
				  </tr>
				</table>
				</td>
			 </tr>
		  </table>
		  </center></div></td>
		</tr>
	 </table>
	 </center></div></td>
  </tr>
</table>

</body>
</html>
<?
mysql_close($dbconn);
?>