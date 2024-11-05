<script> 
function toggle(el) { 
if (el.style.display == "none"){ 
el.filters.blendTrans.Apply(); 
el.style.display = ""; 
el.filters.blendTrans.Play() 
} 
else { 
el.filters.blendTrans.Apply(); 
el.style.display = "none"; 
el.filters.blendTrans.Play() 
} 
} 
</script> 
<table style="border:solid 1 #e5e5e5;" cellspacing=0 cellpadding=0 width=<?=$width?>> 
<tr> 
<td height=22 width=100% align=right bgcolor=#f1f1f1><a href=javascript:toggle(zerom_c) onfocus=this.blur()> 짧은답글쓰기 </a></td> 
</tr> 
<tr> 
<td> 
<span id="zerom_c" style="display:none;width:100%;filter:blendTrans(Duration=0.5)"> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
	<td>
		<table style="border:solid 1 #f1f1f1;" cellspacing=0 cellpadding=8 width=100% height=120>
		<script>
			function check_comment_submit(obj) {
				if(obj.memo.value.length<10) {
					alert("코멘트는 10자 이상 적어주세요");
					obj.memo.focus();
					return false;
				}
				return true;
			}
		</script>
		<form method=post name=write action=comment_ok.php onsubmit="return check_comment_submit(this)"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"> 
		<col width=95 align=right style=padding-right:10px></col><col width=></col>
		<?if(!$member['no']){?>
		<tr>
			<td><font class=z_list><b>이름</b></td>
			<td><font class=z_list><?=$c_name?></font></td>
		</tr>
		<?}?>
		<?=$hide_c_password_start?>
		<tr>
			<td><font class=z_list><b>비밀번호</b></td>
			<td><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
		</tr>
		<?=$hide_c_password_end?>
		<tr>	
			<td onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:hand><font class=z_list><b>코멘트</b><br>▼</td>
			<td>
				<table border=0 cellspacing=0 cellpadding=1 width=100% height=100%>
				<col width=></col><col width=100></col>
				<tr>
					<td width=100%><textarea name=memo cols=20 rows=8 class=textarea style=width:100%></textarea></td>
					<td width=100><input type=submit rows=5 class=submit value='  글쓰기  ' accesskey="s" style=height:100%></td>
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
