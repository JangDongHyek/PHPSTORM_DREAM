<?
/*
���� ����Ÿ���̽� �������α׷�

������
admin ���丮 �ȿ� �ø�����
������/admin/drop_rg_tables.php �Ͻ���
Ȯ�δ����ø� �˴ϴ�.
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	if($act) {
		// ���� �������̺� ����

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		while($tmp = mysql_fetch_array($rs)) {
			if(eregi("^($db_table_prefix)",$tmp[0])) {
				query("drop table $tmp[0] ",$dbcon);
			}
		}
		rg_delete_board_file($data_path);
		rg_href("/","���� ���� ���̺��� ���� �����Ͽ����ϴ�.");
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
              ������ ��� �Խ����� �����մϴ�.<br>
							�������� ������ ���� ����ž� �մϴ�.</td>
          </tr>
        </table>
        <br>
        <input type="submit" value="����">
        <a href="javascript:history.back()">���</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>