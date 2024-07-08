<!--/////////////////////////////////////-리스트풋시작--------->
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
  <TR height=40> 
    <td width=45% class="bbs" height="30"> 
      <?=$print_page?>
    </td>
    <TD width=55% class="bbs" align=right height="30"> 
      <?=$show_write_begin?>


<?
if($yeyak_date_start && $yeyak_date_end){
	$write_add = "&yeyak_date_start=$yeyak_date_start&yeyak_date_end=$yeyak_date_end";
}
?>

      <a href="write.php?bbs_id=<?=$bbs_id?><?=$write_add?>">
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
<table width="<?=$width?>" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="1"></td>
  </tr>
</table>
<table width="100%" border=0 align="center" cellpadding=6 cellspacing=0>
  <tr height=40> 
    <form name=fsearch method=get action='<?=$u_search?>'>
      <td width=55% class="bbs" align=right height="40"> 
        <div align="center">
    

			예약일:
			  <input type="text" name="yeyak_date_start" size="11" style="cursor:hand;font: 9pt 굴림; border:1 solid #d5d5d5 ; BACKGROUND-COLOR:#ffffff;" onClick="popUpCalendar(this, yeyak_date_start, 'yyyy-mm-dd');" value="<?=$yeyak_date_start?>">
		    ~
			  <input type="text" name="yeyak_date_end" size="11" style="cursor:hand;font: 9pt 굴림; border:1 solid #d5d5d5 ; BACKGROUND-COLOR:#ffffff;" onClick="popUpCalendar(this, yeyak_date_end, 'yyyy-mm-dd');" value="<?=$yeyak_date_end?>">



&nbsp;





				<?
					$ext32_array = array("접수","완료"); 
				?>
				상태:
				  <select name="ext32_change" class="lo_box" onchange="location='?bbs_id=yeyak_list&ext32_change='+this.value">
				<option value="">전체</option>
				<?					
					for($i=0;$i<sizeof($ext32_array);$i++){
						if($ext32_array[$i] == $ext32_change){
							$ext32_change_seled = "selected";
						}
				?>
						<option value="<?=$ext32_array[$i]?>" <?=$ext32_change_seled?>><?=$ext32_array[$i]?></option>
				<?
					$ext32_change_seled="";
					}	
					
				?>
				</select>	  
		  
		  
		  <input type=hidden name=bbs_id value='<?=$bbs_id?>'>
          <input type="checkbox" name="ss[sname]" value="1" <?=$checked_sname?>>
          이름 
          <input type="checkbox" name="ss[stel]" value="1" <?=$checked_stel?>>
          연락처 
          <input type=text name="ss[kw]" size=10  itemname='검색어' value='<?=$ss[kw]?>' class=b_input>
          <input onFocus=this.blur() type=image src="<?=$skin_board_url?>/images/search.gif" border=0 name=search_button align="absbottom">
        </div></td>
    </form>
  </tr>
</table>
<!--/////////////////////////////////////-리스트풋끝--------->