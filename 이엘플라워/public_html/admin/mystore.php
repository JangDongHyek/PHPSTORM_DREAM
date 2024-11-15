<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../connect.php";
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="./js/common.js"></script>
<meta http-equiv='refresh' content='0; URL=<?=$home_dir?>/?mart_id=<?=$Mall_Admin_ID?>'>
<!--<meta http-equiv='refresh' content='0; URL=<?=$home_dir?>/<?=$Mall_Admin_ID?>'>-->
</head>
</body>
</html>
<?
mysql_close($dbconn);
?>