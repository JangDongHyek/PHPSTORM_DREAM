<?
/******************************************************************
 �� ���ϼ��� �� 
�ڸ�Ʈ�ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$skin_vote_url?>		��Ų URL
<?=$vtc_name?>				�α��εǾ� ������� �ۼ���
<?=$vtc_email?>				�α��εǾ� ������� �̸���

<?=$show_comment_form_begin?>
�ڸ�Ʈ�Է���
<?=$show_comment_form_end?>

<?=$show_mb_logout_begin?>
�α��εǾ� ���� �ʾ��� ���
<?=$show_mb_logout_end?>

<?=$show_mb_login_begin?>
�α��εǾ� �������
<?=$show_mb_login_end?>

<?=$u_comment_write?>	�ڸ�Ʈ�� action URL

******************************************************************/
?>
		</table>
<?=$show_comment_form_begin?>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<form action="" method="post" name="comment_form" id="vote_form">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="comment_write">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
<?=$show_mb_logout_begin?>
    <tr> 
      <td class=bottomline align=center> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
                <td align="left" class=bbs>&nbsp;&nbsp;&nbsp;�̸�&nbsp;:&nbsp; <input type=text name=vtc_name class=textarea size=15 maxlength=20 value='<?=$vtc_name?>' itemname='�̸�' required> 
                </td>
                <td align="center" class=bbs>�̸���&nbsp;:&nbsp; <input type=text name=vtc_email class=textarea size=20 maxlength=50 value='<?=$vtc_email?>' itemname='�̸���' email> 
                </td>
                <td align="right" class=bbs>��ȣ&nbsp;:&nbsp; <input type=password name=vtc_password class=textarea size=15 itemname='��ȣ' required></td>
                <td width="80" align=center></td>
              </tr>
            </table></td>
    </tr>
<?=$show_mb_logout_end?>
<?=$show_mb_login_begin?>
    <tr> 
      <td class=bottomline align=center> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
                <td height="24" align="left" valign="bottom" class=bbs>&nbsp;&nbsp;&nbsp;�̸�&nbsp;:&nbsp; 
                  <?=$vtc_name?>
                </td>
                <td valign="bottom" class=bbs>�̸���&nbsp;:&nbsp; 
                  <?=$vtc_email?>
                </td>
                <td width="80" align=center></td>
              </tr>
            </table></td>
    </tr>
<?=$show_mb_login_end?>
    <tr> 
      <td class=bottomline align=center> <table width=100%>
          <tr> 
            <td width=50 align=center class=bbs onclick="document.comment_form.vtc_comment.rows=document.comment_form.vtc_comment.rows+2" style=cursor:hand>���� ��
            <td><textarea rows=4 name=vtc_comment class=textarea style='width:100%' required itemname='�ڸ�Ʈ����'></textarea></td>
            <td width="80" height="100%"><input type=submit value='  �۾���  ' style="height:100%;width:100%"></td></tr> 
        </table></td>
    </tr>
  </form>
		<tr>
			<TD align=middle bgColor=#cdcdc colSpan=2 height=1><IMG 
				height=1 width="100%" border=0></TD>
			</TR>
</table>
<?=$show_comment_form_end?>