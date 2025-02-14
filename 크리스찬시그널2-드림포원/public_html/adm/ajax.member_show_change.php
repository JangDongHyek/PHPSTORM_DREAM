<?php
$sub_menu = "200100";
include_once('./_common.php');

$mb_no = $_POST['mb_no'];
$show_yn = $_POST['show_yn'];

if($show_yn == '공개') {
    $show_yn = 'Y';
} else {
    $show_yn = 'N';
}

$sql = " update g5_member set show_yn = '{$show_yn}' where mb_no = {$mb_no} ";
$result = sql_query($sql);

die($result);
?>