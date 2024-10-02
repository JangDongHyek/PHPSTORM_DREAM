<?php
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = $title;
include_once('./admin.head.php');

$colspan = 7;
include_once("./json/".$url."_form.php");
?>



<?php
include_once ('./admin.tail.php');
?>