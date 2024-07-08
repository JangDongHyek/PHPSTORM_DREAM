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
	if($flag == 'Y') {
		//insert 일때 새글 번호($no)와  sortno, levelno, ref를 설정한다.
		if($mode == "insert") {
			$sql = "SELECT MAX(NO) FROM TB_BOOKING";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
	
			if($row[0] == "") {
				$new_no = 1;
			} else {
				$new_no = $row[0] + 1;
			}
			

			$sql = "SELECT MAX(SORTNO) FROM TB_BOOKING";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			if($row[0] == "") $sortno = 1;
			else $sortno = $row[0] + 1;

			$no = $new_no;
			$levelno = 0;
			$ref = $new_no;
		}else if($mode == "reply"){

			$sql = "SELECT MAX(NO) FROM TB_BOOKING";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
	
			if($row[0] == "") {
				$new_no = 1;
			} else {
				$new_no = $row[0] + 1;
			}
			$no = $new_no;



			$sql = "UPDATE TB_BOOKING SET SORTNO = SORTNO + 1 WHERE SORTNO >= $sortno";
			mysql_query($sql);
			$levelno = $levelno + 1;
			$ref = $ref;
			$sortno = $sortno;
		}else if($mode == "update") {
			$sql = "SELECT PASSWD FROM TB_BOOKING WHERE NO = $no";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			if($_SESSION[ss_mb_level]!=10){
				if (!($passwd == $row[PASSWD])) {
					echo "<script>";
					echo "alert('비밀번호를 잘못 입력하셨습니다.');";
					echo "</script>";
				}
			}
		} else {
			echo "<script>";
				echo "alert('mode값이 없습니다');";
				echo "</script>";
			
		}
	
		//넘어온 데이타 체크
		$writer  = addslashes($writer);
		$subject = addslashes($HTTP_POST_VARS[subject]);
		$content = addslashes($content);
	
		if($notice_orderby1 == "y"){
			$sql_q = "select max(notice_orderby) from TB_BOOKING";
			$result_q = mysql_query($sql_q);
			$sql_result = mysql_result($result_q,0,0);	


			$notice_orderby_value = $sql_result + 2;
		}else{	
			$notice_orderby_value = "0";
		}

		if($mode == "insert" || $mode == "reply") {
			$tel = $tel1."-".$tel2."-".$tel3;
			$sql = "INSERT INTO TB_BOOKING (NO, WRITER, PASSWD, SUBJECT, EMAIL, TEL, BOOKDATE, BOOKTIME, CONTENT, STATUS, REF, LEVELNO, SORTNO, WDATE, notice_orderby) VALUES ($no, '$writer', '$passwd', '$subject', '$email', '$tel', '$bookdate', '$booktime', '$content', '1', $ref, $levelno, $sortno, '" . date("Y-m-d H:i:s") . "','$notice_orderby_value')";
		} else if($mode == "update") {
			if($no > "5962"){				
				$tel = $tel1."-".$tel2."-".$tel3;
			}

			$sql = "UPDATE TB_BOOKING SET writer='$writer', EMAIL='$email', TEL='$tel', BOOKDATE='$bookdate', BOOKTIME='$booktime', SUBJECT='$subject', CONTENT='$content' WHERE NO = $no";
		}
		mysql_query($sql);
		echo "<script language=javascript>";
		echo "parent.location.href='booking_list.php?page=$page';";
		echo "</script>";
		//$newDb->ExeSqlGoUrlParent($sql, "등록되었습니다", "booking_list.php?page=$page");
	}
?>
</form>
</body>
</html>
<? 
	//$newDb->dbClose();
?>