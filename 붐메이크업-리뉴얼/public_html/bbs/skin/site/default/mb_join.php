<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../style.css" rel="stylesheet" type="text/css">

<!--����̹��� �ڵ� ���� -->
<style type="text/css">
<!--
body {background:#1A1F2F url(../images/sub_bg.jpg) no-repeat  center top}
-->
</style>
<!--����̹��� �ڵ� �� -->

<!--�����÷��� ���̾� ���� -->
<style type="text/css">
<!--
#LayerContainer3 {
	position: absolute;
	top:141px;
	text-align: center;
	width: 100%;
	z-index: -1;
}
#Layer3 {
margin: 0 auto;
position: relative;
width: 990px;
text-align: center;
padding-left: 0px;
z-index: -1
}
.style1 {color: #585858;
	font-size: 11px;
}
.style8 {font-family: "����"}
-->
</style>
<!--�����÷��� ���̾� �� -->
</head>

<script languagwe='JavaScript' src='../js/printEmbed.js'></script>
<script languagwe='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">
<div id="LayerContainer3">
<div id="Layer3"><script type="text/javascript">flashWrite('../swf/sub1.swf?pageNum=<?=$num?>','990','223')</script></div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990" height="141" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td width="198" height="141" background="../images/logo.jpg"><script type="text/javascript">flashWrite('../swf/logo.swf?pageNum=<?=$num?>','198','141')</script></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="55" style="padding:10 0 0 0"><div align="right">
              <? include '../inc/top.htm'; ?>
            </div></td>
          </tr>
          <tr>
            <td height="86" background="../images/menu_bg.jpg"><? $num = "0"; include "../inc/menu.php"; ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990" height="171">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="198" height="100%" valign="top"><table width="197" height="100%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td bgcolor="#000000"><div align="center">
              <table width="197" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top" bgcolor="#000000"><div align="center">
                    <?
if($_SESSION['ss_mb_id']){ //�α��� �����϶�
?>
                    <? $num = "1"; include "../inc/mem_menu2.php"; ?>
                    <?
}
else{ //�α׾ƿ� �����϶�
?>
                    <? $num = "2"; include "../inc/mem_menu.php"; ?>
                    <?
}
?>
</div></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td height="100%" bgcolor="#000000">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#000000">&nbsp;</td>
          </tr>
        </table></td>
        <td width="19" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="17"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="203"><table width="100" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="text3">
                        <?
