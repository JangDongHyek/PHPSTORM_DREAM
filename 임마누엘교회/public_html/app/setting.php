<?php
$pid = "setting";
include_once("./app_head.php");
include_once('../jl/JlConfig.php');

?>
    <div id="setting" >
        <div>
            <div id="app" >
                <site-setting></site-setting>
            </div>
        </div>
    </div>

<?
$jl->vueLoad('app');
$jl->componentLoad('/adm');

?>
<?php
include_once("./app_tail.php");
?>