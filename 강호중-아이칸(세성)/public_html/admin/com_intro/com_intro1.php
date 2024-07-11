<?
include "../lib/Mall_Admin_Session.php";
?>
<?
	include "../admin_head.php";
?>

<script language="JavaScript">
<!--
//*************************** 파일 업로드 창 ********************************************************************

function fileup(whichform,comment1,comment2){
// formname : form 의 name
// mart_id : 상점 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "file_upload_intro.php?whichform="+whichform+"&comment1="+comment1+"&comment2="+comment2;
	var uploadwin = window.open(url,"uploadwin","width=310,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

function OpenWindow2() {
	RemindWindow = window.open( "com_intro1_content.php", "mainpage2","toolbar=no,width=540,height=240,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=yes"); 
}
function prev_win() {
	window.open( "preview.php", "mainpage3","toolbar=no,width=600,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes"); 
}
//*************************** 파일 업로드 창 ********************************************************************

//-->
</script>
</head>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회사소개 설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="80%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="7" valign="top"><p style="padding-left: 15px"><span class="aa">아래의 화면을 보시고 &quot;√ click&quot;표시가 있는 부분을 
						클릭하셔서 수정하시고, 페이지하단의 Preview버튼을<br>
						클릭하시면 작성하신 회사소개화면을 보실 수 있습니다.<br>
						<br>
						</span>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="7" valign="top">
						<div align="center"><center>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="3"><img src="../images/lay1000.gif" border="0" WIDTH="438" HEIGHT="150"></td>
							</tr>
							<tr>
								<td><img src="../images/lay1001.gif" border="0" WIDTH="84" HEIGHT="266"></td>
								<td><a href="javascript:fileup('1','회사소개에 올릴 이미지를 업로드하세요.','이미지사이즈 : 가로 154pixel x 세로 173pixel');" onfocus="this.blur()"><img src="../images/lay1002.gif" border="0" WIDTH="92" HEIGHT="266"></a></td>
								<td><a href="javascript:OpenWindow2()" onfocus="this.blur()"><img src="../images/lay1003.gif" border="0" WIDTH="262" HEIGHT="134"></a><br>
									<a href="javascript:fileup('2','회사 약도에 올릴 이미지를 업로드하세요.','이미지사이즈 : 가로 450 pixel x 세로 350 pixel');" onfocus="this.blur()"><img src="../images/lay1004.gif" border="0" WIDTH="262" HEIGHT="132"></a></td>
							</tr>
						</table>
						</center></div><p style="padding-left: 10px" class="aa">　
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top"><p align="center"><span class="aa">
						<input class="aa" onclick='javascript:prev_win()' style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="Preview"></span></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top"></td>
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