<?php 
include_once("./_common.php");
$sql="select * from g5_roulette_config";
$row2=sql_fetch($sql);
$sql="select ro_no from g5_roulette order by idx desc";
$row=sql_fetch($sql);
if($row[ro_no]==$row2[roulette1]){
	$ro_no=1;
}else{
	$ro_no=$row[ro_no]+1;
}

$sql="update g5_roulette set 
			ro_rank='$ro_rank'
			where idx='$idx'
			and mb_id='$member[mb_id]'";
sql_query($sql);

//insert_point_l($member['mb_id'], "-1000", "룰렛게임", '@game', $member['mb_id'], $member['mb_id']."_".G5_TIME_YMDHIS);

$savePoint=$row2['roulette'.$ro_rank.'point'];
if(0 < $ro_rank && $ro_rank < 99){
	insert_point_l($member['mb_id'], $savePoint, "룰렛게임".$ro_rank."등 당첨", '@game', $member['mb_id'], $member['mb_id']."_".G5_TIME_YMDHIS);
}
?>