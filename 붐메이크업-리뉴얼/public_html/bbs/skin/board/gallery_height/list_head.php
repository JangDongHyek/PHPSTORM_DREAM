<?
/******************************************************************
 �� ���ϼ��� �� 
��ϻ��

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$img_width?>		�̹��� ����
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
<SCRIPT LANGUAGE="JavaScript">
<!--
	function change_image(src, width, title)
	{
		document.image_view.src = src;
		sText.innerHTML = title;

		if(width < <?=$image_width?>)
			document.image_view.width = width;
		else
			document.image_view.width = <?=$image_width?>;

		//document.image_view.height=600;
	}
//-->
</SCRIPT>
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
<TABLE WIDTH=640 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2>
			<IMG SRC="<?=$skin_board_url?>images/gallery_1.gif" WIDTH=93 HEIGHT=48 ALT=""></TD>
		<TD COLSPAN=3 background="<?=$skin_board_url?>images/gallery_2.gif"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20">&nbsp;</td>
          </tr>
          <tr>
            <td><nobr><p id="sText"></p></nobr></td>
          </tr>
        </table></TD>
	</TR>
	<TR>
		<TD COLSPAN=4>
			<IMG SRC="<?=$skin_board_url?>images/gallery_3.gif" WIDTH=489 HEIGHT=8 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/gallery_4.gif" WIDTH=151 HEIGHT=8 ALT=""></TD>
	</TR>
	<TR>
		<TD background="<?=$skin_board_url?>images/gallery_5.gif" WIDTH=31 height=350></TD>
		<TD COLSPAN=2 align=center><img src="<?=$skin_board_url?>blank_.gif" border="0" name="image_view" onClick="img_new_window(this.src)" style="cursor:hand;"></TD>
		<TD background="<?=$skin_board_url?>images/gallery_7.gif" WIDTH=16 height=350></TD>
		<TD valign="top" background="<?=$skin_board_url?>images/gallery_8.gif"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
		<form name=form_list method='post' action=''>
		<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
		<input type=hidden name=page value='<?=$page?>'>
