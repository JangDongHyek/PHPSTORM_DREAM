<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");
	
	function html_level_sel($i){
		global $R,$bbs_auths;
		$_result = "<select name=\"bbs_cfg[$i]\">";
		$_result .= rg_html_option($bbs_auths,'','',$R[bbs_cfg][$i]);
		$_result .= "</select>";
		return $_result;
	}
	
	if($act) {
//		while(list($key,$value)=each($HTTP_POST_VARS)) $GLOBALS[$key]=trim($value);
		// �迭�� �߰��� ���Դ� ��찡 �־� üũ�ؼ� �迭�� �������
		for($i=0;$i<40;$i++)
			$bbs_cfg[$i] = (isset($bbs_cfg[$i])) ? $bbs_cfg[$i]:'';

		ksort($bbs_cfg);
		$db_bbs_cfg = implode (',', $bbs_cfg);

		if($mode=='edit') {
		 	// ���̺� �Խ��� ����Ÿ ����
			$dbqry="
				UPDATE `$db_table_bbs_cfg` SET
					`bbs_cfg` = '$db_bbs_cfg'
				WHERE `bbs_num` = '$bbs_num'
			";
			query($dbqry,$dbcon);
		}
		if(count($group_chk)>0){ // �׷�üũ ó�� 
			$R=rg_get_bbs_cfg($bbs_num,1);

			$dbqry="
				SELECT bbs_num,bbs_cfg
				FROM `$db_table_bbs_cfg`
				WHERE `bbs_gr_num` = '$R[bbs_gr_num]'";
			$rs=query($dbqry,$dbcon);
			while ($R1=mysql_fetch_array($rs)) {
				$db_bbs_cfg = explode(',', $R1[bbs_cfg]);
				foreach($group_chk as $field) {
					$field = trim($field);
					$db_bbs_cfg[${$field}] = $bbs_cfg[${$field}];
				}
				$db_bbs_cfg = implode (',', $db_bbs_cfg);
				
				$dbqry="
					UPDATE `$db_table_bbs_cfg` SET
						`bbs_cfg` = '$db_bbs_cfg'
					WHERE `bbs_num` = '$R1[bbs_num]'
				";
				query($dbqry,$dbcon);
			}
		}

		if(count($all_chk)>0){ // ��üüũ ó�� 
			$R=rg_get_bbs_cfg($bbs_num,1);

			$dbqry="
				SELECT bbs_num,bbs_cfg
				FROM `$db_table_bbs_cfg`";
			$rs=query($dbqry,$dbcon);
			while ($R1=mysql_fetch_array($rs)) {
				$db_bbs_cfg = explode(',', $R1[bbs_cfg]);
				foreach($all_chk as $field) {
					$field = trim($field);
					$db_bbs_cfg[${$field}] = $bbs_cfg[${$field}];
				}
				$db_bbs_cfg = implode (',', $db_bbs_cfg);
				
				$dbqry="
					UPDATE `$db_table_bbs_cfg` SET
						`bbs_cfg` = '$db_bbs_cfg'
					WHERE `bbs_num` = '$R1[bbs_num]'
				";
				query($dbqry,$dbcon);
			}
		}

//		rg_href("board_edit1.php?$p_str&mode=edit&bbs_num=$bbs_num");
		rg_href("board_list.php?$p_str&page=$page");
	}
	$R=rg_get_bbs_cfg($bbs_num,1);
	$R[bbs_cfg] = explode(',', $R[bbs_cfg]);
	$i=0;
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<script language="JavaScript" type="text/JavaScript">
	function all_checked(form_name,checkbox_name,chk)
	{
		eval('var f = document.'+form_name);

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == checkbox_name) { 
				f.elements[i].checked = chk;
			}
		}
	}
</script>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"> <a href="board_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$bbs_num?>" title="��ɼ���"><img src="images/ab_lot1.gif" border="0"></a>&nbsp;&nbsp;<a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank" title="�Խ��Ǻ���"><img src="images/ab_lot2.gif" border="0"></a>&nbsp;&nbsp;<a href="board_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/ab_lot3.gif" border="0"></a> 
    </td>
  </tr>
</table>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><font color="#404040">���� 
        ����</font></p></td>
  </tr>
