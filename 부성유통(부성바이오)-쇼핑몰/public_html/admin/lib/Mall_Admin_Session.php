<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

/*if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}*/

if( !$MemberLevel || ($MemberLevel > 2) ){
	act_href("../login.html","","top","",$charset='euc-kr');
	//header("location:./login.html");
	exit;
}else{
	return true;
}
exit;
?>