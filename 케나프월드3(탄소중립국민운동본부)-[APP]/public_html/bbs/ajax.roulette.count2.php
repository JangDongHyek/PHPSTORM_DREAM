<?php 
include_once("./_common.php");
$sql="select * from g5_roulette_config";
$row2=sql_fetch($sql);
$sql="select ro_no  from g5_roulette order by idx desc";
$row=sql_fetch($sql);
$ro_no=$row[mx]+1;
if($row2[roulette1]<=$row[ro_no]){
	$ro_no=1;
}else{
	$ro_no=$row[ro_no]+1;
}
$sql="insert g5_roulette set 
			ro_no='$ro_no',
			mb_id='$member[mb_id]',
			ro_rank='$ro_rank',
			regdate='".time()."'";
sql_query($sql);
$idx=sql_insert_id();
insert_point_l($member['mb_id'], "-1000", "룰렛게임", '@game', $member['mb_id'], $member['mb_id']."_".G5_TIME_YMDHIS);

$jsonArray=array();
$jsonArray['idx']=$idx;
$jsonArray['ro_no']=$ro_no;
echo json_encode($jsonArray);
?>