</table>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="40" align="center" bgcolor="#EDEDED"><b><font color="#9842E1">����A</font></b></td>
    <td height="30"bgcolor="f7f7f7">&nbsp;����A�� üũ�� �Ǿ� ������쿡�� ��ü�� ������ �Ǹ� üũ�ڽ��� 
      ǥ�õ˴ϴ�</td>
    <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;<a href="javascript:all_checked('bbs_edit','all_chk[]',true)" title="(A)��ü����"><img src="images/all_choice.gif" border="0"></a>&nbsp;&nbsp;<a href="javascript:all_checked('bbs_edit','all_chk[]',false)" title="(A)�������"><img src="images/ch_choice.gif" border="0"></a></td>
  </tr>
  <tr> 
    <td width="40" align="center" bgcolor="#EDEDED"><b><font color=#0099CC>����G</font></b></td>
    <td height="30" bgcolor="f7f7f7">&nbsp;����G�� üũ�� �Ǿ� ������쿡�� ���ϱ׷쿡 ������ �Ǹ� üũ�ڽ��� 
      ǥ�õ˴ϴ�</td>
    <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;<a href="javascript:all_checked('bbs_edit','group_chk[]',true)" title="(G)��ü����"><img src="images/all_choice.gif" border="0"></a>&nbsp;&nbsp;<a href="javascript:all_checked('bbs_edit','group_chk[]',false)" title="(G)�������"><img src="images/ch_choice.gif" border="0"></a></td>
  </tr>
  <tr> 
    <td width="40" align="center" bgcolor="#EDEDED"><b><font color=RED>��&nbsp;��</font></b></td>
    <td height="30" bgcolor="f7f7f7" colspan="2">&nbsp;���� ������ ���������� ǥ�õǸ� �ش� ������ 
      �Ʒ��� ��ġ�ϰ� �ֽ��ϴ�</td>
  </tr>
</table>
<form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"> 
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="bbs_num" type="hidden" value="<?=$bbs_num?>">
<input name="page" type="hidden" value="<?=$page?>">
<input name="bbs_cfg[<?=$i?>]" type="hidden" value="<?=$R[bbs_cfg][$i]?>">
    </table>
		<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
		<tr> 
			<td height="30" align="center" bgcolor="#F7F7F7">���Ѽ���</td>
		</tr>
		</table>        
  <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    <tr> 
      <td width="1%" height="22" align="center" bgcolor="#f7f7f7"><strong><font color="#0000FF">A</font></strong></td>
      <td width="1%" align="center" bgcolor="#EDE8F4"><strong><font color="#0000FF">G</font></strong></td>
      <td width="17%" align="right" bgcolor="#f7f7f7">�Խ����̸�&nbsp;:&nbsp;</td>
      <td width="34%"> &nbsp; 
        <?=$R[bbs_name]?>
      </td>
      <td width="1%" align="center" bgcolor="#f7f7f7" ><strong><font color="#0000FF">A</font></strong></td>
      <td width="1%" align="center" bgcolor="#EDE8F4" ><strong><font color="#0000FF">G</font></strong></td>
      <td width="17%" align="right" bgcolor="#f7f7f7">�Խ��� ������&nbsp;:&nbsp;</td>
      <td width="34%" > &nbsp; 
        <?=rg_date($R[bbs_reg_date])?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_LIST"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_LIST"></td>
      <td align="right" bgcolor="#f7f7f7" >��Ϻ���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_LIST)
?>
      </td>
      <td bgcolor="#f7f7f7"><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_READ"></td>
      <td bgcolor="#EDE8F4"><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_READ"></td>
      <td align="right" bgcolor="#f7f7f7">�б�&nbsp;:&nbsp;</td>
      <td> &nbsp; 
        <?
echo html_level_sel($C_AUTH_READ)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_WRITE"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_WRITE"></td>
      <td align="right" bgcolor="#f7f7f7">�������&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_WRITE)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_REPLY"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_REPLY"></td>
      <td align="right" bgcolor="#f7f7f7" >�����&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_REPLY)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_EDIT"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_EDIT"></td>
      <td align="right" bgcolor="#f7f7f7" >�ۼ������&nbsp;:&nbsp;</td>
      <td >&nbsp; 
        <?
echo html_level_sel($C_AUTH_EDIT)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_DELETE"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_DELETE"></td>
      <td align="right" bgcolor="#f7f7f7" >�ۻ���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_DELETE)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_COMMENT"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_COMMENT"></td>
      <td align="right" bgcolor="#f7f7f7" >�ڸ�Ʈ����&nbsp;:&nbsp;</td>
      <td >&nbsp; 
        <?
