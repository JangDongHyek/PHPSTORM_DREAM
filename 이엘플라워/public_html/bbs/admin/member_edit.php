<?
	$site_path = '../';
	$site_url = '../';
	require_once($site_path."include/admin.lib.inc.php");

	if($act=='ok') {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		//$mb_id=strtolower($mb_id);
		$mb_email=strtolower($mb_email);
		$mem = rg_get_member_info($mb_num,1);
		if($mode=='edit') {
			$dbqry = "
				SELECT mb_num
				FROM $db_table_member
				WHERE mb_id = '$mb_id'
				  AND mb_num <> '$mb_num'
			";
			$rs=query($dbqry,$dbcon);
			
			if(mysql_num_rows($rs)) { // ����ϰ� �ִ� ���̵�
				$msg = str_replace ("%mb_id%", $mb_id, "$msg_exist_mb_id");
				rg_href('',$msg,'','back');
			}
			
			if($site[st_join_form_cfg][1] != 0 && $mb_nick!="") { // �г���
				$dbqry = "
					SELECT mb_num
					FROM $db_table_member
					WHERE mb_nick = '$mb_nick'
						AND mb_num <> '$mb_num'
				";
				$rs=query($dbqry,$dbcon);
				if(mysql_num_rows($rs)) { // ����ϰ� �ִ� �г���
					$msg = str_replace ("%mb_nick%", $mb_nick, "$msg_exist_mb_nick");
					rg_href('',$msg,'','back');
				}
			}		
			
			if(($mb_jumin1 != "") && ($mb_jumin2 != "")) { // �ֹε�Ϲ�ȣ üũ
				$jumin = $mb_jumin1.$mb_jumin2;
				$mb_jumin = get_password_str($jumin);
/*				$dbqry = "
					SELECT mb_num
					FROM $db_table_member
					WHERE mb_jumin = '$mb_jumin'
						AND mb_num <> '$mb_num'
				";
				$rs=query($dbqry,$dbcon);
				if(mysql_num_rows($rs)>0) { // ����ϰ� �ִ� �ֹι�ȣ
					rg_href('','�̹̻������ �ֹε�Ϲ�ȣ �Դϴ�.','','back');
				} */
				$sql_jumin = "`mb_jumin` = '$mb_jumin',";
			}	
			
			if($mb_password) {
				$mb_password = get_password_str($mb_password);
				$sql_password = "`mb_password` = '$mb_password',";
			}
			
			$mb_photo = $mem[mb_photo];
			$mb_icon = $mem[mb_icon];
			include($site_path."include/mb_upload.inc.php");

			$dbqry="
				UPDATE `$db_table_member` SET
					 $sql_password
					 $sql_jumin
					`mb_id` = '$mb_id',
					`mb_name` = '$mb_name',
					`mb_nick` = '$mb_nick',
					`mb_email` = '$mb_email',
					`mb_msn` = '$mb_msn',
					`mb_homepage` = '$mb_homepage', 
					`mb_tel` = '$mb_tel',
					`mb_mobile` = '$mb_mobile',
					`mb_birth` = '$mb_birth',
					`mb_post` = '$mb_post',
					`mb_address1` = '$mb_address1',
					`mb_address2` = '$mb_address2',
					`mb_job` = '$mb_job',
					`mb_sex` = '$mb_sex',
					`mb_hobby` = '$mb_hobby',
					`mb_photo` = '$mb_photo',
					`mb_mailing` = '$mb_mailing',
					`mb_open_info` = '$mb_open_info',
					`mb_icon` = '$mb_icon',
					`mb_signature` = '$mb_signature',
					`mb_greet` = '$mb_greet',
					`mb_modi_date` = '$mb_modi_date',
					`mb_point` = '$mb_point',
					`mb_today_point` = '$mb_today_point',
					`mb_state` = '$mb_state',
                                        `mb_level` = '$mb_level', 
					`mb_ext1` = '$mb_ext1',
					`mb_ext2` = '$mb_ext2',
					`mb_ext3` = '$mb_ext3',
					`mb_ext4` = '$mb_ext4',
					`mb_ext5` = '$mb_ext5',
					`mb_ext6` = '$mb_ext6',
					`mb_ext7` = '$mb_ext7',
					`mb_ext8` = '$mb_ext8',
					`mb_ext9` = '$mb_ext9',
					`mb_ext10` = '$mb_ext10'
				WHERE `mb_num` = '$mb_num'
			";
			query($dbqry,$dbcon);
		} else {
			$mb_reg_date=$now;
			$mb_login_ip=$REMOTE_ADDR;
			
			if(rg_get_member_info($mb_id)) { // ����ϰ� �ִ� ���̵�
				$msg = str_replace ("%mb_id%", $mb_id, "$msg_exist_mb_id");
				rg_href('',$msg,'','back');
			}
			
			if($site[st_join_form_cfg][1] != 0) { // �г���
				if(rg_get_member_info($mb_nick)) { // ����ϰ� �ִ� �г���
					$msg = str_replace ("%mb_nick%", $mb_nick, "$msg_exist_mb_nick");
					rg_href('',$msg,'','back');
				}
			}	

			if($site[st_join_form_cfg][8] != 0) { // �ֹε�Ϲ�ȣ üũ
				$jumin = $mb_jumin1.$mb_jumin2;
				$mb_jumin = get_password_str($jumin);
			}	
			
			$mb_password = get_password_str($mb_password);
			
			$mb_photo = '';
			$mb_icon = '';
			
			$dbqry="
				INSERT INTO `$db_table_member`
					( `mb_num` , `mb_id` , `mb_password` , 
						`mb_nick` , `mb_name` , `mb_email` , 
						`mb_msn` , `mb_homepage` , `mb_tel` , 
						`mb_mobile` , `mb_jumin` , `mb_birth` , 
						`mb_post` , `mb_address1` , `mb_address2` , 
						`mb_sex` , `mb_job` , `mb_hobby` , 
						`mb_photo` , `mb_mailing` , `mb_open_info` , 
						`mb_icon` , `mb_signature` , `mb_greet` , 
						`mb_point` , `mb_today_point`,
						`mb_level` , `mb_state` , 
						`mb_reg_date` , `mb_modi_date` , `mb_login_ip` , 
						`mb_log_count` , `mb_ext1` , `mb_ext2` , 
						`mb_ext3` , `mb_ext4` , `mb_ext5`,
						`mb_ext6` , `mb_ext7` , `mb_ext8`,
						`mb_ext9` , `mb_ext10`
					) 
				VALUES 
					( '', '$mb_id', '$mb_password', 
						'$mb_nick', '$mb_name', '$mb_email',
						'$mb_msn', '$mb_homepage', '$mb_tel', 
						'$mb_mobile', '$mb_jumin', '$mb_birth', 
						'$mb_post', '$mb_address1', '$mb_address2', 
						'$mb_sex', '$mb_job', '$mb_hobby', 
						'$mb_photo', '$mb_mailing', '$mb_open_info', 
						'$mb_icon', '$mb_signature', '$mb_greet', 
						'$mb_point', '$mb_today_point',
						'$mb_level', '$mb_state', 
						'$mb_reg_date', '$mb_modi_date', '$mb_login_ip', 
						'$mb_log_count', '$mb_ext1', '$mb_ext2', 
						'$mb_ext3', '$mb_ext4', '$mb_ext5',
						'$mb_ext6', '$mb_ext7', '$mb_ext8',
						'$mb_ext9', '$mb_ext10'
					)
			";
			query($dbqry,$dbcon);

			$mb_num = mysql_insert_id();
			include($site_path."include/mb_upload.inc.php");
	
			$dbqry="
				UPDATE `$db_table_member` SET
					`mb_photo` = '$mb_photo',
					`mb_icon` = '$mb_icon'
				WHERE `mb_num` = '$mb_num'		
			";
			query($dbqry,$dbcon);			
		}
		
		rg_href("member_list.php?$p_str&page=$page");
	}
	
	if($mode=='edit') {
		$mem=rg_get_member_info($mb_num,1);
	} else {
		$mem[mb_today_point] = '0';
		$mem[mb_point] = $site[st_default_point];
		$mem[mb_level] = $site[st_default_level];
		$mem[mb_state] = $site[st_default_state];
	}
		
	$show_join_begin = '';
	$show_join_end = '';

	$show_edit_begin = '<!--';
	$show_edit_end = '-->';
	
	$show = array(1=>"nick",2=>"name",3=>"email",4=>"msn",5=>"homepage",
	              6=>"tel",7=>"mobile",8=>"jumin",9=>"birth",10=>"address",
								11=>"sex",12=>"job",13=>"hobby",14=>"photo",15=>"icon",
								16=>"signature", 17=>"greet");
	foreach($show as $key => $val) {
		if($site[st_join_form_cfg][$key] == 0) { 
			$GLOBALS["show_{$val}_begin"]= '<!--';
			$GLOBALS["show_{$val}_end"]= '-->';
		} else {
			$GLOBALS["show_{$val}_begin"]= '';
			$GLOBALS["show_{$val}_end"]= '';
		}
		if($site[st_join_form_cfg][$key] == 2) { 
			$GLOBALS["need_{$val}"]= true;
		} else {
			$GLOBALS["need_{$val}"]= false;
		}
	}

	if($mem[mb_photo]) {
		$mb_photo_view = "<img src=$member_photo_url$mem[mb_photo]>";
	} else {
		if(!$show_photo_begin) {
			$show_del_photo_begin = '<!--';
			$show_del_photo_end = '-->';
		}
	}
	if($mem[mb_icon]) {
		$mb_icon_view = "<img src=$member_icon_url$mem[mb_icon]>";
	} else {
		if(!$show_icon_begin) {
			$show_del_icon_begin = '<!--';
			$show_del_icon_end = '-->';
		}
	}

	for($i=1;$i<11;$i++) {
		eval("\$show_ext{$i}_begin = (\$site[st_mb_ext_types][{$i}]==0)?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$site[st_mb_ext_types][{$i}]==0)?'-->':'';");
		eval("\$show_ext{$i}_title = \$site[st_mb_ext_name{$i}];");
		eval("\$show_ext{$i}_input = rg_makeform('mb_ext{$i}',\$site[st_mb_ext_types][{$i}],\$site[st_mb_ext_value{$i}],\$mem[mb_ext$i]);");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"><font color="#404040">ȸ����������</font></td>
  </tr>
</table>
<br>
<form name=mb_form method=post action='' onsubmit='return formcheck()' enctype='multipart/form-data' autocomplete=off>
  <table width="850" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#D4D4D4">
    <input type=hidden name=act value='ok'>
    <input type=hidden name=mode value='<?=$mode?>'>
    <input type=hidden name=mb_num value='<?=$mb_num?>'>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_id)?'*':''?>
        ���̵�&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input type=text name='mb_id' size=20 maxlength=20 minlength=2 itemname='���̵�' required value="<?=$mem[mb_id]?>"> 
        <input name="button" type=button class=button onclick="popup_id('mb_form', '../', 'mb_id', mb_form.mb_id)" value='�ߺ��˻�'> 
      </td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_password)?'*':''?>
        ��ȣ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input name='mb_password' type=password id="mb_password3" size=20 maxlength=20 itemname='��ȣ'> 
      </td>
    </tr>
    <?=$show_nick_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_nick)?'*':''?>
        �г���&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name='mb_nick' type=text id="mb_nick" value='<?=$mem[mb_nick]?>' size=20 maxlength=20 itemname='�г���'> 
        <input name="button2" type=button class=button onclick="popup_nick('mb_form', '../', 'mb_nick', mb_form.mb_nick)" value='�ߺ��˻�'> 
      </td>
    </tr>
    <?=$show_nick_end?>
    <?=$show_name_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_name)?'*':''?>
        �̸�&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_name' size=20 maxlength=20  itemname='�̸�' value='<?=$mem[mb_name]?>'> 
      </td>
    </tr>
    <?=$show_name_end?>
    <?=$show_email_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_email)?'*':''?>
        e-mail&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_email' size=40 maxlength=100 itemname='e-mail' value='<?=$mem[mb_email]?>'> 
      </td>
    </tr>
    <?=$show_email_end?>
    <?=$show_homepage_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_homepage)?'*':''?>
        Ȩ������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_homepage' size=40 maxlength=255 itemname='Ȩ������' value='<?=$mem[mb_homepage]?>'> 
      </td>
    </tr>
    <?=$show_homepage_end?>
    <?=$show_jumin_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_jumin)?'*':''?>
        �ֹε�Ϲ�ȣ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_jumin1' size=7 maxlength=6 itemname='�ֹε�Ϲ�ȣ ���ڸ�' onkeyup='if (this.value.length >= 6) this.form.mb_jumin2.focus();'>
        - 
        <input type=password name='mb_jumin2' size=8 maxlength=7 itemname='�ֹε�Ϲ�ȣ ���ڸ�'> 
        <br>
      ��ȣȭ�Ͽ� ����ǹǷ� �ڷ� ����� �Ƚ��� �� �ֽ��ϴ�.</td>
    </tr>
    <?=$show_jumin_end?>
    <?=$show_tel_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_tel)?'*':''?>
        ��ȭ��ȣ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_tel' size=21 maxlength=20 itemname='��ȭ��ȣ' value='<?=$mem[mb_tel]?>'> 
      </td>
    </tr>
    <?=$show_tel_end?>
    <?=$show_mobile_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_mobile)?'*':''?>
        �ڵ�����ȣ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name='mb_mobile' type=text id="mb_mobile3" value='<?=$mem[mb_mobile]?>' size=21 maxlength=20 itemname='�ڵ�����ȣ'> 
      </td>
    </tr>
    <?=$show_mobile_end?>
    <?=$show_address_begin?>
 <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    function daumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // �˾����� �˻���� �׸��� Ŭ�������� ������ �ڵ带 �ۼ��ϴ� �κ�.

                // �� �ּ��� ���� ��Ģ�� ���� �ּҸ� �����Ѵ�.
                // �������� ������ ���� ���� ��쿣 ����('')���� �����Ƿ�, �̸� �����Ͽ� �б� �Ѵ�.
                var fullAddr = ''; // ���� �ּ� ����
                var extraAddr = ''; // ������ �ּ� ����

                // ����ڰ� ������ �ּ� Ÿ�Կ� ���� �ش� �ּ� ���� �����´�.
                if (data.userSelectedType === 'R') { // ����ڰ� ���θ� �ּҸ� �������� ���
                    fullAddr = data.roadAddress;

                } else { // ����ڰ� ���� �ּҸ� �������� ���(J)
                    fullAddr = data.jibunAddress;
                }

                // ����ڰ� ������ �ּҰ� ���θ� Ÿ���϶� �����Ѵ�.
                if(data.userSelectedType === 'R'){
                    //���������� ���� ��� �߰��Ѵ�.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // �ǹ����� ���� ��� �߰��Ѵ�.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // �������ּ��� ������ ���� ���ʿ� ��ȣ�� �߰��Ͽ� ���� �ּҸ� �����.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // �����ȣ�� �ּ� ������ �ش� �ʵ忡 �ִ´�.
                document.getElementById("mb_post").value = data.postcode1 + "-" + data.postcode2;
                document.getElementById("mb_address1").value = fullAddr;

                // Ŀ���� ���ּ� �ʵ�� �̵��Ѵ�.
                document.getElementById("mb_address2").focus();
            }
        }).open();
    }
