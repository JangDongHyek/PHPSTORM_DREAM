<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "delete from $AdminMainTable where banner_no = $banner_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL2 = "delete from $Admin_ItemTable where adminmain_parent = $banner_no and mart_id='$mart_id'";
	$dbresult2 = mysql_query($SQL2, $dbconn);
 
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>관리자 지정상품 관리</b></td>
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
										<td width="100%" bgcolor="#e7e7e7" colspan="4">
											
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
												<td width="80%">&nbsp; <b>등록된 리스트</b> <br>&nbsp;&nbsp;&nbsp;<font color="blue">※화면이 깨지는걸 방지하기 위하여 이미지 사이즈가 600픽셀이상 인것은 500픽셀로 표시합니다.</font></td>
												<td width="20%"><p align="right"><input class="aa" onclick="window.location.href='banner_write_new.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="타이틀 이미지 등록">&nbsp;&nbsp;&nbsp;<input class="aa" onclick="window.location.href='banner_order.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="순서조정"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td bgcolor="#f7f7f7" align="center">이미지</td>
										<td bgcolor="#f7f7f7" align="center">등록일</td>
										<td bgcolor="#f7f7f7" align="center">상품관리</td>
										<td bgcolor="#f7f7f7" align="center">수정/삭제</td>
									</tr>
									<?
								$SQL = "select * from $AdminMainTable where mart_id='$mart_id' order by banner_order desc";
								$dbresult = mysql_query($SQL, $dbconn);
								$numRows = mysql_num_rows($dbresult);
								for ($i=0; $i<$numRows; $i++) {
									mysql_data_seek($dbresult,$i);
									$ary = mysql_fetch_array($dbresult);
									$banner_no = $ary["banner_no"];
									$info = $ary["info"];
									$img = $ary["img"];
									$banner_pos = $ary["banner_pos"];
									$link = $ary["link"];
									$date = $ary["date"];
									$if_flash = $ary["if_flash"];
									$flash_image = $ary["flash_image"];
									$flash_width = $ary["flash_width"];
									$flash_height = $ary["flash_height"];
									$img_width = $ary["img_width"];
									$img_height =$ary["img_height"];

									if($img_width > 600){
										$img_width = "500";
									}

			
									$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
									if($banner_pos == 'right') $banner_pos_str='오른편';
									if($banner_pos == 'left') $banner_pos_str='왼편';
									if($banner_pos == 'bottom') $banner_pos_str='하단';
									if($banner_pos == 'scrol') $banner_pos_str='스크롤';    
									echo ("
								<tr>
										<td bgcolor='#FFFFFF' align='center'>
						  ");
						  if($if_flash == 0){
							 if($img!='') echo "<img src='$Co_img_DOWN$mart_id/$img' width='$img_width' height='$img_height' border='0'>";
						  }
						  else{
							if($flash_image!='') echo "<embed src='$Co_img_DOWN$mart_id/$flash_image' width='$flash_width' height='$flash_height'>";
						  }
						  echo ("
											</td>
										<td bgcolor='#FFFFFF' align='center'>$date_str</td>
										<td bgcolor='#FFFFFF' align='center'>
										<input onclick=\"window.location.href='adminmain_item.php?banner_no=$banner_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='상품관리'>
										</td>
										<td bgcolor='#FFFFFF' align='center'>
											<input onclick=\"window.location.href='banner_edit_new.php?banner_no=$banner_no'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='수정'> 
											<input onclick=\"del('$banner_no')\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
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