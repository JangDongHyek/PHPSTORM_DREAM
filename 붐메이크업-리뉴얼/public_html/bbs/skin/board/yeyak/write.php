<?
	if($mode=="edit"){
		if($_SESSION['ss_mb_level']!=10){
			$readonly="readonly";
		}
	}
?>
<script language="javascript">
	function Time_status(){
		window.open("./time_status.php","","width=400,height=300,scrollbars=yes");
	}
	function focus_move(val,next,length){
		if(val.length>=length){
			next.focus();
		}
	}

		function chkForm(f)
	{
		var denyArr=Array(",","-","/","=","~","|","?");
		for(var i=0;i<=denyArr.length;i++){
		//금지 단어 방지 스크립트
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		
	}

	function denyText(gubun){
		var obj_Deny=document.getElementById("bbs_deny_word").value;
		var obj_Title_arr=document.getElementById("rg_title").value.split(gubun);
		var obj_titles="";
		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(gubun);
		var obj_DenyArr=obj_Deny.split(",");
		for(var j=0;j<obj_Title_arr.length;j++){
			obj_titles+=obj_Title_arr[j];
		}
		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}
		var obj_Title=obj_titles;
		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk1=obj_Title.match(obj_DenyArr[i].toString());
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk1==obj_DenyArr[i]){
					return "제목에 "+chk1+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
				if(chk2==obj_DenyArr[i]){
					return "내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
			}
		}
		return "";
	}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' <? if($mode == 'edit') {?>OnSubmit='javascript:return ContentCheck()'<?}else{?>onsubmit="return chkForm(this);"<?}?> enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="rg_html_use" value="0"> 
<input type="hidden" name="input_date" value="<?=date('Y-m-d',$book);?>"> 
<input type="hidden" name='rg_title' value=".">
<input type="hidden" name='year' value="<?=$year?>">
<input type="hidden" name='month' value="<?=$month?>">
<input name=rg_secret type=hidden id="rg_secret" value='1'> 
<input type="hidden" name="bbs_deny_word" id="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
 <TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
		<TR> 
			<TD height=30><B>&nbsp; </B><IMG 
                        src="<?=$skin_board_url?>images/arrow_1.gif" border=0 align=absmiddle> <b><?=date('Y년 m월 d일',$book);?> 예약 <? if($mode == 'edit') {?>수정<?} else {?>작성<?}?></b><div align=right>(<font color=red>*</font>)표시가 있는 부분은 필수항목입니다.<B> 
                          &nbsp; </B></div></TD>
		</TR>
		<TR> 
			<TD bgColor=#cccccc height=1></TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=80 align=right bgColor=#fafafa class="bbs">옵션<B> 
                          &nbsp; </B></TD>
	                    <TD align=left class="bbs" bgcolor="#fafafa"> 

						  <?=$show_secret_begin?>
						  비밀글&nbsp; 
						  <?=$show_secret_end?>
						  <?
						  if($ss_mb_level == 10){
						  ?>
						  <input type="checkbox" name="complete" value="y" <?if($complete=="y"){echo"checked";}?>>예약완료
						  <?
						  }
						  ?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>


		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> <B>이름 &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"> 
                          <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름' style=width:30%;height:22; class=b_input>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>


<?=$show_password_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> <B>비밀번호
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:30%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='암호'>
                          &nbsp;</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_password_end?>
		
<?
if($ss_mb_level == 10 || $mode == "write"){
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> <B>예약시간</b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext1_input?>시
						  <?=$show_ext2_input?>분
						  <? if($ss_mb_level==10){?>
						  <a href="javascript:Time_status()">[시간설정]</a>
						  <? }?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?
}else{
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><B>예약시간</b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$rg_ext1?>시
						  <input type="hidden" name="rg_ext1" value="<?=$rg_ext1?>">
						  <input type="hidden" name="rg_ext2" value="<?=$rg_ext2?>">
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>

<?
}
?>