</script> 

   <tr> 
      <td align="right" bgcolor="#f7f7f7">�����ȣ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name='mb_post' id='mb_post' size=8 maxlength=7 readonly itemname='�����ȣ' value='<?=$mem[mb_post]?>'> 
        <input name="button" type=button class=button onClick="daumPostcode();" value='�����ȣ �˻�'> 
      </td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_address)?'*':''?>
        �ּ�&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name='mb_address1' type=text id="mb_address1" value='<?=$mem[mb_address1]?>' size="60" readonly> 
        <br> <input name='mb_address2' type=text id="mb_address2" value='<?=$mem[mb_address2]?>' size=35 itemname='���ּ�'>
      ���ּ� �Է�</td>
    </tr>
    <?=$show_address_end?>
    <?=$show_birth_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_birth)?'*':''?>
        ����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type=text name=mb_birth size=9 maxlength=8 value='<?=$mem[mb_birth]?>' itemname='����'>
      ��) 1972�� 9�� 1���� ��� 19720901</td>
    </tr>
    <?=$show_birth_end?>
    <?=$show_sex_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_sex)?'*':''?>
        ����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><select name='mb_sex' itemname='����'>
          <option value=''>�����ϼ��� 
          <?=rg_html_option($mb_sex_list,'','',"$mem[mb_sex]")?>
      </select> </td>
    </tr>
    <?=$show_sex_end?>
    <?=$show_job_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_job)?'*':''?>
        ����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name='mb_job' type=text id="mb_job3" value='<?=$mem[mb_job]?>' size=21 maxlength=20 itemname='����'> 
      </td>
    </tr>
    <?=$show_job_end?>
    <?=$show_hobby_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_hobby)?'*':''?>
        ���&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input name='mb_hobby' type=text id="mb_hobby3" value='<?=$mem[mb_hobby]?>' size=21 maxlength=20 itemname='���'> 
      </td>
    </tr>
    <?=$show_hobby_end?>
    <?=$show_signature_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_signature)?'*':''?>
        ����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><textarea name=mb_signature class=textarea rows=5 cols=60 itemname='����'><?=$mem[mb_signature]?></textarea></td>
    </tr>
    <?=$show_signature_end?>
    <?=$show_greet_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=($need_greet)?'*':''?>
        �ڱ�Ұ�&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><textarea name=mb_greet cols=60 rows=5 class=textarea id="mb_greet" itemname='�ڱ�Ұ�'><?=$mem[mb_greet]?></textarea></td>
    </tr>
    <?=$show_greet_end?>
    <?=$show_photo_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">ȸ�� ����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input name='mb_photo' type=file id="mb_photo3" size=40> 
        <?=$show_del_photo_begin?>
        <br> <input name='del_mb_photo' type=checkbox id="del_mb_photo" value='1'>
        ���� 
        <?=$show_del_photo_end?>
        <br> 
        <?=$mb_photo_view?>
      </td>
    </tr>
    <?=$show_photo_end?>
    <?=$show_icon_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">ȸ�� ������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <input type=file name='mb_icon' size=40>
        <font color="#FF0000"> �̹��� ũ��� 16x16���� ���ּ���.</font> 
        <?=$show_del_icon_begin?>
        <br> <input type=checkbox name='del_mb_icon' value='1'>
        ����<br> 
        <?=$mb_icon_view?>
        <?=$show_del_icon_end?>
      </td>
    </tr>
    <?=$show_icon_end?>
    <?=$show_ext1_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext1_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext1_input?>      </td>
    </tr>
    <?=$show_ext1_end?>
    <?=$show_ext2_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext2_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext2_input?>      </td>
    </tr>
    <?=$show_ext2_end?>
    <?=$show_ext3_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext3_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext3_input?>      </td>
    </tr>
    <?=$show_ext3_end?>
    <?=$show_ext4_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext4_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext4_input?>      </td>
    </tr>
    <?=$show_ext4_end?>
    <?=$show_ext5_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext5_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext5_input?>      </td>
    </tr>
    <?=$show_ext5_end?>
	<?=$show_ext6_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext6_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext6_input?>      </td>
    </tr>
    <?=$show_ext6_end?>
	<?=$show_ext7_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext7_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext7_input?>      </td>
    </tr>
    <?=$show_ext7_end?>
	<?=$show_ext8_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext8_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext8_input?>      </td>
    </tr>
    <?=$show_ext8_end?>
	<?=$show_ext9_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext9_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext9_input?>      </td>
    </tr>
    <?=$show_ext9_end?>
	<?=$show_ext10_begin?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7"> 
        <?=$show_ext10_title?>
        &nbsp;:&nbsp; </td>
      <td bgcolor="#FFFFFF"> 
        <?=$show_ext10_input?>      </td>
    </tr>
    <?=$show_ext10_end?>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name="mb_mailing" type="checkbox" id="mb_mailing" value="1" <?=($mem[mb_mailing])?'checked':''?>>
        ���ϼ��� &nbsp; <input name="mb_open_info" type="checkbox" id="mb_open_info" value="1" <?=($mem[mb_open_info])?'checked':''?>>
      ��������</td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">����Ʈ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name="mb_point" type="text" id="mb_point" value="<?=$mem[mb_point]?>"></td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">���þ��� ����Ʈ&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><input name="mb_today_point" type="text" id="mb_today_point" value="<?=$mem[mb_today_point]?>"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#f7f7f7">�ֱ�����Ʈ ������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"><?=rg_date($mem[mb_point_date])?>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> <select name="mb_level">
          <?=rg_html_option($levels,'','',"$mem[mb_level]")?>
      </select> </td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#f7f7f7">ȸ������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> 
        <?
