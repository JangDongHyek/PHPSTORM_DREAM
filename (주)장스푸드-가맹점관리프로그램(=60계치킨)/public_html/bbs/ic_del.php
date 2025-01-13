<?php
include_once('./_common.php');

if(!$is_admin && $member['mb_level'] < 3){
	alert('관리자 또는 임직원으로 로그인해주세요',G5_URL);
	exit;
}

$sql = " delete from g5_write_inquiry_cate where ic_idx='{$ic_idx}' ";
sql_query($sql);

goto_url(G5_BBS_URL.'/ic_list.php');
?>
