<?
	session_start();
	

$id="confirm"; 
/*
$_zb_url = "http://www.pusanmakeup.com/bbs/"; //���κ��带 ��ġ�� �� ���
$_zb_path = "/home2/boom/public_html/bbs/"; //���κ��带 ��ġ�� ������(���κ��� ������ ���������� �� �� ����)
include $_zb_path."lib.php";
include $_zb_path."outlogin.php";

if(!$connect) $connect = dbconn();

if(!$member) $member = member_info();

	
*/
   $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");

	//$newDb = new MysqlConnect;
?>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<html>
<body>
<?
	$sql = "SELECT * FROM TB_BOOKING WHERE NO = $no";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if($row[notice_orderby] > 0){
		$open_ok = "y";
	}


	//�亯���̸� �θ���� ��й�ȣ�� üũ�Ѵ�.
	if($row[LEVELNO] > 0) {
		$sql = "SELECT * FROM TB_BOOKING WHERE NO = $row[REF] ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
	}

	$passwd = $row[PASSWD];

	if($passwd == $_SESSION["booking_passwd"] || $_SESSION[ss_mb_level] == 10 || $open_ok == 'y') {
?>
	<script language="javascript">parent.location.href="mobile_booking_view.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>&no=<?=$no?>";</script>
<?
	} else {
	include "./pass.php";
?>
	
<?
	}
?>
</body>
</html>