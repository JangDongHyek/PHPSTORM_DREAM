<?php
include_once('./_common.php');
$sql="select * from mart_member_new";
$result=sql_query($sql);
while($row=sql_fetch_array($result)){
    $zip=explode("-",$row[zip]);
    $sql="select password('1234') as mb_password";
    $row2=sql_fetch($sql);
    $mb_password=$row2[mb_password];
    $sql="insert g5_member set
            mb_id='$row[username]',
            mb_name='$row[name]',
            mb_email='$row[mb_email]',
            mb_tel='$row[tel]',
            mb_hp='$row[tel2]',
            mb_zip1='$zip[0]',
            mb_zip2='$zip[1]',
            mb_addr1='$row[address]',
            mb_addr2='$row[address_d]',
            mb_password='$mb_password',
            mb_level='2'
    ";
    echo $sql."<br>";
    
    //sql_query($sql);
}
?>