echo rg_html_radio($mb_states,'mb_state','','',$mem[mb_state])
?>      </td>
    </tr>
    <?if($mode=='edit') {?>
    <tr> 
      <td height="22" align="right" bgcolor="#f7f7f7">������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> 
        <?=rg_date($mem[mb_reg_date])?>      </td>
    </tr>
    <tr> 
      <td height="22" align="right" bgcolor="#f7f7f7">����������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> 
        <?=($mem[mb_modi_date]==0)?'-':rg_date($mem[mb_modi_date])?>      </td>
    </tr>
    <tr> 
      <td height="22" align="right" bgcolor="#f7f7f7">�ֱ�������&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> 
        <?=($mem[mb_login_date]==0)?'-':rg_date($mem[mb_login_date])?>      </td>
    </tr>
    <tr> 
      <td height="22" align="right" bgcolor="#f7f7f7">�ֱ����Ӿ�����&nbsp;:&nbsp;</td>
      <td bgcolor="#FFFFFF"> 
        <?=$mem[mb_login_ip]?>      </td>
    </tr>
    <?}?>
  </table> 
  <div align="center"> <br>
    <input name="submit" type=submit class=button value=' Ȯ     �� ' style="font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
  </div></p>
  <p><table width="796" align="center">
		<tr>
		<td align=center><a href="member_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" border="0"></a></td>
		</tr>
		</table>
</form>
<script language='Javascript'>
    var f = document.mb_form;
		
		if(typeof(f.mb_id) != 'undefined')
	    f.mb_id.focus();

    // submit ���� ��üũ
    function formcheck() 
    {
        return true;
    }

    // ȸ�����̵� �˻�
    function mb_id_check()
    {
        if (f.mb_id.value == "") {
            alert('ȸ�� ���̵� �Է��ϼ���.');
            f.mb_id.focus();
            return false;
        }

        window.open('<?=$abs_uri?>mbidcheck.php?mb_id='+f.mb_id.value, 'mbidcheck', 'left=0,top=10000,width=1,height=1');
    }
</script>
<? include("admin.footer.php"); ?>
