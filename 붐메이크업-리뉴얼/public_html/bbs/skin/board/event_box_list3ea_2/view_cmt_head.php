<?
/******************************************************************
 �� ���ϼ��� �� 
�ڸ�Ʈ���

 �� ��Ų ������ ���� ���� ���� �� 

******************************************************************/
?>
<br />
<script src="../bbs/editor/easyEditor.js"></script>
<script>
	function chkForm(f)
	{
		var cmt_comment = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
		if(cmt_comment=="")
		{
			alert("������ �����ּ���!");
			ed.focus();
			return false;
		}
		//alert(rg_content); //��Ȯ��(�����)
		return true;
	}
</script>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="240"><table width="" cellpadding="0" cellspacing="0">
	      <tr>
	        <td width="120" height="40" align="center"  style="border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-right:1px solid #c92b2b;border-bottom:1px solid #c92b2b; background:#f6f6f6"><a href="./view.php?bbs_id=<?=$bbs_id?>&amp;doc_num=<?=$rg_doc_num?>&amp;page=<?=$page?>">ü���ǰ</a></td>
	        <td style="border-right:1px solid #c92b2b;border-top:1px solid #c92b2b" width="120" align="center"><font color="c92b2b"><b>��û�ϱ�</b></font></td>
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
                      <td align="left" class=bbs>&nbsp;&nbsp;&nbsp;�̸�&nbsp;:&nbsp; 
                        <input type=text name=cmt_name class=b_input size=10 maxlength=20 value='<?=$cmt_name?>' itemname='�̸�' required>
                      </td>
                      <td align="right" class=bbs style='padding-left:20px;'>��ȣ&nbsp;:&nbsp; 
                        <input type=password name=cmt_password class=b_input size=15 itemname='��ȣ' required>
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
			<td width=50 align=center class=bbs onclick="document.form_comment.cmt_comment.rows=document.form_comment.cmt_comment.rows+2" style=cursor:hand>��û<br>����
			<td>
			<textarea name="cmt_comment" rows="5" id="cmt_comment"></textarea>
<script>
		var ed = new easyEditor("cmt_comment"); //�ʱ�ȭ id�Ӽ���
		ed.init(); //�������� ����
</script>
			</td>
			<td width="80" height="100%"><input type=submit value='  ��û�ϱ�  ' style='background-color:#FFFFFF;color:#555555;border:1 solid;height:100%;width:100%; height:77px;cursor:hand;' class=input_text></td>
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