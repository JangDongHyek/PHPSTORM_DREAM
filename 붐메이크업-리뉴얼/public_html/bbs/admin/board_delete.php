<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	$R=rg_get_bbs_cfg($bbs_num,1);
	$bbs_id = $R[bbs_id];
	//$bbs_table = $db_table_prefix.$bbs_id;	
	$bbs_table = $db_table_prefix.$R[bbs_table_name];

	if($act) {
		if($bbs_id) {
			// ���̺� �Խ��� ����Ÿ ����
			$dbqry="
				DELETE FROM `$db_table_bbs_cfg`
				WHERE `bbs_num` = '$bbs_num'
			";
				query($dbqry,$dbcon);

			// �Խ������̺� ����
			$dbqry = "
					DROP TABLE rg_".$bbs_id."_body
				";
				query($dbqry,$dbcon);
			// ī�װ����̺� ����
			$dbqry = "
					DROP TABLE rg_".$bbs_id."_category
				";
				query($dbqry,$dbcon);
			// �ڸ�Ʈ���̺� ����
			$dbqry = "
					DROP TABLE rg_".$bbs_id."_comment
				";
				query($dbqry,$dbcon);
			// ����Ÿ ���丮 ����
			if($bbs_id)
				rg_delete_board_file($data_path.$bbs_id);
/*
			// �׷� �Խ��Ǽ� ����
			$dbqry="
				UPDATE `$db_table_group_cfg` SET
					`gr_total_bbs` = `gr_total_bbs` - 1
				WHERE gr_num='$R[bbs_gr_num]'
			";
			query($dbqry,$dbcon);
*/
		}
		rg_href("board_list.php?$p_str");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="801" border="0" align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="bbs_num" type="hidden" value="<?=$bbs_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <br>
        <table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="#f7f7f7"> 
              <font color=red>
              <?=$R[bbs_id]?>
              </font>&nbsp;��&nbsp;�Խ����� �����մϴ� </td>
          </tr>
          <tr>
            <td height="25" align=center><span style=font-size=9pt;><font color=#404040>�ѹ� 
              ������ �Խ����� ���� �� �� ������ ��Ȯ�� �Ǵ� �� ������ �ֽñ� �ٶ��ϴ�</font></span></td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" ��     �� ">
        <table width="796" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td height="10"> </tr>
          <tr> 
            <td align=center><a href="javascript:history.back()" title="�������"><img src="images/delmb_c.gif" border="0"></a>&nbsp;<a href="board_list.php?<?="$p_str&page=$page"?>" title="��Ϻ���"><img src="images/list_mb.gif" border="0"></a></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
