<?
	$bbs_category_table="rg_".$bbs_id."_category";
	$qry="
		SELECT *
		FROM $bbs_category_table
		where cat_num='$rg_cat_num'
		ORDER BY cat_order
	";
	$result=mysql_query($qry);
	if(!$result){
		echo mysql_error();
		echo mysql_errno();
	}
	$rs=mysql_fetch_array($result);
	$cat_name=$rs[cat_name];
?>
<script language="javascript">
	function holeCheck(val){
		var rg_cat_num=parseInt(document.getElementsByName("rg_cat_num")[0].value);
		if(val==0){
			document.getElementsByName("rg_cat_num2")[0].value="";
			document.getElementsByName("rg_cat_num3")[0].value="";
			document.getElementsByName("rg_cat_num4")[0].value="";
		}else if(val==10){
			if(form_write.rg_cat_num_re2.value==""){
				document.getElementsByName("rg_cat_num2")[0].value=rg_cat_num+val;
				document.getElementsByName("rg_cat_num3")[0].value="";
				document.getElementsByName("rg_cat_num4")[0].value="";
			}else{
				document.getElementsByName("rg_ext1")[0].check=true;
				alert("�˼��մϴ�. ���� 18Ȧ�� �̹� �¶��� ������ �Ǿ��ֽ��ϴ�.");
				return;
			}
		}else if(val==20){
			if(form_write.rg_cat_num_re3.value==""&&form_write.rg_cat_num_re2.value==""){
				document.getElementsByName("rg_cat_num2")[0].value=rg_cat_num+10;
				document.getElementsByName("rg_cat_num3")[0].value=rg_cat_num+val;
				document.getElementsByName("rg_cat_num4")[0].value="";
			}else{
				document.getElementsByName("rg_ext1")[0].check=true;
				alert("�˼��մϴ�. ���� 27Ȧ�� �̹� �¶��� ������ �Ǿ��ֽ��ϴ�.");
				return;
			}
		}else if(val==30){
			if(form_write.rg_cat_num_re3.value==""&&form_write.rg_cat_num_re2.value==""&&form_write.rg_cat_num_re4.value==""){
				document.getElementsByName("rg_cat_num2")[0].value=rg_cat_num+10;
				document.getElementsByName("rg_cat_num3")[0].value=rg_cat_num+20;
				document.getElementsByName("rg_cat_num4")[0].value=rg_cat_num+val;
			}else{
				document.getElementsByName("rg_ext1")[0].check=true;
				alert("�˼��մϴ�. ���� 36Ȧ�� �̹� �¶��� ������ �Ǿ��ֽ��ϴ�.");
				return;
			}
		}

	}
</script>
<? $sql="select * from $bbs_category_table where cat_num='$rg_cat_num'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$cat_name=$rs[cat_name];
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' <? if($mode == 'edit') {?>OnSubmit='javascript:return ContentCheck()'<?}?> enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=rg_content value='��Ÿ����'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="rg_html_use" value="1" <?=$checked_html_use1?>>
<input type="hidden" name="rg_cat_num" value="<?=$rg_cat_num?>">
<input type="hidden" name="rg_cat_num2" value="<?=$rg_cat_num2?>">
<input type="hidden" name="rg_cat_num3" value="<?=$rg_cat_num3?>">
<input type="hidden" name="rg_cat_num4" value="<?=$rg_cat_num4?>">
<input type="hidden" name="rg_ext5" value="<?=$rg_ext5?>">
<input type="hidden" name="rg_secret" value="1">
<?
	$rg_cat_num_re2=$rg_cat_num+10;
	$rg_cat_num_re3=$rg_cat_num+20;
	$rg_cat_num_re4=$rg_cat_num+20;
	$sql="select * from $bbs_table where rg_cat_num='$rg_cat_num_re2' and rg_ext5='$rg_ext5'";
	$result2=mysql_query($sql);
	$rs2=mysql_fetch_array($result2);
	
	$sql="select * from $bbs_table where rg_cat_num='$rg_cat_num_re3' and rg_ext5='$rg_ext5'";
	$result3=mysql_query($sql);
	$rs3=mysql_fetch_array($result3);

	$sql="select * from $bbs_table where rg_cat_num='$rg_cat_num_re2' and rg_ext5='$rg_ext5'";
	$result4=mysql_query($sql);
	$rs4=mysql_fetch_array($result4);
