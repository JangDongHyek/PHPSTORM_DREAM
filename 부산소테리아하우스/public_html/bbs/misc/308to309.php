<?
/*
���� 3.0.8 ���� 3.0.9 �� ��� ��ȯ ���α׷�

������
admin ���丮 �ȿ� �ø�����
������/admin/308to309.php �Ͻ���
Ȯ�δ����ø� �˴ϴ�.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		// ���� ���̺� ��ȯ

		$dbqry="ALTER TABLE `$db_table_bbs_cfg` CHANGE `bbs_upload_ext` `bbs_file1_ext` VARCHAR( 255 ) NOT NULL";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` ADD `bbs_file2_ext` VARCHAR( 255 ) NOT NULL AFTER `bbs_file1_ext`";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` CHANGE `bbs_max_file_size` `bbs_file1_size` INT( 20 ) DEFAULT '0' NOT NULL ";
		query($dbqry,$dbcon);
		$dbqry="ALTER TABLE `$db_table_bbs_cfg` ADD `bbs_file2_size` INT( 20 ) NOT NULL AFTER `bbs_file1_size`";
		query($dbqry,$dbcon);

		rg_href("/","����Ÿ���̽� ��ȯ�� �Ϸ�Ǿ����ϴ�.");
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
              ���� ����Ÿ���̽��� 3.0.8 ���� 3.0.9�� ��ȯ�մϴ�..<br>
							������ ����Ÿ ���ǿ����� å���� ���� �ʻ���� �̸� ������ֽñ� �ٶ��ϴ�.</td>
          </tr>
        </table>
        <br>
        <input type="submit" value=" Ȯ �� ">
        <a href="javascript:history.back()">���</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>