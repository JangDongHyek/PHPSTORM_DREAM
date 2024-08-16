<?php
$sub_menu = "200500";
include_once('./_common.php');
include_once ("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '상담리스트';
include_once('./admin.head.php');
?>

<div id="vueApp">
    <consult-list></consult-list>
</div>

<?php
$jl->vueLoad("vueApp");
$jl->includeDir("/component/consult");
?>

<?php
include_once ('./admin.tail.php');
?>
