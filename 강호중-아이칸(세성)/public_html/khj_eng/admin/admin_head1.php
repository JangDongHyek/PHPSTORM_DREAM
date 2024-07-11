<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
ini_set("session.cache_expire", 86400);  // 세션 유휴시간 24시간
ini_set("session.gc_maxlifetime", 86400);  // 역시 24시간
session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", ".wickhan.com");
if( !$MemberLevel ){
	echo("
		<script>
		parent.location.href='../login.html';
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
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>