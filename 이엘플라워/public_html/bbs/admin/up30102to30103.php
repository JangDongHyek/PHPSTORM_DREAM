<?
/*
���� 3.1.2 ���� 3.1.2 �� ��� ��ȯ ���α׷�
*/
	
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		// ���� ���̺� ��ȯ
		$dbqry="ALTER TABLE `{$db_table_prefix}vote_cfg`
		        ADD `vt_cmt_count` INT UNSIGNED NOT NULL";
		query($dbqry,$dbcon);
		rg_href("admin.sub_menu2.php","����Ÿ���̽� ��ȯ�� �Ϸ�Ǿ����ϴ�.");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
        <br>
        <table width="70%" border="1" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="30" align="center" valign="middle" bgcolor="f7f7f7"><p><br>
                ���� ����Ÿ���̽��� 3.1.2 ���� 3.1.3�� ��ȯ�մϴ�..<br>
                ������ ����Ÿ ���ǿ����� å���� ���� �ʻ���� �̸� ������ֽñ� �ٶ��ϴ�.<br>
                <br>
                ��ȯ ����<br>
                1. ��ǥ���̺� ��ȯ<br>
                <br>
              </p>
              </td>
          </tr>
        </table>
        <br>
        <input name="submit" type="submit" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;" value=" Ȯ     �� ">
        <br>
        <br>
        <a href="admin.sub_menu2.php"><img src="images/list_mb.gif" border="0"></a> 
        <br>
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>