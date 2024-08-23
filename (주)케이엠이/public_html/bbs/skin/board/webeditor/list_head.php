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
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onChange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs_total"><?=$page?>/<?=$total_page?>, 총 게시물 : <?=$total_doc_count?></td>
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
            <td align="center">번호</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table></TD>
	
		<?=$show_category_begin?>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">분류</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table></TD>
		<?=$show_category_end?>
		
		<TD align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">제목</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">작성자</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000">등록일</td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
            </tr>
          </table></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><font color="#000000">다운</td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" /></td>
          </tr>
        </table>
		  <?=$show_download_end?>
		
		</TD>
		<TD width=50 align=middle class="bbs" background="<?=$skin_board_url?>images/head_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
            <tr>
              <td align="center"><font color="#000000">조회수</td>
              <td width="1" align="right"></td>
			  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar01.gif" /></td>
            </tr>
          </table></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>추천</FONT></TD>
		<?=$show_vote_yes_end?>
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle class="bbs"><FONT color=#000000>비추천</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	<!--/////////////////////////////////////-리스트헤드끝--------->