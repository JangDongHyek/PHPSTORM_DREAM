<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";

$sql = "update mart_member_new set password=old_password('$password') where username='$username'";
if(mysql_query($sql,$dbconn)){
	echo "<script>
	alert('비밀번호가 변경되었습니다!');
	location.href='./idfind.html';
	</script>";
	exit;
}else{
	echo "<script>
	alert('비밀번호 변경에 실패하였습니다!');
	location.href='./idfind.html';
	</script>";
	exit;
}
?>