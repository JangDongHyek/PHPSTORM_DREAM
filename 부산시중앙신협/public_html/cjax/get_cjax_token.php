<?php
include_once('./_common.php');

$token = md5(uniqid(rand(), true));
if($token_type == null || $token_type == "") set_session('ss_cjax_token', $token);
else set_session('ss_cjax_'.$token_type.'_token', $token);


die(json_encode(array('token'=>$token)));

