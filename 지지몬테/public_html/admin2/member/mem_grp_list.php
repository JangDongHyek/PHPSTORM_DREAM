<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){
	include "../admin_head.php";
?>
<script>
function really(grp_no){
	if (confirm("그룹을 삭제하시겠습니까?")){
		document.location.href='mem_grp_list.php?flag=del&grp_no='+grp_no;
	}
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원그룹관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				  <td vAlign="top" width="90%" bgColor="#ffffff">
				  현재 쇼핑몰에 가입한 회원들을 그룹별로 관리합니다.<br>
				  그룹명을 클릭하시면 해당그룹의 회원리스트가 출력됩니다.<br>
				  </td>
				</tr>
				<tr>
				  <td vAlign="top" width="90%" bgColor="#ffffff"></td>
				</tr>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
				</tr>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff" height="3"><table width="100%" border="0">
					 <tr>
						<td width="100%" colSpan="2" height="20"><p align="center"><strong>[회원그룹관리]</strong></td>
					 </tr>
					 <?
					 $SQL0 = "select * from $Member_GroupTable where mart_id='$mart_id' order by date desc";
					 $dbresult0 = mysql_query($SQL0,$dbconn);
					 $numRows0 = mysql_num_rows($dbresult0);
					 ?>
					 <tr>
						<td width="50%" height="20"><p align="left"><strong><span class="bb">&nbsp;&nbsp; 전체 
						그룹수 : 총 <font color="#ff0000"><?echo $numRows0?></font> 개</strong></td>
						<td width="50%" height="20"><p align="right">
						<input onclick="window.location.href='mem_grp_add.php'" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="그룹 새로등록"></td>
					 </tr>
				  </table>
				  </td>
				</tr>
				<tr>
				  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table
				  width="97%" border="0">
					 <tr>
						<td width="100%" bgColor="#ffffff">

						<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						  <tr>
							 <td align="middle" width="7%" height="30" bgColor="#e7e7e7"><strong>No.</strong></td>
							 <td align="middle" width="19%" bgColor="#e7e7e7"><strong>그룹명</strong></td>
							 <td align="middle" width="26%" bgColor="#e7e7e7"><strong>그룹설명</strong></td>
							 <td align="middle" width="12%" bgColor="#e7e7e7"><strong>회원수</strong></td>
							 <td align="middle" width="13%" bgColor="#e7e7e7"><strong>등록일</strong></td>
							 <td align="middle" width="23%" bgColor="#e7e7e7"><strong>그룹</strong></td>
						  </tr>
						  <?
						  for($i=0;$i<$numRows0;$i++){
							mysql_data_seek($dbresult0,$i);
										$ary = mysql_fetch_array($dbresult0);
										$grp_no = $ary["grp_no"];
										$grp_name = $ary["grp_name"];
									$grp_detail = $ary["grp_detail"];
									$area_use = $ary["area_use"];
									$sex_use = $ary["sex_use"];
									$age_use = $ary["age_use"];
									$login_use = $ary["login_use"];
									$money_use = $ary["money_use"];
									$bonus_use = $ary["bonus_use"];
									$area = $ary["area"];
									$sex = $ary["sex"];
									$age_from = $ary["age_from"];
									$age_to = $ary["age_to"];
									$login_from = $ary["login_from"];
									$login_to = $ary["login_to"];
									$money_from = $ary["money_from"];
									$money_to = $ary["money_to"];
									$bonus_from = $ary["bonus_from"];
									$bonus_to = $ary["bonus_to"];
										$date = substr($ary["date"],0,10);
										
										$today_year = date("y") + 100;
										
										$j = $i + 1;
										$SQL = "select count(*) from $Mart_Member_NewTable where mart_id='$mart_id' ";
										$SQL_AREA = " and binary address like '%$area%' ";
										$SQL_SEX = " and substring(passport2,1,1) ='$sex'";
										$SQL_AGE = " and ($today_year - substring(passport1,1,2)*1) between $age_from and $age_to ";
										$SQL_LOGIN = " and login_count between $login_from and $login_to ";
										$SQL_MONEY = " and money_total between $money_from and $money_to ";
										$SQL_BONUS = " and bonus_total between $bonus_from and $bonus_to ";
										$SQL_ORDER = " order by username";
										
										if($area_use == '1')
											$SQL = $SQL.$SQL_AREA;
										if($sex_use == '1')
											$SQL = $SQL.$SQL_SEX;
										if($sex_use == '1')
											$SQL = $SQL.$SQL_SEX;
										if($age_use == '1')
											$SQL = $SQL.$SQL_AGE;
										if($login_use == '1')
											$SQL = $SQL.$SQL_LOGIN;
										if($money_use == '1')
											$SQL = $SQL.$SQL_MONEY;
										if($bonus_use == '1')
											$SQL = $SQL.$SQL_BONUS;				
								
								$SQL .= $SQL_ORDER;
								//echo "sql=$SQL";
								$dbresult = mysql_query($SQL,$dbconn);
								$numRows = mysql_result($dbresult,0,0);
							
							echo "
						  <tr>
							 <td align='middle' width='7%' bgColor='#ffffff' height='25'>$j</td>
							 <td align='middle' width='19%' bgColor='#ffffff'>
							 <a href='mem_grp_mem_list.php?grp_no=$grp_no'>
							 $grp_name</a></td>
							 <td align='middle' width='26%' bgColor='#ffffff'>$grp_detail</td>
							 <td align='middle' width='12%' bgColor='#ffffff'>$numRows</td>
							 <td align='middle' width='13%' bgColor='#ffffff'>$date</td>
							 <td align='middle' width='23%' bgColor='#ffffff'>
							 <input onclick=\"window.location.href='mem_grp_edit.php?grp_no=$grp_no'\" class='aa' style='BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white' type='button' value='수정'>&nbsp; 
							 <input onclick=really('$grp_no') class='aa' style='BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white' type='button' value='삭제'></td>
						  </tr>
							";
						  }
						  ?>
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
}
if($flag == 'del'){
	$SQL = "delete from $Member_GroupTable where grp_no=$grp_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=mem_grp_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>