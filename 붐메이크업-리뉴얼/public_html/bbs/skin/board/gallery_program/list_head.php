<?
/******************************************************************
 �� ���ϼ��� �� 
��ϻ��

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
$l_cols = 0;
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
<TABLE width="<?=$width?>" height="30" border=0 cellPadding=0 cellSpacing=0>
	<TR>
	  <TD height=2 colspan="7" align="center" bgcolor=32A3C2></TD>
  </TR>
	<TR>
	  <TD width="30" align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_01.gif"  /></TD>
	  <TD height=29 width="1" align="center" bgcolor=#9CD5E2 background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD align="center" bgcolor=E3F3F7 height=29><img src="<?=$skin_board_url?>images/list_04.gif"  /></TD>
	  <TD width="1" align="center" background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD width="50" height=29 align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_06.gif"  /></TD>
	  <TD  align="center" width="1" background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD width="80" height=29 align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_05.gif"  /></TD>
  </TR>
	<TR>
		<TD height=1 colspan="7" align="center" bgcolor=32A3C2></TD>
	</TR>
</table>

<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<tr><td height="10"></td></tr>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>