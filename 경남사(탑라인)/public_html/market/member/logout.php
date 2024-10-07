<?
//========================== 세션 시작 ========================================
session_start();
global $HTTP_COOKIE_VARS;

$UnameSess = "";
$MemberLevel = "";
$MemberName = "";
$MemberEmail = "";
$NonMemberName = "";
$NonMemberPassport1 = "";
$NonMemberPassport2 = "";
//session_unregister("UnameSess");
//session_unregister("MemberLevel");
//session_unregister("MemberName");
//session_unregister("MemberEmail");
unset($_SESSION["UnameSess"]);
unset($_SESSION["MemberLevel"]);
unset($_SESSION["MemberName"]);
unset($_SESSION["MemberEmail"]);
unset($_SESSION["Membertype"]);
unset($_SESSION["Mall_Admin_ID"]);
unset($_SESSION["NonMemberName"]);
unset($_SESSION["NonMemberPassport1"]);
unset($_SESSION["NonMemberPassport2"]);

unset($_SESSION);

//session_destroy();

//setcookie("member_id","",0,"/");

echo "
	<script>
	//window.alert('안녕히가세요!');
	parent.location.href='logoutM.php';

	</script>
";
?>