?>
<input type="hidden" name="rg_cat_num_re2" value="<?=$rs2[0]?>">
<input type="hidden" name="rg_cat_num_re3" value="<?=$rs3[0]?>">
<input type="hidden" name="rg_cat_num_re4" value="<?=$rs4[0]?>">
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
		<TR> 
			<TD height=30><B>&nbsp; </B><IMG 
                        src="<?=$skin_board_url?>images/arrow_1.gif" border=0 align=absmiddle> <b><?=date('Y�� n�� j��',$rg_ext5)." ".$cat_name." (".$rg_ext1."H)";?> ����</b><div align=right>(<font color=red>*</font>)ǥ�ð� �ִ� �κ��� �ʼ��׸��Դϴ�.<B> 
                          &nbsp; </B></div></TD>
		</TR>
		<TR> 
			<TD bgColor=#0D2465 height=1></TD>
		</TR>
		


		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> �����ڸ�<B> &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"> 
                          <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�̸�' style=width:100%;height:22; class=b_input>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>


				
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> Ȧ�� &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input type="radio" name="rg_ext1" value="9Ȧ" <? if($rg_ext1=="9Ȧ"){echo "checked";}else if(!$rg_ext1){echo "checked";}?> onclick="holeCheck(0)">9Ȧ
						   <? if($rg_cat_num < 104){ ?>
						   <input type="radio" name="rg_ext1" value="18Ȧ" <? if($rg_ext1=="18Ȧ"){echo "checked";}?> onclick="holeCheck(10)">18Ȧ
						   <? } ?>
						   <input type="radio" name="rg_ext1" value="27Ȧ" <? if($rg_ext1=="27Ȧ"){echo "checked";}?> onclick="holeCheck(20)">27Ȧ
						   <input type="radio" name="rg_ext1" value="36Ȧ" <? if($rg_ext1=="36Ȧ"){echo "checked";}?> onclick="holeCheck(30)">36Ȧ
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> ����ó &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_title' type=text style=width:100%;height:22; class=b_input id="rg_title" value='<?=$rg_title?>'  maxlength=100 required itemname='����ó'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR>
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> �ο� &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <select name="rg_ext2" required itemname='�ο�'>
							<option value="">===�ο� ��===</option>
							<option value="2��" <? if($rg_ext2=="2��"){echo "selected";}?>>2��</option>
							<option value="3��" <? if($rg_ext2=="3��"){echo "selected";}?>>3��</option>
							<option value="4��" <? if($rg_ext2=="4��"){echo "selected";}?>>4��</option>
						  </select>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<?/*
		<TR> 
			<TD height="50"  nowrap>
				 <TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>��Ÿ����  ��<B>&nbsp;</B></TD>
					    <TD align=left height="100"> <textarea name="rg_content" id="rg_content"  cols=60  rows=18 style="width:100%;word-break:break-all;" class="b_textarea"><?=$rg_content?></textarea>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		*/?>
<?=$show_link_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 					
                        <TD width=80 align=right bgColor=#fafafa class="bbs">��ũ 1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_link1_url' type=text style=width:100%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='��ũ #1'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>																						
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
                        <TD width=80 align=right bgColor=#fafafa class="bbs">��ũ 2<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link2_url' type=text style=width:100%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='��ũ #2'>
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
                        <TD width=80 align=right bgColor=#fafafa class="bbs">÷������ 1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file11' type='text' style=width:85%;height:22; class=b_input id="rg_file1"  itemname='���� #1'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file1' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file11.value=this.value'></span>
						
						  <?=$show_file1_delete_begin?>
						  <br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          ���� (
                          <?=$rg_file1_name?>
                          ) 
                          <?=$show_file1_delete_end?>
                          <?=$show_file1_size_begin?>

                          ��  ����ũ�� <?=$upload_file1_size?>����,
                          <?=$show_file1_size_end?>
                          <?=$show_file1_ext_begin?>
                          Ȯ���� <?=$upload_file1_ext?> ÷�� <?=($upload_file1_able)?'����':'�Ұ���'?>
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
					    <TD width=80 align=right bgColor=#fafafa class="bbs">÷��ȭ�� 2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file22' type='text' style=width:85%;height:22; class=b_input id="rg_file2"  itemname='���� #2'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file2' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file22.value=this.value'></span>
                          <?=$show_file2_delete_begin?>
                          <br>
                           <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          ���� (
                          <?=$rg_file2_name?>
                          ) 
                          <?=$show_file2_delete_end?>
                          <?=$show_file2_size_begin?>
                   				�� ����ũ�� <?=$upload_file2_size?> ����, 
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  Ȯ���� <?=$upload_file2_ext?> ÷�� <?=($upload_file2_able)?'����':'�Ұ���'?>
						  <?=$show_file2_ext_end?>

						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>
		<?=$show_password_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* ��й�ȣ<B> 
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:90%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='��ȣ'>
                          &nbsp;</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_password_end?>

<?=$show_ext1_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><B><?=$show_ext1_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext1_input?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext1_end?>
<?=$show_ext2_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext2_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext2_input?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext2_end?>
<?=$show_ext3_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext3_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext3_input?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext3_end?>
<?=$show_ext5_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext5_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext5_input?>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext5_end?>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD bgcolor=#0D2465 height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> 
		<INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</form>
</TABLE>
<br>
<br>