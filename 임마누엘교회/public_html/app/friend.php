<?php
$pid = "friend";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <div id="friend">
        <div class="slogan">
            <h5>IMC 교우의 소식을 들으시고<br>
                위로, 축하, 격려, 기도를 해주세요.</h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./friend_form'">소식작성하기</button>
        </div>
        <div class=" box_radius box_white">
            <h6>교우소식 보기</h6>
            <bbs-friend-list></bbs-friend-list>
        </div>
    </div>
</div>
<?
$jl->vueLoad('app');
$jl->componentLoad("/bbs/friend");
$jl->componentLoad("/item");
?>
<?php
include_once("./app_tail.php");
?>