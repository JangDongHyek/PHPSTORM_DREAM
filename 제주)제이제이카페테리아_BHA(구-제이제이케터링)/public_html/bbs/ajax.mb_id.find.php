<?php
include_once('./_common.php');

$mb_val=str_replace("-","",$mb_val);
$sql="select * from g5_member where mb_name='$mb_name' and replace($field,'-','')='$mb_val'";
$row=sql_fetch($sql);
if($row[mb_id]){
	$length=strlen($row[mb_id])-4;
	$firstId=substr($row[mb_id],0,4);
	$starTxt="";
	for($i=0;$i<$length;$i++){
		$starTxt.="*";
	}
	$mb_id=$firstId.$starTxt;
	echo "회원님의 아이디는 <font color='blue' style='font-size:15px;font-weight:bold'>".$mb_id."</font> 입니다.";
}else{
	echo "해당정보가 없거나 또는 잘못 정보를 입력하셨습니다.";
}

?>