if($_SESSION['ss_mb_id']){ //�α��� �����϶�
?>
                      </span><img src="../images/mem_t3.gif" width="203" height="21"><strong>
                      <?
}
else{ //�α׾ƿ� �����϶�
?>
                      </strong><img src="../images/mem_t2.gif" width="203" height="21"><strong>
                      <?
}
?>
                      </strong></td>
                    </tr>
                    <tr>
                      <td><img src="../images/s_t.gif" width="203" height="14"></td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <form action='' method="post" enctype='multipart/form-data' name="mb_form" id="mb_form" onsubmit='return formcheck()' autocomplete="off">
                <tr>
                  <td></td>
                </tr>
                <input type="hidden" name="act" value='ok' />
                <input type="hidden" name="url" value='<?=$url?>' />
                <tr>
                  <td valign="top"><img src="../images/login/join_text1.gif" width="545" height="29" /></td>
                </tr>
                <tr>
                  <td height="15"></td>
                </tr>
                <tr>
                  <td height="2" bgcolor="717993"></td>
                </tr>
                <tr>
                  <td><table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
                      <input type="hidden" name="act2" value='ok' />
                      <input type="hidden" name="url" value='<?=$url?>' />
                      <tr>
                        <td width="100" bgcolor="#2B3B58"><img src="../images/login/j01.gif" width="120" height="15" /></td>
                        <td valign="top"><?=$show_join_begin?>
                            <input type="text" class="input_01" name='mb_id' size="20" maxlength="20" minlength="2" itemname='���̵�' value='' required />
                            <img src="<?=$skin_site_url?>images/btn_check.gif" align="absmiddle" style="cursor:hand;" onClick="popup_id('mb_form', './', 'mb_id', mb_form.mb_id)" />
                            <?=$show_join_end?>
                            <?=$show_edit_begin?>
                            <span class="text1"><b><?=$mb_id?></b></span>
                            <?=$show_edit_end?>
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2" bgcolor="#717993"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j02.gif" width="120" height="15" /></td>
                        <td><?=$show_insert_begin?>
                            <input name='mb_password' type="password" class="input_01" id="mb_password" size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='��ȣ' />
                            <?=$show_insert_end?>
                            <br />
                            <input type="password" class="input_01" name='mb_passwd' size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='��ȣ' />
                            <span class="text1">��й�ȣ�� �ٽ� �Է����ּ���. </span></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_nick_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j03.gif" width="120" height="15" /></td>
                        <td><input name='mb_nick' type="text" class="input_01" id="mb_nick" value='<?=$mb_nick?>' size="20" maxlength="20" minlength="2" <?=($need_nick)?'required':''?> itemname='�г���' />
                            <img src="<?=$skin_site_url?>images/btn_check.gif" align="absmiddle" style="cursor:hand;" onClick="popup_nick('mb_form', './', 'mb_nick', mb_form.mb_nick)" /> </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_nick_end?>
                      <?=$show_name_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j04.gif" width="120" height="15" /></td>
                        <td><input type="text" class="input_01" name='mb_name' size="20" maxlength="20" minlength="2"  <?=($need_name)?'required':''?> itemname='�̸�' value='<?=$mb_name?>' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_name_end?>
                      <?=$show_tel_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j05.gif" width="120" height="15" /></td>
                        <td><select name="mb_tel[0]" <?=($need_tel)?'required':''?> itemname='��ȭ��ȣ'>
                            <option value=''>����
                              <?=rg_html_option($mb_tel_list,'','',$mb_tel[0])?>
                            </option>
                          </select>
                          -
                          <input type="text" class="input_01" name='mb_tel[1]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='��ȭ��ȣ' value='<?=$mb_tel[1]?>' />
                          -
                          <input type="text" class="input_01" name='mb_tel[2]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='��ȭ��ȣ' value='<?=$mb_tel[2]?>' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_tel_end?>
                      <?=$show_mobile_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j06.gif" width="120" height="15" /></td>
                        <td><select name="mb_mobile[0]" <?=($need_mobile)?'required':''?> itemname='�ڵ�����ȣ'>
                            <option value=''>����
                              <?=rg_html_option($mb_mobile_list,'','',$mb_mobile[0])?>
                            </option>
                          </select>
                          -
                          <input name='mb_mobile[1]' type="text" class="input_01" value='<?=$mb_mobile[1]?>' size="5" maxlength="4" <?=($need_mobile)?'required':''?> itemname='�ڵ�����ȣ' />
                          -
                          <input name='mb_mobile[2]' type="text" class="input_01" value='<?=$mb_mobile[2]?>' size="5" maxlength="4" <?=($need_mobile)?'required':''?> itemname='�ڵ�����ȣ' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_mobile_end?>
                      <?=$show_email_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j07.gif" width="120" height="15" /></td>
                        <td><input type="text" class="input_01" name='mb_email' size="40" maxlength="100" email="email" <?=($need_email)?'required':''?> itemname='e-mail' value='<?=$mb_email?>' /></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_email_end?>
                      <?=$show_homepage_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j08.gif" width="120" height="15" /></td>
                        <td><input type="text" class="input_01" name='mb_homepage' size="40" maxlength="255" <?=($need_homepage)?'required':''?> itemname='Ȩ������' value='<?=$mb_homepage?>' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_homepage_end?>
                      <?=$show_jumin_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../img/join_t8.gif" width="102" height="16" /></td>
                        <td><input type="text" class="input_01" name='mb_jumin1' size="7" maxlength="6" minlength="6" <?=($need_jumin)?'required':''?> itemname='�ֹε�Ϲ�ȣ ���ڸ�' onkeyup='if (this.value.length &gt;= 6) this.form.mb_jumin2.focus();' />
                          -
                          <input type="password" class="input_01" name='mb_jumin2' size="8" maxlength="7" minlength="7" <?=($need_jumin)?'required':''?> itemname='�ֹε�Ϲ�ȣ ���ڸ�' />
                <br />
                <span class="text1">��ȣȭ�Ͽ� ����ǹǷ� �ڷ� 
                  ����� �Ƚ��� �� �ֽ��ϴ�.</span></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_jumin_end?>
                      <?=$show_address_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j08.gif" width="120" height="15" /></td>
                        <td><input type="text" class="input_01" name='mb_post' size="8" maxlength="7" readonly <?=($need_address)?'required':''?> itemname='�����ȣ' value='<?=$mb_post?>' />
                            <img src="<?=$skin_site_url?>images/btn_search.gif" align="absmiddle" style="cursor:hand;" onClick="popup_zip('mb_form', './', 'mb_post', '', 'mb_address1', 'mb_address2');" /> </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j10.gif" width="120" height="15" /></td>
                        <td><input name='mb_address1' type="text" class="input_01" id="mb_address1" style='width:99%' value='<?=$mb_address1?>' readonly <?=($need_address)?'required':''?> />
                            <br />
                            <input name='mb_address2' type="text" class="input_01" id="mb_address2" value='<?=$mb_address2?>' size="35" <?=($need_address)?'required':''?> itemname='���ּ�' />
                            <span class="text1">���ּ� �Է�</span></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_address_end?>
                      <?=$show_birth_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=($need_birth)?'*':''?>
                          ����</span></td>
                        <td><input type="text" class="input_01" name="mb_birth" size="9" maxlength="8" value='<?=$mb_birth?>' <?=($need_birth)?'required':''?> itemname='����' />
                            <span class="small_txt"><font color="1D8FD1">��) 1972�� 9�� 1���� 
                              ��� 19720901</font></span></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_birth_end?>
                      <?=$show_sex_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=($need_sex)?'*':''?>
                          ����</span></td>
                        <td><select name='mb_sex' <?=($need_sex)?'required':''?> itemname='����'>
                            <option value=''>�����ϼ���
                              <?=rg_html_option($mb_sex_list,'','',"$mb_sex")?>
                            </option>
                          </select>
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_sex_end?>
                      <?=$show_job_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=($need_job)?'*':''?>
                          ����</span></td>
                        <td><input name='mb_job' type="text" class="input_01" id="mb_job" value='<?=$mb_job?>' size="21" maxlength="20" <?=($need_job)?'required':''?> itemname='����' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_job_end?>
                      <?=$show_hobby_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=($need_hobby)?'*':''?>
                          ���</span></td>
                        <td><input name='mb_hobby' type="text" class="input_01" id="mb_hobby" value='<?=$mb_hobby?>' size="21" maxlength="20" <?=($need_hobby)?'required':''?> itemname='���' />
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_hobby_end?>
                      <?=$show_signature_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=($need_signature)?'*':''?>
                          ����</span></td>
                        <td><textarea name="mb_signature" class="b_textarea" style="width:100%" rows="5" <?=($need_signature)?'required':''?> itemname='����'><?=$mb_signature?>
                            </textarea></td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_signature_end?>
                      <?=$show_greet_begin?>
                      <tr>
                        <td bgcolor="#2B3B58"><img src="../images/login/j09.gif" width="120" height="15" /></td>
                        <td><textarea name="mb_greet" style="width:100%" rows="5" class="textarea" id="mb_greet" <?=($need_greet)?'required':''?> itemname='�ڱ�Ұ�'><?=$mb_greet?>
                            </textarea></td>
                      </tr>
                      <?=$show_greet_end?>
                      <?=$show_photo_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">ȸ�� ����</span></td>
                        <td><input name='mb_photo' type="file" class="input_01" id="mb_photo" size="40" />
                            <?=$show_del_photo_begin?>
                            <br />
                            <img src="<?=$skin_site_url?>images/btn_bro.gif" width="64" height="16" />
                            <input name='del_mb_photo' type="checkbox" id="del_mb_photo" value='1' />
                          ����
                          <?=$show_del_photo_end?>
                          <br />
                          <?=$mb_photo_view?>
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_photo_end?>
                      <?=$show_icon_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">ȸ�� ������</span></td>
                        <td><input type="file" name='mb_icon' size="40" class="input_01" />
                            <br />
                            <span class="small_txt"><font color="1D8FD1">�̹��� ũ��� 16x16���� 
                              ���ּ���.
                              <?=$show_del_icon_begin?>
                            </font></span><br />
                            <input type="checkbox" name='del_mb_icon' value='1' />
                          ����<br />
                          <?=$mb_icon_view?>
                          <?=$show_del_icon_end?>
                        </td>
                      </tr>
                      <?=$show_icon_end?>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_ext7_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=$show_ext7_title?>
                        </span></td>
                        <td><?=$show_ext7_input?>
                        </td>
                      </tr>
                      <?=$show_ext7_end?>
                      <?=$show_ext8_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=$show_ext8_title?>
                        </span></td>
                        <td><?=$show_ext8_input?>
                        </td>
                      </tr>
                      <?=$show_ext8_end?>
                      <?=$show_ext9_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=$show_ext9_title?>
                        </span></td>
                        <td><?=$show_ext9_input?>
                        </td>
                      </tr>
                      <?=$show_ext9_end?>
                      <?=$show_ext10_begin?>
                      <tr>
                        <td bgcolor="#717993"><span class="subject">
                          <?=$show_ext10_title?>
                        </span></td>
                        <td><?=$show_ext10_input?>
                        </td>
                      </tr>
                      <tr bgcolor="#717993">
                        <td height="1" colspan="2"></td>
                      </tr>
                      <?=$show_ext10_end?>
                      <tr>
                        <td bgcolor="#2B3B58">&nbsp;</td>
                        <td><input name="mb_mailing" type="checkbox" id="mb_mailing" value="1"<?=$checked_mb_mailing?> />
                          <span class="text1">���ϼ���</span>&nbsp;
                          <input name="mb_open_info" type="checkbox" id="mb_open_info" value="1" <?=$checked_mb_open_info?> />
                          <span class="text1">��������</span></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="2" bgcolor="717993"></td>
                </tr>
                <tr>
                  <td height="70"><div align="center">
                      <?
if($_SESSION['ss_mb_id']){ //�α��� �����϶�
?><input name="image" type="image" style="border:0px;" src="<?=$skin_site_url?>images/cancel_btn_1.gif" /><?
}
else{ //�α׾ƿ� �����϶�
?><input name="image2" type="image" style="border:0px;" src="<?=$skin_site_url?>images/confirm_btn_1.gif" /><?
}
?><a href="../main/"><?
if($_SESSION['ss_mb_id']){ //�α��� �����϶�
?><img src="<?=$skin_site_url?>images/cancel_btn_2.gif" border="0" style="cursor:hand;" onClick="mb_form.reset();mb_form.mb_id.focus();" />
                                      <? }
else{ //�α׾ƿ� �����϶�
?><img src="<?=$skin_site_url?>images/confirm_btn_2.gif" border="0" style="cursor:hand;" onClick="mb_form.reset();mb_form.mb_id.focus();" /></a><?
}
?>
                  </div></td>
                </tr>
              </form>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
include "../inc/copy.htm";
?>
</body>
</html>
