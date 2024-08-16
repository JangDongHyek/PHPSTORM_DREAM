<?
// 회원정보 수정시 비밀번호 변경
// 비밀번호 동일한지 체크
include_once('./_common.php');

$chk_pass = $_POST['pass'];

if ($member['mb_password'] == get_encrypt_string($chk_pass)) {
	echo "T";
} else {
	echo "F";
}

?>