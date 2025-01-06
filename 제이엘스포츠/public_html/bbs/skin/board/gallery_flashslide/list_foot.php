<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 테이블의 넓이 
<?=$skin_board_url?>
스킨 URL 
<?=$site_url?>
사이트 URL 
<?=$bbs_id?>
게시판 아이디 
<?=$print_page?>
네비게이션(페이지 이동) navigation.php 참고 
<?=$show_write_begin?>
글쓰기 
<?=$show_write_end?>
<?=$a_write?>
글쓰기 링크 
<?=$show_chk_begin?>
카트사용 
<?=$show_chk_end?>
<?=$show_admin_begin?>
글관리 
<?=$show_admin_end?>
<?=$u_board_manager?>
글관리주소 
<?=$u_search?>
검색폼 URL 
<?=$checked_sn?>
이름체크 
<?=$checked_st?>
제목체크 
<?=$checked_sc?>
내용체크 
<?=$ss[kw]?>
검색어 
<?=$u_all_list?>
전체목록보기(검색취소) ******************************************************************/ 
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
				alert("게시물을 하나 이상 선택하세요.");
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
