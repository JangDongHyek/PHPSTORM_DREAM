<?php
/**
 * AOS, IOS에서 받은 좌표 쿠키설정
 */
include_once ("../common.php");

//$json = array();
//$json['refresh'] = true;
//$json['post'] = $_POST;

set_cookie('cc_cur_lat', $_POST['my_lat'], 86400 * 31 * 9999);
set_cookie('cc_cur_lng', $_POST['my_lng'], 86400 * 31 * 9999);


//die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));