<?
/******************************************************************
 �� ���ϼ��� �� 
����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> ���̺��� ���� 
<?=$skin_board_url?>
��Ų URL 
<?=$site_url?>
����Ʈ URL 
<?=$bbs_id?>
�Խ��� ���̵� 
<?=$print_page?>
�׺���̼�(������ �̵�) navigation.php ���� 
<?=$show_write_begin?>
�۾��� 
<?=$show_write_end?>
<?=$a_write?>
�۾��� ��ũ 
<?=$show_chk_begin?>
īƮ��� 
<?=$show_chk_end?>
<?=$show_admin_begin?>
�۰��� 
<?=$show_admin_end?>
<?=$u_board_manager?>
�۰����ּ� 
<?=$u_search?>
�˻��� URL 
<?=$checked_sn?>
�̸�üũ 
<?=$checked_st?>
����üũ 
<?=$checked_sc?>
����üũ 
<?=$ss[kw]?>
�˻��� 
<?=$u_all_list?>
��ü��Ϻ���(�˻����) ******************************************************************/ 
?> </form> </TABLE> </TD> </TR></TABLE> 
<TABLE width="<?=$width?>" cellSpacing=0 cellPadding=6 border=0>
  <TR height=40 bgcolor="#f7f7f7"> 
    <td width=45% class="bbs" height="30"> 
      <?=$print_page?>
    </td>
    <TD width=55% class="bbs" align=right bgcolor="#f7f7f7" height="30"> 
      <?=$show_write_begin?>
      <?=$a_write?>
      <img src="<?=$skin_board_url?>images/write.gif" border=0> 
      <?=$show_write_end?>
      <?=$show_chk_begin?>
      <a href='javascript:all_checked();' <?=$class[link_bbs]?>><img src="<?=$skin_board_url?>images/check_all.gif" border=0></a> 
      <a href='javascript:all_unchecked();' <?=$class[link_bbs]?>><img src="<?=$skin_board_url?>images/check_cancel.gif" border=0></a> 
      <script language='javascript'>
	function all_checked()
	{
		var f = document.form_list;

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == 'chk_rg_num[]') { 
				f.elements[i].checked = true;
			}
		}
	}
	function all_unchecked()
	{
		var f = document.form_list;

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == 'chk_rg_num[]') { 
				f.elements[i].checked = false;
			}
		}
	}
	function board_manager(url)
	{
			var f = document.form_list;
			var chk_count = 0;

			for (var i=0; i<f.length; i++) { 
				if (f.elements[i].name == 'chk_rg_num[]' && f.elements[i].checked) { 
					chk_count++;
				}
			}
			if (!chk_count) {
				alert("�Խù��� �ϳ� �̻� �����ϼ���.");
				return;
			}

			window.open('', "board_manager", 'scrollbars=no,width=355,height=200');

			f.action = url;
			f.target='board_manager';
			f.submit();
	}
</script>
      <?=$show_chk_end?>
      <?=$show_admin_begin?>
      <a href="javascript:board_manager('<?=$u_board_manager?>')" class=bbs><img src="<?=$skin_board_url?>images/check_admin.gif" border=0></a> 
      <?=$show_admin_end?>
    </TD>
  </TR>
</TABLE>
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" bgcolor="#e7e7e7">
  <tr> 
    <td height="1"></td>
  </tr>
</table>
