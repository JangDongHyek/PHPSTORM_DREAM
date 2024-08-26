<?
//========================== 세션 시작 ========================================
session_start();
global $HTTP_COOKIE_VARS;

$_SESSION["NonMemberName"] = "";
$_SESSION["NonMemberPassport1"] = "";
$_SESSION["NonMemberPassport2"] = "";

unset($_SESSION["NonMemberName"]);
unset($_SESSION["NonMemberPassport1"]);
unset($_SESSION["NonMemberPassport2"]);

//session_destroy();

//setcookie("member_id","",0,"/");

echo "
	<script>
	window.alert('안녕히가세요!');
	parent.location.href='../../.';
	</script>
";
?>