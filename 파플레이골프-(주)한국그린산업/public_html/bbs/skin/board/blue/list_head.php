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
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>��ü</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, �� �Խù� : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR>
	<TD bgcolor=#CCCCCC height=2></TD>
</TR>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=30 bgcolor=#f7f7f7>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>��ȣ</FONT></TD>
	
		<?=$show_category_begin?>
		<TD width=60 align=middle class="bbs"><FONT color=#000000>�з�</FONT></TD>
		<?=$show_category_end?>
		
		<TD align=middle class="bbs"><FONT color=#000000>��&nbsp;��</FONT></TD>
		<TD width=80 align=middle class="bbs"><FONT color=#000000>�ۼ���</FONT></TD>
		<TD width=80 align=middle class="bbs"><FONT color=#000000>�ø���¥</FONT></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle class="bbs"><FONT color=#000000>�ٿ�</FONT></TD>
		<?=$show_download_end?>
		
		<TD width=50 align=middle class="bbs"><FONT color=#000000>��ȸ��</FONT></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>��õ</FONT></TD>
		<?=$show_vote_yes_end?>
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>����õ</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	<TR> 
		<TD bgColor=#cdcdc0 colSpan=<?=$colspan?> height=1></TD>
	</TR>
