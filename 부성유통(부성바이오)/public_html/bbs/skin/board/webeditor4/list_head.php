<!---------------------HEAD ����-------------------------->
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
<style type="text/css">
<!--
.t11 {
	font-family: "����";
	font-size: 11px;
	color: #929292;
}
-->
</style>

<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>��ü</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="t11"><?=$page?>/<?=$total_page?>, �� �Խù� : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 border=0>

<TR> 
	<TD>
	<TABLE width="100%" height="33" border=0 cellPadding=0 cellSpacing=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=33 >
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="6" align="center"><img src="<?=$skin_board_url?>images/left_line.gif" height="33"></td>
            <td align="center"><img src="<?=$skin_board_url?>images/list_01.gif"  /></td>
          </tr>
        </table></TD>
	
		<?=$show_category_begin?>
		<TD width=60 align=center background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><img src="<?=$skin_board_url?>images/list_02.gif" /></TD>
		<?=$show_category_end?>
		
		<TD align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/list_04.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/list_03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_05.gif" /></font></td>
            </tr>
          </table></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_07.gif"/></font></td>
          </tr>
        </table></TD>
		<?=$show_download_end?>
		
		<TD width=50 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_06.gif" /></font></td>
              <td width="7" align="center"><img src="<?=$skin_board_url?>images/right_line.gif" height="33" /></td>
            </tr>
          </table></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><FONT color=#000000>��õ</FONT></TD>
		<?=$show_vote_yes_end?>
		
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><FONT color=#000000>����õ</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	
<!---------------------HEAD ��-------------------------->






