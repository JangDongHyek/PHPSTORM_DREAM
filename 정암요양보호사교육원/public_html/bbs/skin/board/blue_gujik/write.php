<?
/******************************************************************
 �� ���ϼ��� �� 
����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�

<?=$u_action?>				�۾��� URL
<?=$old_password?>		������ ���� ��ȣ
<?=$a_list?>					�۸�� ��ũ

<?=$show_notice_begin?>��������üũ<?=$show_notice_end?>
<?=$checked_notice?>	��������üũ����

<?=$show_secret_begin?>��б�üũ<?=$show_secret_end?>
<?=$checked_secret?>	��б�üũ����

<?=$show_reply_mail_begin?>����۸��Ϸιޱ⿩��<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	�����üũ����

<?=$show_name_begin?>�̸��Է�<?=$show_name_end?>
<?=$rg_name?>					�̸�

<?=$show_password_begin?>��ȣ�Է�<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	�ۼ�����尡 �ƴ϶�� �ʼ��Է�

<?=$show_email_begin?>�����Է�<?=$show_email_end?>
<?=$rg_email?>				����

<?=$show_home_url_begin?>Ȩ�������Է�<?=$show_home_url_end?>
<?=$rg_home_url?>			Ȩü����

<?=$show_category_begin?>ī�װ�����<?=$show_category_end?>
<?=$category_list_option?>	ī�װ����

<?=$show_html_begin?>	html ���¼���<?=$show_html_end?>
<?=$checked_html_use0?>	�Ϲݱ�üũ
<?=$checked_html_use1?>	htmlüũ
<?=$checked_html_use2?>	html+<br>üũ

<?=$rg_title?>				����
<?=$rg_content?>			����
<?=$show_link_begin?>	��ũ�Է���<?=$show_link_end?>
<?=$rg_link1_url?>		��ũ#1
<?=$rg_link2_url?>		��ũ#2

<?=$show_upload_begin?>���ε���<?=$show_upload_end?>

<?=$show_file1_delete_begin?>���ϻ���<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		���ϸ�
(1~2)

<?=$show_file1_size_begin?>�ִ���ε�뷮<?=$show_file1_size_end?>
<?=$upload_file1_size?>	�ִ���ε�뷮

<?=$show_file1_ext_begin?>���ε�Ȯ����<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	���ε�Ȯ����
<?=($upload_file1_able)?'����':'�Ұ���'?>	���ε� ���ɿ���

<?=$show_ext1_begin?>�߰��׸�1<?=$show_ext1_end?>
<?=$show_ext1_title?>	�߰��׸��
<?=$show_ext1_input?>	�߰��׸��Է���
(1~5)

******************************************************************/
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>

          <tr>
            <td width="50">&nbsp;</td>
            <td align="center">
			<!--////////////////////// ������û������ //////////////////////////////////-->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">


              <tr>
                <td height="40"><table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
                    <tr>
                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="40"><strong><font color="#CC0000">�ص���� ��û���� �ٸ� ������Դ� �������� ������ �����ڸ� �� �� �ֽ��ϴ�.</font></strong></td>
                        </tr>
                      </table>
                        <table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#B5B4A6">
                          <tr>
                            <td width="20%" align="center" bgcolor="#EDECE9"><font color="#5B5A55">�̸�</font></td>
                            <td width="80%" colspan="2" bgcolor="#FFFFFF"><input name="rg_name" type="text" class="bbs" size="30" value="<?=$rg_name?>" required itemname="�̸�"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext1" type="radio" value="��" <? if($rg_ext1=="��"){echo "checked";}else if(!$rg_ext1){echo "checked";}?>>
                              ��
                                <input name="rg_ext1" type="radio" value="��"  <? if($rg_ext1=="��"){echo "checked";}?>>
                                ��</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext2" type="text" class="bbs" size="4" value="<?=$rg_ext2?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�ּ�</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext3" type="text" class="bbs" size="75" value="<?=$rg_ext3?>" required itemname="�ּ�"></td>
                            </tr>

                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�����ڰ���</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_title" type="radio" value="��纸ȣ��" <? if($rg_title=="��纸ȣ��"){echo "checked";}else if(!$rg_title){echo "checked";}?>>
                              ��纸ȣ��
                              <input name="rg_title" type="radio" value="��ȸ������" <? if($rg_title=="��ȸ������"){echo "checked";}?>>
                              ��ȸ������
                              <input name="rg_title" type="radio" value="��ȣ��" <? if($rg_title=="��ȣ��"){echo "checked";}?>>
                              ��ȣ��
                              <input name="rg_title" type="radio" value="��ȣ������" <? if($rg_title=="��ȣ������"){echo "checked";}?>>
                              ��ȣ������
                              <input name="rg_title" type="radio" value="����ġ���" <? if($rg_title=="����ġ���"){echo "checked";}?>>
                              ����ġ��� </td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext4" type="text" class="bbs" value="<?=$rg_ext4?>" size="15">��
							<input name="rg_ext5" type="text" class="bbs" value="<?=$rg_ext5?>" size="15">��

                              <input name="rg_ext6" type="checkbox" value="�����������" <? if($rg_ext6){echo "checked";}?>>������� ����</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext7" type="radio" value="��纸ȣ��" <? if($rg_ext7=="��纸ȣ��"){echo "checked";}else if(!$rg_ext7){echo "checked";}?>>
                              ��纸ȣ��       
                                <input name="rg_ext7" type="radio" value="��ȸ������" <? if($rg_ext7=="��ȸ������"){echo "checked";}?>>
                                ��ȸ������        
                                <input name="rg_ext7" type="radio" value="��ȣ��" <? if($rg_ext7=="��ȣ��"){echo "checked";}?>>
                                ��ȣ��  
                                <br>
                                <input name="rg_ext7" type="radio" value="��ȣ������" <? if($rg_ext7=="��ȣ������"){echo "checked";}?>>
                                ��ȣ������       
                                <input name="rg_ext7" type="radio" value="����ġ���" <? if($rg_ext7=="����ġ���"){echo "checked";}?>>
                                ����ġ���        
                                <input name="rg_ext7" type="radio" value="������� ����" <? if($rg_ext7=="������� ����"){echo "checked";}?>>
                                ������� ����</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ٹ�ó</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext8" type="radio" value="���ü�(����)" <? if($rg_ext8=="���ü�(����)"){echo "checked";}else if(!$rg_ext8){echo "checked";}?>>
                              ���ü�(����)  
                                <input name="rg_ext8" type="radio" value="���ο�纴��" <? if($rg_ext8=="���ο�纴��"){echo "checked";}?>>
                                ���ο�纴��       
                                <input name="rg_ext8" type="radio" value="�湮���" <? if($rg_ext8=="�湮���"){echo "checked";}?>>
                                �湮���<br>
                                <input name="rg_ext8" type="radio" value="�־߰���ȣ" <? if($rg_ext8=="�־߰���ȣ"){echo "checked";}?>>
                                �־߰���ȣ        
                                <input name="rg_ext8" type="radio" value="�ƹ� ���̳� ������" <? if($rg_ext8=="�ƹ� ���̳� ������"){echo "checked";}?>>
                                �ƹ� ���̳� ������</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">���</font></td>
                            <td bgcolor="#FFFFFF"><input name="rg_ext9" type="radio" value="����" <? if($rg_ext9=="����"){echo "checked";}else if(!$rg_ext9){echo "checked";}?>>
                              ����              
                                <input name="rg_ext9" type="radio" value="radiobutton"  <? if($rg_ext9=="����"){echo "checked";}?>>
                                �������ٹ�ó(              
                                <input name="rg_ext10" type="text" class="bbs" size="15" value="<?=$rg_ext10?>">
                                ),      
                                <input name="rg_ext11" type="text" class="bbs" size="4" value="<?=$rg_ext11?>">
                                ��   
                                <input name="rg_ext12" type="text" class="bbs" size="4" value="<?=$rg_ext12?>">
                                ������</td>
                            </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�ٹ����ɽñ� </font></td>
                            <td colspan="2" bgcolor="#FFFFFF">
							<input name="rg_ext13" type="text" class="bbs" size="4" value="<?=$rg_ext13?>">��  
							<input name="rg_ext14" type="text" class="bbs" size="4" value="<?=$rg_ext14?>">��  
							<input name="rg_ext15" type="text" class="bbs" size="4" value="<?=$rg_ext15?>">�� ���� ������</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">�����з� </font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext16" type="text" class="bbs" size="15" value="<?=$rg_ext16?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext17" type="text" class="bbs" size="30" value="<?=$rg_ext17?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">����ó</font></td>
                            <td colspan="2" bgcolor="#FFFFFF">�Ϲ���ȭ
                              <input name="rg_ext18" type="text" class="bbs" size="20" value="<?=$rg_ext18?>"> 
                              �޴���
                              <input name="rg_ext19" type="text" class="bbs" size="20" value="<?=$rg_ext19?>"></td>
                          </tr>
                          

                          <tr>
                            <td height="36" align="center" bgcolor="#EDECE9"><font color="#5B5A55">����� ���� ���̳� ������ ���� �Ұ�</font></td>
							<?
								if(!$rg_content){
									$rg_content="���� �Ұ��� �Է��Ͻʽÿ�";
								}
							?>
                            <td colspan="2" bgcolor="#FFFFFF"><textarea name="rg_content" cols="70" rows="8" onfocus="if(this.value=='���� �Ұ��� �Է��Ͻʽÿ�'){this.value='';}" onblur="if(!this.value){this.value='���� �Ұ��� �Է��Ͻʽÿ�';}"><?=$rg_content?></textarea></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="67" align="center">
							<?
								if($_SESSION[ss_mb_id]=="admin"){
							?>
								<a href="./list.php?bbs_id=<?=$bbs_id?>">
								<img src="<?=$skin_board_url?>images/list2.gif" alt="��� ����">
								</a>
							<? }?>
							<input name="image" type="image" src="../images/btn_ok.gif" width="95" height="44">
                              &nbsp;<img src="../images/btn_ce.gif" width="95" height="44" onClick="javascript:reset();" style="cursor:hand;"></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    <p> <BR>
                  </p></td>
              </tr>


            </table>
			<!--///////////////////// ������û �� �� ///////////////////////////////////-->
			
			</td>
            <td width="20">&nbsp;</td>
          </tr>
		  </form>

        </table>


