<?
/*
���� ī���� ���̺���� ���α׷�

��ġ���Դϴ�. 

count_stat.zip �� �ٿ�ε� �������� count_stat.php �� addon ���丮��  create_count_tables.php�� admin ���丮�� �ø�����. 

[���̺����] 
�����ڷ� �α��� �Ѵ��� 
http://������/������/admin/create_count_tables.php �Ͻ��� Ȯ�δ����ø� ������迡 �ʿ��� ���̺��� �����Ǿ����ϴ�. 

[���α׷��߰�] 
����ó�� �����ϴܿ� ������ �Ϸ��� addon/head.php �� ��� 49��°���� 
<? include($site_path."addon/connect_list.php")?> 
�� �׿� �Ʒ��� ���� �ҽ��� �߰����ּ���. 

<br> 
<? include($site_path."addon/count_stat.php")?> 

������ ���忡 �����غ��ø� ��谡 ���ð��Դϴ�. 

[���۹��] 
1�ϵ��� ������ IP�� ���̺� �����Ͽ� üũ�� �ϰ�, ������ ������ ���Ͽ� 1���� ���� IP�� �ڵ������ǵ��� ���α׷� �Ǿ����ϴ�. 

������
admin ���丮 �ȿ� �ø�����
������/admin/create_count_tables.php �Ͻ���
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
		$table1_exist = false;
		$table2_exist = false;
		while($tmp = mysql_fetch_array($rs)) {
			if($db_table_prefix."count_stat"==$tmp[0]) {
				$table1_exist = true;
			}
			if($db_table_prefix."count_ip"==$tmp[0]) {
				$table2_exist = true;
			}
			if($table1_exist && $table2_exist) break;
		}
		if(!$table1_exist) {
			$dbqry="
				CREATE TABLE `{$db_table_prefix}count_stat` (
				`num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`today_count` INT NOT NULL ,
				`yesterday_count` INT NOT NULL ,
				`total_count` INT NOT NULL ,
				`max_conn_count` INT NOT NULL ,
				`max_count` INT NOT NULL ,
				`today_date` DATE NOT NULL ,
				`ip` VARCHAR( 20 ) NOT NULL 
				) COMMENT = '������̺�'
			";
			$rs=query($dbqry,$dbcon);
		}
		if(!$table2_exist) {
			$dbqry="
				CREATE TABLE `{$db_table_prefix}count_ip` (
					`num` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`ip` VARCHAR( 20 ) NOT NULL ,
					`count_date` DATE NOT NULL ,
					INDEX ( `ip` , `count_date` ) 
				) COMMENT = '��� ������ üũ'
			";
			$rs=query($dbqry,$dbcon);
		}
		rg_href("/","����� ��� ���̺��� �����Ͽ����ϴ�.");
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
              ����� ������̺��� �����մϴ�.<br>
							</td>
          </tr>
        </table>
        <br>
        <input type="submit" value="����">
        <a href="javascript:history.back()">���</a> 
      </form></td>
  </tr>
</table>
<? include("../admin/admin.footer.php"); ?>