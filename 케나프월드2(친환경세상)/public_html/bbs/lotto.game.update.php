<?
include_once("./_common.php");
/*
$saturday=date("w");
$secTime=date("His");*/
$saturday=date("w",strtotime(date("Y-m-d")));
$secTime=date("His",strtotime(date("H:i:s")));
if(date("Y-m-d")==$lastSaturday){
	if(185959<intval($secTime)&&intval($secTime)<=235959){
		alert("이번주 로또 응모시간이 지났습니다. 일요일 정오부터 응모가 가능합니다.");
		exit;
	}
}
$point=1000*count($lotto_num_txt);
if($member[mb_point_l]<=0){
	alert("L포인트가 부족합니다. 충전 후 사용하십시오",G5_BBS_URL."/mywallet.php");
	exit;
}
if($member[mb_point_l]<$point){
	alert("L포인트가 부족합니다. 충전 후 사용하십시오",G5_BBS_URL."/mywallet.php");
	exit;
}
for($i=0;$i<count($lotto_num_txt);$i++){
	$sql="insert g5_lotto set 
				mb_id='$member[mb_id]',
				lotto_num='$lotto_num_txt[$i]',
				turn='$currentTurn',
				regdate='".time()."'";
	sql_query($sql);
}

$point="-".$point;
insert_point_l($member['mb_id'], $point, "복권 ".count($lotto_num_txt)."장 응모", '@game', $member['mb_id'], $member['mb_id']."_".G5_TIME_YMDHIS);
alert("로또에 응모하였습니다.",G5_BBS_URL."/lotto.game.php");
?>