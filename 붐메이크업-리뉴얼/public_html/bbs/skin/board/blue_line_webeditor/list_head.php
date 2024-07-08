<!--/////////////////////////////////////-리스트헤드시작--------->
<?
/******************************************************************
★ 파일설명 
★ 목록상단
★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$total_doc_count?>	총 게시물수
<?=$page?>						현재페이지
<?=$total_page?>			총 페이지수

<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$u_category?>			카테고리 선택 URL
<?=$category_list_option?>	카테고리 option 리스트
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>

******************************************************************/
?>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, 총 게시물 : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR>
	<TD bgcolor=#0D2465 height=1></TD>
</TR>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=30 bgcolor=#f7f7f7>
		<TD width=40 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><img src="<?=$skin_board_url?>images/bbs_title01.gif" width="22" height="11" /></td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
          </tr>
        </table></TD>
	
		<?=$show_category_begin?>
		<TD width=60 align=middle class="bbs"><FONT color=#000000>분류</FONT></TD>
		<?=$show_category_end?>
		
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/bbs_title02.gif" width="22" height="11" /></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/bbs_title10.gif" width="32" height="11" /></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/bbs_title03.gif" width="22" height="11" /></font></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/bbs_title11.gif" width="21" height="11"/></font></td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/list_line.gif" width="1" height="30" /></td>
          </tr>
        </table>
		  <?=$show_download_end?>
		
		</TD>
		<TD width=50 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/bbs_title04.gif" width="33" height="11" /></font></td>
              <td width="1" align="right"></td>
            </tr>
          </table></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>추천</FONT></TD>
		<?=$show_vote_yes_end?>
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>비추천</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	<TR> 
		<TD bgColor=#0D2465 colSpan=<?=$colspan?> height=1></TD>
	</TR>
	<!--/////////////////////////////////////-리스트헤드끝--------->