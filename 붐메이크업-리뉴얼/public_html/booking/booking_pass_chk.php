<?
	session_start();
	
	   $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");


	//$newDb = new MysqlConnect;
?>
<html>
<body>
<?
	$sql = "SELECT * FROM TB_BOOKING WHERE NO = $no";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	//�亯���̸� �θ���� �۹�ȣ�� ��й�ȣ�� üũ�Ѵ�.
	if($row[LEVELNO] > 0) {
		$sql = "SELECT * FROM TB_BOOKING WHERE NO = $row[REF] ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
	}

	if($row[PASSWD] == $passwd) {
		$_SESSION["booking_passwd"] = $passwd; //���Ǽ���
?>
	<script language="javascript">
		parent.opener.parent.location.href="booking_view.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>&no=<?=$no?>";
		parent.self.close();
	</script>
	
<?
	} else {
?>
	<script language="javascript">
		alert("��й�ȣ�� ��ġ���� �ʽ��ϴ�.");
		parent.document.frmChk.passwd.focus();
	</script>
<?
	}
?>
</body>
</html>