<?
/******************************************************************
 ★ 파일설명 ★ 
글삭제,코멘트삭제시 확인

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$u_action?> 				폼 action URL
<?=$title?>		 				타이틀
<?=$message?> 				부가메시지

******************************************************************/
?>
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" height="300">
  <tr>
    <td>
<div align="center"><TABLE cellPadding=0 width="300" border=0>
<form name=frgform method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='confirm_ok'>
<TR> 
	<TD align=middle>
	<TABLE cellSpacing=5 cellPadding=0 border=0 bgColor=#e7e7e7>
	<TR> 
		<TD align=middle>
		<TABLE cellSpacing=0 cellPadding=0 bgColor=#ffffff border=0 height="150">
		<TR> 
			<TD><IMG src="<?=$skin_board_url?>images/head_img11.gif" border=0></TD>
		</TR>
		<TR> 
			              <TD align=middle bgColor=#ffffff class="bbs"><font color="#000000"> 
                            <?=$message?>
                            </font> <br>
			<INPUT type=image onfocus=this.blur() src="<?=$skin_board_url?>images/head_img10.gif"> 
			<a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a></TD>
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