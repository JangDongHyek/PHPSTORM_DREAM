<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
if( !$UnameSess){
	echo "
		<script>
		alert('�α����� �ϼž� �մϴ�.');
		opener.location.href='../member/login.html?url=$url'
		self.close();
		</script>
	";
	exit;
}

	$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$row = mysql_fetch_array($dbresult);
		$bookmark_bonus_ok = $row["bookmark_bonus_ok"];
		$init_bookmark_bonus = $row["init_bookmark_bonus"];
	}

	if($bookmark_bonus_ok == "t" && $init_bookmark_bonus > 0){ //������ ����Ҷ��� ����
		$SQL = "select * from $BonusTable where mart_id ='$mart_id' and id='$UnameSess' and mode='b'";
		$dbresult = mysql_query($SQL, $dbconn);
		if(mysql_num_rows($dbresult)>0){
			echo "
			<script>
			alert('�̹� ���� �Ǿ����ϴ�.');
			opener.location.href='../mypage/index.html';
			self.close();
			</script>
			";
			exit;
		}
		
		$write_date = date("Ymd H:i:s");
		$content = "���ã�� �߰� ������"; 
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) ".
		"values ('$mart_id', '$UnameSess', '$write_date', '$init_bookmark_bonus', '$content', 'b')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $init_bookmark_bonus 
		where username='$username' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}

	echo "
		<script>
		window.external.AddFavorite('http://www.multiall.co.kr', opener.document.title);
		alert('�����Ǿ����ϴ�.\\n\\n�������������� Ȯ�� �Ͻ� �� �ֽ��ϴ�.');
		opener.location.href='../mypage/index.html';
		self.close();
		</script>
	";
?>