<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	$SQL1 = "select * from $ControlTable where see_type='y' and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$dbrows1 = mysql_fetch_array($dbresult1);

if($flag=="del"){
	$SQL = "delete from $ControlTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
if($see_type == "y"){
	$SQL = "update $ControlTable set see_type='y' where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);	
	
	$SQL = "update $ControlTable set see_type='n' where banner_no != $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);	

	echo"<script>alert('메인에 등록되었습니다.');</script>";
	echo"<script>window.location.href='banner_list.php';</script>";
	echo"<script>exit;</script>";
}
?>
<?
	include "../admin_head.php";
?>
<script language="javascript">
<!--
function del(banner_no){
if (confirm("정말로 삭제하시겠습니까?")){
	window.location.href='banner_list.php?flag=del&banner_no='+banner_no;
}
else	
	return;
}
//-->
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "10";
include "../include/left_menu_layer.php"; 

?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>메인화면관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">

					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="100%" bgcolor="#FFFFFF">
									
								<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
									<tr>
										<td width="100%" bgcolor="#e7e7e7" colspan="2">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="50%"><b>&nbsp;&nbsp;&nbsp;&nbsp;현재 사용중인 스킨 : <font color="blue"><?=$dbrows1[name]?></font></b></td>
												<td width="50%"><p align="right"><input class="aa" onclick="window.location.href='control_write_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="스킨 등록"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td bgcolor="#f7f7f7" align="center">스킨명(미리보기)</td>
										<td bgcolor="#f7f7f7" align="center">수정/삭제/스킨사용</td>
									</tr>
									<?
								$SQL = "select * from $ControlTable where mart_id='$mart_id' order by banner_no desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$banner_no = $ary["banner_no"];
									$name = $ary["name"];
									$img1 = $ary["img1"];
			
									echo ("
								<tr>
										<td bgcolor='#FFFFFF' align='center'><a href='/market/main/index2.html?banner_no=$banner_no' target='_blank'><b>$name</b></a></td>
										<td bgcolor='#FFFFFF' align='center'>
											<input onclick=\"window.location.href='banner_edit_new.php?banner_no=$banner_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> /
											<input onclick=\"del('$banner_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'> /
								<input onclick=\"window.location.href='banner_list.php?banner_no=$banner_no&see_type=y'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='스킨사용'> 
										</td>
									</tr>
										");
									}
									?>
									</table>
								</td>
							</tr>
						</table>
						</td>
						</tr>
					</table>

<br><br>
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