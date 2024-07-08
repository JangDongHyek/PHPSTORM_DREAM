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
	
		$ref = $row[REF];
		$levelno = $row[LEVELNO];
		$sortno = $row[SORTNO];

		$sql = "SELECT * FROM TB_BOOKING WHERE REF=$ref AND LEVELNO=" . ($levelno + 1);
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
	
		if($row) {
			//$newDb->dbClose();
			echo "<script>";
			echo "alert('답변이 있는 글은 삭제할 수 없습니다.');";
			echo "</script>";
		} else {
			$sql = "DELETE FROM TB_BOOKING WHERE NO=$no";
			mysql_query($sql);
		echo "<script language=javascript>";
		echo "parent.location.href='booking_list.php?page=$page';";
		echo "</script>";
			//$newDb->ExeSqlGoUrlParent($sql, "삭제되었습니다", "booking_list.php?page=$page");
			//$newDb->dbClose();
		}
	}
	
?>
</form>
</body>
</html>