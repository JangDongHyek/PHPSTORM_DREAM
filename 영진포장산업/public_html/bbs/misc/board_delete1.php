<?
/*
�Խ��Ǿ��̵� ���� ������ �Խ��� �������α׷�

������
admin ���丮 �ȿ� �ø�����
������/admin/board_delete1.php �Ͻ���
Ȯ�δ����ø� �˴ϴ�.

�Ʒ� �޽����� ������ ������ �ʿ䰡 �����ϴ�.
===========================================
DROP TABLE `rg__body` 
���̺� 'rg__body'�� �˼� ����
===========================================
�Ű�Ⱦ��ŵ� �˴ϴ�.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	$bbs_table = $db_table_prefix;
	if($act) {
		// ���̺� �Խ��� ����Ÿ ����
		$dbqry="
			DELETE FROM `$db_table_bbs_cfg`
			WHERE `bbs_num` = '$bbs_num'
		";
			query($dbqry,$dbcon);

		// �Խ������̺� ����
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_body}`
			";
			query($dbqry,$dbcon);
		// ī�װ����̺� ����
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_category}`
			";
			query($dbqry,$dbcon);
		// �ڸ�Ʈ���̺� ����
		$dbqry = "
				DROP TABLE `{$bbs_table}{$db_table_suffix_comment}`
		";
		query($dbqry,$dbcon);
		
		// �׷� �Խ��Ǽ� ����
		$dbqry="
			UPDATE `$db_table_group_cfg` SET
				`gr_total_bbs` = `gr_total_bbs` - 1
			WHERE gr_num='$R[bbs_gr_num]'
		";
		query($dbqry,$dbcon);
			
		rg_href("../admin/index.php");
	}

?>
<? include("../admin/admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <table width="100%" cellspacing="0" style="border-collapse:collapse;">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="silver" class="line1"> 
              �Խ��Ǿ��̵� ���� �Խ��� �����մϴ�. </td>
          </tr>
        </table>
        <br>
        <input type="submit" value="����">
        <a href="javascript:history.back()">���</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>