<?
	$site_path = '../';
	include($site_path."include/lib.inc.php");
	
	// �����ڰ� �ִ��� üũ 
		$dbqry = "
			SELECT mb_num
			FROM $db_table_member
			WHERE mb_id = '$mb_id'
				AND mb_num <> '$mb_num'
		";
		$rs=query($dbqry,$dbcon);
			
	$dbqry = "
			SELECT count(*)
			FROM `$db_table_member`
			WHERE mb_level > 9
		";
	$rs=query($dbqry,$dbcon);
	$tmp=mysql_fetch_array($rs);
	if($tmp[0]) {
		$msg="�̹� ������ ������ �ֽ��ϴ�.";
		include("error.inc.php");
	}
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
	
		if(!$mb_id || !$mb_password || !$mb_name) {
			rg_href('','�������� �Է����ּ���.','','back');
		}
/********************************************************************/
		$mb_reg_date=$now;
		$mb_login_ip=$REMOTE_ADDR;
		
		if(rg_get_member_info($mb_id)) { // ����ϰ� �ִ� ���̵�
			$msg = str_replace ("%mb_id%", $mb_id, "$msg_exist_mb_id");
			rg_href('',$msg,'','back');
		}
		
		$mb_password = get_password_str($mb_password);
		
		$mb_photo = '';
		$mb_icon = '';
		$mb_level = 10;
		$mb_point = 0;
		
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
					`mb_point` , `mb_level` , `mb_state` , 
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
					'$mb_point', '$mb_level', '$mb_state', 
					'$mb_reg_date', '$mb_modi_date', '$mb_login_ip', 
					'$mb_log_count', '$mb_ext1', '$mb_ext2', 
					'$mb_ext3', '$mb_ext4', '$mb_ext5',
					'$mb_ext6', '$mb_ext7', '$mb_ext8',
					'$mb_ext9', '$mb_ext10'
				)
		";
		query($dbqry,$dbcon);

/********************************************************************/
		rg_href('login.php');
	}
?>
<? include("admin.header.php"); ?>
<form name="form1" method="post" action="">
<input name="act" type="hidden" value="ok">
  <table width="500" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="500"> <p>���� ��ġ ȯ���Դϴ�.<br> �����ڸ� �����ϱ� ���� ������ �Է��Ͽ� �ֽʽÿ�.</p></td>
    </tr>
  </table>
  <br>
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">���̵� :&nbsp;</td>
      <td width="318"><input name="mb_id" type="text" id="mb_id" required itemname="���̵�" minlength=2 maxlength=20></td>
    </tr>
    <tr> 
      <td width="176" height="24" align="right" bgcolor="#F7F7F7">��&nbsp;&nbsp;&nbsp;ȣ 
        :&nbsp;</td>
      <td><input name="mb_password" type="password" id="mb_password" required itemname="��ȣ"></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">��&nbsp;&nbsp;&nbsp;�� :&nbsp;</td>
      <td><input name="mb_name" type="text" id="mb_name" required itemname="�̸�"></td>
    </tr>
  </table>
  <br>
  <div align="center">
    <input type="submit" class="button1" value=" Ȯ �� ">
  </div>
</form>
<? include("admin.footer.php"); ?>