<?
/******************************************************************
 ★ 파일설명 ★ 
암호입력스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$u_action?> 				폼 action URL
<?=$title?>		 				타이틀
<?=$message?> 				부가메시지

******************************************************************/
?>
<script>
function chkchk(f){
	if(f.old_password.value == ""){
		alert("비밀번호를 입력해주세요.");
		return false;
	}
}
</script>
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<div align="center">
	<TABLE cellPadding=0 cellpadding=0 width="450" border=0>
	<form name=form_password method=post action='<?=$u_action?>' enctype='multipart/form-data' onsubmit="return chkchk(this);">
	<TR> 
		<TD align=middle>
		<TABLE cellSpacing=5 cellPadding=0 border=0 >
		<TR> 
			<TD>
			<TABLE cellSpacing=0 cellPadding=0  border=0 height="150">
			<TR align="center">
				<TD><b>입력하신 비밀번호를 입력해주세요.</b><br /></TD>
			</TR>
			<TR>
				<TD valign="top"> 
				  <TABLE cellSpacing=0 cellPadding=0 border=0 align=center>
				  <TR>
					<TD align=right><div align="center">
					  <INPUT type=password size=15 required name=old_password itemname='비밀번호' style=width:150;height:21; class=b_input>
					  </div></TD>
					</tr>
					<tr>
					<TD width=200 height="50" align=right valign="bottom"><div align="center" style="padding-top:10px;">
					  <INPUT type=image src="<?=$skin_board_url?>images/head_img10.gif" style="margin:0px auto;padding:0px 0px 0px 0px; display:inline;">&nbsp;&nbsp;</FORM><INPUT type=image src="<?=$skin_board_url?>images/cancel.gif" border=0 onclick="location.href='./mobile_list.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num=<?=$doc_num?>';"></div></TD>
				</TR>
				</TABLE>
			   </TD>
			</TR>
			</TABLE>
			</TD>
		</TR>
		</TABLE>
		</TD>
	</TR>
	</TABLE>
	</div>
	</td>
  </tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	document.form_password.old_password.focus();
//-->
</SCRIPT>