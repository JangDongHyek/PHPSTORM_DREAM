<?php
//사용하지 않으니 막아놓겠습니다.
exit;
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

$ym = date('ym');


$url_gubun = explode("~",$PHP_SELF);

if($url_gubun[1]!=""){//계정접속
	$url_gubun_ex = explode("/",$url_gubun[1]);
	$data_dir =  '/home/'.$url_gubun_ex[0].'/public_html/data/editor/'.$ym;
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/~'.$url_gubun_ex[0].'/data/editor/'.$ym;
	
}else{//도메인접속
	$data_dir =  $_SERVER['DOCUMENT_ROOT'].'/data/editor/'.$ym;
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/data/editor/'.$ym;
}

@umask(0);
@mkdir($data_dir, 0707);
@chmod($data_dir,0707);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	
	if (!preg_match("/(jpe?g|gif|bmp|png)$/i", $filename_ext)) {
		$url .= '&errstr='.$name;
	} else {
		
        $file_name = sprintf('%u', ip2long($_SERVER['REMOTE_ADDR'])).'_'.get_microtime().".".$filename_ext;
		$save_dir = sprintf('%s/%s', $data_dir, $file_name);
        $save_url = sprintf('%s/%s', $data_url, $file_name);
		
		@move_uploaded_file($tmp_name, $save_dir);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".$name;
		$url .= "&sFileURL=".$save_url;
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>