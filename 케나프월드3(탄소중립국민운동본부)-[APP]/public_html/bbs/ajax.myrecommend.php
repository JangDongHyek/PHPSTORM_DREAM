<?php 
include_once("./_common.php");
$mb_idArrStr="";
for($i=0;$i<count($mb_idArr);$i++){
	$mb_idArrStr.="'".$mb_idArr[$i]."',";
}
$mb_idArrStr= substr($mb_idArrStr,0,strlen($mb_idStr)-1);
$jsonArray=array();
$sql="select mb_id,mb_name,mb_recommend from g5_member where mb_recommend in ($mb_idArrStr)";
$jsonArray['sql']=$sql;
$result=sql_query($sql);

$jsonArray['data']=array();
while($row=sql_fetch_array($result)){
		$listArray=array();
		$listArray=$row;
		$sql="select mb_id as recommend_id,mb_name as recommend_name from g5_member where mb_id='$row[mb_recommend]'";
		$row2=sql_fetch($sql);
		$listArray['sql']=$sql;
		$listArray['recommend_id']=$row2['recommend_id'];
		$listArray['recommend_name']=$row2['recommend_name'];
		
		array_push($jsonArray["data"],$listArray);
}

$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
echo stripslashes(trim(strip_tags($output)));
//$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
?>
