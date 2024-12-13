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
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" height="80%">
  <tr>
    <td>
	<div align="center">
	<TABLE cellPadding=0 cellpadding=0 width="330" border=0>
	<form name=form_password method=post action='<?=$u_action?>' enctype='multipart/form-data'>
	<TR> 
		<TD align=middle>
		<TABLE cellSpacing=5 cellPadding=0 border=0 bgColor=#e7e7e7>
		<TR> 
			<TD>
			<TABLE cellSpacing=0 cellPadding=0 bgColor=#ffffff border=0 height="150">
			<TR>
				<TD><IMG src="<?=$skin_board_url?>images/head_img12.gif" border=0></TD>
			</TR>
			<TR>
				<TD valign="top"> 
				  <TABLE cellSpacing=0 cellPadding=0 border=0 align=center>
				  <TR>
					<TD align=right><INPUT type=password size=15 required name=old_password itemname='암호' style=width:80;height:21; class=b_input></TD>
					<TD width=100 align=right><INPUT type=image onfocus=this.blur() src="<?=$skin_board_url?>images/head_img10.gif"> <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a></TD>
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
	</FORM>
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
<!-- 탑메뉴 끝-->

<!--
<div id="ht">
<div class="mb">
        <div class="ml"><img src="images/top.jpg" border="0" usemap="#Map2" /></div>
	  <div class="ml"><img src="images/logo_main.gif" width="300" height="53" border="0" usemap="#Map"/></div>
</div> 
		<div class="mb" style="width:100%; height:342px; z-index:-1; top:116px; left:0; position:absolute;">
<img src="images/p_t1.gif" width="300" height="46" style="width:300; height:46;border-box; max-width:100% !important;"></div>
		<div class="mb" style="width:100%; height:342px; z-index:1; top:165px; left:0; position:absolute;">
		  <iframe src="../bbs/list.php?bbs_id=online" width="300" height="300" frameborder="0" marginheight="0" marginwidth="0"></iframe>
		</div>
</div>
    </div>
</div>
<div id="hb6">
	  <div class="mbottom"></div>
	  <div class="mbottom"><img src="images/bottom.jpg" width="300" height="192" border="0" usemap="#copy"/></div>
</div>
-->
