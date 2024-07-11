<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", ".wickhan.com");
session_start();
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
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes,target-densitydpi=medium-dpi"><title><?=$admin_title?></title>
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">
</head>