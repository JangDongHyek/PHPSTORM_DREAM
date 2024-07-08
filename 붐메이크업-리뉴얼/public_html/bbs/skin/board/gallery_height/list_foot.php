<?

?> 
	</form>
	</TABLE>
	</TD>
	</TR>
	<TR>
		<TD height="50" COLSPAN=5   background="<?=$skin_board_url?>images/gallery_9.gif"></TD>
    </TR>
	<TR>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/spacer.gif" WIDTH=31 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/spacer.gif" WIDTH=62 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/spacer.gif" WIDTH=380 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/spacer.gif" WIDTH=16 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/spacer.gif" WIDTH=151 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE> 
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
				alert("게시물을 하나 이상 선택하세요.");
				return;
			}

			window.open('', "board_manager", 'scrollbars=no,width=355,height=200');

			f.action = url;
			f.target='board_manager';
			f.submit();
	}
	function modify(url)
	{
		var f = document.form_list;
		var chk_count = 0;
		var doc_num;

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == 'chk_rg_num[]' && f.elements[i].checked) { 
				chk_count++;
			}
		}
		if (chk_count != 1) {
			alert("수정할 게시물을 하나만 선택하세요.");
			return false;
		}
		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == 'chk_rg_num[]' && f.elements[i].checked) { 
				doc_num = f.elements[i].value;
				break;
			}
		}

		location.href = url+"="+doc_num;
	}
	function image_view(src)
	{
		image_view.src = src;
	}
</script>
      <?=$show_chk_end?>
      <?=$show_admin_begin?>
      <a href="javascript:board_manager('<?=$u_board_manager?>')" class=bbs><img src="<?=$skin_board_url?>images/check_admin.gif" border=0></a> 
	  <IMG src="<?=$skin_board_url?>images/modify.gif" border=0 onClick="modify('edit.php?bbs_id=<?=$bbs_id?>&page=<?=$page?>&doc_num')" style="cursor:hand;">
      <?=$show_admin_end?>
    </TD>
  </TR>
</TABLE>
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0" bgcolor="#e7e7e7">
  <tr> 
    <td height="1"></td>
  </tr>
</table>
<table width="<?=$width?>" cellspacing=0 cellpadding=6 border=0>
  <tr height=40> 
    <td class="bbs" height="40"></td>
    <form name=fsearch method=get action='<?=$u_search?>'>
      <td class="bbs" align=right height="40"> 
        <input type=hidden name=bbs_id value='<?=$bbs_id?>'>
        <input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>
        이름 
        <input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>
        제목 
        <input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>
        내용 
        <input type=text name="ss[kw]" size=10 required itemname='검색어' value='<?=$ss[kw]?>' class=b_input>
        <input onFocus=this.blur() type=image src="<?=$skin_board_url?>/images/search.gif" border=0 name=search_button align="absbottom">
        <a href="<?=$u_all_list?>"><img src="<?=$skin_board_url?>images/cancel.gif" border="0" align="absbottom"></a> 
      </td>
    </form>
  </tr>
</table>
