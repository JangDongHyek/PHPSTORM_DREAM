<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$reg_mb_company_num = trim($_POST['reg_mb_company_num']);
$mb_id = trim($_POST['reg_mb_id']);

if ($msg = exist_mb_company_num($reg_mb_company_num, $mb_id)) die($msg);
?>