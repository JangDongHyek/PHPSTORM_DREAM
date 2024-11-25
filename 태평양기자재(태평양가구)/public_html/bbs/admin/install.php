<?
	$site_path = '../';
	include($site_path."include/config.inc.php"); 
	include($site_path."include/mysql.inc.php"); 
	include($site_path."include/func.inc.php"); 
	include($site_path."include/schema.inc.php"); 
	clearstatcache();

	if (file_exists($site_path.$data_dir."db.inc.php")) { // �̹� ��ġ�Ǿ� ����
		$msg="
�̹� db.inc.php ������ �ֽ��ϴ�.<br>
�缳ġ �Ͻ÷��� �ش� ���ϰ� ����Ÿ���̽��� �ʱ�ȭ �Ͻ��� ���� �Ͻñ� �ٶ��ϴ�.";
		include("error.inc.php");
	}
	
	if(!is_dir($site_path.$data_dir)) {
		$msg="data ���丮�� ã���� �����ϴ�.<br>
Ȯ�����ּ���.";
		include("error.inc.php");
	}
	
	$data_chk_perms = @fileperms($site_path.$data_dir);
	$data_chk_perms=decoct($data_chk_perms);
	$data_chk_perms=substr($data_chk_perms,-1);

	$editor_data_chk_perms = @fileperms($site_path.$editor_data_dir);
	$editor_data_chk_perms=decoct($editor_data_chk_perms);
	$editor_data_chk_perms=substr($editor_data_chk_perms,-1);

	if($data_chk_perms!='7' || $editor_data_chk_perms != '7') {
		$msg="
editor/upload/ <br>
data <br>
���丮�� ������ 707�Ǵ� 777���� �������ֽñ� �ٶ��ϴ�.<br>
�������� ftp �� �̿��ϼ��� ��� ���� ������ Owner(������) �� Group(�׷�), Other(�������) �� ������ �б�,����,������ �����ϵ��� üũ�ؽð�, <br>
telnet �Ǵ� SSH�� �̿��Ͻǰ�� ��ɾ� chmod 707 data �� �����ϽǼ��� �ֽ��ϴ�.<br><br>
�����ϼ����� Ȯ�� ��ư�� �����ּ���.<br>
<input type=\"button\" onclick=\"location.reload()\" value=\" Ȯ �� \">
";
		include("error.inc.php");
	}
	
	if($HTTP_POST_VARS['act']) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
	
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
		
		$dbqry="
			SHOW TABLES
		";
		$rs=query($dbqry,$dbcon);
		unset($chk);
		$chk[] = $db_table_member;
		$chk[] = $db_table_site_cfg;
		$chk[] = $db_table_group_cfg;
		$chk[] = $db_table_group_member;
		$chk[] = $db_table_bbs_cfg;
		$chk[] = $db_table_zip;
		$chk[] = $db_table_connect;
		$chk[] = $db_table_memo;
		while($tmp = mysql_fetch_array($rs)) {
			if(in_array($tmp[0],$chk)) {
				rg_href('delete_rgboard.php','����Ÿ���̽��� �̹� ���̺��� �ֽ��ϴ�.\n�缳ġ �Ͻ÷��� ������� ���̺��� ��� �������ֽ��� �������ּ���.');		
			}
		}
		
		$fp = fopen($site_path.$data_dir."db.inc.php", "wb");
		if(!$fp) {
			$msg="
����Ÿ���̽� ������ �����Ҽ� �����ϴ�.<br>
���������ڿ��� �������ּ���.<br>
";
			include("error.inc.php");
		}
		$dbcfg="<"."?
