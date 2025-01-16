<?php
$pid = "friend_form";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
    <div id="app">
        <div id="friend" class="view">
            <button class="btn btn_large btn_back" type="button" onclick="location.href='./friend'"><i class="fa-solid fa-arrow-left"></i> 교우소식 목록</button>
            <bbs-friend-view primary="<?=$_GET['idx']?>"></bbs-friend-view>
        </div>
    </div>

<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/friend");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>
<?php
include_once("./app_tail.php");
?>