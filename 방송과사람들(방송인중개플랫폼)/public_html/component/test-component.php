<?php
//include_once('./_common.php');
//include_once("./model/member_request_conversion.php");
//include_once(G5_PATH."/model/model.php");
//
//$data['member_idx'] = "36";
//$data['permit'] = "false";
//$model = new Car_Engine();
//echo 1;
//
//$aa = new Model("member_request_conversion");
//echo 5;
//for ($i = 0; $i < 10; $i++) {
//    $ss = $aa->post($data);
//}

//echo $ss;
//echo $aa;
$tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $_SERVER['SCRIPT_NAME']);
$document_root = str_replace($tilde_remove, '', $_SERVER['SCRIPT_FILENAME']);
echo $_SERVER['SCRIPT_FILENAME'];
//include_once ("./test2.php");
?>