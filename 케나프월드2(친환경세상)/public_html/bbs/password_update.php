<?php
include_once('./_common.php');

$mb_password = get_encrypt_string($mb_password);

$sql = " update {$g5['member_table']}
		set mb_password = '{$mb_password}'
		where mb_id = '$mb_id' ";
$result = sql_query($sql);

if($result == false) {
	echo "<script>alert('페이지에 오류가 발생하였습니다. 다시 시도해 주세요.'); history.back();</script>";
} else {
	alert('비밀번호가 변경되었습니다.', G5_URL);
}
?>