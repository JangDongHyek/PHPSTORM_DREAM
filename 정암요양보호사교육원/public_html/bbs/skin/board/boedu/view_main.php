<SCRIPT LANGUAGE="JavaScript">
<!--

function openTarget(objForm, strFeatures, strWindowName){
	strWindowName = 'formTarget' + (new Date().getTime());
	objForm.target = strWindowName;
	open('', strWindowName, strFeatures);
}

//-->
</SCRIPT>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<form name="form_view" method="post" action="<?=$skin_board_url?>form_print.html" onsubmit="openTarget(this,'width=645,height=750,resizable=1,scrollbars=1'); return true;">
<TR> 
	<TD align=right>
    <?=$show_prev_begin?><?=$a_prev?><img src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?>
    <?=$show_next_begin?><?=$a_next?><img src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
</TR>
<TR>
	<TD bgColor=#CCCCCC>
	
		<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
          <tr>
            <td align="center">
			<!--////////////////////// ������û������ //////////////////////////////////-->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40"><table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
                    <tr>
                      <td bgcolor="#FFFFFF">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<input type="hidden" name="rg_name" value="<?=$rg_name?>">
<input type="hidden" name="rg_ext1" value="<?=$rg_ext1?>">
<input type="hidden" name="rg_ext2" value="<?=$rg_ext2?>">
<input type="hidden" name="rg_ext3" value="<?=$rg_ext3?>">
<input type="hidden" name="rg_title" value="<?=$rg_title?>">
<input type="hidden" name="rg_ext4" value="<?=$rg_ext4?>">
<input type="hidden" name="rg_ext5" value="<?=$rg_ext5?>">
<input type="hidden" name="rg_ext6" value="<?=$rg_ext6?>">
<input type="hidden" name="rg_ext7" value="<?=$rg_ext7?>">
<input type="hidden" name="rg_ext8" value="<?=$rg_ext8?>">
<input type="hidden" name="rg_ext9" value="<?=$rg_ext9?>">
<input type="hidden" name="rg_ext10" value="<?=$rg_ext10?>">
<input type="hidden" name="rg_ext11" value="<?=$rg_ext11?>">
<input type="hidden" name="rg_ext12" value="<?=$rg_ext12?>">
<input type="hidden" name="rg_ext13" value="<?=$rg_ext13?>">
<input type="hidden" name="rg_ext14" value="<?=$rg_ext14?>">
<input type="hidden" name="rg_ext15" value="<?=$rg_ext15?>">
<input type="hidden" name="rg_ext16" value="<?=$rg_ext16?>">
<input type="hidden" name="rg_ext17" value="<?=$rg_ext17?>">
<input type="hidden" name="rg_ext18" value="<?=$rg_ext18?>">
<input type="hidden" name="rg_ext19" value="<?=$rg_ext19?>">
<input type="hidden" name="rg_content" value="<?=$rg_content?>">
                        <tr>
                          <td width="80%" height="40"><strong><font color="#CC0000">�ص���� ��û���� �ٸ� ������Դ� �������� ������ �����ڸ� �� �� �ֽ��ϴ�.</font></strong>
						  </td>
						  <td width="20%" align="right">
						  <input type="image" src="<?=$skin_board_url?>images/btn_print.gif" width="94" height="21" border="0">
						  </td>
                        </tr>
</form>
                      </table>
                        <table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#B5B4A6">
						<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
						<input type=hidden name=act value='ok'>
						<input type=hidden name=old_password value='<?=$old_password?>'>
                          <tr>
                            <td width="20%" align="center" bgcolor="#EDECE9"><font color="#5B5A55">�̸�</font></td>
                            <td width="80%" colspan="2" bgcolor="#FFFFFF"><? if($rg_name){ echo $rg_name; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext1){ echo $rg_ext1; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext2){ echo $rg_ext2; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�ּ�</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext3){ echo $rg_ext3; }else{ echo "&nbsp;"; } ?></td>
                            </tr>

                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�����ڰ���</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_title){ echo $rg_title; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><?=$rg_ext4?>��
							<?=$rg_ext5?>��

                             <?=$rg_ext6?>
							 <? if(!$rg_ext4 && !$rg_ext5 && !$rg_ext6){ echo "&nbsp;"; } ?>
							 </td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext7){ echo $rg_ext7; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�ó</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext8){ echo $rg_ext8; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">���</font></td>
                            <td bgcolor="#FFFFFF"><?=$rg_ext9?>
                                �������ٹ�ó(<?=$rg_ext10?>), <?=$rg_ext11?>�� <?=$rg_ext12?>������
								<? if(!$rg_ext9 && !$rg_ext10 && !$rg_ext11 && !$rg_ext12){ echo "&nbsp;"; } ?>
								</td>
                            </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�ٹ����ɽñ� </font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><?=$rg_ext13?>��  <?=$rg_ext14?>��  <?=$rg_ext15?>�� ���� ������
							<? if(!$rg_ext13 && !$rg_ext14 && !$rg_ext15){ echo "&nbsp;"; } ?>
							</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�����з� </font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext16){ echo $rg_ext16; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_ext17){ echo $rg_ext17; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ó</font></td>
                            <td colspan="2" bgcolor="#FFFFFF">�Ϲ���ȭ
                              <?=$rg_ext18?>
                              �޴��� <?=$rg_ext19?>
							  <? if(!$rg_ext18 && !$rg_ext19){ echo "&nbsp;"; } ?>
							  </td>
                          </tr>
                          

                          <tr>
                            <td height="36" align="center" bgcolor="#EDECE9"><font color="#5B5A55">����� ���� ���̳� ������ ���� �Ұ�</font></td>
							<?
								if($rg_content=="���� �Ұ��� �Է��Ͻʽÿ�"){
									$rg_content="";
								}
							?>
                            <td colspan="2" bgcolor="#FFFFFF"><? if($rg_content){ echo $rg_content; }else{ echo "&nbsp;"; } ?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>


            </table>
			<!--///////////////////// ������û �� �� ///////////////////////////////////-->
			
			</td>
          </tr>
		  </form>

        </table>
	</TD>
</TR>
<TR>
	<TD height=5></TD>
</TR>