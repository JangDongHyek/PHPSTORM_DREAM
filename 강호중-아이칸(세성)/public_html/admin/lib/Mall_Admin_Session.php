<?
//================== DB 설정 파일을 불러옴 ===============================================
include_once "../../connect.php";

/*if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}*/

if( !$_SESSION["MemberLevel"]  ){
	act_href("../login.html","","top","",$charset='euc-kr');
	//header("location:./login.html");
	exit;
}else{
	return true;
}
exit;
?>