<?php
include_once('./_common.php');

$sql="select * from g5_dmenu_category where bo_table='$bo_table' and wr_id='$wr_id' order by idx asc";
$result=sql_query($sql);
$idxArray=array();
$idx2Array=array();
$i=0;
while($row=sql_fetch_array($result)){
	$idxArray[$i]=$row[idx];

	$i++;
}

for($i=0;$i<count($cat_name);$i++){
	$idx2Array[$i]=$idx[$i];
	//카테고리가 일치가 되면 update 아니면 insert
	if($idx[$i]==$idxArray[$i]&&$idx[$i]){
		$sql="update g5_dmenu_category set cat_name='$cat_name[$i]' where idx='$idx[$i]'";
		sql_query($sql);
	}else{
		if($cat_name[$i]){
		$sql="insert g5_dmenu_category set bo_table='$bo_table',wr_id='$wr_id',cat_name='$cat_name[$i]'";
		sql_query($sql);
		}
	}
}
//카테고리 삭제된 것 db에서도 삭제하기
for($i=0;$i<count($idxArray);$i++){
	if($idxArray[$i]!=$idx2Array[$i]){
		$sql="delete from g5_dmenu_category where idx='$idxArray[$i]'";
		sql_query($sql);

		$sql="delete from g5_dmenu where cat_idx='$idxArray[$i]'";
		sql_query($sql);
	}
}

goto_url("./menu.form.php?bo_table=$bo_table&wr_id=$wr_id");
?>