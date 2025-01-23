<?php
$pid = "pray_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

?>

    <div id="app">
        <div id="prayer" class="view">
            <div class="box_radius box_white table">
                <bbs-prayer-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" mb_1="<?=$member['mb_1']?>"></bbs-prayer-view>
            </div>
        </div>
    </div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>