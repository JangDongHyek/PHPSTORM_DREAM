<?php
$sub_menu = "300100";
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

auth_check($auth[$sub_menu], 'r');

if($_GET['type'] == "1") $title = "일반 매장 배달대행 문의";
if($_GET['type'] == "2") $title = "기업 본사 배달제휴 문의";
if($_GET['type'] == "3") $title = "라이더 지원";
$g5['title'] = $title;
include_once('./admin.head.php');

?>

<div id="app">
    <form<?=$_GET['type']?>-list></form<?=$_GET['type']?>-list>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("form");
$jl->componentLoad("item");
?>

<?php
include_once ('./admin.tail.php');
?>
