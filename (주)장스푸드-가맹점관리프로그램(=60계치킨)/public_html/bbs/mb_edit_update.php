<?php
include_once('./_common.php');

if(!$is_member){
	alert('로그인을 해주세요',G5_URL);
	exit;
}

if($mb_password != ''){
	$mb_password_qry = ", mb_password = '".get_encrypt_string($mb_password)."' ";
}

$sql = " update {$g5['member_table']} set 
mb_hp = '{$_POST['mb_hp']}'
{$mb_password_qry}
where mb_id='{$member['mb_id']}' ";
sql_query($sql);

alert('정보수정이 완료되었습니다!', G5_URL);
?>
