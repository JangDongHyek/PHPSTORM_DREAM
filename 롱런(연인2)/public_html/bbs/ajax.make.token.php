<?php
include_once('./_common.php');

$name = $_POST['name'];

$name = trim(sql_real_escape_string($name));


$token = md5(uniqid(rand(), true));
set_session("{$name}_token", $token);

echo $token;


?>