echo html_level_sel($C_AUTH_COMMENT)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_NOTICE"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_NOTICE"></td>
      <td align="right" bgcolor="#f7f7f7" >��������&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_NOTICE)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" >&nbsp;</td>
      <td bgcolor="#EDE8F4" >&nbsp;</td>
      <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
      <td >&nbsp;</td>
      <td bgcolor="#f7f7f7" >&nbsp;</td>
      <td bgcolor="#EDE8F4" >&nbsp;</td>
      <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_UPLOAD"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_UPLOAD"></td>
      <td align="right" bgcolor="#f7f7f7" >���ε�&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_UPLOAD)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_DOWNLOAD"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_DOWNLOAD"></td>
      <td align="right" bgcolor="#f7f7f7" >�ٿ�ε�&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_DOWNLOAD)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_VOTE_YES"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_VOTE_YES"></td>
      <td align="right" bgcolor="#f7f7f7" >��õ���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_VOTE_YES)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_VOTE_NO"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_VOTE_NO"></td>
      <td align="right" bgcolor="#f7f7f7" >����õ���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_VOTE_NO)
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_SECRET"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_SECRET"></td>
      <td align="right" bgcolor="#f7f7f7" >��б۱��&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_SECRET)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_CART"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_CART"></td>
      <td align="right" bgcolor="#f7f7f7" >īƮ���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_CART)
?>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_LINK"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_LINK"></td>
      <td align="right" bgcolor="#f7f7f7" >��ũ&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_LINK)
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_AUTH_HTML"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_AUTH_HTML"></td>
      <td align="right" bgcolor="#f7f7f7" >HTML���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo html_level_sel($C_AUTH_HTML)
?>
      </td>
    </tr>
  </table>
	<br>
  <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td height="30" align="center" bgcolor="#F7F7F7" >��ɼ���</td>
  </tr>
	</table>
	<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    
    <tr> 
      <td height="22" align="center" bgcolor="#f7f7f7"><strong><font color="#0000FF">A</font></strong></td>
      <td align="center" bgcolor="#EDE8F4"><strong><font color="#0000FF">G</font></strong></td>
      <td align="center" bgcolor="#f7f7f7" >&nbsp;</td>
      <td >&nbsp;</td>
      <td align="center" bgcolor="#f7f7f7" ><strong><font color="#0000FF">A</font></strong></td>
      <td align="center" bgcolor="#EDE8F4" ><strong><font color="#0000FF">G</font></strong></td>
      <td align="center" bgcolor="#f7f7f7" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr> 
      <td width="1%" height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_CATEGORY"></td>
      <td width="1%" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_CATEGORY"></td>
      <td width="17%" align="right" bgcolor="#f7f7f7" >ī�װ����&nbsp;:&nbsp;</td>
      <td width="34%" >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_CATEGORY]",'','',$R[bbs_cfg][$C_USE_CATEGORY])
?>
      </td>
      <td width="1%" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_REMOTE_WRITE"></td>
      <td width="1%" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_REMOTE_WRITE"></td>
      <td width="17%" align="right" bgcolor="#f7f7f7" >���ݱ۾���&nbsp;:&nbsp;</td>
      <td width="34%" >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_REMOTE_WRITE]",'','',$R[bbs_cfg][$C_USE_REMOTE_WRITE])
?>
        <br>
        &nbsp;(�κ���� ��뿩��)</td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_QUOTE"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_QUOTE"></td>
      <td align="right" bgcolor="#f7f7f7" >�����ο뿩��&nbsp;:&nbsp;</td>
      <td >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_QUOTE]",'','',$R[bbs_cfg][$C_USE_QUOTE])
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_VIEW_MAIL"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_VIEW_MAIL"></td>
      <td align="right" bgcolor="#f7f7f7" >���޸��ϻ��&nbsp;:&nbsp;</td>
      <td >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_VIEW_MAIL]",'','',$R[bbs_cfg][$C_USE_VIEW_MAIL])
?>
      </td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_REPLAY_MAIL"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_REPLAY_MAIL"></td>
      <td align="right" bgcolor="#f7f7f7" >���ñ۸���&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_REPLAY_MAIL]",'','',$R[bbs_cfg][$C_USE_REPLAY_MAIL])
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_ADMIN_MAIL"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_ADMIN_MAIL"></td>
      <td align="right" bgcolor="#f7f7f7" >��ڸ��ϼ���&nbsp;:&nbsp; </td>
      <td >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_ADMIN_MAIL]",'','',$R[bbs_cfg][$C_USE_ADMIN_MAIL])
