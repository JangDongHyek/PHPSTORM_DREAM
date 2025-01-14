<?php
include_once('./_common.php');
include_once('../jl/JlConfig.php');

$g5['title'] = '사이트설정';
include_once('./admin.head.php');
?>

<div id="app">
    <site-setting></site-setting>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad('/adm');

?>
<?php
include_once ('./admin.tail.php');
?>
