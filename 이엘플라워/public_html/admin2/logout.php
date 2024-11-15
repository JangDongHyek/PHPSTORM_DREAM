<?
//========================== 세션 시작 ========================================
session_start();
global $HTTP_COOKIE_VARS;

$Mall_Admin_ID = "";
$MemberLevel = "";
$MemberName = "";
$MemberEmail = "";
$mart_id = "";

unset($_SESSION["Mall_Admin_ID"]);
unset($_SESSION["MemberLevel"]);
unset($_SESSION["MemberName"]);
unset($_SESSION["MemberEmail"]);
unset($_SESSION["mart_id"]);

unset($_SESSION);

session_destroy();

echo "
	<script>
	//window.alert('안녕히가세요!');
	parent.location.href='../admin/';
	</script>
";
?>