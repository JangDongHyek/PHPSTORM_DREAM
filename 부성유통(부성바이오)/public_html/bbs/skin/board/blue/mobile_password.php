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
<script>
function chkchk(f){
	if(f.old_password.value == ""){
		alert("��й�ȣ�� �Է����ּ���.");
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
				<TD><b>�Է��Ͻ� ��й�ȣ�� �Է����ּ���.</b><br /></TD>
			</TR>
			<TR>
				<TD valign="top"> 
				  <TABLE cellSpacing=0 cellPadding=0 border=0 align=center>
				  <TR>
					<TD align=right><div align="center">
					  <INPUT type=password size=15 required name=old_password itemname='��й�ȣ' style=width:150;height:21; class=b_input>
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