<? 
include_once('./_common.php');
$dotIndexOf=strpos($_FILES['file']['name'],".")+1;
$imgLength=strlen($_FILES['file']['name']);
$ext=strtolower(substr($_FILES['file']['name'],$dotIndexOf,$imgLength));//확장자
$uploadPath=G5_DATA_PATH."/member/";
$filename=$member[mb_id]."_".date("YmdHis").".".$ext;
if(!move_uploaded_file($_FILES['file']['tmp_name'],$uploadPath.$filename)){
	$jsonArray['success']="오류";
}else{
	$jsonArray['success']="성공";
}
$jsonArray["filename"]=$filename;
$jsonArray["imgsrc"]=G5_URL."/data/member/".$filename;
$output=json_encode($jsonArray,JSON_UNESCAPED_UNICODE);
echo $output;
?>