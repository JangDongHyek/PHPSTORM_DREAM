<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
//include_once("./_common.php");

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING ); 

@include_once("./JSON.php");

if( !function_exists('json_encode') ) {
    function json_encode($data) {
        $json = new Services_JSON();
        return( $json->encode($data) );
    }
}

@ini_set('gd.jpeg_ignore_warning', 1);

$ym = date('ym');


$url_gubun = explode("~",$PHP_SELF);

if($url_gubun[1]!=""){//계정접속
	$url_gubun_ex = explode("/",$url_gubun[1]);
	$data_dir =  '/home/'.$url_gubun_ex[0].'/public_html/data/editor/'.$ym.'/';
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/~'.$url_gubun_ex[0].'/data/editor/'.$ym.'/';
	
}else{//도메인접속
	$data_dir =  $_SERVER['DOCUMENT_ROOT'].'/data/editor/'.$ym.'/';
	$data_url =  "http://" .$_SERVER['SERVER_NAME'].'/data/editor/'.$ym.'/';
}


@umask(0);
@mkdir($data_dir,0707);
@chmod($data_dir,0707);



if(!function_exists('ft_nonce_is_valid')){
   include_once('../../../editor.lib.php');
}

$is_editor_upload = false;

//if( isset($_GET['_nonce']) && ft_nonce_is_valid( $_GET['_nonce'] , 'smarteditor' ) ){
    $is_editor_upload = true;
//}

if( $is_editor_upload ) {

    require('UploadHandler.php');
    $options = array(
        'upload_dir' => $data_dir,
        'upload_url' => $data_url,
        // This option will disable creating thumbnail images and will not create that extra folder.
        // However, due to this, the images preview will not be displayed after upload
        'image_versions' => array()
    );

    $upload_handler = new UploadHandler($options);

} else {
    echo json_encode(array('files'=>array('0'=>array('error'=>'정상적인 업로드가 아닙니다.'))));
    exit;
}