<?
function getWeekDay($y,$m,$d)
{
 $week = array("일","월","화","수","목","금","토");
 $yoil = date("w",mktime(0,0,0,$m,$d,$y));
 return $week[$yoil];
} 
?>
<SCRIPT LANGUAGE=JAVASCRIPT SRC="PopupCalendar.js"></SCRIPT>

<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, 총 : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TR>
	<TD bgcolor=#0D2465 height=1></TD>
</TR>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=30 bgcolor=#f7f7f7>
		<TD width=40 align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" align="center"><strong>번호</strong></td>
            <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
          </tr>
        </table></TD>
	

		
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="150" align="center"><strong>접수일</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="150" align="center"><strong>예약일</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="center"><strong>상태</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="120" align="center"><strong>예약시간</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="200" align="center"><strong>이름</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="210" align="center"><strong>연락처</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="center"><strong>금액</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="center"><strong>예약금</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="center"><strong>잔금</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><strong>행사기간</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><strong>행사장소</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><strong>비고</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="110" align="center"><strong>상담자</strong></td>
              <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
            </tr>
          </table>
		</TD>
		
	</TR>
	<TR> 
		<TD bgColor=#0D2465 colSpan=14 height=1></TD>
	</TR>
	<!--/////////////////////////////////////-리스트헤드끝--------->