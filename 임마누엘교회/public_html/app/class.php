<?php
$pid = "class";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>

<div id="app">
    <class-main></class-main>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/class");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>
<?php
include_once("./app_tail.php");
?>