<?php
//사용하지 않으니 막아놓겠습니다.
exit;

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
@mkdir($data_dir,0707);
@chmod($data_dir,0707);



 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$file = new stdClass;
	//$file->name = str_replace("\0", "", rawurldecode($headers['file_name']));
    $file->name = str_replace("\0", "", rawurldecode($headers['file_name']));
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));

    if (!preg_match("/(jpe?g|gif|bmp|png)$/i", $filename_ext)) {
        echo "NOTALLOW_".$file->name;
        exit;
    }
    
	//$file_name = iconv("utf-8", "cp949", $file->name);
    $file_name = sprintf('%u', ip2long($_SERVER['REMOTE_ADDR'])).'_'.get_microtime().".".$filename_ext;
    $newPath = $data_dir."/".$file_name;
    $save_url = sprintf('%s/%s', $data_url, $file_name);

    if(file_put_contents($newPath, $file->content)) {
        $sFileInfo .= "&bNewLine=true";
        $sFileInfo .= "&sFileName=".$file->name;
        $sFileInfo .= "&sFileURL=".$save_url;
    }
    
    echo $sFileInfo;
?>