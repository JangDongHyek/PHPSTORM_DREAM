<?
/******************************************************************
 ★ 파일설명 ★ 
코멘트하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$skin_vote_url?>		스킨 URL
<?=$vtc_name?>				로그인되어 있을경우 작성자
<?=$vtc_email?>				로그인되어 있을경우 이메일

<?=$show_comment_form_begin?>
코멘트입력폼
<?=$show_comment_form_end?>

<?=$show_mb_logout_begin?>
로그인되어 있지 않았을 경우
<?=$show_mb_logout_end?>

<?=$show_mb_login_begin?>
로그인되어 있을경우
<?=$show_mb_login_end?>

<?=$u_comment_write?>	코멘트폼 action URL

******************************************************************/
?>
		</table>
<?=$show_comment_form_begin?>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<form action="" method="post" name="comment_form" id="vote_form">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="comment_write">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
<?=$show_mb_logout_begin?>
    <tr> 
      <td class=bottomline align=center> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
                <td align="left" class=bbs>&nbsp;&nbsp;&nbsp;이름&nbsp;:&nbsp; <input type=text name=vtc_name class=textarea size=15 maxlength=20 value='<?=$vtc_name?>' itemname='이름' required> 
                </td>
                <td align="center" class=bbs>이메일&nbsp;:&nbsp; <input type=text name=vtc_email class=textarea size=20 maxlength=50 value='<?=$vtc_email?>' itemname='이메일' email> 
                </td>
                <td align="right" class=bbs>암호&nbsp;:&nbsp; <input type=password name=vtc_password class=textarea size=15 itemname='암호' required></td>
                <td width="80" align=center></td>
              </tr>
            </table></td>
    </tr>
<?=$show_mb_logout_end?>
<?=$show_mb_login_begin?>
    <tr> 
      <td class=bottomline align=center> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
                <td height="24" align="left" valign="bottom" class=bbs>&nbsp;&nbsp;&nbsp;이름&nbsp;:&nbsp; 
                  <?=$vtc_name?>
                </td>
                <td valign="bottom" class=bbs>이메일&nbsp;:&nbsp; 
                  <?=$vtc_email?>
                </td>
                <td width="80" align=center></td>
              </tr>
            </table></td>
    </tr>
<?=$show_mb_login_end?>
    <tr> 
      <td class=bottomline align=center> <table width=100%>
          <tr> 
            <td width=50 align=center class=bbs onclick="document.comment_form.vtc_comment.rows=document.comment_form.vtc_comment.rows+2" style=cursor:hand>내용 ▼
            <td><textarea rows=4 name=vtc_comment class=textarea style='width:100%' required itemname='코멘트내용'></textarea></td>
            <td width="80" height="100%"><input type=submit value='  글쓰기  ' style="height:100%;width:100%"></td></tr> 
        </table></td>
    </tr>
  </form>
		<tr>
			<TD align=middle bgColor=#cdcdc colSpan=2 height=1><IMG 
				height=1 width="100%" border=0></TD>
			</TR>
</table>
<?=$show_comment_form_end?>