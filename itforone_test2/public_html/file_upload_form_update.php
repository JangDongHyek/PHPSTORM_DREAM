<?php
include_once("./_common.php");
for($i=0;$i<count($_FILES['bf_file']);$i++){
	$dotIndexOf=strpos($_FILES['bf_file']['name'][$i],".")+1;//확장자 구하기

	$imgLength=strlen($_FILES['bf_file']['name'][$i]);//확장자 구하기

	$ext=strtolower(substr($_FILES['bf_file']['name'][$i],$dotIndexOf,$imgLength));//확장자
	$filename=date("YmdHis")."_".$i.".".$ext;//파일명
	echo $_FILES['bf_file']['name'][$i];
	if(!move_uploaded_file($_FILES['bf_file']['tmp_name'][$i],G5_DATA_PATH."/tmp/".$filename)){
		echo "오류";
	}
}

?>