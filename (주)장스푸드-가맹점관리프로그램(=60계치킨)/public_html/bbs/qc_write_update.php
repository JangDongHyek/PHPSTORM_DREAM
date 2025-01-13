<?php
include_once('./_common.php');

if(!$is_admin && $member['mb_level'] < 3){
	alert('관리자 또는 임직원으로 로그인해주세요',G5_URL);
	exit;
}

if($w == ''){
	$sql = " insert into g5_write_question_cate set 
	qc_bo_table = 'question',
	qc_ca_name = '{$_POST['qc_ca_name']}',
	qc_use = '{$_POST['qc_use']}' 
	";
	sql_query($sql);
}else{
	$sql = " update g5_write_question_cate set 
	qc_bo_table = 'question',
	qc_ca_name = '{$_POST['qc_ca_name']}',
	qc_use = '{$_POST['qc_use']}' 
	where qc_idx='{$_POST['qc_idx']}'
	";
	sql_query($sql);
}

goto_url(G5_BBS_URL.'/qc_list.php');
?>