echo \"<script>alert('�߸��� �����Դϴ�.(����� ...)');location='http://lets080.com'</script>\";exit;
/*
$mysql_host
$mysql_user
$mysql_password
$mysql_database_name
*/
?".">		
";
		if(!fputs($fp, $dbcfg)) {
			$msg="
����Ÿ���̽� ������ �����Ҽ� �����ϴ�.<br>
���������ڿ��� �������ּ���.<br>
";
			include("error.inc.php");
		}
		fclose($fp);

		// �Խ��Ǽ������̺� ����
		$dbqry = "
				CREATE TABLE `$db_table_bbs_cfg`
				$mysql_schema_bbs_cfg
			";
		query($dbqry,$dbcon);
			// �׷켳��
		$dbqry = "
				CREATE TABLE `$db_table_group_cfg`
				$mysql_schema_group_cfg
			";
		query($dbqry,$dbcon);
		// �׷�ȸ������
		$dbqry = "
				CREATE TABLE `$db_table_group_member`
				$mysql_schema_group_member
			";
		query($dbqry,$dbcon);
	
		// ȸ������
		$dbqry = "
				CREATE TABLE `$db_table_member`
				$mysql_schema_member
			";
		query($dbqry,$dbcon);
	
		// �⺻����Ʈ����
		$dbqry = "
				CREATE TABLE `$db_table_site_cfg`
				$mysql_schema_site_cfg
			";
		query($dbqry,$dbcon);

		// ����������
		$dbqry = "
				CREATE TABLE `$db_table_connect`
				$mysql_schema_connect
			";
		query($dbqry,$dbcon);

		// ����
		$dbqry = "
				CREATE TABLE `$db_table_memo`
				$mysql_schema_memo
			";
		query($dbqry,$dbcon);
		
		// �������
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}count_stat`
				$mysql_schema_count_stat
			";
		query($dbqry,$dbcon);
		
		// ������� �����Ǹ��
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}count_ip`
				$mysql_schema_count_ip
			";
		query($dbqry,$dbcon);

		// ��ǥ����
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_cfg`
				$mysql_schema_vote_cfg
			";
		query($dbqry,$dbcon);

		// ��ǥ �ڸ�Ʈ
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_cmt`
				$mysql_schema_vote_cmt
			";
		query($dbqry,$dbcon);
	
		// ��ǥ ������ 
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_ip`
				$mysql_schema_vote_ip
			";
		query($dbqry,$dbcon);

	 	//��ǥ �׸� 
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}vote_item`
				$mysql_schema_vote_item
			";
		query($dbqry,$dbcon);

		// ī���� ������/os ���̺�
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_browser`
				$mysql_schema_counter_browser
			";
		query($dbqry,$dbcon);

		// ī���� ������ ���̺�
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_ip`
				$mysql_schema_counter_ip
			";
		query($dbqry,$dbcon);

		// ī���� �α� ���̺�
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_log`
				$mysql_schema_counter_log
			";
		query($dbqry,$dbcon);

		// ī���� ������ ���̺�
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_page`
				$mysql_schema_counter_page
			";
		query($dbqry,$dbcon);

		// ī���� ���۷� ���̺�
		$dbqry = "
				CREATE TABLE `{$db_table_prefix}counter_ref`
				$mysql_schema_counter_ref
			";
		query($dbqry,$dbcon);
		
		// �⺻����Ÿ �߰�.
		for($i=0;$i<count($mysql_site_data);$i++) {
			$dbqry = "
				INSERT INTO `{$db_table_site_cfg}`
				VALUES 
				$mysql_site_data[$i]
			";
			query($dbqry,$dbcon);
		}
		for($i=0;$i<count($mysql_group_data);$i++) {
			$dbqry = "
				INSERT INTO `{$db_table_group_cfg}`
				VALUES 
				$mysql_group_data[$i]
			";
			query($dbqry,$dbcon);
		}

		// �⺻ ����Ÿ���丮 ����
		if(!is_dir($site_path.$data_dir.$member_icon_dir))
		{
			@mkdir($site_path.$data_dir.$member_icon_dir,0707);
			@chmod($site_path.$data_dir.$member_icon_dir,0707);
		}

		if(!is_dir($site_path.$data_dir.$member_photo_dir))
		{
			@mkdir($site_path.$data_dir.$member_photo_dir,0707);
			@chmod($site_path.$data_dir.$member_photo_dir,0707);
		}

		if(!is_dir($site_path.$data_dir.$session_tmp_dir))
		{
			@mkdir($site_path.$data_dir.$session_tmp_dir,0707);
			@chmod($site_path.$data_dir.$session_tmp_dir,0707);
		}

		rg_href('install_1.php');
		exit;
	}
?>
<? include("admin.header.php"); ?>
<form name="form1" method="post" action="">
<input name="act" type="hidden" value="ok">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center" width="500">���� ��ġ ȯ���Դϴ�.<br> MySql ������ ��Ȯ�� �Է��Ͽ� �ֽʽÿ�.</td>
    </tr>
  </table>
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
  <br>
  <div align="center">
    <input type="submit" class="button1" value=" Ȯ  �� ">
  </div>
</form>
<?
	include("admin.footer.php");
?>