<?=$show_ext3_begin?>
		<TR> 
		<?
		$rg_ext3_ex = explode("-",$rg_ext3);
		?>
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font><b><?=$show_ext3_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                         <input type="text" name="rg_ext3_1" value="<?=$rg_ext3_ex[0]?>" size="4" required itemname="연락처" onkeyup="focus_move(this.value,form_write.rg_ext3_2,'3')">
						 -
						 <input type="text" name="rg_ext3_2" value="<?=$rg_ext3_ex[1]?>" size="4" required itemname="연락처" onkeyup="focus_move(this.value,form_write.rg_ext3_3,'4')">
						 -
						 <input type="text" name="rg_ext3_3" value="<?=$rg_ext3_ex[2]?>" size="4" required itemname="연락처" onkeyup="focus_move(this.value,form_write.rg_ext4,'4')">
						 (<span style="font-weight:bold;color:#3369c1">정확한 연락처가 아니면 삭제될 수 있습니다.</span>)
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext3_end?>
<?=$show_ext4_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b>* 면접시간</b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input type="text" name="rg_ext4" value="<?=$rg_ext4?>" required itemname="면접시간">
						  (<span style="font-weight:bold;color:#3369c1">정확한 면접시간을 적어주세요.</span>)
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext4_end?>



		<TR> 
			<TD  nowrap>
				 <TABLE width="100%" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"></TD>
					    <TD bgColor=#fafafa class="bbs" style="color:#3369c1" colspan="2">
							메이크업 + 헤어 <b>1시간 30분</b> 소요합니다~<br>
							<b>기재사항을 정확히 남겨 주시면 예약 확인 전화 드리겠습니다.!^^*</b><br>
							<span style="color:red"><b>부정확할시 예약 취소</b></span> 되실수 있으니 유의해 주세요~~감사합니다.
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50"  nowrap valign="top">
				 <TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand><font color=red>*</font> 남기실글  ▼<B>&nbsp;</B></TD>
					    <TD align=left height="100"> <textarea name="rg_content" id="rg_content"  cols=60  rows=18 style="width:100%;word-break:break-all;" class="textarea2" required itemname='남기실글'><?=$rg_content?></textarea>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_link_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 					
                        <TD width=80 align=right bgColor=#fafafa class="bbs">링크 1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_link1_url' type=text style=width:100%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='링크 #1'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>																						
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
                        <TD width=80 align=right bgColor=#fafafa class="bbs">링크 2<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link2_url' type=text style=width:100%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='링크 #2'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_link_end?>
<?=$show_upload_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 					
                        <TD width=80 align=right bgColor=#fafafa class="bbs">첨부파일 1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file11' type='text' style=width:85%;height:22; class=b_input id="rg_file1"  itemname='파일 #1'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file1' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file11.value=this.value'></span>
						
						  <?=$show_file1_delete_begin?>
						  <br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          삭제 (
                          <?=$rg_file1_name?>
                          ) 
                          <?=$show_file1_delete_end?>
                          <?=$show_file1_size_begin?>

                          ※  파일크기 <?=$upload_file1_size?>이하,
                          <?=$show_file1_size_end?>
                          <?=$show_file1_ext_begin?>
                          확장자 <?=$upload_file1_ext?> 첨부 <?=($upload_file1_able)?'가능':'불가능'?>
                          <?=$show_file1_ext_end?>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs">첨부화일 2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file22' type='text' style=width:85%;height:22; class=b_input id="rg_file2"  itemname='파일 #2'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file2' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file22.value=this.value'></span>
                          <?=$show_file2_delete_begin?>
                          <br>
                           <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          삭제 (
                          <?=$rg_file2_name?>
                          ) 
                          <?=$show_file2_delete_end?>
                          <?=$show_file2_size_begin?>
                   				※ 파일크기 <?=$upload_file2_size?> 이하, 
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  확장자 <?=$upload_file2_ext?> 첨부 <?=($upload_file2_able)?'가능':'불가능'?>
						  <?=$show_file2_ext_end?>

						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD bgcolor=#cccccc height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> 
		<INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
<? if($mode == 'edit') {?>
<input type=hidden name=rg_ext5 value='<?=$rg_ext5?>'>
<?} else {?>
<input type=hidden name=rg_ext5 value='<?=$book?>'>
<?}?>
</form>
</TABLE>
<br>
<br>