<?php
$pid = "lost_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

$wr_2 = $_GET['tab'] == 1 ? '습득' : '분실'
?>
<div id="app">
    <div id="lost" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./lost'"><i class="fa-solid fa-arrow-left"></i> <?=$wr_2?> 목록</button>

        <bbs-lost-input mb_no="<?=$member['mb_no']?>" wr_2="<?=$wr_2?>"></bbs-lost-input>
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