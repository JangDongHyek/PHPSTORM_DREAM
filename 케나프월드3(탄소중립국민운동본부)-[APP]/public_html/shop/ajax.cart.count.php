<?php
include_once('./_common.php');
$sql="select count(*) as cnt from g5_shop_cart where mb_id='$member[mb_id]' and ct_select='0' and ct_direct='0'";
$row=sql_fetch($sql);
if(0<$row[cnt]){
	echo $row[cnt];
}else{
	echo "";
}
?>