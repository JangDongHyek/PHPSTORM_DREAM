<?
/*
���� ��� ����Ÿ���̽� ���̺� �������α׷� 

������
admin ���丮 �ȿ� �ø�����
������/admin/drop_all_tables.php �Ͻ���
Ȯ�δ����ø� �˴ϴ�.
*/
	
	$site_path = '../';
	include($site_path."include/config.inc.php"); 
	include($site_path."include/mysql.inc.php"); 
	include($site_path."include/func.inc.php"); 
	
	if($act) {

		if(!$mysql_host || !$mysql_user || !$mysql_password || !$mysql_database_name) {
			rg_href('','mysql������ �������� �Է����ּ���.','','back');
		}
		$dbcon=@mysql_connect($mysql_host, $mysql_user, $mysql_password);
		if(!$dbcon) {
			echo "����Ÿ���̽� ������ �����Ҽ� �����ϴ�.<br>
	ȣ��Ʈ,����ھ��̵�,��ȣ�� Ȯ�����ּ���.<br>
	���� : ".mysql_error();
			exit;
		}
		if(!@mysql_select_db($mysql_database_name,$dbcon)) {
				echo "����Ÿ���̽��� ���� �Ҽ� �����ϴ�.<br>
	����Ÿ���̽����� Ȯ���ϼ���.<br>			
	���� : ".mysql_error();
				exit;
		}
		
		// ���̺� ����

		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		while($tmp = mysql_fetch_array($rs)) {
			query("drop table `$tmp[0]` ",$dbcon);
		}
		rg_delete_board_file($site_path.$data_dir);
		rg_href("/","����Ÿ���̽� ���̺��� ���� �����Ͽ����ϴ�.");
	}

?>
<? include("../admin/admin.header.php"); ?>
<form name="form1" method="post" action="">
  <input name="act" type="hidden" value="ok">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center">����Ÿ���̽��� ��� ���̺��� �����մϴ�.<br>
        <font color="#FF0000">�����ϰ� �������ֽñ� �ٶ��ϴ�.</font><br>
        <br>
        MYSQL ������ �Է��ϼ���.</td>
    </tr>
  </table>
  <br>
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="right">Host Name :&nbsp;</td>
      <td><input name="mysql_host" type="text" id="mysql_host" value="localhost" required itemname="Host Name">
        mysql ȣ��Ʈ ��</td>
    </tr>
    <tr> 
      <td width="150" align="right">User ID :&nbsp;</td>
      <td><input name="mysql_user" type="text" id="mysql_user" required itemname="User ID">
        mysql ���� ����ڸ�</td>
    </tr>
    <tr> 
      <td align="right">User Password :&nbsp;</td>
      <td><input name="mysql_password" type="password" id="mysql_password" required itemname="User Password">
        mysql ����� ��ȣ</td>
    </tr>
    <tr> 
      <td align="right">DB Name :&nbsp;</td>
      <td><input name="mysql_database_name" type="text" id="mysql_database_name" required itemname="DB Name">
        mysql ��뵥��Ÿ���̽���</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div align="center"> 
    <input name="submit" type="submit" value=" Ȯ �� ">
  </div>
</form>
<? include("../admin/admin.footer.php"); ?>