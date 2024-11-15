<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
/*
if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}*/
?>
<?
/*	
$_PID // 상품코드
$_SHOPID // 소호몰 ID
$use // 0:사용안함, 1:사용함
*/
// 상품정보 수정 DB에 저장하는 루틴 삽입 //
$SQL = "update $ItemTable set use_coupon='$use' where item_no = '$_PID'";

$dbresult = mysql_query($SQL, $dbconn);
mysql_close($dbconn);
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
쿠폰사용(수정)이 완료되었습니다.
</body>
</html>