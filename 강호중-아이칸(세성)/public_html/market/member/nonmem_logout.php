<?
//========================== 세션 시작 ========================================
session_start();
global $HTTP_COOKIE_VARS;

$_SESSION["NonMemberName"] = "";
$_SESSION["NonMemberPass"] = "";

unset($_SESSION["NonMemberName"]);
unset($_SESSION["NonMemberPass"]);

//session_destroy();

//setcookie("member_id","",0,"/");

echo "
	<script>
	window.alert('안녕히가세요!');
	parent.location.href='../../.';
	</script>
";
?>