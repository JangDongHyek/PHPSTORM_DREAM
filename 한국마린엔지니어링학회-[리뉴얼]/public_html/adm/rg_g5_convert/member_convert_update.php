<?php
$sub_menu = "910100";

include_once('./_common.php');
$sql="select * from rg_member where mb_level!='10'";

$result=sql_query($sql);
while($row=sql_fetch_array($result)){
	$sql_common="mb_id='$row[mb_id]',
				mb_nick='$row[mb_nick]',
				mb_name='$row[mb_name]',
				mb_email='$row[mb_email]',
				mb_homepage='$row[mb_homepage]',
				mb_tel='$row[mb_tel]',
				mb_hp='$row[mb_hp]',
				mb_birth='$row[mb_birth]',
				mb_zip1='$row[mb_post]',
				mb_addr1='$row[mb_address1]',
				mb_addr2='$row[mb_address2]',
				mb_sex='$row[mb_sex]',
				mb_password=password('1050')";
	$sql="insert g5_member set $sql_common";
	sql_query($sql);


}
?>