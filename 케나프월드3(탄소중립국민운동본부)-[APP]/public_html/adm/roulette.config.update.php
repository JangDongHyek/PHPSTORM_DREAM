<?php
include_once("./_common.php");
$sql="select * from g5_roulette_config";
$result=sql_query($sql);
$cnt=sql_num_rows($result);
if(!$cnt){
	$queryType="insert";
}else{
	$queryType="update";
}
$sql="$queryType g5_roulette_config set
				roulette1='$roulette1',
				roulette2='$roulette2',
				roulette3='$roulette3',
				roulette4='$roulette4',
				roulette5='$roulette5',
				roulette1point='$roulette1point',
				roulette2point='$roulette2point',
				roulette3point='$roulette3point',
				roulette4point='$roulette4point',
				roulette5point='$roulette5point'
			";
sql_query($sql);
if($queryType=="update"){
	$sql="insert g5_roulette set 
				ro_no='0',
				mb_id='$member[mb_id]',
				ro_rank='99',
				regdate='".time()."'";
	sql_query($sql);
}

goto_url("./roulette.config.php");
?>