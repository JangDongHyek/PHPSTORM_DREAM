<?
/******************************************************************
 ★ 파일설명 ★ 
코멘트상단

 ★ 스킨 제작을 위한 변수 설명 ★ 

******************************************************************/
?>
<br />
<script src="../bbs/editor/easyEditor.js"></script>
<script>
	function chkForm(f)
	{
		var cmt_comment = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
		if(cmt_comment=="")
		{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
		}
		//alert(rg_content); //값확인(디버깅)
		return true;
	}
</script>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="240"><table width="" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="120" height="40" align="center"  style="border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-right:1px solid #c92b2b;border-bottom:1px solid #c92b2b; background:#f6f6f6"><a href="./view.php?bbs_id=<?=$bbs_id?>&amp;doc_num=<?=$rg_doc_num?>&amp;page=<?=$page?>">체험상품</a></td>
	        <td style="border-right:1px solid #c92b2b;border-top:1px solid #c92b2b" width="120" align="center"><font color="c92b2b"><b>신청하기</b></font></td>
	        </tr>
        </table></td>
	    <td style="border-bottom:1px solid #c92b2b">&nbsp;</td>
      </tr>
    </table></td>
</tr>
<? if($auth[bbs_comment]){?>
<tr>
	<td style="padding-top:10px">
	<table border=0 width=100% cellpadding=0 cellspacing=0>
	<form name=form_comment method=post action='<?=$u_comment_write?>' autocomplete=off onsubmit="return chkForm(this);">
	<input type="hidden" name="url" value="./view2.php?bbs_id=<?=$bbs_id?>&doc_num=<?=$rg_doc_num?>&page=<?=$page?>">
<?=$show_mb_logout_begin?>
	<tr> 
		<td align=center style='padding-top:5;'>
		          <table border="0" cellspacing="0" cellpadding="0" align="left">
                    <tr> 
                      <td>&nbsp;</td>
                      <td align="left" class=bbs>&nbsp;&nbsp;&nbsp;이름&nbsp;:&nbsp; 
                        <input type=text name=cmt_name class=b_input size=10 maxlength=20 value='<?=$cmt_name?>' itemname='이름' required>
                      </td>
                      <td align="right" class=bbs style='padding-left:20px;'>암호&nbsp;:&nbsp; 
                        <input type=password name=cmt_password class=b_input size=15 itemname='암호' required>
                      </td>
                    </tr>
                  </table>
		</td>
	</tr>
<?=$show_mb_logout_end?>
	<tr>
		<td class=bottomline align=center> 
		<table width=100%>
		<tr> 
			<td width=50 align=center class=bbs onclick="document.form_comment.cmt_comment.rows=document.form_comment.cmt_comment.rows+2" style=cursor:hand>신청<br>내용
			<td>
			<textarea name="cmt_comment" rows="5" id="cmt_comment"></textarea>
<script>
		var ed = new easyEditor("cmt_comment"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>
			</td>
			<td width="80" height="100%"><input type=submit value='  신청하기  ' style='background-color:#FFFFFF;color:#555555;border:1 solid;height:100%;width:100%; height:77px;cursor:hand;' class=input_text></td>
		</tr> 
		</table>
		</td>
	</tr>
	</form>
	</table>
	</td>
</tr>
<? }else{?>
<tr>
	<td align="center" style="font-weight:bold" height="80">
	<br>
	<a href="./mb_login.php?url=view.php?bbs_id=<?=$bbs_id?>&doc_num=<?=$rg_doc_num?>&page=<?=$page?>"><img src="<?=$skin_board_url?>images/btn_login.gif" /></a>
	</td>
</tr>
<? }?>
<tr>
	<TD>
	<TABLE cellSpacing=0 cellPadding=5 width="100%" border=0>