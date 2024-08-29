<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='./login.html';
		</script>
	");
	exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<title><?=$admin_title?></title>
<script language="javascript" src="./js/common.js"></script>
<link href="./css/style.css" rel="stylesheet" type="text/css">
</head>