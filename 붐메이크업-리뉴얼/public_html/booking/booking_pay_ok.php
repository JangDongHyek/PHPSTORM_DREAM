<?
   $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");

	//$newDb = new MysqlConnect;
?>
<html>
<body>
<form name="frmResult" method="post">
<?
	if($flag == "Y") {
		$sql = "SELECT * FROM TB_BOOKING WHERE NO=$no";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		if($row) {
			$sql = "UPDATE TB_BOOKING SET PAYBANK='$paybank', PAYDATE='$paydate', PAYNAME='$payname', PAYAMT='$payamt', STATUS='3' WHERE NO=$no";
            mysql_query($sql);
			/*$newDb->exeSql($sql);
			$newDb->dbClose();*/
			alert("�Ա�Ȯ�� ��û�Ͽ����ϴ�.");
		} else {
			alert("��ϵ��� ���� �����ڷ��Դϴ�.");
		}
	}
	
?>
</form>
</body>
</html>