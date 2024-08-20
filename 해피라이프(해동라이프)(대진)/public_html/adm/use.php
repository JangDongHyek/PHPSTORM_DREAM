<?php
$sub_menu = "200600";
include_once('./_common.php');
include_once ("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '이용리스트';
include_once('./admin.head.php');
?>

<div id="vueApp">
    <use-list></use-list>
</div>

<?php
$jl->vueLoad("vueApp");
$jl->includeDir("/component/use");
$jl->includeDir("/component/slot");
$jl->includeDir("/component/part");
?>

<?php
include_once ('./admin.tail.php');
?>
