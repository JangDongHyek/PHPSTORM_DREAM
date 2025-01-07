<?php
include_once("./_common.php");
if($sch){
	$where = " and wr_subject like ('%$sch%') or wr_1 like ('%$sch%')";
}
$addColumn=",(6371*acos(cos(radians($myLng))*cos(radians(wr_7))*cos(radians(wr_8)-radians($myLat))+sin(radians($myLng))*sin(radians(wr_8))))	AS distance";
$sql="select * $addColumn from g5_write_franchise where 1 $where order by distance asc";
$result=sql_query($sql);
$json=array();
for($i=0;$row=sql_fetch_array($result);$i++){
	$json[$i]['wr_id']=$row[wr_id];
	$json[$i]['lat']=$row[wr_7];
	$json[$i]['lng']=$row[wr_8];
	$json[$i]['title']=$row[wr_subject];
	$json[$i]['addr']=$row[wr_1];
	$json[$i]['latlng']="new kakao.maps.LatLng(".$row[wr_7].", ".$row[wr_8].")";
}

echo json_encode($json,JSON_UNESCAPED_UNICODE);

