<!--/////////////////////////////////////-����Ʈ������--------->
<?
/******************************************************************
�� ���ϼ��� 
�� ��ϻ��
�� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�

<?=$total_doc_count?>	�� �Խù���
<?=$page?>						����������
<?=$total_page?>			�� ��������

<?=$show_category_begin?>ī�װ�<?=$show_category_end?>
<?=$u_category?>			ī�װ� ���� URL
<?=$category_list_option?>	ī�װ� option ����Ʈ
<?=$show_chk_begin?>īƮ���(üũ�ڽ�)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>��õ��<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>����õ��<?=$show_vote_no_end?>

******************************************************************/
?>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onChange="location='<?=$u_category?>'+this.value;" class=select><option value=''>��ü</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs_total"><?=$page?>/<?=$total_page?>, �� �Խù� : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=38>
		<TD width=40 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
		    <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar01.gif" /></td>
            <td align="center">��ȣ</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table></TD>
	
		<?=$show_category_begin?>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">�з�</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table></TD>
		<?=$show_category_end?>
		
		<TD align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">����</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">�ۼ���</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000">�����</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><font color="#000000">�ٿ�</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table>
		  <?=$show_download_end?>
		
		</TD>
		<TD width=50 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
            <tr>
              <td align="center"><font color="#000000">��ȸ��</td>
              <td width="1" align="right"></td>
			  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar01.gif" /></td>
            </tr>
          </table></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>��õ</FONT></TD>
		<?=$show_vote_yes_end?>
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>����õ</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	<!--/////////////////////////////////////-����Ʈ��峡--------->