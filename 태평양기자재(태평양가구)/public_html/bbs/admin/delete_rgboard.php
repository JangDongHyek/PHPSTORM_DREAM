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
			if(eregi("^($db_table_prefix)",$tmp[0])) {
				query("drop table $tmp[0] ",$dbcon);
			}
		}
		rg_delete_board_file($site_path.$data_dir);
		rg_href("/","����Ÿ���̽� ���̺��� ���� �����Ͽ����ϴ�.");
	}

?>
<? include("../admin/admin.header.php"); ?>
<form name="form1" method="post" action="" onSubmit="if(!confirm('������ ������ �ٽ� �츱�� �����ϴ�.\nȮ���մϱ�?')) return false;">
  <input name="act" type="hidden" value="ok">
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr>
      <td width="124" align="center"><a href="./"><img src="images/main_1.gif" border="0"></a></td>
      <td align="center">����Ͻô� ���� ����Ÿ���̽���<br> ������̺��� �����մϴ�.<br>
        <font color="#FF0000">��� ������ �����Ǵ� �����ϰ�<br> �������ֽñ� �ٶ��ϴ�.</font><br>
      </td>
    </tr>
  </table>
  <br>
  <br>
  <table width="500" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#E1E1E1">
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">Host Name :&nbsp;</td>
      <td><input name="mysql_host" type="text" id="mysql_host" value="localhost" required itemname="Host Name"> 
        <font color="#FF0000">mysql ȣ��Ʈ ��</font></td>
    </tr>
    <tr> 
      <td width="150" height="24" align="right" bgcolor="#F7F7F7">User ID :&nbsp;</td>
      <td><input name="mysql_user" type="text" id="mysql_user" required itemname="User ID"> 
        <font color="#FF0000">mysql ���� ����ڸ�</font></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">User Password :&nbsp;</td>
      <td><input name="mysql_password" type="password" id="mysql_password" required itemname="User Password"> 
        <font color="#FF0000">mysql ����� ��ȣ</font></td>
    </tr>
    <tr> 
      <td height="24" align="right" bgcolor="#F7F7F7">DB Name :&nbsp;</td>
      <td><input name="mysql_database_name" type="text" id="mysql_database_name" required itemname="DB Name"> 
        <font color="#FF0000">mysql ��뵥��Ÿ���̽���</font></td>
    </tr>
  </table>
  <div align="center"> <br>
    <br>
    <input name="submit" type="submit" class="button1" value="  Ȯ  ��  ">
  </div>
</form>
<? include("../admin/admin.footer.php"); ?>