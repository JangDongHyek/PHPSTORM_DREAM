	  </table>
    </td>
  </tr>
<?=$show_comment_form_begin?>
  <tr>
	<td>
	  <table cellSpacing=0 cellPadding=6 width="100%" border=0>
		<tr bgcolor=#f7f7f7>
		  <td align=center class=bbs>

			<table border=0 width=100% cellpadding=0 cellspacing=0>
			<form name=form_comment method=post action='<?=$u_comment_write?>' autocomplete=off>
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
							<td width=20 align=center class=bbs onclick="document.form_comment.cmt_comment.rows=document.form_comment.cmt_comment.rows+2" style=cursor:hand>▼</td>
							<td> <textarea rows=5 name=cmt_comment class=b_textarea style='width:100%;' required itemname='코멘트내용'></textarea></td>
							<td width="70" height="100%"><input type=submit value='  코멘트  ' style='background-color:#FFFFFF;color:#555555;border:1 solid;height:100%;width:100%;cursor:hand;' class=b_input></td>
						</tr> 
					</table>
					</td>
				</tr>
				</form>
				</table>
			  </td>
			</tr>
		</table>
	</td>
  </tr>
<?=$show_comment_form_end?>
</table>
<br>
<? include($skin_board_path."list_head.php"); ?>