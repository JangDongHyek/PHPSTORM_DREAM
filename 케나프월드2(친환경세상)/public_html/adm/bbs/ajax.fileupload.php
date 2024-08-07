<?
	include_once("./_common.php");
	$dotIndexOf=strpos($_FILES['file']['name'],".")+1;
	$imgLength=strlen($_FILES['file']['name']);
	$ext=strtolower(substr($_FILES['file']['name'],$dotIndexOf,$imgLength));//확장자
	
	$uploadPath=G5_PATH."/data/banner/";
	$filename=date("YmdHis").".".$ext;
	if(!move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath.$filename)){
		echo "오류";
		exit;
	}
	
?>
	<input type="hidden" name="image<?=$no?>" value="<?=$filename?>">
	<img src="<?=G5_DATA_URL?>/banner/<?=$filename?>" width="300">
<? 
	
?>