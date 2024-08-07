<?php
include_once('./_common.php');
$sql="select * from mart_member_new";
$result=sql_query($sql);
while($row=sql_fetch_array($result)){
    $mb_zip1=substr($row[zip],0,3);
	$mb_zip2=str_replace("-","",substr($row[zip],3,strlen($row[zip])));
    $sql="select password('0000') as mb_password";
    $row2=sql_fetch($sql);
    $mb_password=$row2[mb_password];
	$mb_datetime = date("Y-m-d H:i:s",strtotime($row['date']));
	$bonus_sql = "select sum(bonus) as  bonus_total from bonus where id='$row[username]'";
	$bonus_res = sql_query($bonus_sql);
	$bonus_row = sql_fetch_array( $bonus_res);
	print_r($bonus_row);
   /* $sql="insert g5_member set
            mb_id='$row[username]',
            mb_name='$row[name]',
            mb_email='$row[email]',
            mb_tel='$row[tel]',
            mb_hp='$row[tel2]',
            mb_zip1='$mb_zip1',
            mb_zip2='$mb_zip2',
            mb_addr1='$row[address]',
            mb_addr2='$row[address_d]',
            mb_password='$mb_password',
			mb_datetime='$mb_datetime',
            mb_level='2'
    ";
    sql_query($sql);*/
	insert_point($row['username'], $bonus_row[bonus_total], '포인트', '@member', $row[username], '포인트이전');
}
?>