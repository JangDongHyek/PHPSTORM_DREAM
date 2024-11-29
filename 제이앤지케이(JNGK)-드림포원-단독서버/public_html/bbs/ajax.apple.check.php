<?php
	include_once("./_common.php");
	$sql="select * from g5_member where mb_id='$_POST[mb_id]'";
	$row=sql_fetch($sql);
	$jsonArray=array();
	if($row[mb_id]){
		$jsonArray["success"]="true";
		$jsonArray["login"]="ok";
	}else{
		 $sql = " insert into {$g5['member_table']}
                set mb_id = '{$_POST[mb_id]}',
                     mb_password = '".get_encrypt_string('12345')."',
                     mb_name = '익명',
                     mb_nick = '',
                     mb_nick_date = '',
                     mb_email = '{$_POST[mb_id]}',
					 mb_level='2'
                     ";
		sql_query($sql);
	}
	$jsonArry['sql']=$sql;
	$jsonArray["success"]="true";
	$jsonArray["login"]="ok";
	$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
	echo $output;
?>