<?
$ym = date('ym');

$url_gubun = explode("~",$PHP_SELF);

if($url_gubun[1]!=""){//��������
	$url_gubun_ex = explode("/",$url_gubun[1]);
	$data_dir =  $_SERVER['DOCUMENT_ROOT'].'/data/editor/'.$ym.'/';
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/~'.$url_gubun_ex[0].'/data/editor/'.$ym.'/';
	
}else{//����������
	$data_dir =  $_SERVER['DOCUMENT_ROOT'].'/data/editor/'.$ym.'/';
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/data/editor/'.$ym.'/';
}


echo $data_url;
?>