<?
/******************************************************************
 �� ���ϼ��� �� 
��ȣ�Է½�Ų

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$u_action?> 				�� action URL
<?=$title?>		 				Ÿ��Ʋ
<?=$message?> 				�ΰ��޽���

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
					<TD align=right><INPUT type=password size=15 required name=old_password itemname='��ȣ' style=width:80;height:21; class=b_input></TD>
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