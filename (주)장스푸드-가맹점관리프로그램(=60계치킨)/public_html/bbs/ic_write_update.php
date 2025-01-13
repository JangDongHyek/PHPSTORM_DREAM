<?php
include_once('./_common.php');

if(!$is_admin && $member['mb_level'] < 3){
	alert('관리자 또는 임직원으로 로그인해주세요',G5_URL);
	exit;
}

if($w == ''){
	$sql = " insert into g5_write_inquiry_cate set 
	ic_bo_table = 'inquiry',
	ic_ca_name = '{$_POST['ic_ca_name']}',
	ic_mb_id = '{$_POST['ic_mb_id']}',
	ic_use = '{$_POST['ic_use']}' 
	";
	sql_query($sql);
}else{
	$sql = " update g5_write_inquiry_cate set 
	ic_bo_table = 'inquiry',
	ic_ca_name = '{$_POST['ic_ca_name']}',
	ic_mb_id = '{$_POST['ic_mb_id']}',
	ic_use = '{$_POST['ic_use']}' 
	where ic_idx='{$_POST['ic_idx']}'
	";
	sql_query($sql);
}

goto_url(G5_BBS_URL.'/ic_list.php');
?>
