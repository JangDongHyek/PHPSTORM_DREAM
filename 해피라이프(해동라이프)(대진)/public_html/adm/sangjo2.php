<?php
$sub_menu = "200800";
include_once('./_common.php');
include_once ("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '적립금 신청 리스트';
include_once('./admin.head.php');
?>

<div id="vueApp">
    <sangjo-list version="2"></sangjo-list>
</div>

<?php
$jl->vueLoad("vueApp");
$jl->includeDir("/component/sangjo");
$jl->includeDir("/component/slot");
$jl->includeDir("/component/part");
?>

<?php
include_once ('./admin.tail.php');
?>
