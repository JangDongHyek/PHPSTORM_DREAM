<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>                
<link href="./1278950988/jquery.datepick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./1278950988/jquery.datepick.min.js"></script>
<script type="text/javascript">
$(function() {
	$('#popupDatepicker').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
	$('#popupDatepicker2').datepick();
	$('#inlineDatepicker2').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>





<?
if($yeyak_date_start && $yeyak_date_end){
?>

<?
function getWeekDay($y,$m,$d)
{
 $week = array("��","��","ȭ","��","��","��","��");
 $yoil = date("w",mktime(0,0,0,$m,$d,$y));
 return $week[$yoil];
} 
?>



<TR>
	<TD>
	
	



		<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
		<TR>
			<TD bgcolor=#0D2465 height=1></TD>
		</TR>
		<TR> 
			<TD>
			<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
			<TR height=30 bgcolor=#f7f7f7>
				
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">������</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">������</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">����</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">����ð�</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">�̸�</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">����ó</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">�ݾ�</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">�����</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">�ܱ�</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">���Ⱓ</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">������</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">���</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				<TD align=middle class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center">�����</td>
					  <td width="1" align="right"><img src="<?=$skin_board_url?>images/bar03.gif" width="1" height="11" /></td>
					</tr>
				  </table>
				</TD>
				
			</TR>
			<TR> 
				<TD bgColor=#0D2465 colSpan=13 height=1></TD>
			</TR>






<?
$sql = "select * from rg_yeyak_list_body where 1 AND (rg_ext1 >= '$yeyak_date_start' and rg_ext1 <= '$yeyak_date_end')";
$result = mysql_query($sql,$dbcon);
for($i=0;$rows = mysql_fetch_array($result);$i++){
?>


			<?
			$rg_ext1_ex = explode("-",$rows[rg_ext1]);
			?>
			<TR height=26> 
				<TD align=middle class="bbs"><?=$rows[rg_ext2]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext1]?>(<?=getWeekDay($rg_ext1_ex[0],$rg_ext1_ex[1],$rg_ext1_ex[2])?>)</TD>
				<TD align=middle class="bbs"><?if($rows[rg_ext11]=="����"){echo"<font color=blue><b>����</b></font>";}else{echo"<font color=black><b>�Ϸ�</b></font>";}?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext3]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext4]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext5]?></TD>
				<TD align=middle class="bbs"><?=number_format($rows[rg_ext6])?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext7]?></TD>
				<TD align=middle class="bbs"><?=number_format($rows[rg_ext8])?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext9]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext10]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_content]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext12]?></TD>
				<TD align=middle class="bbs"><?=$rows[rg_ext13]?></TD>

			</TR>
			<TR> 
				<TD height=1 colSpan='13' align=middle background="<?=$skin_board_url?>images/dot_line.gif" ></TD>
			</TR>
<?
}
?>











	 </TABLE> </TD> </TR></TABLE> 

	
	</TD>
</TR>
<TR>
	<TD bgcolor=#0D2465 height=2></TD>
</TR>
<TR>
	<TD height=20>&nbsp;</TD>
</TR>





<?
}
?>








<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<input type=hidden name=rg_name value='ok'>
<input type=hidden name=rg_title value='ok'>
<input type=hidden name=old_rg_ext2 value='<?=$rg_ext2?>'>
<input type=hidden name=old_rg_ext1 value='<?=$rg_ext1?>'>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
		<TR> 
			<TD bgColor=#e7e7e7 height=1></TD>
		</TR>






		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ����<B> &nbsp;</B></TD>
					    <TD align=left > 
                            <input type=radio name="rg_ext11" value="����" <?if(!$rg_ext11 || $rg_ext11=="����"){echo"checked";}?>>���� 
                            <input type=radio name="rg_ext11" value="�Ϸ�" <?if($rg_ext11=="�Ϸ�"){echo"checked";}?>>�Ϸ�
                            <input type=radio name="rg_ext11" value="���̹�" <?if($rg_ext11=="���̹�"){echo"checked";}?>>���̹�
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ������<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext2' id="popupDatepicker" type=text class=b_input value='<?=$rg_ext2?>' itemname='������'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ������<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext1' type=text  class=b_input id="popupDatepicker2"  value='<?=$rg_ext1?>' required itemname='������'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ����ð�<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext3' type=text style=width:20%;height:22; class=b_input id="rg_ext3"  value='<?=$rg_ext3?>' itemname='����ð�'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �̸�<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext4' type=text style=width:20%;height:22; class=b_input id="rg_ext4"  value='<?=$rg_ext4?>' required itemname='�̸�'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
			<SCRIPT LANGUAGE="JavaScript">
			<!--
				function next_text1(){
					form=document.form_write;
					if(form.rg_ext5_1.value.length >= 3){
						form.rg_ext5_2.focus();
					}
				}
				function next_text2(){
					form=document.form_write;
					if(form.rg_ext5_2.value.length >= 4){
						form.rg_ext5_3.focus();
					}
				}
			//-->
			</SCRIPT>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ����ó<B> &nbsp;</B></TD>
					    <TD align=left >
						<?$rg_ext5_ex=explode("-",$rg_ext5);?>
						<input name='rg_ext5[]' type=text style=width:4%;height:22; class=b_input id=rg_ext5_1  value='<?=$rg_ext5_ex[0]?>' itemname='����ó' onkeyup="next_text1();">
						-
						<input name='rg_ext5[]' type=text style=width:5%;height:22; class=b_input  id=rg_ext5_2 value='<?=$rg_ext5_ex[1]?>' itemname='����ó' onkeyup="next_text2();">
						-
						<input name='rg_ext5[]' type=text style=width:5%;height:22; class=b_input id=rg_ext5_3 value='<?=$rg_ext5_ex[2]?>' itemname='����ó'>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �ݾ�<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext6' type=text style=width:20%;height:22; class=b_input id="rg_ext6"  value='<?=$rg_ext6?>' itemname='�ݾ�'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �����<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext7' type=text style=width:20%;height:22; class=b_input id="rg_ext7"  value='<?=$rg_ext7?>' itemname='�����'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �ܱ�<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext8' type=text style=width:20%;height:22; class=b_input id="rg_ext8"  value='<?=$rg_ext8?>' itemname='�ܱ�'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ���ð�<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext9' type=text style=width:60%;height:22; class=b_input id="rg_ext9"  value='<?=$rg_ext9?>' itemname='���ð�'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ������<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext10' type=text style=width:60%;height:22; class=b_input id="rg_ext10"  value='<?=$rg_ext10?>' itemname='������'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>

		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* ���<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_content' type=text style=width:100%;height:22; class=b_input id="rg_content"  value='<?=$rg_content?>' itemname='���'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>

		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �����<B> &nbsp;</B></TD>
					    <TD align=left > <input name='rg_ext12' type=text style=width:60%;height:22; class=b_input id="rg_ext12"  value='<?=$rg_ext12?>' required itemname='�����'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
			<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right class="bbs">* �޸�<B> &nbsp;</B></TD>
					    <TD align=left > <textarea name='rg_ext13' rows=10 cols=100 id="rg_ext13"><?=$rg_ext13?></textarea></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>

		
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD bgcolor=#E7E7E7 height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> <INPUT  type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()"><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</form>
</TABLE>
<br>
<br>
