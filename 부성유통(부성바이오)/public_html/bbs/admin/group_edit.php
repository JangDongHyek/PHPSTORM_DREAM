<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS)) $GLOBALS[$key]=trim($value);
		$gr_reg_date = $now;
		$gr_ext_types = '0';
		$gr_ext_types .= (strlen($gr_ext_type1)==1) ? $gr_ext_type1:'0';
		$gr_ext_types .= (strlen($gr_ext_type2)==1) ? $gr_ext_type2:'0';
		$gr_ext_types .= (strlen($gr_ext_type3)==1) ? $gr_ext_type3:'0';
		$gr_ext_types .= (strlen($gr_ext_type4)==1) ? $gr_ext_type4:'0';
		$gr_ext_types .= (strlen($gr_ext_type5)==1) ? $gr_ext_type5:'0';
		
		if($mode=='edit') {
		 	// ���̺� �׷� ����Ÿ ����
			$dbqry="
				UPDATE `$db_table_group_cfg` SET
					`gr_owner_no` = '$gr_owner_no',
					`gr_name` = '$gr_name',
					`gr_header_file` = '$gr_header_file', 
					`gr_header_tag` = '$gr_header_tag', 
					`gr_footer_file` = '$gr_footer_file', 
					`gr_footer_tag` = '$gr_footer_tag', 
					`gr_intro` = '$gr_intro', 
					`gr_state` = '$gr_state', 
					`gr_member_state` = '$gr_member_state', 
					`gr_reg_date` = '$gr_reg_date', 
					`gr_name_disp` = '$gr_name_disp', 
					`gr_ext_types` = '$gr_ext_types', 
					`gr_ext_name1` = '$gr_ext_name1', 
					`gr_ext_value1` = '$gr_ext_value1', 
					`gr_ext_name2` = '$gr_ext_name2', 
					`gr_ext_value2` = '$gr_ext_value2', 
					`gr_ext_name3` = '$gr_ext_name3', 
					`gr_ext_value3` = '$gr_ext_value3', 
					`gr_ext_name4` = '$gr_ext_name4', 
					`gr_ext_value4` = '$gr_ext_value4', 
					`gr_ext_name5` = '$gr_ext_name5', 
					`gr_ext_value5` = '$gr_ext_value5',
					`gr_member_level` = '$gr_member_level',
					`gr_open` = '$gr_open',
					`gr_level_type` = '$gr_level_type'
				WHERE gr_num='$gr_num'
			";
			query($dbqry,$dbcon);
		} else {
			// ���̺� �׷� ����Ÿ �߰�
			$dbqry="
				INSERT INTO `$db_table_group_cfg` 
					( `gr_num` , `gr_id` , `gr_owner_no` , `gr_name` ,
						`gr_header_file` , `gr_header_tag` , `gr_footer_file` , 
						`gr_footer_tag` , `gr_intro` , `gr_state` , 
						`gr_member_state` , `gr_reg_date` , 
						`gr_name_disp` , `gr_ext_types` , 
						`gr_ext_name1` , `gr_ext_value1` , `gr_ext_name2` , 
						`gr_ext_value2` , `gr_ext_name3` , `gr_ext_value3` , 
						`gr_ext_name4` , `gr_ext_value4` , `gr_ext_name5` , 
						`gr_ext_value5`, `gr_member_level`, `gr_open`, `gr_level_type`
					) 
				VALUES 
					( '', '$gr_id', '$gr_owner_no', '$gr_name', 
						'$gr_header_file', '$gr_header_tag', '$gr_footer_file', 
						'$gr_footer_tag', '$gr_intro', '$gr_state', 
						'$gr_member_state', '$gr_reg_date',
						'$gr_name_disp', '$gr_ext_types', 
						'$gr_ext_name1', '$gr_ext_value1', '$gr_ext_name2', 
						'$gr_ext_value2', '$gr_ext_name3', '$gr_ext_value3', 
						'$gr_ext_name4', '$gr_ext_value4', '$gr_ext_name5', 
						'$gr_ext_value5', '$gr_member_level', '$gr_open', '$gr_level_type'
					)
			";
			query($dbqry,$dbcon);
		}
		rg_href("group_list.php?$p_str&page=$page");
	}
	if($mode=='edit') {
		$R=rg_get_group_cfg($gr_num,1);
		$tmp=rg_get_member_info($R[gr_owner_no],1);
		$R[gr_owner_id]=$tmp[mb_id];
		unset($tmp);
	} else {
		$R[gr_state]='0';
		$R[gr_member_state]='0';
		$R[gr_member_level]='1';
		$R[gr_open]='0';
		$R[gr_level_type]='0';
		$R[gr_name_disp]='0';
	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040">�׷�&nbsp;����</font></span></p></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="group_edit" id="group_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="gr_num" type="hidden" value="<?=$gr_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td width="100" align="right" bgcolor="#f7f7f7">�׷���̵�&nbsp;:&nbsp; 
            </td>
            <td >&nbsp; <input name="gr_id" type="text" id="gr_id" value="<?=$R[gr_id]?>" size="50" <?=($mode=='edit')?'readonly':''?>> 
            </td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >������ ���̵�&nbsp;:&nbsp;</td>
            <td >&nbsp; <input name="gr_owner_id" type="text" id="gr_owner_id" value="<?=$R[gr_owner_id]?>" size="30" readonly> 
              <input name="gr_owner_no" type="hidden" id="gr_owner_no" value="<?=$R[gr_owner_no]?>" size="30"> 
              <input type=button class=button onclick="popup_mb_list('group_edit', './','gr_owner_id','gr_owner_no','','0')" value='ȸ������'> 
            </td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�׷��̸�&nbsp;:&nbsp;</td>
            <td >&nbsp; <input name="gr_name" type="text" id="gr_name" value="<?=$R[gr_name]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >��ܻ�������&nbsp;:&nbsp;</td>
            <td >&nbsp; <input name="gr_header_file" type="text" id="gr_header_file" value="<?=$R[gr_header_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >����±�&nbsp;:&nbsp;</td>
            <td >&nbsp; <textarea name="gr_header_tag" cols="50" rows="8" id="gr_header_tag"><?=$R[gr_header_tag]?></textarea></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�ϴܻ�������&nbsp;:&nbsp;</td>
            <td >&nbsp; <input name="gr_footer_file" type="text" id="gr_footer_file" value="<?=$R[gr_footer_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�ϴ��±�&nbsp;:&nbsp;</td>
            <td >&nbsp; <textarea name="gr_footer_tag" cols="50" rows="8" id="gr_footer_tag"><?=$R[gr_footer_tag]?></textarea></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�׷�Ұ���&nbsp;:&nbsp;</td>
            <td >&nbsp; <textarea name="gr_intro" cols="50" rows="8" id="gr_intro"><?=$R[gr_intro]?></textarea></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�׷����&nbsp;:&nbsp;</td>
            <td >&nbsp; 
              <?
echo rg_html_radio($gr_states,'gr_state','','',$R[gr_state])
?>
            </td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >ȸ���⺻����&nbsp;:&nbsp;</td>
            <td >&nbsp; 
              <?
echo rg_html_radio($mb_states,'gr_member_state','','',$R[gr_member_state])
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >ȸ���⺻����&nbsp;:&nbsp;</td>
            <td >&nbsp; <select name="gr_member_level">
                <?=rg_html_option($levels,'','',"$R[gr_member_level]")?>
              </select></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >��������&nbsp;:&nbsp;</td>
            <td >&nbsp; 
              <?
echo rg_html_radio($gr_open_list,'gr_open','','',$R[gr_open])
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >��������&nbsp;:&nbsp;</td>
            <td > &nbsp; 
              <?
echo rg_html_radio($gr_level_type_list,'gr_level_type','','',$R[gr_level_type])
?>
            </td>
          </tr>
          <?=($mode=='edit')?'':'<!--'?>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >������&nbsp;:&nbsp;</td>
            <td > &nbsp; 
              <?=rg_date($R[gr_reg_date])?>
            </td>
          </tr>
          <?=($mode=='edit')?'':'-->'?>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >�̸� ǥ�� ���&nbsp;:&nbsp;</td>
            <td > &nbsp; 
              <?
echo rg_html_radio($gr_name_disps,'gr_name_disp','','',$R[gr_name_disp])
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td ><table width="87%" border="0" cellspacing="0" cellpadding="0">
                <tr align="center"> 
                  <td width="2%">&nbsp;</td>
                  <td width="11%">����</td>
                  <td width="31%">�׸��</td>
                  <td width="56%">������</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >&nbsp;ȸ���߰��Է�1&nbsp;:&nbsp;</td>
            <td > &nbsp; <select name="gr_ext_type1" id="gr_ext_type1">
                <option value="0">������</option>
                <?
echo rg_html_option($ext_types,'','name',$R[gr_ext_types][1]);
?>
              </select> <input name="gr_ext_name1" type="text" id="gr_ext_name1" value="<?=$R[gr_ext_name1]?>"> 
              <input name="gr_ext_value1" type="text" id="gr_ext_value12" value="<?=$R[gr_ext_value1]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >ȸ���߰��Է�2&nbsp;:&nbsp;</td>
            <td >&nbsp; <select name="gr_ext_type2" id="gr_ext_type2">
                <option value="0">������</option>
                <?
echo rg_html_option($ext_types,'','name',$R[gr_ext_types][2]);
?>
              </select> <input name="gr_ext_name2" type="text" id="gr_ext_name2" value="<?=$R[gr_ext_name2]?>"> 
              <input name="gr_ext_value2" type="text" id="gr_ext_value22" value="<?=$R[gr_ext_value2]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >ȸ���߰��Է�3&nbsp;:&nbsp;</td>
            <td >&nbsp; <select name="gr_ext_type3" id="gr_ext_type3">
                <option value="0">������</option>
                <?
echo rg_html_option($ext_types,'','name',$R[gr_ext_types][3]);
?>
              </select> <input name="gr_ext_name3" type="text" id="gr_ext_name3" value="<?=$R[gr_ext_name3]?>"> 
              <input name="gr_ext_value3" type="text" id="gr_ext_value32" value="<?=$R[gr_ext_value3]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >ȸ���߰��Է�4&nbsp;:&nbsp;</td>
            <td >&nbsp; <select name="gr_ext_type4" id="gr_ext_type4">
                <option value="0">������</option>
                <?
echo rg_html_option($ext_types,'','name',$R[gr_ext_types][4]);
?>
              </select> <input name="gr_ext_name4" type="text" id="gr_ext_name4" value="<?=$R[gr_ext_name4]?>"> 
              <input name="gr_ext_value4" type="text" id="gr_ext_value42" value="<?=$R[gr_ext_value4]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >ȸ���߰��Է�5&nbsp;:&nbsp;</td>
            <td >&nbsp; <select name="gr_ext_type5" id="gr_ext_type5">
                <option value="0">������</option>
                <?
echo rg_html_option($ext_types,'','name',$R[gr_ext_types][5]);
?>
              </select> <input name="gr_ext_name5" type="text" id="gr_ext_name5" value="<?=$R[gr_ext_name5]?>"> 
              <input name="gr_ext_value5" type="text" id="gr_ext_value52" value="<?=$R[gr_ext_value5]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" ><font color="#404040">������&nbsp;����&nbsp;:&nbsp;</font></td>
            <td> <table border="0" cellpadding="0" cellspacing="3" width="552">
                <tr> 
                  <td width="79" align="right"><font color="#FF0000">������ư :&nbsp; 
                    </font></td>
                  <td width="161"><font color="#FF0000">!��1|��2|��3|��4</font></td>
                  <td width="85" align="right"><font color="#FF0000">&nbsp;�ؽ�Ʈ�Է� 
                    :&nbsp;</font></td>
                  <td width="212"><font color="#FF0000">ũ��|�⺻��</font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">����Ʈ :&nbsp; </font></td>
                  <td><font color="#FF0000">��1|!��2|��3|��4</font></td>
                  <td align="right"><font color="#FF0000">üũ�ڽ� :&nbsp; </font></td>
                  <td><font color="#FF0000">!{}ǥ���̸�|��</font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">�ؽ�Ʈ���� :&nbsp;</font></td>
                  <td><font color="#FF0000">cols|rows|�⺻��</font></td>
                  <td><font color="#FF0000">&nbsp;</font></td>
                  <td><font color="#FF0000">&nbsp;</font></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <br>
        <table border="0" width="796" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"> <input name="Submit" type="submit" id="Submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" Ȯ     �� "></td>
          </tr>
        </table>
        <br>
        <table border="0" width="796" cellspacing="0" cellpadding="0">
          <tr>
            <td><p align="center"><a href="group_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" border="0"></a></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>