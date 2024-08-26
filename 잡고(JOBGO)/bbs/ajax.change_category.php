<?php
include_once('./_common.php');

$category1 = $_POST['category1'];

$result = common_code($category1,'code_p_idx','html');
echo $result;
?>