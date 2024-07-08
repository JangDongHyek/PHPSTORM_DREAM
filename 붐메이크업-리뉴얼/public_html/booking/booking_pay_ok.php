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
			alert("입금확인 요청하였습니다.");
		} else {
			alert("등록되지 않은 예약자료입니다.");
		}
	}
	
?>
</form>
</body>
</html>