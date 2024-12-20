<?php
include_once('./_common.php');
header('Content-Type: text/html; charset=utf-8');
$messageArr=array("wr_9"=>"주차라인이","wr_11"=>"상태가","wr_12"=>"키보관여부가","wr_13"=>"확인전화");
$sql="update g5_write_b_reserv set $field='$val' where wr_id='$wr_id'";
sql_query($sql);
$sql="select * from g5_write_b_reserv where wr_id='$wr_id'";
$row=sql_fetch($sql);
extract($row);
/*
if($field=="wr_11"&&$val=="예약완료"){
	$wr_1=str_replace("-","/",substr($wr_1,5,strlen($wr_1)));
	$wr_2=str_replace("-","/",substr($wr_2,5,strlen($wr_2)));
	$msg=$wr_subject."\n".$wr_name."\n".$wr_1."\n".$wr_2;
	goSms($wr_3,"0519733888",$msg);
	
	$wr_1=str_replace("-","/",substr($wr_1,5,strlen($wr_1)));
	$wr_2=str_replace("-","/",substr($wr_2,5,strlen($wr_2)));
	$msg=$wr_subject."찾아오시는 길\n"."https://bit.ly/30hqQsK";
	goSms($wr_3,"0519733888",$msg);
}*/


?>