?>
      </td>
    </tr>
    <tr>
      <td height="22" bgcolor="#f7f7f7" >&nbsp;</td>
      <td bgcolor="#EDE8F4" >&nbsp;</td>
      <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
      <td >&nbsp;</td>
      <td bgcolor="#f7f7f7" >&nbsp;</td>
      <td bgcolor="#EDE8F4" >&nbsp;</td>
      <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
      <td ><font color="#FF0000">&nbsp;(�Խ��ǿ�ڿ� ����)</font></td>
    </tr>
    <tr> 
      <td height="22" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_SIGNATURE"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_SIGNATURE"></td>
      <td align="right" bgcolor="#f7f7f7" >������&nbsp;:&nbsp;</td>
      <td >&nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_SIGNATURE]",'','',$R[bbs_cfg][$C_USE_SIGNATURE])
?>
      </td>
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_USE_MB_ICON"></td>
      <td bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_USE_MB_ICON"></td>
      <td align="right" bgcolor="#f7f7f7" >ȸ�������ܻ��&nbsp;:&nbsp;</td>
      <td > &nbsp; 
        <?
echo rg_html_radio($bbs_func,"bbs_cfg[$C_USE_MB_ICON]",'','',$R[bbs_cfg][$C_USE_MB_ICON])
?>
      </td>
    </tr>
    <!--
          <tr> 
            <td align="center" bgcolor="silver" class="line1" >HTML�������</td>
            <td height="22" colspan="3" class="line1" > 
              <?
echo rg_html_radio($bbs_html_auths,"bbs_cfg[$C_HTML_TYPE]",'','',$R[bbs_cfg][$C_HTML_TYPE])
?>
            </td>
          </tr>
-->
    <tr> 
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_REPLY_DELETE"></td>
      <td height="22" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_REPLY_DELETE"> 
      </td>
      <td align="right" bgcolor="#f7f7f7" >���ñ� ���&nbsp;:&nbsp;</td>
      <td height="22" colspan="5" >&nbsp; 
        <?
echo rg_html_radio($bbs_exist_del_auths,"bbs_cfg[$C_REPLY_DELETE]",'','',$R[bbs_cfg][$C_REPLY_DELETE])
?>
      </td>
    </tr>
    <tr> 
      <td height="22" colspan="2" align="center" bgcolor="#f7f7f7" ><b><font color="#FF0000">����</font></b></td>
      <td align="right" bgcolor="#f7f7f7" ><font color="#404040">���ñ� ���� &nbsp;:&nbsp;</font></td>
      <td height="22" colspan="5" ><font color="#FF0000"> &nbsp;���ñ��� ���� �� �ÿ� ���� 
        �� ���� ���ɿ��θ� �����մϴ�</font></td>
    </tr>
    <tr> 
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_VIEW_LIST"></td>
      <td height="22" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_VIEW_LIST"> 
      </td>
      <td align="right" bgcolor="#f7f7f7" >����Բ�����&nbsp;:&nbsp;</td>
      <td height="22" colspan="5" >&nbsp; 
        <?
echo rg_html_radio($bbs_list_auths,"bbs_cfg[$C_VIEW_LIST]",'','',$R[bbs_cfg][$C_VIEW_LIST])
?>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="C_VIEW_IMAGE"></td>
      <td height="22" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="C_VIEW_IMAGE"> 
      </td>
      <td align="right" bgcolor="#f7f7f7" >�̹��� �Բ�����&nbsp;:&nbsp;</td>
      <td height="22" colspan="5" > &nbsp; 
        <?
echo rg_html_radio($bbs_image_view_auths,"bbs_cfg[$C_VIEW_IMAGE]",'','',$R[bbs_cfg][$C_VIEW_IMAGE])
?>
      </td>
    </tr>
  </table>
        
  <br>
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="796">
    <tr> 
      <td align="center"><input type="submit" name="Submit2" value=" Ȯ     �� " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center"> <a href="board_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$bbs_num?>" title="��ɼ���"><img src="images/ab_lot1.gif" border="0"></a>&nbsp;&nbsp;<a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank"><img src="images/ab_lot2.gif" border="0" title="�Խ��Ǻ���"></a>&nbsp;&nbsp;<a href="board_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/ab_lot3.gif" border="0"></a> 
      </td>
    </tr>
  </table>
</form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
