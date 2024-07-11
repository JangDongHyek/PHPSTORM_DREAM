<?
//========================== 세션 시작 ========================================
session_start();
global $HTTP_COOKIE_VARS;

$Mall_Admin_ID = "";
$MemberLevel = "";
$MemberName = "";
$MemberEmail = "";
$mart_id = "";
$MemberCountry= "";
$Admin_type= "";
$Admin_level= "";
$Admin_startdate= "";
$Admin_enddate= "";


unset($_SESSION["Mall_Admin_ID"]);
unset($_SESSION["MemberLevel"]);
unset($_SESSION["MemberName"]);
unset($_SESSION["MemberEmail"]);
unset($_SESSION["mart_id"]);
unset($_SESSION["MemberCountry"]);
unset($_SESSION["Admin_type"]);
unset($_SESSION["Admin_type"]);
unset($_SESSION["Admin_startdate"]);
unset($_SESSION["Admin_enddate"]);

unset($_SESSION);

session_destroy();

echo "
	<script>
	//window.alert('안녕히가세요!');
	parent.location.href='../admin/';
	</script>
";
?>