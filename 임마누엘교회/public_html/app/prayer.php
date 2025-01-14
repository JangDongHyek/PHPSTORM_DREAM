<?php
$pid = "prayer";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");

?>

<div id="app">
    <div id="prayer">
        <div class="slogan">
            <h5>이와 같이 성령도 우리의 연약함을 도우시나니 우리는 마땅히 기도할 바를 알지 못하나<br class="hidden-xs">
                오직 성령이 말할 수 없는 탄식으로 우리를 위하여 친히 간구하시느니라 <span>롬 8:26</span></h5>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./pray_form'">기도요청하기</button>
        </div>
        <div class="box_radius box_white">
            <h6><i class="fa-solid fa-person-praying"></i> 함께 기도해주세요!</h6>

            <bbs-prayer-list></bbs-prayer-list>

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