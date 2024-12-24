<?php
include_once("./_common.php");
if(count($lotto_num)){
	$lotto_num=implode(",",$lotto_num);
}

for($i=1;$i<6;$i++){
	$info=getimagesize(${rank.$i.ImgTxt});
	$ext="";
	switch($info['mime']){
		case "image/jpeg":
		case "image/jpg":
			$ext="jpg";
			break;
		case "image/png":
			$ext="png";
			break;
		case "image/gif":
			$ext="gif";
			break;
	}
	if(${rank.$i.ImgTxt}){
		${rank.$i.Img}=date("YmdHis").$i.".".$ext;
		$file = G5_DATA_PATH."/lotto/".${rank.$i.Img};
		$uri = substr(${rank.$i.ImgTxt},strpos(${rank.$i.ImgTxt}, ",") + 1);
		${add.$i.rank}=",rank{$i}Img='${rank.$i.Img}'";
		file_put_contents($file, base64_decode($uri));
	}else{
		${add.$i.rank}=",rank{$i}Img='${rank.$i.ImgLatest}'";
	}
}


$sql="select * from g5_lotto_config where turn='$whereCurrentTurn'";
$row=sql_fetch($sql);
if(!$row[idx]){

	$sql="insert g5_lotto_config set
			lotto_num='$lotto_num',
			turn='$whereCurrentTurn',
			rank1point='$rank1point',
			rank2point='$rank2point',
			rank3point='$rank3point',
			rank4point='$rank4point',
			rank5point='$rank5point'
			$add1rank
			$add2rank
			$add3rank
			$add4rank
			$add5rank
			";
	sql_query($sql);
}else{
	$sql="update g5_lotto_config set
			lotto_num='$lotto_num',
			rank1point='$rank1point',
			rank2point='$rank2point',
			rank3point='$rank3point',
			rank4point='$rank4point',
			rank5point='$rank5point'
			$add1rank
			$add2rank
			$add3rank
			$add4rank
			$add5rank
			where turn='$whereCurrentTurn'
			";
	sql_query($sql);

	$sql="update g5_lotto set rank='99' where turn='$whereCurrentTurn'";
	sql_query($sql);
}
//당첨 번호
$dangchum=explode(",",",".$lotto_num);
//등수
$rankArr=array("3"=>"5","4"=>"4","5"=>"3","5.5"=>"2","6"=>"1");

$sql="select * from g5_lotto where turn='$whereCurrentTurn'";
$result=sql_query($sql);
while($row=sql_fetch_array($result)){
	//사용자 추첨번호
	$userNum=explode(",",$row[lotto_num]);
	$i=0;
	for($j=0;$j<=count($userNum);$j++){
		if(array_search($userNum[$j],$dangchum)){
			if($dangchum[count($dangchum)-1]==$userNum[$j]){
				$i+=0.5;
			}else{
				$i++;
			}
		}
	}
	if($i==5.5){
		$i=strval($i);
	}else{
		$i=floor($i);
	}
	if(2<$i){
		$sql="update g5_lotto set rank='$rankArr[$i]' where idx='$row[idx]'";
		sql_query($sql);
	}
}
goto_url("./lotto.config.php?whereCurrentTurn=$whereCurrentTurn");




			
?>