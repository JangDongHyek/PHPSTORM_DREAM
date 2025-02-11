<?php
$pid = "lost";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="lost" class="main">
        <div class="slogan">
            <button type="button" class="btn btn_colorline btn-large" onclick="location.href='./lost_form?tab=1'">주웠어요</button>
            <button type="button" class="btn btn_colorline btn-large" onclick="location.href='./lost_form?tab=2'">잃어버렸어요</button>
        </div>

        <bbs-lost-list admin="<?=$is_admin?>"></bbs-lost-list>
    </div>
</div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/lost");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>