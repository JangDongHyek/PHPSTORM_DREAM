<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	$group_mb=rg_get_group_member_info($gm_num,'',4);
	$tmp=rg_get_member_info($group_mb[gm_mb_num],1);
	$group_mb[gm_mb_id]=$tmp[mb_id];
	$group = rg_get_group_cfg($group_mb[gm_gr_num],1);
	unset($tmp);
	
	if($act) {
/*
		// �׷� ȸ���� ���� 
		$dbqry="
			UPDATE `$db_table_group_cfg` SET
				`gr_total_member` = `gr_total_member` - 1
			WHERE gr_num='$group_mb[gm_gr_num]'
		";
		query($dbqry,$dbcon);
*/
		$dbqry = "
			DELETE FROM $db_table_group_member
			WHERE gm_num = '$gm_num'
		";
		$rs=query($dbqry,$dbcon);
		rg_href("group_member_list.php?$p_str");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
<input name="gm_num" type="hidden" value="<?=$gm_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <br>
        <table width="70%" cellspacing="0" border="1" cellpadding="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="#f7f7f7"> 
              <?=$group[gr_name]?>
              ��&nbsp;<font color=red> 
              <?=$group_mb[gm_mb_id]?>
              </font>&nbsp;ȸ���� Ż���մϴ� </td>
          </tr>
          <tr>
            <td height="25" align=center><span style=font-size=9pt;><font color=#404040>�׷쿡�� 
              Ż�� �ǹ��ϸ� ȸ���� �����Ǵ� ���� �ƴմϴ�.</font></span></td>
          </tr>
        </table>
        <br>
        <p align="center"> 
          <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" ��     �� ">
        </p>
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"> </tr>
          <tr> 
            <td align=center><a href="javascript:history.back()" title="�������"><img src="images/delmb_c.gif" width="66" height="25" border="0"></a>&nbsp;<a href="group_member_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" width="66" height="25" border="0"></a></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>